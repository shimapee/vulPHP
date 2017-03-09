FROM centos:6

RUN set -x && \
yum update -y && \
yum install -y git && \
yum install -y http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm && \
yum install -y mysql-server && \
rpm -Uvh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm && \
rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm && \
yum install --enablerepo=remi --enablerepo=remi-php55 -y php php-mbstring php-mysqlnd php-pdo && \
chkconfig httpd on && \
chkconfig mysqld on && \
sed -i -e "$ a \[client]\ndefault-character-set=utf8" /etc/my.cnf && \
service mysqld start && \
git clone https://github.com/shimapee/vulPHP.git /var/tmp/tbkdemo && \
mysql -u root < /var/tmp/tbkdemo/sql/create-table.sql && \
cp -r /var/tmp/tbkdemo/TBK-HM /var/www/html && \
chown -R apache:apache /var/www/html/TBK-HM 

EXPOSE 80

ENTRYPOINT /etc/init.d/mysqld start && httpd -D FOREGROUND
