CREATE DATABASE bookmarks /*!40100 DEFAULT CHARACTER SET utf8 */;
USE bookmarks;

CREATE TABLE user  (
  username varchar(16) primary key,
  passwd char(40) not null,
  email varchar(100) not null
) ENGINE=InnoDB;

CREATE TABLE bookmark (
  username varchar(16) not null,
  bm_URL varchar(255) not null,
  index (username),
  index (bm_URL)
) ENGINE=InnoDB;

GRANT SELECT, INSERT, UPDATE, DELETE
on bookmarks.*
TO zhangb@localhost IDENTIFIED BY '123456';