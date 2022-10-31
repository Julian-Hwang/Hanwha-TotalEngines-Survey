<?php
include('../_inc/inc.php');
include('../_inc/db.php');
include('../_inc/pointCalc.php');
login_check();

	$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

	$point1=abccheck($_POST["answr1"],3,2,1); //점수

	$i_numArr = array($_POST["inum1"]);
	
    $answrArr = array($_POST["answr1"]);
  			
    $contArr = array($_POST["note1"]);
	$noteArr = array('');
    $pointArr = array($point1);

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
				QUES_PHASE = '6',
				SURVEY_NAME = '한화',
				SURVEY_YEAR = '2022',
				SUBMIT_YN = 'N',
				REG_ID = '".$member_id."',
				REG_DATE = NOW()";
		$qwe_idx = mysqli_query($dbconn,$qwe);
	}

	if($subMode == "update"){
		//답변수정
		for($i=0; $i<1; $i++){
            $sql = "UPDATE ESG_ANSWER set
                ANSWER_CD = '".$answrArr[$i]."'
                ,ANSWER_CONT = '".$contArr[$i]."'
                ,ANSWER_NOTE = '".$noteArr[$i]."'
				,ANSWER_POINT   = '".$pointArr[$i]."'
                ,MOD_ID = '".$member_id."'
                ,MOD_DATE = now()
                WHERE ESM_IDX = $esmIdx and QUES_NUM = '$i'+'1'";
			$proc = mysqli_query($dbconn,$sql);
		}
		if($proc){
			echo "<script> alert('저장되었습니다.'); location.href='../survey08.php';</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}else{
		//답변등록
		for($i=0; $i<1; $i++){
			$sql = "INSERT into ESG_ANSWER set
				ESM_IDX = (SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '6' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022)
				,QUES_CD = '".$i_numArr[$i]."'
				,QUES_PHASE = '6'
				,QUES_NUM = '$i'+'1'
				,ANSWER_CD = '".$answrArr[$i]."'
	            ,ANSWER_CONT = '".$contArr[$i]."'
				,ANSWER_NOTE = '".$noteArr[$i]."'
	            ,ANSWER_POINT = '".$pointArr[$i]."'
				,REG_ID = '".$member_id."'
				,REG_DATE = now()";

			$proc = mysqli_query($dbconn,$sql);
		}
		if($proc) {
			echo "<script>alert('저장되었습니다.'); location.href='../survey08.php'</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
    }

?>