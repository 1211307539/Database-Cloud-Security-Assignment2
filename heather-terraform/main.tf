
provider "aws" {
  region = "us-east-1"
}

resource "aws_vpc" "heather_vpc" {
  cidr_block = "10.0.0.0/16"
  tags = {
    Name = "heather-vpc"
  }
}

resource "aws_subnet" "public_subnet" {
  vpc_id            = aws_vpc.heather_vpc.id
  cidr_block        = "10.0.1.0/24"
  availability_zone = "us-east-1a"
  tags = {
    Name = "heather-public"
  }
}

resource "aws_subnet" "private_subnet" {
  vpc_id            = aws_vpc.heather_vpc.id
  cidr_block        = "10.0.2.0/24"
  availability_zone = "us-east-1b"
  tags = {
    Name = "heather-private"
  }
}

resource "aws_internet_gateway" "heather_igw" {
  vpc_id = aws_vpc.heather_vpc.id
  tags = {
    Name = "heather-igw"
  }
}

resource "aws_route_table" "public_rt" {
  vpc_id = aws_vpc.heather_vpc.id
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.heather_igw.id
  }
  tags = {
    Name = "heather-public-rt"
  }
}

resource "aws_route_table_association" "public_subnet_assoc" {
  subnet_id      = aws_subnet.public_subnet.id
  route_table_id = aws_route_table.public_rt.id
}

resource "aws_security_group" "web_sg" {
  name        = "web-sg"
  description = "Allow HTTP and SSH"
  vpc_id      = aws_vpc.heather_vpc.id

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
}

resource "aws_instance" "web" {
  ami                         = "ami-0c55b159cbfafe1f0"
  instance_type               = "t2.micro"
  subnet_id                   = aws_subnet.public_subnet.id
  vpc_security_group_ids      = [aws_security_group.web_sg.id]
  associate_public_ip_address = true

  tags = {
    Name = "heather-webserver"
  }

  user_data = <<-EOF
              #!/bin/bash
              yum update -y
              yum install -y httpd php php-mysqlnd git
              systemctl start httpd
              systemctl enable httpd
              cd /var/www/html
              git clone https://github.com/1211307539/Database-Cloud-Security-Assignment1.git .
              EOF
}
