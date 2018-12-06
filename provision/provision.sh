#!/bin/bash

# turn off selinux.
if getenforce | grep -v Disabled > /dev/null 2>&1; then
    setenforce 0
    sed -i "s/SELINUX=enforcing/SELINUX=disabled/" /etc/selinux/config
    sed -i "s/SELINUX=permissive/SELINUX=disabled/" /etc/selinux/config
fi

# fast mirror setting
grep prefer /etc/yum/pluginconf.d/fastestmirror.conf 2>&1 > /dev/null
if [ $? -ne 0 ]; then
    echo "prefer=ftp.riken.jp" >> /etc/yum/pluginconf.d/fastestmirror.conf
    yum clean plugins
fi

# タイムゾーンを変更
rm -f /etc/localtime && cp -p /usr/share/zoneinfo/Japan /etc/localtime

# php7
yum -y install epel-release
rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
yum -y install --enablerepo=remi,remi-php71 php-cli php-mbstring php-pdo php-gd php-fpm php-zip php-mysql php-xml php-bcmath php-pecl-imagick php-pecl-memcached php-openssl php-tokenizer

# python
cd /tmp
wget https://bootstrap.pypa.io/ez_setup.py -O - | python
easy_install pip
sudo yum -y install gcc gcc-c++ kernel-devel
sudo yum -y install python-devel
sudo yum -y install libxslt-devel

# scrapyフレームワーク
pip install scrapy

# mysql
yum -y install https://dev.mysql.com/get/mysql57-community-release-el7-9.noarch.rpm
yum -y install mysql-community-server
mysqld --version
systemctl enable mysqld
systemctl start mysqld

# mysql 一時パスワードを取得・変更
cd /vagrant/provision
php mysqlpass.php
temp_password_file=temp_password
for line in `cat ${temp_password_file} | grep -v ^#`
do
    mysql -u root -p"${line}" --connect-expired-password -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'Practice@123';create database site;"
done

# nginx
yum -y install nginx

# nginx 設定
cd /etc/nginx/conf.d
cp default.conf default.conf.org
cp /vagrant/week_trend/provision/default.conf default.conf
mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.org
cp /vagrant/week_trend/provision/nginx.conf /etc/nginx/nginx.conf
systemctl enable nginx
systemctl start nginx

# php-fpmの起動スクリプト
cp /vagrant/provision/php-fpm /etc/init.d/php-fpm
chmod 755 /etc/init.d/php-fpm
mv /etc/php-fpm.d/www.conf /etc/php-fpm.d/www.conf.org
cp /vagrant/week_trend/provision/www.conf /etc/php-fpm.d/www.conf
systemctl enable php-fpm
systemctl start php-fpm

# composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/bin/composer

# cd /vagrant
# composer create-project --prefer-dist laravel/laravel site "5.5.*"

# Laravel設定
sudo cp /vagrant/week_trend/.env.example /vagrant/week_trend/.env
cd /vagrant/week_trend
php artisan key:generate
composer update

# フォルダ権限の変更
chmod -R 777 /vagrant//site/bootstrap/cache
chmod -R 777 /vagrant/site/storage