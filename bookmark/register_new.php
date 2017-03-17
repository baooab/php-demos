<?php

    require_once('fns/bookmark_fns.php');

    session_start();

    $email = $_POST['email'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $passwd2 = $_POST['passwd2'];

    try {
        // 校验表单是否填写完整
        if (!filled_out($_POST)) {
            throw new Exception('表单没有填写完整');
        }
        // 校验 Email 地址是否有效
        if (!valid_email($email)) {
            throw new Exception('邮件地址无效');
        }
        // 输入密码是否一致
        if ($passwd != $passwd2) {
            throw new Exception('两次输入密码不一致');
        }
        // 校验密码长度
        if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
            throw new Exception('密码应该是 6~16 位字符');
        }

        // 注册用户
        register($username, $email, $passwd);
        $_SESSION['valid_user'] = $username;

        // 页面显示注册成功后的内容
        do_html_header('注册成功');
        echo '去会员页添加书签吧！';
        do_html_url('member.php', '去会员页');
        do_html_footer();

    } catch (Exception $e) {
        do_html_header('问题：');
        echo $e->getMessage() . ' - 请返回重试 ;(';
        do_html_footer();
        exit;
    }

?>
