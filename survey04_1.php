<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 4;

$member_id = $_SESSION['mb_id'];
$query = "	SELECT
			ESM_IDX,
            ANSWER_CD AS ANSWR,
            ANSWER_CONT AS CONT,
            ANSWER_NOTE AS NOTE
        FROM
            ESG_ANSWER
        WHERE REG_ID = '".$member_id."'
        AND QUES_PHASE = '4'
				ORDER BY REG_DATE DESC, QUES_NUM
				LIMIT 5";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}

	$answr1 = $row[0]["ANSWR"];

	$answr2 = $row[1]["ANSWR"];

    $answr3 = $row[2]["ANSWR"];

    $answr4 = $row[3]["ANSWR"];

    $answr5 = $row[4]["ANSWR"];
    $answr5Arr = explode('|', $answr5);
    $answr_text5 = $row[4]["CONT"];
    $answr5Arr_text = explode('|', $answr_text5);

	$note1 = $row[0]["CONT"];
    $note2 = $row[1]["CONT"];
    $note3 = $row[2]["CONT"];
    $note4 = $row[3]["CONT"];
    $note5 = $row[4]["CONT"];
	$note5Arr = explode('|', $note5);
    
}
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>

	<div class="contents">
	<form name="frm" id="frm" action="survey/survey04_1_proc.php" method="post">
		<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["ESM_IDX"];?>">
		<p class="tit">2-3.수준진단(지배구조)</p>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">1. 전사적 차원의 행동강령을 보유하고, 이를 공개하고 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr1" id="q1_a1" onclick="answerChk(this,'1');" value="A" <?if($answr1 == "A"){?>checked<?}?>><label for="q1_a1">상: 행동강령이 있으며, 대외공개하고 있다. (홈페이지에 윤리규정 및 윤리규정 실천지침 공시)</label>
			<input type="radio" name="answr1" id="q1_a2" onclick="answerChk(this,'1');" value="B" <?if($answr1 == "B"){?>checked<?}?>><label for="q1_a2">중: 행동강령이 있으나, 대외공개하고 있지는 않다.</label>
			<input type="radio" name="answr1" id="q1_a3" onclick="answerChk(this,'1');" value="C" <?if($answr1 == "C"){?>checked<?}?>><label for="q1_a3">하: 행동강령이 없다.</label>
            <input type="hidden" id="i_num1" name="inum1" value="HTE-CG-01">
            <input type="hidden" id="note_1" name="note1" value="<?php echo $note1; ?>">
		</div>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">2. 선물과 뇌물 수수 금지에 대하여 보장해주는 효과적인 절차가 마련되어 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr2" id="q2_a1" onclick="answerChk(this,'2');" value="A" <?if($answr2 == "A"){?>checked<?}?>><label for="q2_a1">상 : 뇌물과 같은 부당한 이익을 약속, 제공, 허가한 증거나 그러할 위험이 없으며, 관련 의혹이 제기된 경우 적절한 조사와 제재를 실시하기 위한 절차가 문서화되어 있다.</label>
			<input type="radio" name="answr2" id="q2_a2" onclick="answerChk(this,'2');" value="B" <?if($answr2 == "B"){?>checked<?}?>><label for="q2_a2">중 : 선물과 뇌물 수수에 대한 적절한 조사와 제재를 실시하고 있으나, 절차가 문서화되어 있지않다.</label>
			<input type="radio" name="answr2" id="q2_a3" onclick="answerChk(this,'2');" value="C" <?if($answr2 == "C"){?>checked<?}?>><label for="q2_a3">하 : 선물과 뇌물 수수에 대한 적절한 조사와 제재를 실시하지 않는다.</label>
            <input type="hidden" id="i_num2" name="inum2" value="HTE-CG-02">
            <input type="hidden" id="note_2" name="note2" value="<?php echo $note2; ?>">
		</div>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">3. 개인정보보호 시스템을 보유하고 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr3" id="q3_a1" onclick="answerChk(this,'3');" value="A" <?if($answr3 == "A"){?>checked<?}?>><label for="q3_a1">상 : 모의해킹, 파일럿 테스팅 등을 통해 발생가능한 개인정보 유출 사고에 대비하고 있다.</label>
			<input type="radio" name="answr3" id="q3_a2" onclick="answerChk(this,'3');" value="B" <?if($answr3 == "B"){?>checked<?}?>><label for="q3_a2">중 : 개인정보보호 시스템을 정기적으로 점검하고, 문제점을 보완하고 있다.</label>
			<input type="radio" name="answr3" id="q3_a3" onclick="answerChk(this,'3');" value="C" <?if($answr3 == "C"){?>checked<?}?>><label for="q3_a3">하 : 개인정보보호 시스템 보안 소프트웨어를 설치 및 업데이트하고 있다.</label>
            <input type="hidden" id="i_num3" name="inum3" value="HTE-CG-03">
            <input type="hidden" id="note_3" name="note3" value="<?php echo $note3; ?>">
		</div>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">4. 내부 고발자 및 내외부 신고 접수자의 신원을 보호하고 보복 금지를 보장하는 효과적인 정책과 절차가 마련되어 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr4" id="q4_a1" onclick="answerChk(this,'4');" value="A" <?if($answr4 == "A"){?>checked<?}?>><label for="q4_a1">상: 내부 고발자의 신원 노출과 보복을 예방하기 위한 프로세스 또는 정책과 절차를 보유하고 있으며, 내부 고발자 보호 조치의 수준이 감소하였다는 증거나 그럴 위험이 없음을 증빙할 수 있다.</label>
			<input type="radio" name="answr4" id="q4_a2" onclick="answerChk(this,'4');" value="B" <?if($answr4 == "B"){?>checked<?}?>><label for="q4_a2">중 : 내부 고발자 보호 조치의 수준이 감소하였다는 증거나 그럴 위험이 없음을 증빙할 수 있다.</label>
			<input type="radio" name="answr4" id="q4_a3" onclick="answerChk(this,'4');" value="C" <?if($answr4 == "C"){?>checked<?}?>><label for="q4_a3">하 : 신원 보호 및 보복과 관련된 모니터링 절차를 별도로 보유하지 않고 있다.</label>
            <input type="hidden" id="i_num4" name="inum4" value="HTE-CG-04">
            <input type="hidden" id="note_4" name="note4" value="<?php echo $note4; ?>">
		</div>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">5. 조직의 정보 및 개인정보를 관리하는 담당조직이 있습니까?</span></p>
		<div class="A a01">
			<div>
				<input type="radio" name="answr5" id="q5_a1" onclick="answerChk(this,'5');" value="A" <?if($answr5Arr[0] == "A"){?>checked<?}?>><label for="q5_a1">상 : 전사 차원에서 정보보안 및 개인정보보호를 관리하는 총괄조직이 있다.</label>
				<input type="radio" name="answr5" id="q5_a2" onclick="answerChk(this,'5');" value="B" <?if($answr5Arr[0] == "B"){?>checked<?}?>><label for="q5_a2">중 : 사업장 별로 관리하나, 전사 조직이 없다.</label>
				<input type="radio" name="answr5" id="q5_a3" onclick="answerChk(this,'5');" value="C" <?if($answr5Arr[0] == "C"){?>checked<?}?>><label for="q5_a3">하 : 정보보안 및 개인정보보호를 담당하는 조직이 없다.</label>
			</div>
			<table class="mt10">
				<colgroup><col width="155px"><col width="*"></colgroup>
				<tr>
					<th>조직명 입력(부서명)</th>
					<td><input type="text" name="answr5_1" id="q5_a4" value="<?if($answr5Arr_text[1] != ""){echo $answr5Arr_text[1];}?>" <?if($answr5== "C" || $answr5 == "B" || $answr5 == NULL){?>readonly<?}?>></td>
				</tr>
			</table>
            <input type="hidden" id="i_num5" name="inum5" value="HTE-CG-05">
            <input type="hidden" id="note_5" name="note5" value="<?php echo $note5Arr[0] ?>">
            <input type="hidden" id="note_5_1" name="note5_1" value="<?php echo $note5Arr[1] ?>">
		</div>

		<p class="s_btn">
			<a href="survey03_1.php" class="prev">이전단계</a>
			<a href="javascript:void(0)" onclick="fn_submit()" class="next">다음단계</a>
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

        if (idTmp=="q5_a1") {
            $('#q5_a4').removeProp('readonly');
        }
        else if(idTmp=="q5_a2" || idTmp=="q5_a3"){
            $('#q5_a4').attr('readonly',true);
			$('#q5_a4').val("");
		}
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
			alert("1번 문항을 체크해주세요.");
			$('input[name=answr1]:radio').focus();
			return false;
		}

		if($('input[name=answr2]:radio:checked').length < 1){
			alert("2번 문항을 체크해주세요.");
			$('input[name=answr2]:radio').focus();
			return false;
		}

        if($('input[name=answr3]:radio:checked').length < 1){
			alert("3번 문항을 체크해주세요.");
			$('input[name=answr3]:radio').focus();
			return false;
		}

        if($('input[name=answr4]:radio:checked').length < 1){
			alert("4번 문항을 체크해주세요.");
			$('input[name=answr4]:radio').focus();
			return false;
		}

        if($('input[name=answr5]:radio:checked').length < 1){
			alert("5번 문항을 체크해주세요.");
			$('input[name=answr5]:radio').focus();
			return false;
		}
        if($("#q5_a1").is(':checked')){
            if($("#q5_a4").val().trim() == ""){
                alert("5번의 조직명을 입력해주세요.");
                $("#q5_a4").focus();
                return false;
            }
        }
        frm.submit();
	}
</script>
</html>
