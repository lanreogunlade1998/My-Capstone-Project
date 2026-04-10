terraform {
  required_providers {
    aws = {
      source = "hashicorp/aws"
      version = "~> 5.0"
    }
  }
}

provider "aws" {
  region = var.aws_region
}

# --- Networking ---
resource "aws_vpc" "main" {
  cidr_block           = "10.0.0.0/16"
  enable_dns_hostnames = true
  tags = {
    Name = "sprevonix-vpc"
  }
}

resource "aws_subnet" "public" {
  vpc_id                  = aws_vpc.main.id
  cidr_block              = "10.0.1.0/24"
  map_public_ip_on_launch = true
  availability_zone       = "${var.aws_region}a"
  tags = {
    Name = "sprevonix-public-subnet"
  }
}

# --- TWO private subnets (required for RDS) ---
resource "aws_subnet" "private1" {
  vpc_id            = aws_vpc.main.id
  cidr_block        = "10.0.2.0/24"
  availability_zone = "${var.aws_region}a"
  tags = {
    Name = "sprevonix-private-subnet-1"
  }
}

resource "aws_subnet" "private2" {
  vpc_id            = aws_vpc.main.id
  cidr_block        = "10.0.3.0/24"
  availability_zone = "${var.aws_region}b"
  tags = {
    Name = "sprevonix-private-subnet-2"
  }
}

resource "aws_internet_gateway" "igw" {
  vpc_id = aws_vpc.main.id
  tags = {
    Name = "sprevonix-igw"
  }
}

resource "aws_route_table" "public" {
  vpc_id = aws_vpc.main.id
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.igw.id
  }
}

resource "aws_route_table_association" "public" {
  subnet_id      = aws_subnet.public.id
  route_table_id = aws_route_table.public.id
}

# ============================================
# MONITORING & SECURITY RESOURCES
# ============================================

# --- SNS Topic for Email Alerts ---
resource "aws_sns_topic" "alerts" {
  name = "sprevonix-alerts"
  tags = {
    Name = "sprevonix-alerts"
  }
}

# Email Subscription (CHANGE THIS EMAIL ADDRESS)
resource "aws_sns_topic_subscription" "email_alerts" {
  topic_arn = aws_sns_topic.alerts.arn
  protocol  = "email"
  endpoint  = var.alert_email  # Add this to variables.tf
}

# --- CloudWatch Log Groups ---
resource "aws_cloudwatch_log_group" "ec2_logs" {
  name              = "/sprevonix/ec2"
  retention_in_days = 30
  tags = {
    Name = "sprevonix-ec2-logs"
  }
}

resource "aws_cloudwatch_log_group" "docker_logs" {
  name              = "/sprevonix/docker"
  retention_in_days = 30
  tags = {
    Name = "sprevonix-docker-logs"
  }
}

resource "aws_cloudwatch_log_group" "rds_logs" {
  name              = "/sprevonix/rds"
  retention_in_days = 30
  tags = {
    Name = "sprevonix-rds-logs"
  }
}

# --- CloudWatch Alarms ---
resource "aws_cloudwatch_metric_alarm" "high_cpu" {
  alarm_name          = "sprevonix-high-cpu"
  comparison_operator = "GreaterThanThreshold"
  evaluation_periods  = 2
  metric_name         = "CPUUtilization"
  namespace           = "AWS/EC2"
  period              = 300
  statistic           = "Average"
  threshold           = 80
  alarm_description   = "Alert when EC2 CPU exceeds 80%"
  
  dimensions = {
    InstanceId = aws_instance.web.id
  }
  
  alarm_actions = [aws_sns_topic.alerts.arn]
}

resource "aws_cloudwatch_metric_alarm" "rds_connections" {
  alarm_name          = "sprevonix-rds-connections"
  comparison_operator = "GreaterThanThreshold"
  evaluation_periods  = 2
  metric_name         = "DatabaseConnections"
  namespace           = "AWS/RDS"
  period              = 300
  statistic           = "Average"
  threshold           = 10
  alarm_description   = "Alert when RDS connections exceed 10"
  
  dimensions = {
    DBInstanceIdentifier = aws_db_instance.main.id
  }
  
  alarm_actions = [aws_sns_topic.alerts.arn]
}

