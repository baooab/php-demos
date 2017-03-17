<?php

function db_connect() {
   $result = new mysqli('localhost', 'zhangb', '123456', 'book_sc');
   // 返回当前数据库连接的默认字符编码
   //var_dump($result->character_set_name());
   $result->query('set names utf8');
   if (!$result) {
      return false;
   }
   $result->autocommit(TRUE);
   return $result;
}

function db_result_to_array($result) {
   $res_array = array();

   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}

?>
