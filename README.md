## Tech Info Open Platform
包括爬虫、数据库、网站三部分

## 安装配置相关
下面以阿里云的CentOS7.2为例，简单的说明一下。

服务设置:
```java
// 自启动
chkconfig supervisor on
// 查看服务状态（一般服务名后面加个d，为守护进程）
systemctl status supervisord
systemctl restart ...
systemctl stop ...
systemctl enable ...
systemctl disable ...
// 常用服务名
supervisord
nginxd
php-fpm
```

防火墙配置:
```java
// 打开端口，比如80,3306
firewall-cmd --zone=public --add-port=80/tcp --permanent
firewall-cmd --zone=public --add-port=80/udp --permanent
// 重新加载配置
firewall-cmd --reload
// 查看防火墙配置
firewall-cmd --list-all
```

安装php:
```java
yum install php php-fpm
chkconfig php-fpm on
// 安装php mysql扩展
yum install php-mysql
```

安装nginx:
```java
yum install nginx
chkconfig nginx on
```

安装mysql:
```java
// 默认centos7.2已经把mysql换成了mariadb，所以需要手动安装mysql源
// 下载源配置
wget http://dev.mysql.com/get/mysql57-community-release-el7-7.noarch.rpm
// 安装源配置
yum localinstall -y mysql57-community-release-el7-7.noarch.rpm
// 安装mysql
yum install -y mysql-community-server
chkconfig mysqld on
systemctl start mysqld
// 忘记root密码
vim /etc/my.cnf
在[mysqld] 下面加上:
skip-grant-tables
配置项。
// 更改密码
update mysql.user set authentication_string=password('root') where user='root' ;
// 修改密码策略，可设置简单密码
set global validate_password_policy=0;
SET PASSWORD = PASSWORD('<db_password>');
```

定时任务:
```java
crontab -e
crontab -l
```
比如我在6到22点每隔15分钟更新数据库，则通过crontab -e增加下面一条即可：
```java
*/15 6-22 * * * /root/.linuxbrew/bin/python3 /var/www/html/TechInfo/crawl/main.py
```
