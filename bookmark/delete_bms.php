<?php

    require_once('fns/bookmark_fns.php');
    session_start();

    $del_me = isset($_POST['del_me']) ? $_POST['del_me'] : [];
    $valid_user = $_SESSION['valid_user'];

    do_html_header('删除书签');

    check_valid_user();
    if (!filled_out($_POST)) {
      echo '<p>你没有选择要删除的书签，再试一次 ;)</p>';
      display_user_menu();
      do_html_footer();
      exit;
    } else {
      if (count($del_me) > 0) {
          foreach($del_me as $url) {
              if (delete_bm($valid_user, $url)) {
                  echo '删除了 ' . htmlspecialchars($url) . '。<br />';
              } else {
                  echo '删除 ' . htmlspecialchars($url) . '出现异常。<br />';
              }
          }
      } else {
          echo '你没有选择要删除的书签，再试一次 ;)';
      }
    }
    if ($url_array = get_user_urls($valid_user)) {
        display_user_urls($url_array);
    }
    display_user_menu();

    do_html_footer();

?>