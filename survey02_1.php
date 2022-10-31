<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 2;

$member_id = $_SESSION['mb_id'];
$query = "	SELECT
				ESM_IDX,
	            ANSWER_CD AS ANSWR,
	            ANSWER_CONT AS CONT,
	            ANSWER_NOTE AS NOTE
			FROM
				ESG_ANSWER
			WHERE REG_ID = '".$member_id."'
			AND QUES_PHASE = '2'
			ORDER BY REG_DATE DESC, QUES_NUM
			LIMIT 8";
$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}
	for($i=1; $i<9; $i++){
		${"answr".$i} = $row[$i-1]["ANSWR"];
	}

  	for($i=1; $i<9; $i++){
    ${"note".$i} = $row[$i-1]["CONT"];
	}
}
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>

	<div class="contents">
		<form name="frm" id="frm" action="survey/survey02_1_proc.php" method="post">
			<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["ESM_IDX"];?>">
			<p class="tit">2-1.수준진단(환경)</p>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">1. 환경경영을 추진 하기 위한 전담 조직(EHS 팀 등)을 운영하고 있습니까?<span></p>
			<input type="hidden" id="i_num1" name="inum1" value="HTE-CE-01">
			<input type="hidden" id="note_1" name="note1" value="<?php echo $note1; ?>">
			<div class="A a01">
				<input type="radio" name="answr1" id="r01_01" onclick="answerChk(this,1);" value="A" <?if($answr1 == "A"){?>checked<?}?>>
				<label for="r01_01">상 : 환경경영 전담조직을 별도로 구성하여 운영하고 있다.</label>
				<input type="radio" name="answr1" id="r02_01" onclick="answerChk(this,1);" value="B" <?if($answr1 == "B"){?>checked<?}?>>
				<label for="r02_01">중 : 환경경영을 포괄하는 조직(안전환경팀 또는 EHS팀 등)을 구성하여 운영하고 있다.</label>
				<input type="radio" name="answr1" id="r03_01" onclick="answerChk(this,1);" value="C" <?if($answr1 == "C"){?>checked<?}?>>
				<label for="r03_01">하 : 환경경영을 관리하는 조직이 없다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">2. 환경관리 기준 및 목표를 수립하고, 관련 활동을 수행하고 있습니까?<span></p>
			<input type="hidden" id="i_num2" name="inum2" value="HTE-CE-02">
			<input type="hidden" id="note_2" name="note2" value="<?php echo $note2; ?>">
			<div class="A a01">
				<input type="radio" name="answr2" id="r01_02" onclick="answerChk(this,2);" value="A" <?if($answr2 == "A"){?>checked<?}?>>
				<label for="r01_02">상 : 환경관리 기준 및 목표를 수립하고, 관련 활동을 수행하고 있다.</label>
				<input type="radio" name="answr2" id="r02_02" onclick="answerChk(this,2);" value="B" <?if($answr2 == "B"){?>checked<?}?>>
				<label for="r02_02">중 : 환경관리 기준 및 목표를 수립하였다.</label>
				<input type="radio" name="answr2" id="r03_02" onclick="answerChk(this,2);" value="C" <?if($answr2 == "C"){?>checked<?}?>>
				<label for="r03_02">하 : 환경관리 기준 또는 목표를 설정하고 있지 않다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">3. 오염 물질과 폐기물의 발생 및 배출을 관리하고, 이를 최소화하기 위한 자원절약 프로그램 및 개선활동을 실시합니까?<span></p>
			<input type="hidden" id="i_num3" name="inum3" value="HTE-CE-03">
			<input type="hidden" id="note_3" name="note3" value="<?php echo $note3; ?>">
			<div class="A a01">
				<input type="radio" name="answr3" id="r01_03" onclick="answerChk(this,3);" value="A" <?if($answr3 == "A"){?>checked<?}?>>
				<label for="r01_03">상 : 오염 물질과 폐기물의 발생 및 배출을 관리하고, 이를 최소화하기 위한 프로그램 또는 개선활동을 실시한다.</label>
				<input type="radio" name="answr3" id="r02_03" onclick="answerChk(this,3);" value="B" <?if($answr3 == "B"){?>checked<?}?>>
				<label for="r02_03">중 : 오염 물질과 폐기물의 발생 및 배출을 관리하고 있다.</label>
				<input type="radio" name="answr3" id="r03_03" onclick="answerChk(this,3);" value="C" <?if($answr3 == "C"){?>checked<?}?>>
				<label for="r03_03">하 : 오염 물질과 폐기물의 발생 및 배출을 관리하지 않는다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">4. 문서화된 환경정책 또는 환경방침을 보유하고 있습니까?<span></p>
			<input type="hidden" id="i_num4" name="inum4" value="HTE-CE-04">
			<input type="hidden" id="note_4" name="note4" value="<?php echo $note4; ?>">
			<div class="A a01">
				<input type="radio" name="answr4" id="r01_04" onclick="answerChk(this,4);" value="A" <?if($answr4 == "A"){?>checked<?}?>>
				<label for="r01_04">상 : 환경정책 또는 환경방침을 보유하고 대외에 공시하고 있다.</label>
				<input type="radio" name="answr4" id="r02_04" onclick="answerChk(this,4);" value="B" <?if($answr4 == "B"){?>checked<?}?>>
				<label for="r02_04">중 : 환경정책 또는 환경방침을 내부문서로만 보유하고 있다.</label>
				<input type="radio" name="answr4" id="r03_04" onclick="answerChk(this,4);" value="C" <?if($answr4 == "C"){?>checked<?}?>>
				<label for="r03_04">하 : 환경정책 또는 환경방침을 보유하지 않고 있다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">5. 사업과 관련하여 환경관련 법규(또는 행정명령)을 위반한 사실이 있습니까? <span></p>
			<input type="hidden" id="i_num5" name="inum5" value="HTE-CE-05">
			<input type="hidden" id="note_5" name="note5" value="<?php echo $note5; ?>">
			<div class="A a01">
				<input type="radio" name="answr5" id="r01_05" onclick="answerChk(this,5);" value="A" <?if($answr5 == "A"){?>checked<?}?>>
				<label for="r01_05">상 : 사업과 관련하여 환경관련 법규(또는 행정명령)을 위반건수는 0건이다.</label>
				<input type="radio" name="answr5" id="r02_05" onclick="answerChk(this,5);" value="B" <?if($answr5 == "B"){?>checked<?}?>>
				<label for="r02_05">중 : 사업과 관련하여 환경관련 법규(또는 행정명령) 위반건수가 2건 이하이다.</label>
				<input type="radio" name="answr5" id="r03_05" onclick="answerChk(this,5);" value="C" <?if($answr5 == "C"){?>checked<?}?>>
				<label for="r03_05">하 : 사업과 관련하여 환경관련 법규(또는 행정명령) 위반건수가 3건 이상이다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">6. '유해 폐기물을 안전하게 반환하거나 폐기할 수 있는 효과적인 절차가 마련되어 있습니까?<br/>(유해 폐기물 감축을 위한 목표량 설정 및 모니터링, 유해 폐기물 처리/운반 협력업체 점검 등)<span></p>
			<input type="hidden" id="i_num6" name="inum6" value="HTE-CE-06">
			<input type="hidden" id="note_6" name="note6" value="<?php echo $note6; ?>">
			<div class="A a01">
				<input type="radio" name="answr6" id="r01_06" onclick="answerChk(this,6);" value="A" <?if($answr6 == "A"){?>checked<?}?>>
				<label for="r01_06">상 : 유해물질 처리업체를 통하여 유해 물질을 안전하게 폐기하고, 유해물질 처리업체 평가를 진행한다.</label>
				<input type="radio" name="answr6" id="r02_06" onclick="answerChk(this,6);" value="B" <?if($answr6 == "B"){?>checked<?}?>>
				<label for="r02_06">중 : 유해물질 처리업체를 통하여 유해 물질을 안전하게 폐기한다.</label>
				<input type="radio" name="answr6" id="r03_06" onclick="answerChk(this,6);" value="C" <?if($answr6 == "C"){?>checked<?}?>>
				<label for="r03_06">하 : 유해물질 처리에 대한 별도의 절차를 보유하고 있지 않다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">7. 용수와 폐수를 관리하기 위한 연간 절감 계획을 이행하고 있습니까?<span></p>
			<input type="hidden" id="i_num7" name="inum7" value="HTE-CE-07">
			<input type="hidden" id="note_7" name="note7" value="<?php echo $note7; ?>">
			<div class="A a01">
				<input type="radio" name="answr7" id="r01_07" onclick="answerChk(this,7);" value="A" <?if($answr7 == "A"){?>checked<?}?>>
				<label for="r01_07">상 : 수자원 취수/사용/방류를 모니터링하기 위한 절차 또는 시스템이 마련되어 있고, 연감 절감 계획을 수립 및 이행하고 있다.</label>
				<input type="radio" name="answr7" id="r02_07" onclick="answerChk(this,7);" value="B" <?if($answr7 == "B"){?>checked<?}?>>
				<label for="r02_07">중 : 수자원 취수/사용/방류를 모니터링하기 위한 절차 또는 시스템이 마련되어 있다.</label>
				<input type="radio" name="answr7" id="r03_07" onclick="answerChk(this,7);" value="C" <?if($answr7 == "C"){?>checked<?}?>>
				<label for="r03_07">하 : 수자원 취수/사용/방류를 모니터링하기 위한 절차 또는 시스템을 보유하고 있지 않다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">8. 온실가스 배출량 감축 목표 설정(단/장기 목표설정 및 선언)<span></p>
			<input type="hidden" id="i_num8" name="inum8" value="HTE-CE-08">
			<input type="hidden" id="note_8" name="note8" value="<?php echo $note8; ?>">
			<div class="A a01">
				<input type="radio" name="answr8" id="r01_08" onclick="answerChk(this,8);" value="A" <?if($answr8 == "A"){?>checked<?}?>>
				<label for="r01_08">상: 2030년까지의 감축 목표와 2050(or 2040) 넷제로 목표를 각각 설정하고 대외에 공시하였다. </label>
				<input type="radio" name="answr8" id="r02_08" onclick="answerChk(this,8);" value="B" <?if($answr8 == "B"){?>checked<?}?>>
				<label for="r02_08">중: 2030년까지의 감축 목표 또는 2050(or 2040) 넷제로 목표 중 하나만 설정하고 대외에 공시하였다.</label>
				<input type="radio" name="answr8" id="r03_08" onclick="answerChk(this,8);" value="C" <?if($answr8 == "C"){?>checked<?}?>>
				<label for="r03_08">하: 별도의 온실가스 배출량 감축목표 설정값이 없다.</label>
			</div>

			<p class="s_btn">
				<a href="survey01.php" class="prev">이전단계</a>
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
		alert("환경경영을 추진 하기 위한 전담 조직(EHS 팀 등)을 운영하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr1]:radio').focus();
		return false;
	}

	if($('input[name=answr2]:radio:checked').length < 1){
		alert("환경관리 기준 및 목표를 수립하고, 관련 활동을 수행하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr2]:radio').focus();
		return false;
	}
	if($('input[name=answr3]:radio:checked').length < 1){
		alert("오염 물질과 폐기물의 발생 및 배출을 관리하고, 이를 최소화하기 위한 자원절약 프로그램 및 개선활동을 실시합니까? 문항을 체크해주세요.");
		$('input[name=answr3]:radio').focus();
		return false;
	}
	if($('input[name=answr4]:radio:checked').length < 1){
		alert("문서화된 환경정책 또는 환경방침을 보유하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr4]:radio').focus();
		return false;
	}
	if($('input[name=answr5]:radio:checked').length < 1){
		alert("사업과 관련하여 환경관련 법규(또는 행정명령)을 위반한 사실이 있습니까? 문항을 체크해주세요.");
		$('input[name=answr5]:radio').focus();
		return false;
	}
	if($('input[name=answr6]:radio:checked').length < 1){
		alert("유해 폐기물을 안전하게 반환하거나 폐기할 수 있는 효과적인 절차가 마련되어 있습니까? 문항을 체크해주세요.");
		$('input[name=answr6]:radio').focus();
		return false;
	}
	if($('input[name=answr7]:radio:checked').length < 1){
		alert("용수와 폐수를 관리하기 위한 연간 절감 계획을 이행하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr7]:radio').focus();
		return false;
	}


	if($('input[name=answr8]:radio:checked').length < 1){
		alert("온실가스 배출량 감축 목표 설정(단/장기 목표설정 및 선언) 문항을 체크해주세요.");
		$('input[name=answr8]:radio').focus();
		return false;
	}
	
	frm.submit();
}
</script>
</html>
