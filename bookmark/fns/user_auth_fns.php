<?php

require_once('db_fns.php');

// 校验注册信息
function register($username, $email, $password) {
  $conn = db_connect();

  $result = $conn->query("select * from user where username='".$username."'");
  if (!$result) {
    throw new Exception('Could not execute query');
  }

  if ($result->num_rows>0) {
    throw new Exception('That username is taken - go back and choose another one.');
  }

  $result = $conn->query("insert into user values
                         ('".$username."', sha1('".$password."'), '".$email."')");
  if (!$result) {
    throw new Exception('Could not register you in database - please try again later.');
  }

  return true;
}

// 校验登录信息
function login($username, $password) {
    $conn = db_connect();

    $result = $conn->query("select * from user
                           where username='".$username."'
                           and passwd = sha1('".$password."')");
    if (!$result) {
       throw new Exception('登录失败。');
    }

    if ($result->num_rows > 0) {
       return true;
    } else {
       throw new Exception('登录失败');
    }
}

// 校验用户是否登录 & 给出提示信息
function check_valid_user() {
  if (isset($_SESSION['valid_user']))  {
      echo "使用账号 " . $_SESSION['valid_user'] . " 登录。<br />";
  } else {
     do_html_heading('问题：');
     echo '你还没登录呢。<br />';
     do_html_url('login.php', '登录');
     do_html_footer();
     exit;
  }
}

// 修改用户密码
function change_password($username, $old_password, $new_password) {

  login($username, $old_password);
  $conn = db_connect();
  $result = $conn->query("update user
                          set passwd = sha1('".$new_password."')
                          where username = '".$username."'");
  if (!$result) {
    throw new Exception('修改密码失败 ;(');
  }

  return true;
}

// function get_random_word($min_length, $max_length) {

//   $word = '';
//   $dictionary = 'E:/wamp/www/t/php_and_mysql_web_development/Chapter 28/fns/dict/words';
//   $fp = @fopen($dictionary, 'r');
//   if(!$fp) {
//     return false;
//   }
//   $size = filesize($dictionary);
//   $rand_location = rand(0, $size);
//   fseek($fp, $rand_location);

//   // get the next whole word of the right length in the file
//   while ((strlen($word) < $min_length) || (strlen($word)>$max_length) || (strstr($word, "'"))) {
//      if (feof($fp)) {
//         fseek($fp, 0);        // if at end, go to start
//      }
//      $word = fgets($fp, 80);  // skip first word as it could be partial
//      $word = fgets($fp, 80);  // the potential password
//   }
//   $word = trim($word); // trim the trailing \n from fgets
//   return $word;
// }

// function reset_password($username) {
// // set password for username to a random value
// // return the new password or false on failure
//   // get a random dictionary word b/w 6 and 13 chars in length
//   $new_password = get_random_word(6, 13);

//   if($new_password == false) {
//     throw new Exception('不能产生新密码');
//   }

//   // add a number  between 0 and 999 to it
//   // to make it a slightly better password
//   $rand_number = rand(0, 999);
//   $new_password .= $rand_number;

//   // set user's password to this in database or return false
//   $conn = db_connect();
//   $result = $conn->query("update user
//                           set passwd = sha1('".$new_password."')
//                           where username = '".$username."'");
//   if (!$result) {
//     throw new Exception('Could not change password.');
//   } else {
//     return $new_password;  // changed successfully
//   }
// }

// function notify_password($username, $password) {
//     $conn = db_connect();
//     $result = $conn->query("select email from user where username='" . $username . "'");

//     if (!$result || $result->num_rows == 0) {
//       throw new Exception('不能得到 Email 地址。');
//     } else {
//       $row = $result->fetch_object();
//       $email = $row->email;
//       $from = "From: 3183442656@qq.com \r\n";
//       $mesg = "你的密码改成 " . $password . " 了\r\n" . "请及时登录后改密码。\r\n";

//       $to = $row->email;
//       $subject = "【书签采集】登录信息";
//       $txt = "你的密码改成 " . $password . " 了\r\n" . "请及时登录后改密码。\r\n";
//       $headers = "From: 3183442656@qq.com" . "\r\n" . "CC: 3183442656@qq.com";

//       if (mail($to,$subject,$txt,$headers)) {
//           return true;
//       } else {
//           throw new Exception('不能发送 Email。');
//       }
//     }
// }

?>
