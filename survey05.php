<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 5;

$member_id = $_SESSION['mb_id'];
$query = "  SELECT
			ESM_IDX,
            ANSWER_CD AS ANSWR,
            ANSWER_CONT AS CONT,
            ANSWER_NOTE AS NOTE
        FROM
            ESG_ANSWER
        WHERE REG_ID = '".$member_id."'
            AND QUES_PHASE = '5'
            ORDER BY REG_DATE DESC, QUES_NUM
            LIMIT 3";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}

	$answr1 = $row[0]["ANSWR"];

    $answr2 = $row[1]["ANSWR"];
 
	$answr3 = $row[2]["CONT"]; 
    $answr3Arr = explode('|', $answr3);  
    $answr_option3 = $row[2]["ANSWR"];  
	$answr_text3 = $row[2]["CONT"];  
	$answr3Arr_option = explode('|', $answr_option3); //관리여부 
	$answr3Arr_text = explode('|', $answr_text3);
   

    $note1 = $row[0]["CONT"];
    $note2 = $row[1]["CONT"];
    $note3 = $row[2]["CONT"];
    $note3Arr = explode('|', $note3);

}
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>


	<div class="contents">
	<form name="frm" id="frm" action="survey/survey05_proc.php" method="post">
		<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["ESM_IDX"];?>">
		<p class="tit">2-4.수준진단(산업특화/화학제조)</p>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">1. 위험물질을 취급하는 근로자를 대상으로 정기 건강검진을 시행하고 이를 관리하고 있습니까?</span></p>
        <div class="A a01">
			<input type="radio" id="q1_a1" name="answr1" onclick="answerChk(this,1);"  value="A" <?if($answr1 == "A"){?>checked<?}?>>
			<label for="q1_a1">상 : 전 사업장 및 하청업체/협력업체의 근로자를 관리하고 있다.</label>
			<input type="radio" id="q1_a2" name="answr1" onclick="answerChk(this,1);" value="B" <?if($answr1 == "B"){?>checked<?}?>>
			<label for="q1_a2" >중 : 전 사업장의 근로자를 관리하고 있다.</label>
			<input type="radio" id="q1_a3" name="answr1" onclick="answerChk(this,1);"value="C" <?if($answr1 == "C"){?>checked<?}?>>
			<label for="q1_a3" >하 : 일부 사업장의 근로자를 관리하고 있거나 별도로 관리하지 않고 있다.</label>
			<input type="hidden" id="i_num1" name="inum1" value="HTE-IC-01">
			<input type="hidden" id="note_1" name="note1" value="<?php echo $note1; ?>">
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">2. 유해물질 수령, 보관, 배포, 사용 등 각 행위에 대하여 유해물질을 관리하는데 효과적인 절차가 확립되어 있습니까?<br/>(사용 추적 및 검토, 구매 승인, 보관소 내 정보 공시 등)</span></p>
		<div class="A a01">
			<input type="radio" name="answr2" id="q2_a1" onclick="answerChk(this,2);"  value="A" <?if($answr2 == "A"){?>checked<?}?>>
            <label for="q2_a1">상 : 정부 승인/면허 취득 업체를 통하여 폐기물을 포함한 유해 물질을 분류, 표시, 취급, 보관, 운송, 처리한다.</label>
			<input type="radio" name="answr2" id="q2_a2" onclick="answerChk(this,2);"  value="B" <?if($answr2 == "B"){?>checked<?}?>>
            <label for="q2_a2">중 : 자체적인 기준을 수립하여 유해 물질을 분류, 표시, 취급, 보관, 운송, 처리한다.</label>
			<input type="radio" name="answr2" id="q2_a3" onclick="answerChk(this,2);"  value="C" <?if($answr2 == "C"){?>checked<?}?>>
            <label for="q2_a3">하 : 유해 물질을 분류, 표시, 취급, 보관, 운송, 처리하는 절차를 보유하고 있지 않다.</label>
			<input type="hidden" id="i_num2" name="inum2" value="HTE-IC-02">
			<input type="hidden" id="note_2" name="note2" value="<?php echo $note5; ?>">
		</div>

		<p class="Q c03"><span class="c03">환경</span><span class="txt">3. 사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익</span></p>
		<div class="A a01">
		<input type="hidden" id="i_num3" name="inum3" value="HTE-IC-03">
        <input type="hidden" id="note_3" name="note3" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
        <input type="hidden" id="note_3_1" name="note3_1" value="<?php echo $note3Arr[0]?>">
        <input type="hidden" id="note_3_2" name="note3_2" value="<?php echo $note3Arr[1]?>">
        <input type="hidden" id="note_3_3" name="note3_3" value="<?php echo $note3Arr[2]?>">    
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
						<select id="q3_a1" name="answr3_1" onchange="showValue(this,'3_1')">
							<option value="">관리여부</option>
							<option value="Y" <?if($answr3Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
							<option value="N" <?if($answr3Arr_option[0] == "N"){?>selected<?}?>>NO</option>
							<option value="X" <?if($answr3Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q3_a2" name="answr3_2" onchange="showValue(this,'3_2')">
                            <option value="">목표설정여부</option>
							<option value="Y" <?if($answr3Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr3Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr3Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q3_a3" name="answr3_3" onchange="showValue(this,'3_3')">
                            <option value="">공개여부</option>
							<option value="Y" <?if($answr3Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr3Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr3Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            <br>
            <p class="unit">단위:원</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q4_a1" name="answr4_1" value="<?if($answr3Arr_text[3] == ""){echo "";}else{echo $answr3Arr[3];}?>" <?if($answr3Arr_option[0] != "Y" && $answr3Arr_option[0] == null && $answr3Arr_option[1] != "Y" && $answr3Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q4_a2" name="answr4_2" value="<?if($answr3Arr_text[4] == ""){echo "";}else{echo $answr3Arr[4];}?>" <?if($answr3Arr_option[0] != "Y" && $answr3Arr_option[0] == null && $answr3Arr_option[1] != "Y" && $answr3Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q4_a3" name="answr4_3" value="<?if($answr3Arr_text[5] == ""){echo "";}else{echo $answr3Arr[5];}?>" <?if($answr3Arr_option[0] != "Y" && $answr3Arr_option[0] == null && $answr3Arr_option[1] != "Y" && $answr3Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		
		</div>		

		<p class="s_btn">
			<a href="survey04.php" class="prev">이전단계</a>
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

    var selectOption1  = document.getElementById('q3_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q3_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q3_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;
        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q4_a1').attr('readonly',false);
            $('#q4_a2').attr('readonly',false);
            $('#q4_a3').attr('readonly',false);
        } else {
            $('#q4_a1').attr('readonly',true);
            $('#q4_a2').attr('readonly',true);
            $('#q4_a3').attr('readonly',true);
            $('#q4_a1').val("");
            $('#q4_a2').val("");
            $('#q4_a3').val("");
        }
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
		alert("위험물질을 취급하는 근로자를 대상으로 정기 건강검진을 시행하고 이를 관리하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr1]:radio').focus();
		return false;
	}

	if($('input[name=answr2]:radio:checked').length < 1){
		alert("유해물질 수령, 보관, 배포, 사용 등 각 행위에 대하여 유해물질을 관리하는데 효과적인 절차가 확립되어 있습니까? 문항을 체크해주세요.");
		$('input[name=answr2]:radio').focus();
		return false;
	}

	
	if($("#q3_a1").val().trim()==""){
	alert("사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익 문항을 선택해주세요");
			$("#q3_a1").focus();
	return false;
	}

	
	if($("#q3_a2").val().trim()==""){
	alert("사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익 문항을 선택해주세요");
			$("#q3_a2").focus();
	return false;
	}

	
	if($("#q3_a3").val().trim()==""){
	alert("사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익 문항을 선택해주세요");
			$("#q3_a3").focus();
	return false;
	}
	
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q4_a1").val().trim()==""){
	alert("사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익  문항을 입력해주세요");
			$("#q4_a1").focus();
		return false;
		}    

	if(!reg.test($("#q4_a1").val())){
		alert('사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익  숫자만 입력해주세요.');
		$("#q4_a1").focus();
		return false;
	}
	if($("#q4_a2").val().trim()==""){
	alert("사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익  문항을 입력해주세요");
			$("#q4_a2").focus();
		return false;
		}   

	if(!reg.test($("#q4_a2").val())){
	alert('사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익  숫자만 입력해주세요.');
		$("#q4_a2").focus();
		return false;
		}
	
	if($("#q4_a3").val().trim()==""){
	alert(" 사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익  문항을 입력해주세요");
			$("#q4_a3").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q4_a3").val())){
		alert('사용단계에서 자원효율을 높이도록 설계된 제품의 총 수익 숫자만 입력해주세요.');
		$("#q4_a3").focus();
		return false;
	}
	frm.submit();
}
</script> 
</html>
