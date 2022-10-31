<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 7;

$member_id = $_SESSION['mb_id'];
$query = "	SELECT
			ESM_IDX,
            ANSWER_CD AS ANSWR,
            ANSWER_CONT AS CONT,
            ANSWER_NOTE AS NOTE
        FROM
            ESG_ANSWER
        WHERE REG_ID = '".$member_id."'
        AND QUES_PHASE = '7'
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

    $answr3 = $row[2]["CONT"];
    $answr3Arr = explode('|', $answr3);
    $answr_option3 = $row[2]["ANSWR"];
	$answr3Arr_option = explode('|', $answr_option3);	

	$answr4 = $row[3]["ANSWR"];

    $answr5 = $row[4]["CONT"];
    $answr5Arr = explode('|', $answr5);
    $answr_option5 = $row[4]["ANSWR"];
	$answr_text5 = $row[4]["CONT"];
	$answr5Arr_option = explode('|', $answr_option5);
    $answr5Arr_text = explode('|', $answr_text5);


	$note1 = $row[0]["CONT"];
    $note2 = $row[1]["CONT"];
    $note3 = $row[2]["CONT"];
	$note3Arr = explode('|', $note3);
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
	<form name="frm" id="frm" action="survey/survey07_proc.php" method="post">
		<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["ESM_IDX"];?>">
		<p class="tit">2-4.수준진단(산업특화/운송)</p>

		<p class="Q c02"><span class="c02">환경</span><span class="txt">1. 물류 배송 측면의 에너지 절감을 위한 전략 또는 목표를 수립하여 관리하고 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr1" id="q1_a1" onclick="answerChk(this,'1');" value="A" <?if($answr1 == "A"){?>checked<?}?>><label for="q1_a1">상 : 물류 배송 측면의 에너지 절감을 위한 전략 또는 목표를 수립하고, 물류 효율화 달성 및 공차율 감소 등의 에너지 관리 활동을 수행하고 있다.</label>
			<input type="radio" name="answr1" id="q1_a2" onclick="answerChk(this,'1');" value="B" <?if($answr1 == "B"){?>checked<?}?>><label for="q1_a2">중 : 물류 배송 측면의 에너지 절감을 위한 활동을 수행하고 있다.</label>
			<input type="radio" name="answr1" id="q1_a3" onclick="answerChk(this,'1');" value="C" <?if($answr1 == "C"){?>checked<?}?>><label for="q1_a3">하 : 물류 배송 측면의 에너지 절감을 위한 활동을 별도로 수행하고 있지 않다.</label>
			<input type="hidden" id="i_num1" name="inum1" value="HTE-IL-01">
            <input type="hidden" id="note_1" name="note1" value="<?php echo $note1; ?>">
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">2. 초과근무 과다 통제, 휴무 보장 등 법적 근로기준을 준수하여 근무시간을 관리하는 정책 및 방침이 확립되어 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr2" id="q2_a1" onclick="answerChk(this,'2');" value="A" <?if($answr2 == "A"){?>checked<?}?>><label for="q2_a1">상 : 초과근무 과다 통제, 휴무 보장 등 법적 근로기준을 준수하여 근무시간을 관리하는 정책 및 방침을 문서화하여 보유하고 있다.</label>
			<input type="radio" name="answr2" id="q2_a2" onclick="answerChk(this,'2');" value="B" <?if($answr2 == "B"){?>checked<?}?>><label for="q2_a2">중 : 초과근무 과다 통제, 휴무 보장 등 법적 근로기준을 준수하고 있다.</label>
			<input type="radio" name="answr2" id="q2_a3" onclick="answerChk(this,'2');" value="C" <?if($answr2 == "C"){?>checked<?}?>><label for="q2_a3">하 : 최근 3년 이내 초과근무 과다 통제, 휴무 보장 등 법적 근로기준을 준수하지 않는 경우가 발생했다.</label>
			<input type="hidden" id="i_num2" name="inum2" value="HTE-IL-02">
            <input type="hidden" id="note_2" name="note2" value="<?php echo $note2; ?>">
		</div>

		<p class="Q c02"><span class="c02">환경</span><span class="txt">3. 화물자동차운수사업법 규정 준수와 근무시간, 일정, 수면무호흡 및 피로관리 활동</span></p>
		<div class="A a01">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
						<select id="q3_a1" name="answr3_1" onchange="showValue(this,'3_1','3')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr3Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr3Arr_option[0] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr3Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q3_a2" name="answr3_2" onchange="showValue(this,'3_2','3')">
                            <option value="">목표설정여부</option>
    						<option value="Y" <?if($answr3Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr3Arr_option[1] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr3Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q3_a3" name="answr3_3" onchange="showValue(this,'3_3','3')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr3Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr3Arr_option[2] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr3Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
			<input type="hidden" id="i_num3" name="inum3" value="HTE-IL-03">
			<input type="hidden" id="note_3" name="note3" value="관리여부|목표설정여부|공개여부">
            <input type="hidden" id="note_3_1" name="note3_1" value="<?php echo $note3Arr[0]?>">
            <input type="hidden" id="note_3_2" name="note3_2" value="<?php echo $note3Arr[1]?>">
            <input type="hidden" id="note_3_3" name="note3_3" value="<?php echo $note3Arr[2]?>">
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">4. 유해화학물질 운송 관리체계 구축를 구축하여 운영하고 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr4" id="q4_a1" onclick="answerChk(this,'4');" value="A" <?if($answr4 == "A"){?>checked<?}?>><label for="q4_a1">상 : 유해화학물질 운송 중 발생할 수 있는 사고를 사전에 방지하는 것을 목표로 유해화학물질 체계를 구축하고, 협력사 자체 안전관리 역량을 강화할 수 있도록 지원하고 있다.</label>
			<input type="radio" name="answr4" id="q4_a2" onclick="answerChk(this,'4');" value="B" <?if($answr4 == "B"){?>checked<?}?>><label for="q4_a2">중 : 초과근무 과다 통제, 휴무 보장 등 법적 근로기준을 준수하고 있다.</label>
			<input type="radio" name="answr4" id="q4_a3" onclick="answerChk(this,'4');" value="C" <?if($answr4 == "C"){?>checked<?}?>><label for="q4_a3">하 : 최근 3년 이내 초과근무 과다 통제, 휴무 보장 등 법적 근로기준을 준수하지 않는 경우가 발생했다.</label>
			<input type="hidden" id="i_num4" name="inum4" value="HTE-IL-04">
            <input type="hidden" id="note_4" name="note4" value="<?php echo $note4; ?>">
		</div>

		<p class="Q c02"><span class="c02">환경</span><span class="txt">5. 연료 사용량 중 천연가스 비율, 재생에너지 비율</span></p>
		<div class="A a01">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
                        <select id="q5_a1" name="answr5_1" onchange="showValue(this,'5_1','5')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr5Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr5Arr_option[0] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr5Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q5_a2" name="answr5_2" onchange="showValue(this,'5_2','5')">
                            <option value="">목표설정여부</option>
    						<option value="Y" <?if($answr5Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr5Arr_option[1] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr5Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q5_a3" name="answr5_3" onchange="showValue(this,'5_3','5')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr5Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr5Arr_option[2] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr5Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            <br>
            <p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q5_a4" name="answr5_4" value="<?if($answr5Arr_text[3] != ""){echo $answr5Arr[3];}?>" <?if($answr5Arr_option[0] != "Y" && $answr5Arr_option[0] == null && $answr5Arr_option[1] != "Y" && $answr5Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q5_a5" name="answr5_5" value="<?if($answr5Arr_text[4] != ""){echo $answr5Arr[4];}?>" <?if($answr5Arr_option[0] != "Y" && $answr5Arr_option[0] == null && $answr5Arr_option[1] != "Y" && $answr5Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q5_a6" name="answr5_6" value="<?if($answr5Arr_text[5] != ""){echo $answr5Arr[5];}?>" <?if($answr5Arr_option[0] != "Y" && $answr5Arr_option[0] == null && $answr5Arr_option[1] != "Y" && $answr5Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
			<input type="hidden" id="i_num5" name="inum5" value="HTE-IL-05">
			<input type="hidden" id="note_5" name="note5" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_5_1" name="note5_1" value="<?php echo $note5Arr[0]?>">
            <input type="hidden" id="note_5_2" name="note5_2" value="<?php echo $note5Arr[1]?>">
            <input type="hidden" id="note_5_3" name="note5_3" value="<?php echo $note5Arr[2]?>">
			<input type="hidden" id="note_5_4" name="note5_4" value="<?php echo $note5Arr[3]?>">
			<input type="hidden" id="note_5_5" name="note5_5" value="<?php echo $note5Arr[4]?>">
			<input type="hidden" id="note_5_6" name="note5_6" value="<?php echo $note5Arr[5]?>">
		</div>

		<p class="s_btn">
			<a href="survey06.php" class="prev">이전단계</a>
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
	}

	function showValue(target,num, num1){
    	var answer = target.options[target.selectedIndex].text;
    	$('input[name=note'+num+']').attr('value',answer);

        var selectOption1  = document.getElementById('q'+num1+'_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q'+num1+'_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q'+num1+'_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;
        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q'+num1+'_a4').attr('readonly',false);
            $('#q'+num1+'_a5').attr('readonly',false);
            $('#q'+num1+'_a6').attr('readonly',false);
        } else {
            $('#q'+num1+'_a4').attr('readonly',true);
            $('#q'+num1+'_a5').attr('readonly',true);
            $('#q'+num1+'_a6').attr('readonly',true);
            $('#q'+num1+'_a4').val("");
            $('#q'+num1+'_a5').val("");
            $('#q'+num1+'_a6').val("");
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
			alert("1번 문항에 체크해주세요.");
			$('input[name=answr1]:radio').focus();
			return false;
		}

		if($('input[name=answr2]:radio:checked').length < 1){
			alert("2번 문항에 체크해주세요.");
			$('input[name=answr2]:radio').focus();
			return false;
		}

		for(var i=1; i<4; i++){
			if($("#q3_a"+i).val().trim()==""){
	      		alert("3번 문항을 선택해주세요.");
				$("#a3_a"+i).focus();
	      		return false;
			}
	    }

		if($('input[name=answr4]:radio:checked').length < 1){
			alert("4번 문항에 체크해주세요.");
			$('input[name=answr4]:radio').focus();
			return false;
		}

		for(var i=1; i<=3; i++){
			if($("#q5_a"+i).val().trim()==""){
	      		alert("5번 문항을 선택해주세요.");
				$("#a5_a"+i).focus();
	      		return false;
			}
	    }

		var reg = /^[-|+]?\d+\.?\d*$/;
		var year = 2019;
		if($("#q5_a1").val()=="Y" || $("#q5_a2").val()=="Y"){  
		for(var i=4; i<=6; i++){
			if($("#q5_a"+i).val().trim() == ""){
				alert("5번 비율을 입력해주세요.");
				$("#q5_a"+i).focus();
				return false;
			}
			if(!reg.test($("#q5_a"+i).val())){
				alert(year+"년 비율에 숫자만 입력해주세요.");
				$("#q5_a"+i).focus();
				return false;
			}
			year++;
		}
	}

        frm.submit();
	}
</script>
</html>
