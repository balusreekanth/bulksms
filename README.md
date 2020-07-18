###### Its been long time since we last deployed and tested this .Please write your comments in Issues section if you find any issue. If you want to contribute to this repo , please feel free  to open pull requests or contact me at balusreekanth(at)gmail(dot)com





################ Automated SMS broadcasting Web Application ###########


# What is this for ?

With this open source automated sms broadcasting applicaion you can send secheduled sms .

This is  PHP front end for [Gammu-smsd](https://wammu.eu/smsd/) . You can use this application as  SMS marketing application for a small size business or you can use it  to schedule broadcast SMS greetings for birthday events etc.,.



# Prerequistes 

[gammu-smsd](http://download.opensuse.org/repositories/home:/Nijel/CentOS_CentOS-6/x86_64/gammu-1.33.0-2.2.x86_64.rpm) , Mysql , Php , Apache ( webserver) installed 


# How to deploy ?

#### STEP1 : install gammu-smsd on cent OS system . 

The procedure might be different for another distro , please check the gammu installation guide for other OS like Debian system

yum groupinstall 'Development Tools'

yum install gcc gcc-c++ ncurses-devel

##### Install cmake

cd /tmp/

wget http://www.cmake.org/files/v3.0/cmake-3.0.0.tar.gz

tar -zxvf cmake-3.0.0.tar.gz

cd cmake-3.0.0

.bootstrap
gmake
gmake install

check cmake installed

cmake -version

##### Install gammu 64 bit


wget http://download.opensuse.org/repositories/home:/Nijel/CentOS_CentOS-6/x86_64/gammu-1.33.0-2.2.x86_64.rpm

yum install gammu-1.33.0-2.2.x86_64.rpm -y


check modem are used 

dmesg

gammu --identify

gammu-config


#### STEP2:   clone git repositoy 


cd ~/

git clone https://github.com/SipCoSystems/bulksms.git  bulksms



Create mysql database:

create database poc_sms;


mysql -uroot -p poc_sms  < /root/bulksms/poc_sms.sql


-----

edit file   /etc/gammu-smsdrc


[gammu]
device = /dev/ttyACM0
model = E173 (E173)
connection = at115200

[smsd]
service = sql
driver = native_mysql
#########if your SIM needs pin
PIN = 1234
logfile = /var/log/gammu/smsdlog
debuglevel = 1
########runonreceive = /some/script
commtimeout = 30
sendtimeout = 30
user =  
password = 
pc = localhost
database = poc_sms


start gammu-smsd now

gammu-smsd --daemon

check if gammu process is running 

ps aux | grep gammu-smsd

check logs 

tail -f /var/log/gammu/smsdlog

---------------------

#### STEP3: Copy files to webserver root directory 

mkdir -p /var/www/html/bulksms

cp -r ~/bulksms/*  /var/www/html/bulksms

Now change configuration files in Application Dircetory 
/var/www/html/bulksms/application/config/config.php
and
/var/www/html/bulksms/application/config/database.php


## Need Help ?

you can contact me at balusreekanth(at)gmail(dot)com  or open issue  
