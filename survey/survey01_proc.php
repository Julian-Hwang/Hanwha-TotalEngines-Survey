<?php
include('../_inc/inc.php');
include('../_inc/db.php');
login_check();

	$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

	$answr2_arr=array($_POST["answr2_1"],$_POST["answr2_2"],$_POST["answr2_3"]);
	$answr2  = implode("|",$answr2_arr);
	// $answr5_arr=array($_POST["answr5_1"],$_POST["answr5_2"]);
	// $answr5  = implode("|",$answr5_arr);
	$answr11_arr=array($_POST["answr11_1"],$_POST["answr11_2"],$_POST["answr11_3"]);
	$answr11  = implode("|",$answr11_arr);

	$note11_arr = array($_POST["note11_1"],$_POST["note11_2"],$_POST["note11_3"]);
  	$note11 = implode("|",$note11_arr);

	$i_numArr = array($_POST["inum0"],$_POST["inum1"],$_POST["inum2"],$_POST["inum3"],$_POST["inum4"],$_POST["inum5"],$_POST["inum6"],$_POST["inum7"],$_POST["inum8"],$_POST["inum9"],$_POST["inum10"],$_POST["inum11"]);
	$answrArr = array($_POST["answr0"],$_POST["answr1"], 'etc', $_POST["answr3"], $_POST["answr4"], 'etc', $_POST["answr6"], $_POST["answr7"], $_POST["answr8"], $_POST["answr9"], $_POST["answr10"], $answr11);
  	$contArr = array($_POST["note0"],$_POST["note1"], $answr2, $_POST["note3"], $_POST["note4"], $_POST["answr5"], $_POST["note6"], $_POST["note7"], $_POST["note8"], $_POST["note9"], $_POST["note10"], $note11);
	$noteArr = array('','',$_POST["note2"],'','',$_POST["note5"],'','','','','',$_POST["note11"]);
	$pointArr = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

	$subMode = $_POST["subMode"];
	$esmIdx = $_POST["esmIdx"];

    if($_POST["answr0"] == "A"){
        $level = "_1";
    }else if($_POST["answr0"] == "B"){
        $level = "_2";
    }else{
        $level = "";
    }

    //echo "$level";

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
				QUES_PHASE = '1',
				SURVEY_NAME = '한화',
				SURVEY_YEAR = '2022',
				SUBMIT_YN = 'N',
				REG_ID = '".$member_id."',
				REG_DATE = NOW()";
		$qwe_idx = mysqli_query($dbconn,$qwe);
	}
	
	if($subMode == "update"){
		//답변수정
		for($i=0; $i<12; $i++){
		$sql = "UPDATE ESG_ANSWER set
				ANSWER_CD = '".$answrArr[$i]."'
				,ANSWER_CONT = '".$contArr[$i]."'
				,ANSWER_NOTE = '".$noteArr[$i]."'
				,MOD_ID = '".$member_id."'
				,MOD_DATE = now()
				WHERE ESM_IDX = $esmIdx and QUES_NUM = '$i'+'1'";

			$proc = mysqli_query($dbconn,$sql);
		}
		if($proc){
			echo "<script> alert('저장되었습니다.'); location.href='../survey02".$level.".php';</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}else{
		//답변등록
		for($i=0; $i<12; $i++){
			$sql = "INSERT into ESG_ANSWER set
					ESM_IDX = (SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '1' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022)
					,QUES_CD = '".$i_numArr[$i]."'
					,QUES_PHASE = '1'
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
			echo "<script>alert('저장되었습니다.'); location.href='../survey02".$level.".php'</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}

	
?>
