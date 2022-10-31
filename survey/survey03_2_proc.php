<?php
include('../_inc/inc.php');
include('../_inc/db.php');
include('../_inc/pointCalc.php');
login_check();

	$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

    $answr4_arr=$_POST['answr4'];
    $answr4=implode("|",$answr4_arr);


    for($i=8; $i<=15; $i++){
        ${"answr".$i."_arr"}=array($_POST["answr".$i."_1"],$_POST["answr".$i."_2"],$_POST["answr".$i."_3"],"etc","etc","etc"); 
        ${"answr".$i}= implode("|",${"answr".$i."_arr"});
    }

    $answr12_arr=array($_POST["answr12_1"],$_POST["answr12_2"],"etc","etc","etc","etc","etc","etc","etc","etc","etc"); 
    $answr12= implode("|",$answr12_arr);

    for($i=18; $i<=19; $i++){
        ${"answr".$i."_arr"}=array($_POST["answr".$i],"etc","etc","etc"); 
        ${"answr".$i}= implode("|",${"answr".$i."_arr"});
    }

        	//HTE-CS-10 12개 문항 예외처리 덮어씌움
	$answr10_arr_etc=array($_POST["answr10_1"],$_POST["answr10_2"],$_POST["answr10_3"],'etc','etc','etc','etc','etc','etc','etc','etc','etc');
	$answr10_etc=implode("|",$answr10_arr_etc);
	$answr10_arr_cont=array($_POST["note10_1"],$_POST["note10_2"],$_POST["note10_3"],$_POST["answr10_4"],$_POST["answr10_5"],$_POST["answr10_6"],$_POST["answr10_7"],$_POST["answr10_8"],$_POST["answr10_9"],$_POST["answr10_10"],$_POST["answr10_11"],$_POST["answr10_12"]);
	$answr10_cont=implode("|",$answr10_arr_cont);

    for($i=8; $i<=15; $i++){
        ${"cont_".$i."_arr"}=array($_POST["note$i"."_1"],$_POST["note$i"."_2"],$_POST["note$i"."_3"],$_POST["answr".$i."_4"],$_POST["answr".$i."_5"],$_POST["answr".$i."_6"]); 
        ${"cont_".$i}= implode("|",${"cont_".$i."_arr"});
    }

    $cont_12_arr=array($_POST["note12_1"],$_POST["note12_2"],$_POST["answr12_4"],$_POST["answr12_5"],$_POST["answr12_6"],$_POST["answr12_7"],$_POST["answr12_8"],$_POST["answr12_9"],$_POST["answr12_10"],$_POST["answr12_11"],$_POST["answr12_12"]); 
    $cont_12= implode("|",$cont_12_arr);

    for($i=18; $i<=19; $i++){
        ${"cont_".$i."_arr"}=array($_POST["note$i"],$_POST["answr".$i."_1"],$_POST["answr".$i."_2"],$_POST["answr".$i."_3"]); 
        ${"cont_".$i}= implode("|",${"cont_".$i."_arr"});
    }

    $note4=$_POST['note4'];

    for($i=18; $i<=19; $i++){
        ${"note".$i."_arr"}=array(" ",$_POST["note$i"."_1"]); 
        ${"note".$i}= implode("|",${"note".$i."_arr"});
    }

    //지문 점수 계산
    for($i=1; $i<=2; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
    }
    $point3 = abccheck1($_POST["answr3"],3,2,1);
    $point4 = checkcount($_POST["answr4"],1,2,3);
    for($i=5; $i<=7; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
    }
    for($i=8; $i<=15;$i++){
        ${"point$i"}= ynxcheck($_POST["answr$i"."_1"],$_POST["answr$i"."_2"],$_POST["answr$i"."_3"],1,0,0) 
                    + yearscheck($_POST["answr$i"."_4"],$_POST["answr$i"."_5"],$_POST["answr$i"."_6"],1,0,0.5);
    }
    for($i=16; $i<=17; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1)+ yearscheck($_POST["answr$i"."_4"],$_POST["answr$i"."_5"],$_POST["answr$i"."_6"],1,0,0.5);
    }
    for($i=18; $i<=19; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1)+ yearscheck($_POST["answr$i"."_1"],$_POST["answr$i"."_2"],$_POST["answr$i"."_3"],1,0,0.5);;
    }
    for($i=20; $i<=21; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
    }

    $answrCD = array($_POST["answr1"], $_POST["answr2"], $_POST["answr3"], $answr4, $_POST["answr5"], $_POST["answr6"], $_POST["answr7"],
                    $answr8,$answr9,$answr10_etc,$answr11,$answr12,$answr13,$answr14,$answr15,
                    $_POST["answr16"],$_POST["answr17"],
                    $answr18,$answr19,
                    $_POST["answr20"],$_POST["answr21"]);

    $answrCONT = array($_POST["note1"],$_POST["note2"],$_POST["note3"],$note4,$_POST["note5"],$_POST["note6"],$_POST["note7"],
                    $cont_8,$cont_9,$answr10_cont,
                    $cont_11,$cont_12,$cont_13,$cont_14,$cont_15,
                    $_POST["note16"],$_POST["note17"],$cont_18,$cont_19
                    ,$_POST["note20"],$_POST["note21"]);

    $noteArr = array("","","","","","","",
                    $_POST["note8"],$_POST["note9"],$_POST["note10"],$_POST["note11"],$_POST["note12"],$_POST["note13"],$_POST["note14"],$_POST["note15"],
                    "","",
                    $note18,$note19,"","");

    $pointArr = array($point1,$point2,$point3,$point4,$point5,$point6,$point7,$point8,$point9,$point10,$point11,$point12,$point13,
    $point14,$point15,$point16,$point17,$point18,$point19,$point20,$point21);
    
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
				QUES_PHASE = '3',
				SURVEY_NAME = '한화',
				SURVEY_YEAR = '2022',
				SUBMIT_YN = 'N',
				REG_ID = '".$member_id."',
				REG_DATE = NOW()";
		$qwe_idx = mysqli_query($dbconn,$qwe);
	}

    if($subMode == "update"){
		//답변수정
		for($i=0; $i<21; $i++){
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
			echo "<script> alert('저장되었습니다.'); location.href='../survey04.php';</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}else{
		//답변등록
		for($i=0; $i<21; $i++){
            $val=$i+1;
            $sql = "insert into ESG_ANSWER set
                ESM_IDX = (SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '3' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022)
                ,QUES_CD         = '".$_POST["inum$val"]."'
                ,QUES_PHASE		= '3'
                ,QUES_NUM       = '$i'+'1'
                ,ANSWER_CD		= '".$answrCD[$i]."'
                ,ANSWER_CONT    = '".$answrCONT[$i]."'
                ,ANSWER_NOTE    = '".$noteArr[$i]."'
                ,ANSWER_POINT   = '".$pointArr[$i]."'
                ,REG_ID			= '".$member_id."'
                ,REG_DATE		= now()";	
            $proc = mysqli_query($dbconn,$sql);
	    }
		if($proc) {
			echo "<script>alert('저장되었습니다.'); location.href='../survey04.php'</script>";
		}else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}
?>
