/*
  TBKHACK-DEMO
*/
-- database
create database tbkhack_demo character set utf8;

-- database user
grant all on tbkhack_demo.* to 'tbkhack'@'localhost' identified by 'tbkhack2016';

use tbkhack_demo;

-- user table
create table user (
  user_id int(10) not null primary key,
  user_email varchar(100),
  user_name varchar(100),
  user_birthday date,
  user_address varchar(200)
);
insert into user values (100001, 'hackdemo@tbkobenkyo.com', 'デモ太郎', '1990/1/1', '千葉県柏市とある場所');
insert into user values (100002, 'hackmemo@tbkobenkyo.com', 'デモ次郎', '1975/11/22', '東京都足立区とある場所');

-- password table
create table password (
  user_id int(10) not null primary key,
  password varchar(256),
  foreign key (user_id) references user(user_id)
);
insert into password values (100001, '1234abcd');
insert into password values (100002, '5678efgh');


-- book list table
create table book (
  user_id int(10) not null,
  isbn13 varchar(17) not null,
  isbn10 varchar(13),
  bookname varchar(200),
  author varchar(200),
  primary key (user_id,isbn13),
  foreign key (user_id) references user (user_id)
);
insert into book values (100001, '978-4087452761', '408745276X', '天才ハッカー安部響子と五分間の相棒', '一田 和樹');
insert into book values (100001, '978-4041205570', '4041205573', '僕だけがいない街 (1)', '三部 けい');
insert into book values (100001, '978-4062639248', '4062639246', 'すべてがFになる', '森 博嗣');
insert into book values (100001, '978-4062777360', '4062777363', '警視庁情報官 サイバージハード', '濱 嘉之');
insert into book values (100001, '978-4062192026', '4062192020', '掟上今日子の備忘録', '西尾 維新');
insert into book values (100001, '978-4562048908', '4562048905', 'サイバークライム 悪意のファネル', '一田 和樹');
insert into book values (100001, '978-4797361193', '4797361190', '体系的に学ぶ 安全なWebアプリケーションの作り方', '徳丸 浩');
insert into book values (100001, '978-4102020012', '4102020012', 'ロミオとジュリエット', 'シェイクスピア (著), 中野 好夫 (翻訳)');
insert into book values (100001, '978-4063955491', '4063955494', '進撃の巨人(18)', '諫山 創');
insert into book values (100001, '978-4094088960', '4094088962', '下町ロケット', '池井戸 潤');

insert into book values (100002, '978-4094088960', '4094088962', '下町ロケット', '池井戸 潤');
insert into book values (100002, '978-4093864299', '4093864292', '下町ロケット2 ガウディ計画', '池井戸 潤');
insert into book values (100002, '978-4167174033', '4167174030', '池袋ウエストゲートパーク', '石田 衣良');
insert into book values (100002, '978-4163902302', '4163902309', '火花', '又吉 直樹');
insert into book values (100002, '978-4062639248', '4062639246', 'すべてがFになる', '森 博嗣');
-- tag
create table tag (
  tag_id int(100) not null primary key,
  tag_name varchar(100)
);
insert into tag values (1, '日本文学');
insert into tag values (2, '小説');
insert into tag values (3, 'ミステリー');
insert into tag values (4, 'サスペンス');
insert into tag values (5, 'コミック');
insert into tag values (6, 'コンピュータ/IT');
insert into tag values (7, 'WEB');
insert into tag values (8, 'セキュリティ');
insert into tag values (9, '演劇/舞台');

-- book tag
create table booktag (
  user_id int(10),
  isbn13 varchar(17),
  tag_id int(100),
  foreign key (user_id,isbn13) references book (user_id,isbn13),
  foreign key (tag_id) references tag (tag_id)
);
insert into booktag values (100001, '978-4087452761', 2);
insert into booktag values (100001, '978-4087452761', 3);
insert into booktag values (100001, '978-4087452761', 4);
insert into booktag values (100001, '978-4041205570', 5);
insert into booktag values (100001, '978-4062639248', 2);
insert into booktag values (100001, '978-4062639248', 3);
insert into booktag values (100001, '978-4062639248', 4);
insert into booktag values (100001, '978-4062777360', 2);
insert into booktag values (100001, '978-4062777360', 3);
insert into booktag values (100001, '978-4062777360', 4);
insert into booktag values (100001, '978-4062192026', 2);
insert into booktag values (100001, '978-4062192026', 3);
insert into booktag values (100001, '978-4062192026', 4);
insert into booktag values (100001, '978-4562048908', 2);
insert into booktag values (100001, '978-4562048908', 3);
insert into booktag values (100001, '978-4562048908', 4);
insert into booktag values (100001, '978-4797361193', 6);
insert into booktag values (100001, '978-4797361193', 7);
insert into booktag values (100001, '978-4797361193', 8);
insert into booktag values (100001, '978-4102020012', 9);
insert into booktag values (100001, '978-4063955491', 5);
insert into booktag values (100001, '978-4094088960', 1);
insert into booktag values (100001, '978-4094088960', 2);

insert into booktag values (100002, '978-4094088960', 1);
insert into booktag values (100002, '978-4094088960', 2);
insert into booktag values (100002, '978-4093864299', 1);
insert into booktag values (100002, '978-4093864299', 2);
insert into booktag values (100002, '978-4167174033', 1);
insert into booktag values (100002, '978-4167174033', 2);
insert into booktag values (100002, '978-4163902302', 1);
insert into booktag values (100002, '978-4163902302', 2);
insert into booktag values (100002, '978-4062639248', 2);
insert into booktag values (100002, '978-4062639248', 3);
insert into booktag values (100002, '978-4062639248', 4);

-- COMMENT
create table comment (
  isbn13 varchar(17),
  comm_user_id int(10),
  comment varchar(2000)
);

insert into comment values ('978-4041205570', 100001, 'これは最高！バカなの？');
insert into comment values ('978-4041205570', 100002, '面白そうですね。');
