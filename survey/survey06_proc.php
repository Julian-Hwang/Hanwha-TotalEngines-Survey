<?php
include('../_inc/inc.php');
include('../_inc/db.php');
include('../_inc/pointCalc.php');
login_check();

	$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

    //2번 implode
	$answr2_arr_etc=array($_POST["answr2_1"],$_POST["answr2_2"],$_POST["answr2_3"],'etc','etc','etc'); 
	$answr2_etc=implode("|",$answr2_arr_etc);

	$answr2_arr_cont=array($_POST["note2_1"],$_POST["note2_2"],$_POST["note2_3"],$_POST["answr2_4"],$_POST["answr2_5"],$_POST["answr2_6"]); 
	$answr2_cont=implode("|",$answr2_arr_cont);

	$note2_arr = array($_POST["note2_1"],$_POST["note2_2"],$_POST["note2_3"],$_POST["note2_4"],$_POST["note2_5"],$_POST["note2_6"]); 
	$note2 = implode("|",$note2_arr);

    //3번 implode
    $answr3_arr_etc=array($_POST["answr3_1"],$_POST["answr3_2"],$_POST["answr3_3"],'etc'); 
	$answr3_etc=implode("|",$answr3_arr_etc);

	$answr3_arr_cont=array($_POST["note3_1"],$_POST["note3_2"],$_POST["note3_3"],$_POST["answr3_4"]); 
	$answr3_cont=implode("|",$answr3_arr_cont);

	$note3_arr = array($_POST["note3_1"],$_POST["note3_2"],$_POST["note3_3"],$_POST["note3_4"]); 
	$note3 = implode("|",$note3_arr);

	//점수
	$point1=abccheck($_POST["answr1"],3,2,1);
	$point2= ynxcheck($_POST["answr2_1"],$_POST["answr2_2"],$_POST["answr2_3"],1,0,0) 
              + yearscheck($_POST["answr2_4"],$_POST["answr2_5"],$_POST["answr2_6"],1,0,0.5);
	$point3= ynxcheck($_POST["answr3_1"],$_POST["answr3_2"],$_POST["answr3_3"],1,0,0);		  
	for($i=4; $i<=5; $i++){
		${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
	}

	$i_numArr = array($_POST["inum1"],$_POST["inum2"],$_POST["inum3"],$_POST["inum4"],$_POST["inum5"]);
	
    $answrArr = array($_POST["answr1"], $answr2_etc,$answr3_etc,$_POST["answr4"],$_POST["answr5"]);
  
	//문항마다 넣어주는 변수 다름 주의					
    $contArr = array($_POST["note1"],$answr2_cont,$answr3_cont,$_POST["note4"],$_POST["note5"]);
	$noteArr = array('',$_POST["note2"],$_POST["note3"],'','');
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
		for($i=0; $i<5; $i++){
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
			echo "<script> alert('저장 되었습니다..'); location.href='../survey08.php';</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}else{
		//답변등록
		for($i=0; $i<5; $i++){
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
			echo "<script>alert('저장 되었습니다.'); location.href='../survey08.php'</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
    }

	

?>