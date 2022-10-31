<?
include('../_inc/inc.php');
include('../_inc/db.php');
login_check();

$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

$subMode = $_POST["subMode"];
$esmIdx = $_POST["esmIdx"];

if($subMode == "update"){
  $qwe = "UPDATE ESG_SURVEY_MASTER set
          MOD_ID = '".$member_id."',
          MOD_DATE = NOW()
          WHERE IDX = $esmIdx";
  $result = mysqli_query($dbconn,$qwe);
  // if($result){
  //   echo "<script> alert('파일 업로드 완료.'); location.href='../complete.php';</script>";
  // }
} else {
  $qwe = "INSERT into ESG_SURVEY_MASTER set
          QUES_PHASE = '8',
          SURVEY_NAME = '한화',
          SURVEY_YEAR = '2022',
          SUBMIT_YN = 'N',
          REG_ID = '".$member_id."',
          REG_DATE = NOW()";
  $result = mysqli_query($dbconn,$qwe);

  $esmIdx = "SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '8' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022";
}

$dir = "../_upload/";
$ext_str = "zip,7z,hwp,xls,doc,xlsx,docx,pdf,jpg,jpeg,gif,png,txt,ppt,pptx";
$allowed_extensions = explode(',', $ext_str);
$max_file_size = 5242880;

for($i=1; $i<10; $i++){
    if($_FILES["file$i"]['name']){
        $file = $_FILES["file$i"];
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1);

        // 확장자 체크   
        if(!in_array($ext, $allowed_extensions)){
          echo "<script> alert('$ext 은(는) 업로드할 수 없는 확장자 입니다.'); history.back();</script>";
          exit;
        }

        // 파일 크기 체크   
        if($file['size'] >= $max_file_size) {
          echo "<script> alert('5MB 까지만 업로드 가능합니다.'); history.back();</script>";
          exit;
        }

        $path = md5(microtime()) . '.' . $ext;
        if(move_uploaded_file($file['tmp_name'], $dir.$path)) {
            $query = "INSERT INTO ESG_FILE (ESM_IDX, QUES_CD, FILE_ID, USR_FILE_NAME, SRV_FILE_NAME, REG_ID, REG_DATE, DEL_YN) VALUES(($esmIdx),'".$_POST["inum$i"]."',?,?,?,'".$member_id."',now(),'N')";
            $file_id = md5(uniqid(rand(), true));
            $name_orig = $file['name'];
            $name_save = $path;
            $stmt = mysqli_prepare($dbconn, $query);
            $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
            $exec = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
          echo "<script> alert('파일 업로드 실패. 잠시 후 다시 시도해주세요.'); history.back();</script>";
          exit;
        }
    }
}
echo "<script> alert('파일 업로드 완료.'); location.href='../complete.php';</script>";
?>
