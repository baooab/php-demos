<?php

    require_once('fns/bookmark_fns.php');
    session_start();

    $old_user = isset($_SESSION['valid_user']) ? $_SESSION['valid_user'] : '';

    // 销毁 session
    unset($_SESSION['valid_user']);
    $result_dest = session_destroy();

    do_html_header('注销');

    if (!empty($old_user)) {
        if ($result_dest) {
            echo '注销了……<br />';
            do_html_url('login.php', '登录');
        } else {
            echo '注销操作发生异常 - 返回重试<br />';
        }
    } else {
        echo '你还没登录，所以还不能注销<br />';
        do_html_url('login.php', '登录');
    }

    do_html_footer();

?>
