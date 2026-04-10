#!/bin/bash

# Update system
dnf update -y

# Install Docker
dnf install docker -y
systemctl enable docker
systemctl start docker

# Add ec2-user to docker group
usermod -a -G docker ec2-user

# Install CloudWatch Agent
dnf install amazon-cloudwatch-agent -y

# Create CloudWatch Agent configuration
cat > /opt/aws/amazon-cloudwatch-agent/etc/amazon-cloudwatch-agent.json << 'EOF'
{
  "agent": {
    "metrics_collection_interval": 60,
    "run_as_user": "cwagent"
  },
  "metrics": {
    "append_dimensions": {
      "InstanceId": "${aws:InstanceId}"
    },
    "metrics_collected": {
      "mem": {
        "measurement": ["mem_used_percent"],
        "metrics_collection_interval": 60
      },
      "disk": {
        "measurement": ["disk_used_percent"],
        "metrics_collection_interval": 60,
        "resources": ["/"]
      }
    }
  }
}
EOF

# Start CloudWatch Agent
/opt/aws/amazon-cloudwatch-agent/bin/amazon-cloudwatch-agent-ctl -a fetch-config -m ec2 -c file:/opt/aws/amazon-cloudwatch-agent/etc/amazon-cloudwatch-agent.json -s

# Pull and run Docker container
docker pull ghcr.io/lanreogunlade1998/sprevonix:latest
docker run -d --name sprevonix --restart always -p 80:80 \
  -e DB_HOST="${DB_HOST}" \
  -e DB_NAME="${DB_NAME}" \
  -e DB_USER="${DB_USER}" \
  -e DB_PASS="${DB_PASS}" \
  ghcr.io/lanreogunlade1998/sprevonix:latest