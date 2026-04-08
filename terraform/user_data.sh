#!/bin/bash
yum update -y
yum install docker -y
systemctl enable docker
systemctl start docker

docker pull ghcr.io/lanreogunlade1998/sprevonix:latest

docker run -d --name sprevonix \
  -p 80:80 \
  -e DB_HOST="${DB_HOST}" \
  -e DB_NAME="${DB_NAME}" \
  -e DB_USER="${DB_USER}" \
  -e DB_PASS="${DB_PASS}" \
  ghcr.io/lanreogunlade1998/sprevonix:latest