variable "aws_region" {
  description = "AWS region"
  default     = "us-east-1"
}

variable "ami_id" {
  description = "Amazon Linux 2023 AMI ID"
  default     = "ami-0ea87431b78a82070"  # Amazon Linux 2023 in us-east-1
}

variable "db_password" {
  description = "RDS MySQL master password"
  type        = string
  sensitive   = true
}

variable "alert_email" {
  description = "Email address for CloudWatch alerts"
  type        = string
  default     = "admin@sprevonix.com"  # CHANGE THIS
}