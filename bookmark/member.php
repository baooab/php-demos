<?php

    require_once('fns/bookmark_fns.php');
    session_start();

    //create short variable names
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $passwd = isset($_POST['passwd']) ? $_POST['passwd'] : '';
    if ($username && $passwd) {
        try  {
            login($username, $passwd);
            $_SESSION['valid_user'] = $username;
        }
        catch(Exception $e)  {
            do_html_header('问题');
            echo '登录失败 ;(<br>';
            do_html_url('login.php', '登录');
            do_html_footer();
            exit;
        }
    }

    do_html_header('会员主页');

    check_valid_user();
    if ($url_array = get_user_urls($_SESSION['valid_user'])) {
        display_user_urls($url_array);
    }
    display_user_menu();

    do_html_footer();

?>
