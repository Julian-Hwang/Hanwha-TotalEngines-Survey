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
		LIMIT 5";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}

    $answr1 = $row[0]["ANSWR"];

    $answr2 = $row[1]["CONT"];
    $answr2Arr = explode('|', $answr2);
    $answr_option2 = $row[1]["ANSWR"];
	$answr_text2 = $row[1]["CONT"];
	$answr2Arr_option = explode('|', $answr_option2);
    $answr2Arr_text = explode('|', $answr_text2);

    $answr3 = $row[2]["CONT"];
    $answr3Arr = explode('|', $answr3);
    $answr_option3 = $row[2]["ANSWR"];
	$answr_text3 = $row[2]["CONT"];
	$answr3Arr_option = explode('|', $answr_option3);
    $answr3Arr_text = explode('|', $answr_text3);

	$answr4 = $row[3]["ANSWR"];
	$answr5 = $row[4]["ANSWR"];

    $note1 = $row[0]["CONT"];
    $note2 = $row[1]["CONT"];
    $note3 = $row[2]["CONT"];
    $note4 = $row[3]["CONT"];
    $note5 = $row[4]["CONT"];
	$note2Arr = explode('|', $note2);
    $note3Arr = explode('|', $note3);

}
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>

	<div class="contents">
	<form name="frm" id="frm" action="survey/survey06_proc.php" method="post">
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

		<p class="Q c03"><span class="c03">사회</span><span class="txt">2. 결함 및 안전 관련 재작업 비용 금액</span></p>
		<div class="A a01">
        <input type="hidden" id="i_num2" name="inum2" value="HTE-ID-02">
        <input type="hidden" id="note_2" name="note2" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_2_1" name="note2_1" value="<?php echo $note2Arr[0]?>">
			<input type="hidden" id="note_2_2" name="note2_2" value="<?php echo $note2Arr[1]?>">
			<input type="hidden" id="note_2_3" name="note2_3" value="<?php echo $note2Arr[2]?>">
            <input type="hidden" id="note_2_4" name="note2_4" value="<?php echo $note2Arr[3]?>">
			<input type="hidden" id="note_2_5" name="note2_5" value="<?php echo $note2Arr[4]?>">
			<input type="hidden" id="note_2_6" name="note2_6" value="<?php echo $note2Arr[5]?>">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
						<select id="q2_a1" name="answr2_1" onchange="showValue(this,'2_1','2')">
							<option value="">관리여부</option>
							<option value="Y" <?if($answr2Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr2Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr2Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
                        <select id="q2_a2" name="answr2_2" onchange="showValue(this,'2_2','2')">
							<option value="">목표설정여부</option>
							<option value="Y" <?if($answr2Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr2Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr2Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
                        <select id="q2_a3" name="answr2_3" onchange="showValue(this,'2_3','2')">
							<option value="">공개여부</option>
							<option value="Y" <?if($answr2Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr2Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr2Arr_option[2] == "X"){?>selected<?}?>>모름</option>
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
                    <td><input type="text" id="q2_a4" name="answr2_4" value="<?if($answr2Arr_text[3] == ""){echo "";}else{echo $answr2Arr[3];}?>" <?if($answr2Arr_option[0] != "Y" && $answr2Arr_option[0] == null && $answr2Arr_option[1] != "Y" && $answr2Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q2_a5" name="answr2_5" value="<?if($answr2Arr_text[4] == ""){echo "";}else{echo $answr2Arr[4];}?>" <?if($answr2Arr_option[0] != "Y" && $answr2Arr_option[0] == null && $answr2Arr_option[1] != "Y" && $answr2Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q2_a6" name="answr2_6" value="<?if($answr2Arr_text[5] == ""){echo "";}else{echo $answr2Arr[5];}?>" <?if($answr2Arr_option[0] != "Y" && $answr2Arr_option[0] == null && $answr2Arr_option[1] != "Y" && $answr2Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>
		<p class="Q c02"><span class="c02">환경</span><span class="txt">3. 프로젝트 설계, 현장 및 건설과 관련된 환경 리스크를 평가하고 관리하기 위한 프로세스</span></p>
		<div class="A a01">
        <input type="hidden" id="i_num3" name="inum3" value="HTE-ID-03">
        <input type="hidden" id="note_3" name="note3" value="관리여부|목표설정여부|공개여부|환경영향평가 프로세스 서술">
            <input type="hidden" id="note_3_1" name="note3_1" value="<?php echo $note3Arr[0]?>">
			<input type="hidden" id="note_3_2" name="note3_2" value="<?php echo $note3Arr[1]?>">
			<input type="hidden" id="note_3_3" name="note3_3" value="<?php echo $note3Arr[2]?>">
            <input type="hidden" id="note_3_4" name="note3_4" value="<?php echo $note3Arr[3]?>">
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
			<div class="mt10">
				<textarea placeholder="환경영향평가 프로세스 서술" id="q3_a4" name="answr3_4"><?if($answr3Arr_text[3] == ""){echo "";}else{echo $answr3Arr[3];}?><?if($answr3Arr_option[0] != "Y" && $answr3Arr_option[0] == null && $answr3Arr_option[1] != "Y" && $answr3Arr_option[1] == null){?><?}?></textarea>
			</div>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">4. 중대재해로 이어질 수 있는 건설기계 및 장비사고를 예방하기 위해 타워크레인, 건설용리프트 등 장비 반입 전 사전검사를 실시하고 있습니까?</span></p>
        <input type="hidden" id="i_num4" name="inum4" value="HTE-ID-04">
		<input type="hidden" id="note_4" name="note4" value="<?php echo $note4; ?>">
        <div class="A a01">
			<input type="radio" id="r01_04" name="answr4" onclick="answerChk(this,4);" value="A" <?if($answr4 == "A"){?>checked<?}?>>
            <label for="r01_04">상 : 건설기계 및 장비사고를 예방하기 위한 정책 또는 방침을 수립하여 문서화하고, 장비 반입 전 사전검사를 실시하고 있다.</label>
			<input type="radio" id="r02_04" name="answr4" onclick="answerChk(this,4);" value="B" <?if($answr4 == "B"){?>checked<?}?>>
            <label for="r02_04">중 : 건설기계 및 장비사고를 예방하기 위한 정책 또는 방침을 보유하고 있다.</label>
			<input type="radio" id="r03_04" name="answr4" onclick="answerChk(this,4);" value="C" <?if($answr4 == "C"){?>checked<?}?>>
            <label for="r03_04">하 : 건설기계 및 장비사고를 예방하기 위한 정책 또는 방침을 보유하고 있지 않다.</label>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">5. 기계, 전기, 화학, 화재 및 물리적 위험 등을 포함한 모든 확인된 작업 현장 위험에 대해 근로자에게 적절한 작업장 보건 안전 정보와 교육을 모국어 또는 근로자가 이해할 수 있는 언어로 제공하고 있습니까?</span></p>
        <input type="hidden" id="i_num5" name="inum5" value="HTE-ID-05">
		<input type="hidden" id="note_5" name="note5" value="<?php echo $note5; ?>">
        <div class="A a01">
			<input type="radio" id="r01_05" name="answr5" onclick="answerChk(this,5);" value="A" <?if($answr5 == "A"){?>checked<?}?>>
            <label for="r01_05">상 : 안전보건 관련 정보는 작업현장 시설 내에 잘 보이도록 게시하고 근로자가 접근할 수 있으며, 업무 시작 전 그리고 업무 중 정기적으로 모든 근로자에게 교육을 제공하고 있다.</label>
			<input type="radio" id="r02_05" name="answr5" onclick="answerChk(this,5);" value="B" <?if($answr5 == "B"){?>checked<?}?>>
            <label for="r02_05">중 : 안전보건 관련 정보는 작업현장 시설 내에 잘 보이도록 게시하고 근로자가 접근할 수 있다.</label>
			<input type="radio" id="r03_05" name="answr5" onclick="answerChk(this,5);" value="C" <?if($answr5 == "C"){?>checked<?}?>>
            <label for="r03_05">하 : 비정기적으로 모든 근로자에게 안전보건 교육을 제공하고 있다.</label>
		</div>

		<p class="s_btn">
			<a href="survey05.php" class="prev">이전단계</a>
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

	function showValue(target,num,num1){
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
			alert("재해의 원인을 분석하여 현장 안전지침으로 인지시키고 있습니까? 문항을 체크해주세요.");
			$('input[name=answr1]:radio').focus();
			return false;
		}

        //alert ($("#q2_a1").val());
		if($("#q2_a1").val().trim()==""){
	        alert("결함 및 안전 관련 재작업 비용 금액을 관리하고 있습니까? 문항을 선택해주세요.");
		    $("#q2_a1").focus();
	      return false;
	    }
        if($("#q2_a2").val().trim()==""){
	        alert("결함 및 안전 관련 재작업 비용 금액을 목표 설정하고 있습니까? 문항을 선택해주세요.");
		    $("#q2_a2").focus();
	      return false;
	    }
        if($("#q2_a3").val().trim()==""){
	        alert("결함 및 안전 관련 재작업 비용 금액을 공개하고 있습니까? 문항을 선택해주세요.");
		    $("#q2_a3").focus();
	      return false;
	    }
		

		var reg = /^[-|+]?\d+\.?\d*$/;
		var year = 2019;
		if($("#q2_a1").val()=="Y" || $("#q2_a2").val()=="Y"){
			for(var i=4; i<7; i++){
				if($("#q2_a"+i).val().trim() == ""){
					alert(year+"년 결함 및 안전 관련 재작업 비용 금액을 입력해주세요.");
					$("#q2_a"+i).focus();
					return false;
				}
				if(!reg.test($("#q2_a"+i).val())){
					alert(year+"년 결함 및 안전 관련 재작업 비용 금액에 숫자만 입력해주세요.");
					$("#q2_a"+i).focus();
					return false;
				}
				year++;
			}
		}
        if($("#q3_a1").val().trim()==""){
	        alert("3번 관리여부 문항을 선택해주세요.");
		    $("#q3_a1").focus();
	      return false;
	    }
        if($("#q3_a2").val().trim()==""){
	        alert("3번 목표설정여부 문항을 선택해주세요.");
		    $("#q3_a2").focus();
	      return false;
	    }
        if($("#q3_a3").val().trim()==""){
	        alert("3번 공개여부 문항을 선택해주세요.");
		    $("#q3_a3").focus();
	      return false;
	    }

		if($("#q3_a1").val()=="Y" || $("#q3_a2").val()=="Y"){
			if($("#q3_a4").val().trim() == ""){
					alert("3번의 환경영향평가 프로세스를 서술해주세요.");
					$("#q3_a4").focus();
					return false;
			}
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

		frm.submit();
	}
</script>
</html>
