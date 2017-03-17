<?php

// 取得数据库连接
function db_connect() {
    $result = new mysqli('localhost', 'zhangb', '123456', 'bookmarks');
    if (!$result) {
        throw new Exception('无法连接数据库服务器 ;(');
    } else {
        return $result;
    }
}

?>
