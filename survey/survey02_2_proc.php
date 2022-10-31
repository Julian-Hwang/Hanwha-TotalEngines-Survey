<?php
include('../_inc/inc.php');
include('../_inc/db.php');
include('../_inc/pointCalc.php');
login_check();

$member_id = $_SESSION['mb_id']; //세션에 담긴 아이디

    for($i=9; $i<=10; $i++){
        ${"answr".$i."_arr"}=array($_POST["answr$i"."_1"],$_POST["answr$i"."_2"],$_POST["answr$i"."_3"]);
        ${"answr".$i}= implode("|",${"answr".$i."_arr"});
    }

    for($i=11; $i<=20; $i++){
        ${"answr".$i."_arr_etc"}=array($_POST["answr$i"."_1"],$_POST["answr$i"."_2"],$_POST["answr$i"."_3"],'etc','etc','etc');
        ${"answr".$i."_etc"}= implode("|",${"answr".$i."_arr_etc"});
    }
	for($i=11; $i<=20; $i++){
        ${"answr".$i."_arr_cont"}=array($_POST["note$i"."_1"],$_POST["note$i"."_2"],$_POST["note$i"."_3"],$_POST["answr$i"."_4"],$_POST["answr$i"."_5"],$_POST["answr$i"."_6"]);
        ${"answr".$i."_cont"}= implode("|",${"answr".$i."_arr_cont"});
    }

	//HTE-CE-12 9개 문항 예외처리 덮어씌움
	$answr12_arr_etc=array($_POST["answr12_1"],$_POST["answr12_2"],$_POST["answr12_3"],'etc','etc','etc','etc','etc','etc');
	$answr12_etc=implode("|",$answr12_arr_etc);
	$answr12_arr_cont=array($_POST["note12_1"],$_POST["note12_2"],$_POST["note12_3"],$_POST["answr12_4"],$_POST["answr12_5"],$_POST["answr12_6"],$_POST["answr12_7"],$_POST["answr12_8"],$_POST["answr12_9"]);
	$answr12_cont=implode("|",$answr12_arr_cont);

    for($i=9; $i<=10; $i++){
        ${"note".$i."_arr"}=array($_POST["note$i"."_1"],$_POST["note$i"."_2"],$_POST["note$i"."_3"]);
        ${"note".$i}= implode("|",${"note".$i."_arr"});
    }

    for($i=11; $i<=20; $i++){
        ${"note".$i."_arr"}=array($_POST["note$i"."_1"],$_POST["note$i"."_2"],$_POST["note$i"."_3"],$_POST["note$i"."_4"],$_POST["note$i"."_5"],$_POST["note$i"."_6"]);
        ${"note".$i}= implode("|",${"note".$i."_arr"});
    }

	//HTE-CE-12 9개 문항 예외처리 덮어씌움
	$note12_arr = array($_POST["note12_1"],$_POST["note12_2"],$_POST["note12_3"],$_POST["note12_4"],$_POST["note12_5"],$_POST["note12_6"],$_POST["note12_7"],$_POST["note12_8"],$_POST["note12_9"]);
	$note12 = implode("|",$note12_arr);

    //지문 점수계산
    for($i=1; $i<=8; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
    }

    for($i=9; $i<=10; $i++){
        ${"point$i"}=ynxcheck($_POST["answr$i"."_1"],$_POST["answr$i"."_2"],$_POST["answr$i"."_3"],1,0,0);
    }

    $point11 = ynxcheck($_POST["answr11_1"],$_POST["answr11_2"],$_POST["answr11_3"],1,0,0) + yearscheck($_POST["answr11_4"],$_POST["answr11_5"],$_POST["answr11_6"],1,0,0.5);
    $point12 = ynxcheck($_POST["answr12_1"],$_POST["answr12_2"],$_POST["answr12_3"],1,0,0)+ yearscheck($_POST["answr12_4"],$_POST["answr12_5"],$_POST["answr12_6"],1,0,0.5)+ yearscheck($_POST["answr12_7"],$_POST["answr12_8"],$_POST["answr12_9"],1,0,0.5);
    $point13 = ynxcheck($_POST["answr13_1"],$_POST["answr13_2"],$_POST["answr13_3"],1,0,0) + yearscheck($_POST["answr13_4"],$_POST["answr13_5"],$_POST["answr13_6"],1,0,0.5);

    for($i=14; $i<=20;$i++){
        ${"point$i"}= ynxcheck($_POST["answr$i"."_1"],$_POST["answr$i"."_2"],$_POST["answr$i"."_3"],1,0,0) 
                    + yearscheck($_POST["answr$i"."_4"],$_POST["answr$i"."_5"],$_POST["answr$i"."_6"],1,0,0.5);
    }

    for($i=21; $i<=23; $i++){
        ${"point$i"}=abccheck($_POST["answr$i"],3,2,1);
    }

    //

	$i_numArr = array($_POST["inum1"],$_POST["inum2"],$_POST["inum3"],$_POST["inum4"],$_POST["inum5"],$_POST["inum6"],$_POST["inum7"],$_POST["inum8"],$_POST["inum9"],$_POST["inum10"],
                    $_POST["inum11"],$_POST["inum12"],$_POST["inum13"],$_POST["inum14"],$_POST["inum15"],$_POST["inum16"],$_POST["inum17"],$_POST["inum18"],$_POST["inum19"],$_POST["inum20"],
                    $_POST["inum21"],$_POST["inum22"],$_POST["inum23"]);

    $answrArr = array($_POST["answr1"], $_POST["answr2"], $_POST["answr3"], $_POST["answr4"], $_POST["answr5"], $_POST["answr6"], $_POST["answr7"], $_POST["answr8"],$answr9,$answr10,
                    $answr11_etc,$answr12_etc,$answr13_etc,$answr14_etc,$answr15_etc,$answr16_etc,$answr17_etc,$answr18_etc,$answr19_etc,$answr20_etc,
                    $_POST["answr21"],$_POST["answr22"],$_POST["answr23"]);

	//문항마다 넣어주는 변수 다름 주의
    $contArr = array($_POST["note1"],$_POST["note2"],$_POST["note3"],$_POST["note4"],$_POST["note5"],$_POST["note6"],$_POST["note7"], $_POST["note8"],
                    $note9,$note10,
                    $answr11_cont,$answr12_cont,$answr13_cont,$answr14_cont,$answr15_cont,$answr16_cont,$answr17_cont,$answr18_cont,$answr19_cont,$answr20_cont,$_POST["note21"],$_POST["note22"],$_POST["note23"]);
	$noteArr = array('','','','','','','','',$_POST["note9"],$_POST["note10"],$_POST["note11"],$_POST["note12"],$_POST["note13"],$_POST["note14"],$_POST["note15"],$_POST["note16"],
                    $_POST["note17"],$_POST["note18"],$_POST["note19"],$_POST["note20"],'','','');
    $pointArr = array($point1,$point2,$point3,$point4,$point5,$point6,$point7,$point8,$point9,$point10,$point11,$point12,$point13,
    $point14,$point15,$point16,$point17,$point18,$point19,$point20,$point21,$point22,$point23);

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
		for($i=0; $i<23; $i++){
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
            echo "<script> alert('저장되었습니다.'); location.href='../survey03_2.php';</script>";
        }else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}else{
		for($i=0; $i<23; $i++){
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
            echo "<script>alert('저장되었습니다.'); location.href='../survey03_2.php'</script>";
        }else{
			echo "<script> alert('저장에 실패했습니다. 잠시 후 다시 시도해주세요.'); history.back();</script>";
		}
	}
    
?>
