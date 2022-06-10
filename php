#!/bin/bash
# clear: if you want to clear the above info in the command

echo "Install and Configure"
sudo yum install php php-pear php-mysqlnd -y



echo "
* Edit /etc/php.ini for better error messages and logs, and upgraded performance. These modifications provide a good starting point for a Linode 2GB:File: /etc/php.ini1

error_reporting = E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR

error_log = /var/log/php/error.log

max_input_time = 30

备注：NoteEnsure that all lines noted above are uncommented. A commented line begins with a semicolon (;).

"
vi /etc/php.ini




# Create the log directory for PHP and give the Apache user ownership:
sudo mkdir /var/log/php
sudo chown apache:apache /var/log/php

# Reload Apache:
sudo systemctl reload httpd.service

echo "completed: installed PHP 7.4"










