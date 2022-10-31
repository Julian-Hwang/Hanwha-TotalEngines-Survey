<?
include('../_inc/inc.php');
include('../_inc/db.php');
login_check();

$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

$query = "UPDATE ESG_SURVEY_MASTER SET SUBMIT_YN = 'Y', SUBMIT_ID = '".$member_id."',SUBMIT_DATE = NOW() WHERE SURVEY_NAME = '한화' AND SURVEY_YEAR = '2022' AND REG_ID = '".$member_id."'";
$proc = mysqli_query($dbconn,$query);

if($proc){
  echo "<script>alert('최종 제출이 완료되었습니다.'); location.href='../guide.php'</script>";
} else {
  echo "<script>alert('최종 제출에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
}

?>
