#!/bin/bash
# clear: if you want to clear the above info in the command
echo "updating php..."

echo "updating the server..."
yum install epel-release yum-utils -y
yum update -y

echo "checking the version of php..."
php -v

echo "List all the PHP packages you have installed into a file, so you can refer to it to install all those packages in PHP 7.4"
rpm -qa | grep php > php_rpm.txt


echo "remove all the installed PHP packages..."
yum remove "php*" -y

echo "Install the updated Remi repository if it is not already installed."
yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm


echo "Enable the PHP 7.4 repository, install the core and required PHP packages."
yum --enablerepo=remi-php74 install php php-pdo php-fpm php-gd php-mbstring php-mysql php-curl php-mcrypt php-json -y



echo "Check the updated PHP version."
php -v

echo "Restart Apache to use the newly installed PHP 7.4"
systemctl restart httpd



echo "Install and Configure"
sudo yum install php php-pear php-mysqlnd -y

echo "
* Edit /etc/php.ini for better error messages and logs, and upgraded performance. These modifications provide a good starting point for a Linode 2GB:File: /etc/php.ini1

error_reporting = E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR

error_log = /var/log/php/error.log

max_input_time = 30

备注：NoteEnsure that all lines noted above are uncommented. A commented line begins with a semicolon (;).

"

# Create the log directory for PHP and give the Apache user ownership:
sudo mkdir /var/log/php
sudo chown apache:apache /var/log/php

# Reload Apache:
sudo systemctl reload httpd.service












