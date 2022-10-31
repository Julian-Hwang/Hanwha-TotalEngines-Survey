<?php
include('../_inc/inc.php');
include('../_inc/db.php');
include('../_inc/pointCalc.php');
login_check();

	$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

    $answr3_arr=array($_POST["answr3_1"],$_POST["answr3_2"],$_POST["answr3_3"]); 
    $answr3= implode("|",$answr3_arr);
    $answr5_arr=array($_POST["answr5_1"],$_POST["answr5_2"],$_POST["answr5_3"],"etc","etc","etc"); 
    $answr5= implode("|",$answr5_arr);


    $cont_3_arr=array($_POST["note3_1"],$_POST["note3_2"],$_POST["note3_3"]); 
    $cont_3= implode("|",$cont_3_arr);
    $cont_5_arr=array($_POST["note5_1"],$_POST["note5_2"],$_POST["note5_3"],$_POST["answr5_4"],$_POST["answr5_5"],$_POST["answr5_6"]); 
    $cont_5= implode("|",$cont_5_arr);


    $note3_arr=array("관리여부","목표설정여부","공개여부"); 
    $note3= implode("|",$note3_arr);

    $point1 = abccheck($_POST["answr1"],3,2,1);
    $point2 = abccheck($_POST["answr2"],3,2,1);
    $point3 = ynxcheck($_POST["answr3_1"],$_POST["answr3_2"],$_POST["answr3_3"],1,0,0);
    $point4 = abccheck($_POST["answr4"],3,2,1);   
    $point5 = ynxcheck($_POST["answr5_1"],$_POST["answr5_2"],$_POST["answr5_3"],1,0,0) + yearscheck($_POST["answr5_4"],$_POST["answr5_5"],$_POST["answr5_6"],1,0,0.5);

    $answrCD = array($_POST["answr1"], $_POST["answr2"], $answr3, $_POST["answr4"], $answr5);
    $answrCONT = array($_POST["note1"],$_POST["note2"],$cont_3,$_POST["note4"],$cont_5);
    $noteArr = array("","",$note3,"",$_POST["note5"]);
    $pointArr = array($point1, $point2, $point3, $point4, $point5);
    
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
				QUES_PHASE = '7',
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
                    ANSWER_CD		= '".$answrCD[$i]."'
                    ,ANSWER_CONT    = '".$answrCONT[$i]."'
                    ,ANSWER_NOTE    = '".$noteArr[$i]."'
                    ,ANSWER_POINT   = '".$pointArr[$i]."'
                    ,MOD_ID			= '".$member_id."'
                    ,MOD_DATE		= now()
                    WHERE ESM_IDX = $esmIdx and QUES_NUM = '$i'+'1'";
    
            $proc = mysqli_query($dbconn,$sql);
        }
        if($proc){
			echo "<script> alert('저장되었습니다.'); location.href='../survey08.php';</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
    } else {
        //답변등록
        for($i=0; $i<5; $i++){
            $val=$i+1;
            $sql = "insert into ESG_ANSWER set
                    ESM_IDX = (SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '7' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022)
                    ,QUES_CD         = '".$_POST["inum$val"]."'
                    ,QUES_PHASE		= '7'
                    ,QUES_NUM       = '$i'+'1'
                    ,ANSWER_CD		= '".$answrCD[$i]."'
                    ,ANSWER_CONT    = '".$answrCONT[$i]."'
                    ,ANSWER_NOTE    = '".$noteArr[$i]."'
                    ,ANSWER_POINT   = '".$pointArr[$i]."'
                    ,REG_ID			= '".$member_id."'
                    ,REG_DATE		= now()"        
                    ;	
    
            $proc = mysqli_query($dbconn,$sql);
        }
    }
    if($proc){
        echo "<script> alert('저장되었습니다.'); location.href='../survey08.php';</script>";
    }else{
        echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
    }
?>
