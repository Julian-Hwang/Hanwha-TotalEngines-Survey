<?php
include('../_inc/inc.php');
include('../_inc/db.php');
include('../_inc/pointCalc.php');
login_check();

$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디


	$i_numArr = array($_POST["inum1"],$_POST["inum2"],$_POST["inum3"],$_POST["inum4"],$_POST["inum5"],$_POST["inum6"],$_POST["inum7"],$_POST["inum8"]);

    $answrArr = array($_POST["answr1"], $_POST["answr2"], $_POST["answr3"], $_POST["answr4"], $_POST["answr5"], $_POST["answr6"], $_POST["answr7"], $_POST["answr8"]);

	//지문 점수 계산
	for($i=1; $i<=8; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
    }
	
	//문항마다 넣어주는 변수 다름 주의
    $contArr = array($_POST["note1"],$_POST["note2"],$_POST["note3"],$_POST["note4"],$_POST["note5"],$_POST["note6"],$_POST["note7"], $_POST["note8"]);
	$noteArr = array('','','','','','','','');
    $pointArr = array($point1,$point2,$point3,$point4,$point5,$point6,$point7,$point8);

	

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
				QUES_PHASE = '2',
				SURVEY_NAME = '한화',
				SURVEY_YEAR = '2022',
				SUBMIT_YN = 'N',
				REG_ID = '".$member_id."',
				REG_DATE = NOW()";
		$qwe_idx = mysqli_query($dbconn,$qwe);
	}

    if($subMode == "update"){
        //답변수정
		for($i=0; $i<8; $i++){
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
            echo "<script> alert('저장되었습니다.'); location.href='../survey03_1.php';</script>";
        }else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}else{
		for($i=0; $i<8; $i++){
            //답변등록
			$sql = "INSERT into ESG_ANSWER set
                    ESM_IDX = (SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '2' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = '2022')
                    ,QUES_CD = '".$i_numArr[$i]."'
                    ,QUES_PHASE = '2'
                    ,QUES_NUM = '$i'+'1'
                    ,ANSWER_CD = '".$answrArr[$i]."'
                    ,ANSWER_CONT = '".$contArr[$i]."'
                    ,ANSWER_NOTE = '".$noteArr[$i]."'
                    ,ANSWER_POINT = '".$pointArr[$i]."'
                    ,REG_ID = '".$member_id."'
                    ,REG_DATE = now()";
			$proc = mysqli_query($dbconn,$sql);
		}
        if($proc){
            echo "<script>alert('저장되었습니다.'); location.href='../survey03_1.php'</script>";
        }else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}
    
?>