resource "aws_cloudwatch_metric_alarm" "rds_cpu" {
  alarm_name          = "sprevonix-rds-cpu"
  comparison_operator = "GreaterThanThreshold"
  evaluation_periods  = 2
  metric_name         = "CPUUtilization"
  namespace           = "AWS/RDS"
  period              = 300
  statistic           = "Average"
  threshold           = 80
  alarm_description   = "Alert when RDS CPU exceeds 80%"
  
  dimensions = {
    DBInstanceIdentifier = aws_db_instance.main.id
  }
  
  alarm_actions = [aws_sns_topic.alerts.arn]
}

resource "aws_cloudwatch_metric_alarm" "web_status_check" {
  alarm_name          = "sprevonix-web-status"
  comparison_operator = "LessThanThreshold"
  evaluation_periods  = 2
  metric_name         = "StatusCheckFailed"
  namespace           = "AWS/EC2"
  period              = 300
  statistic           = "Average"
  threshold           = 1
  alarm_description   = "Alert when EC2 status check fails"
  
  dimensions = {
    InstanceId = aws_instance.web.id
  }
  
  alarm_actions = [aws_sns_topic.alerts.arn]
}

# --- CloudWatch Dashboard ---
resource "aws_cloudwatch_dashboard" "sprevonix" {
  dashboard_name = "sprevonix-monitoring"
  
  dashboard_body = jsonencode({
    widgets = [
      {
        type = "metric"
        properties = {
          metrics = [
            ["AWS/EC2", "CPUUtilization", "InstanceId", aws_instance.web.id, { "label" = "EC2 CPU" }],
            ["AWS/RDS", "CPUUtilization", "DBInstanceIdentifier", aws_db_instance.main.id, { "label" = "RDS CPU" }]
          ]
          period = 300
          stat   = "Average"
          region = var.aws_region
          title  = "CPU Utilization"
        }
      },
      {
        type = "metric"
        properties = {
          metrics = [
            ["AWS/EC2", "NetworkIn", "InstanceId", aws_instance.web.id],
            ["AWS/EC2", "NetworkOut", "InstanceId", aws_instance.web.id]
          ]
          period = 300
          stat   = "Sum"
          region = var.aws_region
          title  = "EC2 Network Traffic"
        }
      },
      {
        type = "metric"
        properties = {
          metrics = [
            ["AWS/RDS", "DatabaseConnections", "DBInstanceIdentifier", aws_db_instance.main.id],
            ["AWS/RDS", "FreeStorageSpace", "DBInstanceIdentifier", aws_db_instance.main.id]
          ]
          period = 300
          stat   = "Average"
          region = var.aws_region
          title  = "RDS Metrics"
        }
      }
    ]
  })
}

# --- IAM Role for CloudWatch Agent (Security) ---
resource "aws_iam_role" "cloudwatch_agent" {
  name = "sprevonix-cloudwatch-agent-role"
  
  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Action = "sts:AssumeRole"
        Effect = "Allow"
        Principal = {
          Service = "ec2.amazonaws.com"
        }
      }
    ]
  })
  
  tags = {
    Name = "sprevonix-cloudwatch-role"
  }
}

resource "aws_iam_role_policy_attachment" "cloudwatch_agent" {
  role       = aws_iam_role.cloudwatch_agent.name
  policy_arn = "arn:aws:iam::aws:policy/CloudWatchAgentServerPolicy"
}

resource "aws_iam_instance_profile" "cloudwatch_agent" {
  name = "sprevonix-cloudwatch-profile"
  role = aws_iam_role.cloudwatch_agent.name
}

