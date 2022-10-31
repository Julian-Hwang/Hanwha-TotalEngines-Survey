<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 6;

$member_id = $_SESSION['mb_id'];

$query = "	SELECT
			ESM_IDX,
            ANSWER_CD AS ANSWR,
            ANSWER_CONT AS CONT,
            ANSWER_NOTE AS NOTE
        FROM
            ESG_ANSWER
        WHERE REG_ID = '".$member_id."'
        AND QUES_PHASE = '6'
		ORDER BY REG_DATE DESC, QUES_NUM
		LIMIT 1";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}

    $answr1 = $row[0]["ANSWR"];

    $note1 = $row[0]["CONT"];

}
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>

	<div class="contents">
	<form name="frm" id="frm" action="survey/survey06_1_proc.php" method="post">
		<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["ESM_IDX"];?>">
		<p class="tit">2-4.수준진단(산업특화/건설)</p>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">1. 재해의 원인을 분석해 반드시 지켜야 하는 항목을 현장 안전지침으로 제정하고 근로자들에게 인지시키고 있습니까?</span></p>
        <input type="hidden" id="i_num1" name="inum1" value="HTE-ID-01">
		<input type="hidden" id="note_1" name="note1" value="<?php echo $note1; ?>">
        <div class="A a01">
			<input type="radio" id="r01_01" name="answr1" onclick="answerChk(this,1);" value="A" <?if($answr1 == "A"){?>checked<?}?>>
            <label for="r01_01">상 : 건설기계 및 장비사고를 예방하기 위한 정책 또는 방침을 수립하여 문서화하고, 장비 반입 전 사전검사를 실시하고 있다.</label>
			<input type="radio" id="r02_01" name="answr1" onclick="answerChk(this,1);" value="B" <?if($answr1 == "B"){?>checked<?}?>>
            <label for="r02_01">중 : 건설기계 및 장비사고를 예방하기 위한 정책 또는 방침을 보유하고 있다.</label>
			<input type="radio" id="r03_01" name="answr1" onclick="answerChk(this,1);" value="C" <?if($answr1 == "C"){?>checked<?}?>>
            <label for="r03_01">하 : 건설기계 및 장비사고를 예방하기 위한 정책 또는 방침을 보유하고 있지 않다.</label>
		</div>

		<p class="s_btn">
			<a href="survey04_1.php" class="prev">이전단계</a>
			<a href="javascript:fn_submit();" class="next">다음단계</a>
            <input type="hidden" id="subMode" name="subMode" value="<?php echo $subMode?>">
		</p>
	</form>
	</div>
</body>
<script language="javascript">
	function answerChk(obj,num){
		var nameTmp = $(obj).attr('name');
		if($(obj).prop('checked')){
			$('input[type="radio"][name="'+nameTmp+'"]').prop('checked',false);
			$(obj).prop('checked', true);
		}

		var idTmp = $(obj).attr('id');
		var checkedText=$("label[for='"+idTmp+"']").text();
		$('input[name=note'+num+']').attr('value',checkedText);
	}

	function showValue(target,num){
    var answer = target.options[target.selectedIndex].text;
    $('input[name=note'+num+']').attr('value',answer);
  	}

	function fn_submit(){
		<? 
		$query = "SELECT
						QUES_PHASE,
						SUBMIT_YN
					FROM
						ESG_SURVEY_MASTER
					WHERE REG_ID = '".$member_id."'
					AND SURVEY_NAME = '한화'
					AND SURVEY_YEAR = '2022'
					";
		$result = mysqli_query($dbconn, $query); 
		$numrow = mysqli_num_rows($result);
		
		for($i=0; $i<$numrow+1; $i++){
			$row[$i] = mysqli_fetch_array($result);
		}
		
		if($row[0]["SUBMIT_YN"] == 'Y'){
		?>
			alert("최종 제출 완료되어 답변 수정이 불가합니다. 페이지 이동은 좌측 메뉴를 통해 가능합니다.");
			return false;
		<?}?>

		if($('input[name=answr1]:radio:checked').length < 1){
			alert("재해의 원인을 분석하여 현장 안전지침으로 인지시키고 있습니까? 문항을 체크해주세요.");
			$('input[name=answr1]:radio').focus();
			return false;
		}

		frm.submit();
	}
</script>
</html>
