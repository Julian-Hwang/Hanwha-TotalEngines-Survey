<?php
  ini_set( 'display_errors', '0' );
  session_start();

  //회원로그인체크
    $isLogin = FALSE;
    function login_check(){
        if(!$_SESSION["mb_idx"] || !$_SESSION["mb_id"] || !$_SESSION["mb_name"] ) {
            echo "<script> alert('로그인 후 이용해주세요.'); location.href='../login_admin.php'; </script>";
            exit;
        } else $isLogin = TRUE;
    }

    function admin_check(){
        if($_SESSION["admin"] != "esgadm" ) {
            echo "<script> alert('관리자 로그인 후 이용해주세요.'); location.href='../login_admin.php'; </script>";
            exit;
        } else $isLogin = TRUE;
    }
?>
