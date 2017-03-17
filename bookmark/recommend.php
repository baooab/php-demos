<?php

    require_once('fns/bookmark_fns.php');
    session_start();

    do_html_header('推荐链接');

    check_valid_user();
    try   {
        $urls = recommend_urls($_SESSION['valid_user']);
        display_recommended_urls($urls);
    } catch(Exception $e)   {
        echo $e->getMessage();
    }
    display_user_menu();

    do_html_footer();

?>
