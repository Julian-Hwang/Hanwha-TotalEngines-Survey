<?php
include('../_inc/inc.php');
include('../_inc/db.php');

include('./password.php');

if(isset($_POST['mb_id']) && isset($_POST['mb_pw'])){
    if($_POST['mb_id'] == "admin"){
        $mb_id = mysqli_real_escape_string($dbconn, $_POST['mb_id']);
        $mb_pw = mysqli_real_escape_string($dbconn, $_POST['mb_pw']);
    
        $sql = "SELECT * FROM ESG_MEMBER WHERE MEMBER_ID = '$mb_id'";
        $result = mysqli_query($dbconn,$sql);


        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            
            if(password_verify($mb_pw,$row['MEMBER_PW'])){
                $_SESSION['mb_id'] = $row['MEMBER_ID'];
                $_SESSION['mb_name'] = $row['MEMBER_NAME'];
                $_SESSION['mb_idx'] = $row['IDX'];
                $_SESSION['admin'] = $row['REG_ID'];
    
                echo header("location:../admin/survey.php");
            } else {
                echo "<script> alert('패스워드가 일치하지 않습니다.'); location.href='../login_admin.php';</script>";
            }
    
        } else {
            echo "<script> alert('아이디가 일치하지 않습니다.'); location.href='../login_admin.php';</script>";
        }
    } else {
        echo "<script> alert('관리자 계정으로 로그인 해주세요.'); location.href='../login_admin.php';</script>";
    }
} else {
    echo "<script> alert('알 수 없는 에러.'); location.href='../login_admin.php';</script>";
}
?>
