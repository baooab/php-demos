<?php
/*
  helper function。动态打印出页面中某个部分的HTML代码，比如页头和页尾。

  注意：
        1. do_html_header() 函数与 do_html_footer() 函数要一起使用，否则打印出的页面结构不正确。
*/

// 打印“页面头部”
function do_html_header($title) { ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title;?></title>
    <style>
        body {
            font-family: 'Comic Sans MS', '华文中宋', 'Trebuchet MS', 'Consolas', 'Courier New',Georgia, Verdana, serif;
            font-size: 13px;
            width: 690px;
            margin: 0 auto;
        }
        a {
            color: #000;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        ul {
            padding-left: 0;
        }
        ul > li {
            display: inline-block;
        }
    </style>
</head>
    <body>
        <img src="bookmark.gif" alt="PHPbookmark logo" border="0"
             align="left" valign="bottom" height="55" width="57" />
        <h1>书签采集</h1>
        <hr />
<?php

    // 打印页面副标题
    if($title) {
        do_html_heading($title);
    }
}

// 打印“页面尾部”
function do_html_footer() { ?>
    </body>
</html>
<?php }

// 打印页面“副标题”
function do_html_heading($heading) { ?>
    <h2><?php echo $heading; ?></h2>
<?php }

// 打印“超链接”
function do_html_URL($url, $name) { ?>
    <br /><a href="<?php echo $url; ?>"><?php echo $name; ?></a><br />
<?php }

// 打印“站点欢迎信息”
function display_site_info() { ?>
    <ul>
        <li>在线收藏书签！</li>
        <li>看他人收藏了什么书签！</li>
        <li>把你喜欢的书签分享给他人！</li>
    </ul>
<?php }

// 打印“登录表单”
function display_login_form() { ?>
    <p><a href="register_form.php">还不是会员？</a></p>
    <form method="post" action="member.php">
        <table bgcolor="#cccccc">
         <tr>
             <td colspan="2">会员在这登录：</td><tr>
             <td>用户名：</td><td><input type="text" name="username"/></td></tr>
         <tr>
             <td>密码：</td>
             <td><input type="password" name="passwd"/></td></tr><tr>
             <td colspan="2" align="center"><input type="submit" value="登录"/></td></tr>
         <!-- <tr>
             <td colspan="2"><a href="forgot_form.php">忘记密码了？</a></td></tr> -->
       </table>
   </form>
<?php }

// 打印“注册表单”
function display_registration_form() { ?>
    <form method="post" action="register_new.php">
        <table bgcolor="#cccccc">
            <tr>
               <td>Email 地址：</td>
               <td><input type="text" name="email" size="30" maxlength="100"/></td></tr>
            <tr>
                <td>大名 <br />（最多 16 个字）：</td>
                <td valign="top"><input type="text" name="username" size="16" maxlength="16"/></td></tr>
            <tr>
                <td>密码 <br />（6~16 个字符之间）：</td>
                <td valign="top"><input type="password" name="passwd" size="16" maxlength="16"/></td></tr>
            <tr>
                <td>确认密码：</td>
                <td><input type="password" name="passwd2" size="16" maxlength="16"/></td></tr>
            <tr>
                <td colspan=2 align="center">
                <input type="submit" value="注册"></td></tr>
        </table>
    </form>
<?php }

// 打印用户书签
function display_user_urls($url_array) {
    // $bm_table 设置为全局变量，供其它地方使用
    global $bm_table;
    $bm_table = true;
    ?>
    <br />
    <form name="bm_table" action="delete_bms.php" method="post">
        <table cellpadding="2" cellspacing="0">
            <?php
            $color = "#cccccc";
            echo "<tr bgcolor=\"".$color."\"><td><strong>书签</strong></td>";
            echo "<td><strong>删除？</strong></td></tr>";
            if ((is_array($url_array)) && (count($url_array) > 0)) {
                foreach ($url_array as $url)  {
                    if ($color == "#cccccc") {
                        $color = "#ffffff";
                    } else {
                        $color = "#cccccc";
                    }
                    // 调用 htmlspecialchars()
                    echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
                          <td><input type=\"checkbox\" name=\"del_me[]\"
                              value=\"".$url."\"/></td>
                          </tr>";
                }
            } else {
              echo "<tr><td>没有任何书签被收藏 ;(</td></tr>";
            }
            ?>
        </table>
    </form>
<?php }

// 打印用户菜单
function display_user_menu() { ?>
    <hr />
        <ul>
            <li><a href="member.php">主页</a></li>
            <li><a href="add_bm_form.php">添加书签</a></li>
            <li>
                <?php
                global $bm_table;
                // 在书签列表页？
                if ($bm_table == true) {
                    echo '<a href="javascript:void(0);" onClick="bm_table.submit();">删除书签</a> |';
                } else {
                    echo '<span style="color: #cccccc">删除书签</span> |';
                } ?>
            </li>
            <li>
                <a href="change_passwd_form.php">重置密码</a>
            </li>
            <li><a href="recommend.php">推荐链接</a></li>
            <li><a href="logout.php">注销</a></li>
        </ul>
    <hr />
<?php }

// 打印“添加书签”表单
function display_add_bm_form() { ?>
    <br>
    <form name="bm_table" action="add_bms.php" method="post">
        <table cellpadding="2" cellspacing="0" bgcolor="#cccccc">
            <tr><td>新书签：</td>
            <td><input type="text" name="new_url" placeholder="https://" size="30" maxlength="255"/></td></tr>
            <tr><td colspan="2" align="center"><input type="submit" value="添加书签"/></td></tr>
        </table>
    </form>
<?php }

// 打印“修改密码”表单
function display_password_form() { ?>
    <br />
    <form action="change_passwd.php" method="post">
        <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
            <tr>
                <td>旧密码：</td>
                <td><input type="password" name="old_passwd" size="16" maxlength="16"/></td></tr>
            <tr><td>新密码：</td>
                <td><input type="password" name="new_passwd"size="16" maxlength="16"/></td></tr>
            <tr><td>重复新密码：</td>
                <td><input type="password" name="new_passwd2" size="16" maxlength="16"/></td></tr>
            <tr><td colspan="2" align="center">
                <input type="submit" value="更改密码"/></td></tr>
        </table>
    </form>
    <br />
<?php }

// 打印“忘记密码”表单
//function display_forgot_form() { ?>
<!-- <br />
    <form action="forgot_passwd.php" method="post">
        <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
            <tr><td>输入大名</td><td><input type="text" name="username" size="16" maxlength="16"/></td></tr>
            <tr><td colspan=2 align="center"><input type="submit" value="改变密码"/></td></tr>
        </table>
    </form>
<br /> -->
<?php //}

//  打印“推荐链接”的表格代码
function display_recommended_urls($url_array) { ?>
    <br />
    <table width="300" cellpadding="2" cellspacing="0">
        <?php
            $color = '#cccccc';
            echo '<tr bgcolor="'. $color . '"><td><strong>推荐链接</strong></td></tr>';
            if ((is_array($url_array)) && (count($url_array)>0)) :
              foreach ($url_array as $url) {
                if ($color == "#cccccc") :
                  $color = "#ffffff";
                else :
                  $color = "#cccccc";
                endif;
                echo '<tr bgcolor="' . $color . '"><td><a href="' . $url . '">' . htmlspecialchars($url) . '</a></td></tr>';
              }
            else :
              echo "<tr><td>今日无推荐 ;(</td></tr>";
            endif;
        ?>
    </table>
<?php } ?>