# --- Security Groups (Enhanced with descriptions) ---
resource "aws_security_group" "web" {
  name        = "sprevonix-web-sg"
  description = "Security group for Sprevonix web server"
  vpc_id      = aws_vpc.main.id

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
    description = "HTTP web traffic"
  }

  ingress {
    from_port   = 443
    to_port     = 443
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
    description = "HTTPS web traffic"
  }

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
    description = "SSH access (restrict in production)"
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
    description = "Allow all outbound traffic"
  }

  tags = {
    Name = "sprevonix-web-sg"
  }
}

resource "aws_security_group" "rds" {
  name        = "sprevonix-rds-sg"
  description = "Security group for Sprevonix RDS database"
  vpc_id      = aws_vpc.main.id

  ingress {
    from_port       = 3306
    to_port         = 3306
    protocol        = "tcp"
    security_groups = [aws_security_group.web.id]
    description     = "MySQL access only from web servers"
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
    description = "Allow all outbound traffic"
  }

  tags = {
    Name = "sprevonix-rds-sg"
  }
}

# --- RDS MySQL (with enhanced monitoring) ---
resource "aws_db_subnet_group" "main" {
  name        = "sprevonix-db-subnet"
  subnet_ids  = [aws_subnet.private1.id, aws_subnet.private2.id]
  description = "Database subnet group for Sprevonix"
  
  tags = {
    Name = "sprevonix-db-subnet"
  }
}

resource "aws_db_instance" "main" {
  identifier     = "sprevonix-db"
  engine         = "mysql"
  engine_version = "8.0"
  instance_class = "db.t3.micro"
  allocated_storage = 20
  storage_type   = "gp2"
  db_name        = "sprevonix"
  username       = "admin"
  password       = var.db_password
  
  db_subnet_group_name   = aws_db_subnet_group.main.name
  vpc_security_group_ids = [aws_security_group.rds.id]
  skip_final_snapshot    = true
  publicly_accessible    = false
  
  # Backup configuration (Security)
  backup_retention_period = 7
  backup_window          = "03:00-04:00"
  maintenance_window     = "Mon:04:00-Mon:05:00"
  
  # Enable deletion protection for production (Security)
  deletion_protection = false  # Set to true for production
  
  # Enable performance insights (Monitoring)
  performance_insights_enabled = true
  performance_insights_retention_period = 7

  tags = {
    Name = "sprevonix-rds"
  }
}

# --- EC2 Instance with IAM Profile for CloudWatch ---
resource "aws_instance" "web" {
  ami                    = var.ami_id
  instance_type          = "t3.micro"
  key_name               = "github-actions-key"
  subnet_id              = aws_subnet.public.id
  vpc_security_group_ids = [aws_security_group.web.id]
  
  # Attach IAM profile for CloudWatch monitoring
  iam_instance_profile = aws_iam_instance_profile.cloudwatch_agent.name
  
  user_data = templatefile("${path.module}/user_data.sh", {
    DB_HOST = aws_db_instance.main.endpoint
    DB_USER = aws_db_instance.main.username
    DB_NAME = aws_db_instance.main.db_name
    DB_PASS = var.db_password
  })
  
  tags = {
    Name = "sprevonix-web"
  }
  
  # Enable detailed monitoring (CloudWatch)
  monitoring = true
  
  # Root volume encryption (Security)
  root_block_device {
    encrypted   = true
    volume_size = 20
    volume_type = "gp3"
    tags = {
      Name = "sprevonix-root-volume"
    }
  }
}

# --- Outputs ---
output "instance_public_ip" {
  value = aws_instance.web.public_ip
  description = "Public IP of the EC2 instance"
}

output "rds_endpoint" {
  value = aws_db_instance.main.endpoint
  description = "RDS database endpoint"
}

output "cloudwatch_dashboard_url" {
  value = "https://console.aws.amazon.com/cloudwatch/home?region=${var.aws_region}#dashboards:name=sprevonix-monitoring"
  description = "CloudWatch Dashboard URL"
}

output "sns_alert_topic" {
  value = aws_sns_topic.alerts.arn
  description = "SNS Topic ARN for alerts"
}