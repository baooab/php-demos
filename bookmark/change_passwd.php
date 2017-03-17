<?php

    require_once('fns/bookmark_fns.php');
    session_start();

    // create short variable names
    $old_passwd = $_POST['old_passwd'];
    $new_passwd = $_POST['new_passwd'];
    $new_passwd2 = $_POST['new_passwd2'];

    do_html_header('修改密码');

    check_valid_user();
    try {
        // 校验表单是否填写完整
        if (!filled_out($_POST)) {
            throw new Exception('表单没有填写完整');
        }
        // 输入密码是否一致
        if ($new_passwd != $new_passwd2) {
            throw new Exception('两次输入密码不一致');
        }
        // 校验密码长度
        if ((strlen($new_passwd) < 6) || (strlen($new_passwd) > 16)) {
            throw new Exception('密码应该是 6~16 位字符');
        }
        // attempt update
        change_password($_SESSION['valid_user'], $old_passwd, $new_passwd);
        echo '密码已修改，请记好密码 ;)';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    display_user_menu();

    do_html_footer();

?>
