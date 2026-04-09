variable "aws_region" {
  default = "us-east-1"
}

variable "ami_id" {
  description = "Amazon Linux 2023 AMI for us-east-1"
}

variable "db_password" {
  description = "RDS MySQL password"
  sensitive   = true
}