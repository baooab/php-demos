<?php
// include function files for this application
require_once('fns/bookmark_fns.php');
session_start();

// start output html
do_html_header('添加书签');

check_valid_user();
display_add_bm_form();

display_user_menu();
do_html_footer();

?>
