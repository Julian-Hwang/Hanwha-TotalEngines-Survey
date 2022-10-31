<?
include('../_inc/inc.php');
include('../_inc/db.php');
include('../_inc/pointCalc.php');

$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

$answr5_arr=array($_POST["answr5"],"etc"); 
$answr5= implode("|",$answr5_arr);

$cont_5_arr=array($_POST["note5"],$_POST["answr5_1"]); 
$cont_5= implode("|",$cont_5_arr);

$note5_arr=array("답변","부서명");
$note5=implode("|",$note5_arr);

for($i=1; $i<=5; $i++){
  ${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
}

$answrCD = array($_POST["answr1"], $_POST["answr2"], $_POST["answr3"], $_POST["answr4"], $answr5);
$answrCONT = array($_POST["note1"],$_POST["note2"],$_POST["note3"],$_POST["note4"],$cont_5);
$noteArr = array("","","","",$note5);
$pointArr = array($point1,$point2,$point3,$point4,$point5);

$subMode = $_POST["subMode"];
$esmIdx = $_POST["esmIdx"];

if($subMode == "update"){
  //마스터 테이블 수정
  $qwe = "UPDATE ESG_SURVEY_MASTER set
      MOD_ID = '".$member_id."',
      MOD_DATE = NOW()
      WHERE IDX = $esmIdx";
  $result = mysqli_query($dbconn,$qwe);
} else {
  //마스터 테이블 등록
  $qwe = "insert into ESG_SURVEY_MASTER set
      QUES_PHASE = '4',
      SURVEY_NAME = '한화',
      SURVEY_YEAR = '2022',
      SUBMIT_YN = 'N',
      REG_ID = '".$member_id."',
      REG_DATE = NOW()";
  $qwe_idx = mysqli_query($dbconn,$qwe);
}

if($subMode == "update"){
  //답변수정
  for($i=0; $i<5; $i++){
    $sql = "UPDATE ESG_ANSWER set
            ANSWER_CD = '".$answrCD[$i]."'
            ,ANSWER_CONT = '".$answrCONT[$i]."'
            ,ANSWER_NOTE = '".$noteArr[$i]."'
            ,ANSWER_POINT   = '".$pointArr[$i]."'
            ,MOD_ID = '".$member_id."'
            ,MOD_DATE = now()
            WHERE ESM_IDX = $esmIdx and QUES_NUM = '$i'+'1'";

    $proc = mysqli_query($dbconn,$sql);
  }
  if($proc){
    //1.일반사항 3번 문항 답변에 따라 이동 페이지 다르게 설정
    $query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE QUES_CD = 'HTE-G-03' AND REG_ID = '".$member_id."'";
    $proc_1 = mysqli_query($dbconn,$query);
    $answerRow = mysqli_fetch_assoc($proc_1);
    $answer = $answerRow["ANSWER_CD"];
    switch ($answer) {
      case 'A': echo "<script>alert('저장되었습니다.'); location.href='../survey05_1.php'</script>"; break;
      case 'B': echo "<script>alert('저장되었습니다.'); location.href='../survey06_1.php'</script>"; break;
      case 'C': echo "<script>alert('저장되었습니다.'); location.href='../survey07_1.php'</script>"; break;
      case 'D': echo "<script>alert('저장되었습니다.'); location.href='../survey08.php'</script>"; break;
      default: echo "<script>alert('알 수 없는 에러'); history.back();</script>"; break;
    }
  }else{
    echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
  }
}else{
  //답변등록
  for($i=0; $i<5; $i++){
      $val=$i+1;
      $sql = "INSERT into ESG_ANSWER set
          ESM_IDX = (SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '4' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022)
          ,QUES_CD = '".$_POST["inum$val"]."'
          ,QUES_PHASE = '4'
          ,QUES_NUM = '$i'+'1'
          ,ANSWER_CD = '".$answrCD[$i]."'
          ,ANSWER_CONT = '".$answrCONT[$i]."'
          ,ANSWER_NOTE = '".$noteArr[$i]."'
          ,ANSWER_POINT = '".$pointArr[$i]."'
          ,REG_ID = '".$member_id."'
          ,REG_DATE = now()";	

      $proc = mysqli_query($dbconn,$sql);
  }

  if($proc) {
      //1.일반사항 3번 문항 답변에 따라 이동 페이지 다르게 설정
      $query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE QUES_CD = 'HTE-G-03' AND REG_ID = '".$member_id."'";
      $proc_1 = mysqli_query($dbconn,$query);
      $answerRow = mysqli_fetch_assoc($proc_1);
      $answer = $answerRow["ANSWER_CD"];
      switch ($answer) {
        case 'A': echo "<script>alert('저장되었습니다.'); location.href='../survey05_1.php'</script>"; break;
        case 'B': echo "<script>alert('저장되었습니다.'); location.href='../survey06_1.php'</script>"; break;
        case 'C': echo "<script>alert('저장되었습니다.'); location.href='../survey07_1.php'</script>"; break;
        case 'D': echo "<script>alert('저장되었습니다.'); location.href='../survey08.php'</script>"; break;
        default: echo "<script>alert('알 수 없는 에러'); history.back();</script>"; break;
      }
  }else{
    echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
  }
}
?>
