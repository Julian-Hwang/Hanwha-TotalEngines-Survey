<?
	$mbId = $_SESSION['mb_id'];
	$menu_q = "SELECT * FROM ESG_SURVEY_MASTER WHERE SURVEY_NAME = '한화' AND SURVEY_YEAR = '2022' AND REG_ID = '$mbId' ORDER BY QUES_PHASE DESC LIMIT 1";
	$menu_result = mysqli_query($dbconn, $menu_q);
  	$menu_row = mysqli_fetch_assoc($menu_result);
	if($menu_row){
		$phase = $menu_row["QUES_PHASE"];
	}

	$sql = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE REG_ID = '$mbId' and QUES_CD = 'HTE-G-00'";
	$levelresult = mysqli_query($dbconn,$sql);
	$level_row = mysqli_fetch_assoc($levelresult);	

	$sql2 = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE REG_ID = '$mbId' and QUES_CD = 'HTE-G-03'";
	$typeresult = mysqli_query($dbconn,$sql2);
	$type_row = mysqli_fetch_assoc($typeresult);
	$answer = $type_row["ANSWER_CD"];
    switch ($answer) {
      case 'A': $answernum = 5; break;
      case 'B': $answernum = 6; break;
      case 'C': $answernum = 7; break;
      case 'D': $answernum = 0; break;
	  default: $answernum = 0; break;
    }
?>
<script>
function menuloca(level, selected){
	if(level == 'A'){
		switch (selected) {
			case '1': location.href = "./survey01.php";break;
			case '2': location.href = "./survey02_1.php";break;
			case '3': location.href = "./survey03_1.php";break;
			case '4': location.href = "./survey04_1.php";break;
			case '5': location.href = "./survey05_1.php";break;
			case '6': location.href = "./survey06_1.php";break;
			case '7': location.href = "./survey07_1.php";break;
			case '8': location.href = "./survey08.php";break;
			default: return false; break;
        }
	} else if(level == 'B'){
		switch (selected) {
			case '1': location.href = "./survey01.php";break;
			case '2': location.href = "./survey02_2.php";break;
			case '3': location.href = "./survey03_2.php";break;
			case '4': location.href = "./survey04.php";break;
			case '5': location.href = "./survey05.php";break;
			case '6': location.href = "./survey06.php";break;
			case '7': location.href = "./survey07.php";break;
			case '8': location.href = "./survey08.php";break;
			default: return false; break;
        }
	} else if(level == 'C'){
		switch (selected) {
			case '1': location.href = "./survey01.php";break;
			case '2': location.href = "./survey02.php";break;
			case '3': location.href = "./survey03.php";break;
			case '4': location.href = "./survey04.php";break;
			case '5': location.href = "./survey05.php";break;
			case '6': location.href = "./survey06.php";break;
			case '7': location.href = "./survey07.php";break;
			case '8': location.href = "./survey08.php";break;
			default: return false; break;
        }
	} else return false;
}
</script>
<div class="menu">
	<p class="logo"><img src="_img/logo_han.png" alt="한화토탈에너지스"></p>
	<p style="margin-bottom:20px;">접속 계정 <strong style="word-break:break-word;"><? echo $mbId ?></strong></p>
	
	<!--
	※ 단계별 클래스 안내 ※
	- 진행완료 : comp
	- 진행중 : ing
	- 미진행 : 클래스없음
	-->
  	<ul>
		<li <? if($phase>=1){?>class="comp" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','1');" style="cursor: pointer;"<? } else {?>class="ing" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','1');" style="cursor: pointer;"<?}?>>
			1. 일반사항
		</li>
		<li <? if(($phase>=5)||($answernum === 0 && $phase>=4)){?>class="comp"<? } else if($phase >= 1 && $phase <= 4) {?>class="ing"<?}?>>
			2. 수준진단
		</li>
		<li <? if(($phase>=5)||($answernum === 0 && $phase>=4)){?>class="sm comp" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','2');" style="cursor: pointer;"<? } else if($phase >= 1) {?>class="sm ing" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','2');" style="cursor: pointer;"<?} else {?>class="sm"<?}?>> 
			환경
		</li>
		<li <? if(($phase>=5)||($answernum === 0 && $phase>=4)){?>class="sm comp" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','3');" style="cursor: pointer;"<? } else if($phase >= 2) {?>class="sm ing" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','3');" style="cursor: pointer;"<?} else {?>class="sm"<?}?>> 
			사회
		</li>
		<li <? if(($phase>=5)||($answernum === 0 && $phase>=4)){?>class="sm comp" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','4');" style="cursor: pointer;"<? } else if($phase >= 3) {?>class="sm ing" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','4');" style="cursor: pointer;"<?} else {?>class="sm"<?}?>>
			지배구조
		</li>
		<li <? if(($answernum != 0 && $phase>=5)){?>class="sm comp" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','<? echo $answernum; ?>');" style="cursor: pointer;"<? } else if($answernum != 0 && $phase >= 4){?>class="sm ing" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','<? echo $answernum; ?>');" style="cursor: pointer;"<?} else {?>class="sm"<?}?>>
			산업특화
		</li>
		<li <? if($phase>=8){?>class="comp" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','8');" style="cursor: pointer;"<? } else if(($phase >=5 && $phase <= 7) || ($answernum === 0 && $phase >= 4 && $phase <= 7)){?>class="ing" onclick="menuloca('<?echo $level_row['ANSWER_CD']?>','8');" style="cursor: pointer;"<?}?>>
			3. 증빙자료
		</li>
	</ul>
</div>
