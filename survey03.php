<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 3;

$member_id = $_SESSION['mb_id'];
$query = "	SELECT
			ESM_IDX,
            ANSWER_CD AS ANSWR,
            ANSWER_CONT AS CONT,
            ANSWER_NOTE AS NOTE
        FROM
            ESG_ANSWER
        WHERE REG_ID = '".$member_id."'
        AND QUES_PHASE = '3'
				ORDER BY REG_DATE DESC, QUES_NUM
				LIMIT 28";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}


    for($i=1; $i<29; $i++){
        ${"answr".$i} = $row[$i-1]["ANSWR"];
	}
    $answr4 = $row[3]["ANSWR"];
    $answr18 = $row[17]["ANSWR"];
    $answr19 = $row[18]["ANSWR"];
	for($i=8; $i<16; $i++){
        ${"answr_option".$i} = $row[$i-1]["ANSWR"];
	}
	for($i=8; $i<16; $i++){
        ${"answr_text".$i} = $row[$i-1]["CONT"];
	}

    for($i=18; $i<20; $i++){
        ${"answr_option".$i} = $row[$i-1]["ANSWR"];
	}
	for($i=18; $i<20; $i++){
        ${"answr_text".$i} = $row[$i-1]["CONT"];
	}

    for($i=24; $i<28; $i++){
        ${"answr_option".$i} = $row[$i-1]["ANSWR"];
	}
	for($i=24; $i<28; $i++){
        ${"answr_text".$i} = $row[$i-1]["CONT"];
	}

    $answr4Arr = explode('|', $answr4);
	for($i=8; $i<16; $i++){
        ${"answr".$i."Arr_option"} = explode('|', ${"answr_option".$i});
	}
	for($i=8; $i<16; $i++){
        ${"answr".$i."Arr_text"} = explode('|', ${"answr_text".$i});
	}
    for($i=18; $i<20; $i++){
        ${"answr".$i."Arr_option"} = explode('|', ${"answr_option".$i});
	}
	for($i=18; $i<20; $i++){
        ${"answr".$i."Arr_text"} = explode('|', ${"answr_text".$i});
	}

    for($i=24; $i<28; $i++){
        ${"answr".$i."Arr_option"} = explode('|', ${"answr_option".$i});
	}
	for($i=24; $i<28; $i++){
        ${"answr".$i."Arr_text"} = explode('|', ${"answr_text".$i});
	}

    for($i=8; $i<29; $i++){
        ${"answr".$i."Arr"} = explode('|', ${"answr".$i});
	}
    
    for($i=1; $i<29; $i++){
        ${"note".$i} = $row[$i-1]["CONT"];
	}

	for($i=8; $i<28; $i++){
        ${"note".$i."Arr"} = explode('|', ${"note".$i});
	}

}
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>

	<div class="contents">
	<form name="frm" id="frm" action="survey/survey03_proc.php" method="post">
		<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["ESM_IDX"];?>">
		<p class="tit">2-2.수준진단(사회)</p>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">1. 안전보건 관리를 위한 협의체 또는 전담 조직이 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num1" name="inum1" value="HTE-CS-01">
		<input type="hidden" id="note_1" name="note1" value="<?php echo $note1; ?>">
			<input type="radio" name="answr1" id="q1_a1" onclick="answerChk(this,'1');" value="A" <?if($answr1 == "A"){?>checked<?}?>>
            <label for="q1_a1">상 : 안전보건 의사결정/협의/전담 조직을 보유하고 있으며, 전사 단위의 재해율 및 사고율 관리를 위한 업무를 담당한다.</label>
			<input type="radio" name="answr1" id="q1_a2" onclick="answerChk(this,'1');" value="B" <?if($answr1 == "B"){?>checked<?}?>>
            <label for="q1_a2">중 : 안전보건 의사결정/협의/전담 조직은 없으나 사업장별로 해율 및 사고율 관리를 위한 업무를 별도로 담당한다.</label>
			<input type="radio" name="answr1" id="q1_a3" onclick="answerChk(this,'1');" value="C" <?if($answr1 == "C"){?>checked<?}?>>
            <label for="q1_a3">하 : 안전보건 의사결정/협의/전담 조직이 없다.</label>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">2. 대외적으로 공개하는 안전보건 정책 또는 방침이 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num2" name="inum2" value="HTE-CS-02">
		<input type="hidden" id="note_2" name="note2" value="<?php echo $note2; ?>">
			<input type="radio" name="answr2" id="q2_a1" onclick="answerChk(this,'2');" value="A" <?if($answr2 == "A"){?>checked<?}?>>
            <label for="q2_a1">상 : 안전보건 정책 또는 방침이 있으며, 대외에 공시하고 있다.</label>
			<input type="radio" name="answr2" id="q2_a2" onclick="answerChk(this,'2');" value="B" <?if($answr2 == "B"){?>checked<?}?>>
            <label for="q2_a2">중 : 안전보건 정책 또는 방침이 있으며, 내부 문서화하여 보유하고 있다.</label>
			<input type="radio" name="answr2" id="q2_a3" onclick="answerChk(this,'2');" value="C" <?if($answr2 == "C"){?>checked<?}?>>
            <label for="q2_a3">하 : 안전보건 정책 또는 방침을 보유하지 않고 있다.</label>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">3. 인권정책을 보유하고 있습니까?<span></p>
		<div class="A float a01">
        <input type="hidden" id="i_num3" name="inum3" value="HTE-CS-03">
		<input type="hidden" id="note_3" name="note3" value="<?php echo $note3; ?>">
			<div class="sample">
			- 보유하고 있을 시: 예<br/>
			- 보유하고 있지 않을 시: 아니오<br/>
			- 내부 검토 중일 시: 내부 검토 중 (2023년 내 인권정책 수립 예정의 경우)
			</div>
			<div>
				<input type="radio" name="answr3" id="q3_a1" onclick="answerChk(this,'3');" value="Y" <?if($answr3 == "Y"){?>checked<?}?>>
                <label for="q3_a1">예</label>
				<input type="radio" name="answr3" id="q3_a2" onclick="answerChk(this,'3');" value="X" <?if($answr3 == "X"){?>checked<?}?>>
                <label for="q3_a2">내부 검토 중</label>
				<input type="radio" name="answr3" id="q3_a3" onclick="answerChk(this,'3');" value="N" <?if($answr3 == "N"){?>checked<?}?>>
                <label for="q3_a3">아니오</label>
			</div>
		</div>

        <p class="Q c03"><span class="c03">사회</span><span class="txt">4. 인권정책을 보유하고 있을 시 포함되는 항목을 체크해주세요.<span></p>
		<div class="A float a01">
        <input type="hidden" id="i_num4" name="inum4" value="HTE-CS-04">
		<input type="hidden" id="note_4" name="note4" value="<?php echo $note4; ?>">
        <!-- <input type="hidden" id="note_4" name="note4" value=""> -->
			<input type="checkbox" name="answr4[]" id="q4_a1" onclick="answerChk_4(this,'4');" value="A" <?if($answr4Arr != null && in_array("A",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a1">강제근로 금지</label>
			<input type="checkbox" name="answr4[]" id="q4_a2" onclick="answerChk_4(this,'4');" value="B" <?if($answr4Arr != null && in_array("B",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a2">이동의 자유 보장</label>
			<input type="checkbox" name="answr4[]" id="q4_a3" onclick="answerChk_4(this,'4');" value="C" <?if($answr4Arr != null && in_array("C",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a3">아동근로 금지</label>
			<input type="checkbox" name="answr4[]" id="q4_a4" onclick="answerChk_4(this,'4');" value="D" <?if($answr4Arr != null && in_array("D",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a4">미성년 근로자 보호</label>
			<input type="checkbox" name="answr4[]" id="q4_a5" onclick="answerChk_4(this,'4');" value="E" <?if($answr4Arr != null && in_array("E",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a5">근무시간 준수</label>
			<input type="checkbox" name="answr4[]" id="q4_a6" onclick="answerChk_4(this,'4');" value="F" <?if($answr4Arr != null && in_array("F",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a6">주 1회 휴무 보장</label>
			<input type="checkbox" name="answr4[]" id="q4_a7" onclick="answerChk_4(this,'4');" value="G" <?if($answr4Arr != null && in_array("G",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a7">동일임금산정 및 지급</label>
			<input type="checkbox" name="answr4[]" id="q4_a8" onclick="answerChk_4(this,'4');" value="H" <?if($answr4Arr != null && in_array("H",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a8">비인도적 대우 금지 및 고충처리 제도</label>
			<input type="checkbox" name="answr4[]" id="q4_a9" onclick="answerChk_4(this,'4');" value="I" <?if($answr4Arr != null && in_array("I",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a9">인도적 대우 절차 (ex. 비인도적 행위에 대한 징계절차)</label>
			<input type="checkbox" name="answr4[]" id="q4_a10" onclick="answerChk_4(this,'4');" value="J" <?if($answr4Arr != null && in_array("J",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a10">차별금지 (ex. 건강검진 결과, 임신여부 등)</label>
			<input type="checkbox" name="answr4[]" id="q4_a11" onclick="answerChk_4(this,'4');" value="K" <?if($answr4Arr != null && in_array("K",$answr4Arr)){?>checked<?}?>>
            <label for="q4_a11">노동조합 설립 및 가입 보장</label>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">5. 주 1회 휴무 보장을 위한 정책 및 방침이 확립되어 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num5" name="inum5" value="HTE-CS-05">
		<input type="hidden" id="note_5" name="note5" value="<?php echo $note5; ?>">
			<input type="radio" name="answr5" id="q5_a1" onclick="answerChk(this,'5');" value="A" <?if($answr5 == "A"){?>checked<?}?>>
            <label for="q5_a1">상 : 근로자들의 주 1회 최소 1일 이상의 휴무를 보장하는 정책 또는 방침을 보유하고 있다.</label>
			<input type="radio" name="answr5" id="q5_a2" onclick="answerChk(this,'5');" value="B" <?if($answr5 == "B"){?>checked<?}?>>
            <label for="q5_a2">중 : 근로자들의 주 1회 최소 1일 이상의 휴무를 보장하는 정책 또는 방침을 보유하지 않고 있다.</label>
			<input type="radio" name="answr5" id="q5_a3" onclick="answerChk(this,'5');" value="C" <?if($answr5 == "C"){?>checked<?}?>>
            <label for="q5_a3">하 : 최근 3년 이내 근로자들의 주 1회 최소 1일 이상의 휴무를 보장하지 않은 경우가 발생했다.</label>
		</div>



		<p class="Q c03"><span class="c03">사회</span><span class="txt">6. 기본급, 상여급, 지원비, 초과근무 시간에 따른 수당 등 세전 급여에 대한 구체적 정보, 갑근세, 의료보험비, 기타 회비 등 공제액을 상세하게 구분한 급여명세서를 근로자에게 제공합니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num6" name="inum6" value="HTE-CS-06">
		<input type="hidden" id="note_6" name="note6" value="<?php echo $note6; ?>">
			<input type="radio" name="answr6" id="q6_a1" onclick="answerChk(this,'6');" value="A" <?if($answr6 == "A"){?>checked<?}?>>
            <label for="q6_a1">상 : 기본급, 상여급, 지원비, 초과근무 시간에 따른 수당 등 세전 급여에 대한 구체적 정보, 갑근세, 의료보험비, 기타 회비 등 공제액을 상세하게 구분한 급여명세서를 근로자에게 제공하고 있다.</label>
			<input type="radio" name="answr6" id="q6_a2" onclick="answerChk(this,'6');" value="B" <?if($answr6 == "B"){?>checked<?}?>>
            <label for="q6_a2">중 : 간소화된 내용의 급여명세서를 근로자에게 제공하고 있다.</label>
			<input type="radio" name="answr6" id="q6_a3" onclick="answerChk(this,'6');" value="C" <?if($answr6 == "C"){?>checked<?}?>>
            <label for="q6_a3">하 : 급여명세서를 근로자에게 제공하지 않는다.</label>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">7. 최근 1년간 발생한 근로자의 비인도적 행위에 대한 모든 징계조치 사례를 기록하고 보관합니까?<br/>(ex. 폭력, 성폭력, 성희록, 체벌, 정신적/신체적 억압, 비난, 험담 등)<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num7" name="inum7" value="HTE-CS-07">
		<input type="hidden" id="note_7" name="note7" value="<?php echo $note7; ?>">
			<input type="radio" name="answr7" id="q7_a1" onclick="answerChk(this,'7');" value="A" <?if($answr7 == "A"){?>checked<?}?>>
            <label for="q7_a1">상 : 최근 1년간 발생한 근로자의 비인도적 행위에 대한 모든 징계조치 사례를 기록하고 보관하고 있으며, 절차대로 진행하여 경영진의 검토가 이루어졌다.</label>
			<input type="radio" name="answr7" id="q7_a2" onclick="answerChk(this,'7');" value="B" <?if($answr7 == "B"){?>checked<?}?>>
            <label for="q7_a2">중 : 최근 1년간 발생한 근로자의 비인도적 행위에 대한 모든 징계조치 사례를 기록하고 보관하고 있다.</label>
			<input type="radio" name="answr7" id="q7_a3" onclick="answerChk(this,'7');" value="C" <?if($answr7 == "C"){?>checked<?}?>>
            <label for="q7_a3">하 : 최근 1년간 발생한 근로자의 비인도적 행위에 대한 모든 징계조치 사례를 별도로 관리하지 않는다.</label>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">8. 노동조합 가입비율을 관리하고 있습니까?<span></p>
        <input type="hidden" id="i_num8" name="inum8" value="HTE-CS-08">
        <input type="hidden" id="note_8" name="note8" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
        <div class="A a01">
            <input type="hidden" id="note_8_1" name="note8_1" value="<?php echo $note8Arr[0]?>">
			<input type="hidden" id="note_8_2" name="note8_2" value="<?php echo $note8Arr[1]?>">
			<input type="hidden" id="note_8_3" name="note8_3" value="<?php echo $note8Arr[2]?>">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
                        <select id="q8_a1" name="answr8_1" onchange="showValue(this,'8_1')">
                            <option value="">관리여부</option>
                            <option value="Y" <?if($answr8Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr8Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr8Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q8_a2" name="answr8_2" onchange="showValue(this,'8_2')">
                            <option value="">목표설정여부</option>
                            <option value="Y" <?if($answr8Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr8Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr8Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q8_a3" name="answr8_3" onchange="showValue(this,'8_3')">
                            <option value="">공개여부</option>
                            <option value="Y" <?if($answr8Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr8Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr8Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q8_a4" name="answr8_4" value="<?if($answr8Arr_text[3] == ""){echo "";}else{echo $answr8Arr_text[3];}?>"<?if($answr8Arr_option[0] != "Y" && $answr8Arr_option[0] == null && $answr8Arr_option[1] != "Y" && $answr8Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q8_a5" name="answr8_5" value="<?if($answr8Arr_text[4] == ""){echo "";}else{echo $answr8Arr_text[4];}?>"<?if($answr8Arr_option[0] != "Y" && $answr8Arr_option[0] == null && $answr8Arr_option[1] != "Y" && $answr8Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q8_a6" name="answr8_6" value="<?if($answr8Arr_text[5] == ""){echo "";}else{echo $answr8Arr_text[5];}?>"<?if($answr8Arr_option[0] != "Y" && $answr8Arr_option[0] == null && $answr8Arr_option[1] != "Y" && $answr8Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">9. 정규직 비율을 관리하고 있습니까?<span></p>
        <input type="hidden" id="i_num9" name="inum9" value="HTE-CS-09">
        <input type="hidden" id="note_9" name="note9" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
		<div class="A a01">
			<input type="hidden" id="note_9_1" name="note9_1" value="<?php echo $note9Arr[0]?>">
			<input type="hidden" id="note_9_2" name="note9_2" value="<?php echo $note9Arr[1]?>">
			<input type="hidden" id="note_9_3" name="note9_3" value="<?php echo $note9Arr[2]?>">
        <table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
                        <select id="q9_a1" name="answr9_1" onchange="showValue(this,'9_1')">
                            <option value="">관리여부</option>
                            <option value="Y" <?if($answr9Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr9Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr9Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q9_a2" name="answr9_2" onchange="showValue(this,'9_2')">
                            <option value="">목표설정여부</option>
                            <option value="Y" <?if($answr9Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr9Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr9Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q9_a3" name="answr9_3" onchange="showValue(this,'9_3')">
                            <option value="">공개여부</option>
                            <option value="Y" <?if($answr9Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr9Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr9Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q9_a4" name="answr9_4" value="<?if($answr9Arr_text[3] == ""){echo "";}else{echo $answr9Arr_text[3];}?>"<?if($answr9Arr_option[0] != "Y" && $answr9Arr_option[0] == null && $answr9Arr_option[1] != "Y" && $answr9Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q9_a5" name="answr9_5" value="<?if($answr9Arr_text[4] == ""){echo "";}else{echo $answr9Arr_text[4];}?>"<?if($answr9Arr_option[0] != "Y" && $answr9Arr_option[0] == null && $answr9Arr_option[1] != "Y" && $answr9Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q9_a6" name="answr9_6" value="<?if($answr9Arr_text[5] == ""){echo "";}else{echo $answr9Arr_text[5];}?>"<?if($answr9Arr_option[0] != "Y" && $answr9Arr_option[0] == null && $answr9Arr_option[1] != "Y" && $answr9Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">10. 총 교육참여 인원, 인당 연평균 교육시간(총 교육시간/사업보고서 기준 총 임직원 수), 교육 지출비용을 관리하고 있습니까?<span></p>
        <input type="hidden" id="i_num10" name="inum10" value="HTE-CS-10">
        <input type="hidden" id="note_10" name="note10" value="관리여부|목표설정여부|공개여부|2019년 총 교육참여 인원|2020년 총 교육참여 인원|2021년 총 교육참여 인원|2019년 인당 연평균 교육시간|2020년 인당 연평균 교육시간|2021년 인당 연평균 교육시간|2019년 총 교육 지출비용|2020년 총 교육 지출비용|2021년 총 교육 지출비용">
		<div class="A a01">
			<input type="hidden" id="note_10_1" name="note10_1" value="<?php echo $note10Arr[0]?>">
			<input type="hidden" id="note_10_2" name="note10_2" value="<?php echo $note10Arr[1]?>">
			<input type="hidden" id="note_10_3" name="note10_3" value="<?php echo $note10Arr[2]?>">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
						<select id="q10_a1" name="answr10_1" onchange="showValue(this,'10_1')">
							<option value="">관리여부</option>
							<option value="Y" <?if($answr10Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr10Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr10Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q10_a2" name="answr10_2" onchange="showValue(this,'10_2')">
							<option value="">목표설정여부</option>
							<option value="Y" <?if($answr10Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr10Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr10Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q10_a3" name="answr10_3" onchange="showValue(this,'10_3')">
							<option value="">공개여부</option>
							<option value="Y" <?if($answr10Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr10Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr10Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:명</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 총 교육참여 인원</th>
					<th>2020년 총 교육참여 인원</th>
					<th>2021년 총 교육참여 인원</th>
				</tr>
				<tr>
					<td><input type="text" id="q10_a4" name="answr10_4" value="<?if($answr10Arr_text[3] == ""){echo "";}else{echo $answr10Arr_text[3];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a5" name="answr10_5" value="<?if($answr10Arr_text[4] == ""){echo "";}else{echo $answr10Arr_text[4];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a6" name="answr10_6" value="<?if($answr10Arr_text[5] == ""){echo "";}else{echo $answr10Arr_text[5];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
            </br><p class="unit">단위:시간/명</p>
            <table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 인당 연평균 교육시간</th>
					<th>2020년 인당 연평균 교육시간</th>
					<th>2021년 인당 연평균 교육시간</th>
				</tr>
				<tr>
					<td><input type="text" id="q10_a7" name="answr10_7" value="<?if($answr10Arr_text[6] == ""){echo "";}else{echo $answr10Arr_text[6];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a8" name="answr10_8" value="<?if($answr10Arr_text[7] == ""){echo "";}else{echo $answr10Arr_text[7];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a9" name="answr10_9" value="<?if($answr10Arr_text[8] == ""){echo "";}else{echo $answr10Arr_text[8];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
            </br><p class="unit">단위:명</p>
            <table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 총 교육 지출비용</th>
					<th>2020년 총 교육 지출비용</th>
					<th>2021년 총 교육 지출비용</th>
				</tr>
				<tr>
					<td><input type="text" id="q10_a10" name="answr10_10" value="<?if($answr10Arr_text[9] == ""){echo "";}else{echo $answr10Arr_text[9];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a11" name="answr10_11" value="<?if($answr10Arr_text[10] == ""){echo "";}else{echo $answr10Arr_text[10];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a12" name="answr10_12" value="<?if($answr10Arr_text[11] == ""){echo "";}else{echo $answr10Arr_text[11];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">11. 1인당 복리후생비용을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num11" name="inum11" value="HTE-CS-11">
        <input type="hidden" id="note_11" name="note11" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_11_1" name="note11_1" value="<?php echo $note11Arr[0]?>">
			<input type="hidden" id="note_11_2" name="note11_2" value="<?php echo $note11Arr[1]?>">
			<input type="hidden" id="note_11_3" name="note11_3" value="<?php echo $note11Arr[2]?>">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
						<select id="q11_a1" name="answr11_1" onchange="showValue(this,'11_1')">
							<option value="">관리여부</option>
							<option value="Y" <?if($answr11Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr11Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr11Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q11_a2" name="answr11_2" onchange="showValue(this,'11_2')">
							<option value="">목표설정여부</option>
							<option value="Y" <?if($answr11Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr11Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr11Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q11_a3" name="answr11_3" onchange="showValue(this,'11_3')">
							<option value="">공개여부</option>
							<option value="Y" <?if($answr11Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr11Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr11Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:원</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
                    <td><input type="text" id="q11_a4" name="answr11_4" value="<?if($answr11Arr_text[3] == ""){echo "";}else{echo $answr11Arr_text[3];}?>"<?if($answr11Arr_option[0] != "Y" && $answr11Arr_option[0] == null && $answr11Arr_option[1] != "Y" && $answr11Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q11_a5" name="answr11_5" value="<?if($answr11Arr_text[4] == ""){echo "";}else{echo $answr11Arr_text[4];}?>"<?if($answr11Arr_option[0] != "Y" && $answr11Arr_option[0] == null && $answr11Arr_option[1] != "Y" && $answr11Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q11_a6" name="answr11_6" value="<?if($answr11Arr_text[5] == ""){echo "";}else{echo $answr11Arr_text[5];}?>"<?if($answr11Arr_option[0] != "Y" && $answr11Arr_option[0] == null && $answr11Arr_option[1] != "Y" && $answr11Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">12. 여성, 인종/민족/국적, 종교에 대한 임직원 구성 비율을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num12" name="inum12" value="HTE-CS-12">
        <input type="hidden" id="note_12" name="note12" value="관리여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_12_1" name="note12_1" value="<?php echo $note12Arr[0];?>">
			<input type="hidden" id="note_12_2" name="note12_2" value="<?php echo $note12Arr[1];?>">
        	<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
                        <select id="q12_a1" name="answr12_1" onchange="showValue(this,'12_1')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr12Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr12Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr12Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q12_a2" name="answr12_2" onchange="showValue(this,'12_2')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr12Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr12Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr12Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 여성 임직원 비율</th>
					<th>2020년 여성 임직원 비율</th>
					<th>2021년 여성 임직원 비율</th>
				</tr>
				<tr>
					<td><input type="text" id="q12_a4" name="answr12_4" value="<?if($answr12Arr_text[2] == ""){echo "";}else{echo $answr12Arr_text[2];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q12_a5" name="answr12_5" value="<?if($answr12Arr_text[3] == ""){echo "";}else{echo $answr12Arr_text[3];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q12_a6" name="answr12_6" value="<?if($answr12Arr_text[4] == ""){echo "";}else{echo $answr12Arr_text[4];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
            <table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 인종/민족/국적 소수자 임직원 비율</th>
					<th>2020년 인종/민족/국적 소수자 임직원 비율</th>
					<th>2021년 인종/민족/국적 소수자 임직원 비율</th>
				</tr>
				<tr>
					<td><input type="text" id="q12_a7" name="answr12_7" value="<?if($answr12Arr_text[5] == ""){echo "";}else{echo $answr12Arr_text[5];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q12_a8" name="answr12_8" value="<?if($answr12Arr_text[6] == ""){echo "";}else{echo $answr12Arr_text[6];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q12_a9" name="answr12_9" value="<?if($answr12Arr_text[7] == ""){echo "";}else{echo $answr12Arr_text[7];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
            <table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 종교 소수자 비율</th>
					<th>2020년 종교 소수자 비율</th>
					<th>2021년 종교 소수자 비율</th>
				</tr>
				<tr>
					<td><input type="text" id="q12_a10" name="answr12_10" value="<?if($answr12Arr_text[8] == ""){echo "";}else{echo $answr12Arr_text[8];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q12_a11" name="answr12_11" value="<?if($answr12Arr_text[9] == ""){echo "";}else{echo $answr12Arr_text[9];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q12_a12" name="answr12_12" value="<?if($answr12Arr_text[10] == ""){echo "";}else{echo $answr12Arr_text[10];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">13. 장애인 고용률 현황을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num13" name="inum13" value="HTE-CS-13">
        <input type="hidden" id="note_13" name="note13" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_13_1" name="note13_1" value="<?php echo $note13Arr[0]?>">
			<input type="hidden" id="note_13_2" name="note13_2" value="<?php echo $note13Arr[1]?>">
			<input type="hidden" id="note_13_3" name="note13_3" value="<?php echo $note13Arr[2]?>">
        	<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
                        <select id="q13_a1" name="answr13_1" onchange="showValue(this,'13_1')">
                            <option value="">관리여부</option>
							<option value="Y" <?if($answr13Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr13Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr13Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q13_a2" name="answr13_2" onchange="showValue(this,'13_2')">
                            <option value="">목표설정여부</option>
							<option value="Y" <?if($answr13Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr13Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr13Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q13_a3" name="answr13_3" onchange="showValue(this,'13_3')">
                            <option value="">공개여부</option>
							<option value="Y" <?if($answr13Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr13Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr13Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q13_a4" name="answr13_4" value="<?if($answr13Arr_text[3] == ""){echo "";}else{echo $answr13Arr_text[3];}?>"<?if($answr13Arr_option[0] != "Y" && $answr13Arr_option[0] == null && $answr13Arr_option[1] != "Y" && $answr13Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q13_a5" name="answr13_5" value="<?if($answr13Arr_text[4] == ""){echo "";}else{echo $answr13Arr_text[3];}?>"<?if($answr13Arr_option[0] != "Y" && $answr13Arr_option[0] == null && $answr13Arr_option[1] != "Y" && $answr13Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q13_a6" name="answr13_6" value="<?if($answr13Arr_text[5] == ""){echo "";}else{echo $answr13Arr_text[3];}?>"<?if($answr13Arr_option[0] != "Y" && $answr13Arr_option[0] == null && $answr13Arr_option[1] != "Y" && $answr13Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">14. 산업재해율을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num14" name="inum14" value="HTE-CS-14">
        <input type="hidden" id="note_14" name="note14" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
        <div class="sample">
         - 산출방법: (당해연도 재해자) / (연평균 상시근로자) X 100
		</div>
            <input type="hidden" id="note_14_1" name="note14_1" value="<?php echo $note14Arr[0]?>">
			<input type="hidden" id="note_14_2" name="note14_2" value="<?php echo $note14Arr[1]?>">
			<input type="hidden" id="note_14_3" name="note14_3" value="<?php echo $note14Arr[2]?>">
        	<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
                        <select id="q14_a1" name="answr14_1" onchange="showValue(this,'14_1')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr14Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr14Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr14Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q14_a2" name="answr14_2" onchange="showValue(this,'14_2')">
                            <option value="">목표설정여부</option>
    						<option value="Y" <?if($answr14Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr14Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr14Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q14_a3" name="answr14_3" onchange="showValue(this,'14_3')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr14Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr14Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr14Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
                    <td><input type="text" id="q14_a4" name="answr14_4" value="<?if($answr14Arr_text[3] == ""){echo "";}else{echo $answr14Arr_text[3];}?>"<?if($answr14Arr_option[0] != "Y" && $answr14Arr_option[0] == null && $answr14Arr_option[1] != "Y" && $answr14Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q14_a5" name="answr14_5" value="<?if($answr14Arr_text[4] == ""){echo "";}else{echo $answr14Arr_text[4];}?>"<?if($answr14Arr_option[0] != "Y" && $answr14Arr_option[0] == null && $answr14Arr_option[1] != "Y" && $answr14Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q14_a6" name="answr14_6" value="<?if($answr14Arr_text[5] == ""){echo "";}else{echo $answr14Arr_text[5];}?>"<?if($answr14Arr_option[0] != "Y" && $answr14Arr_option[0] == null && $answr14Arr_option[1] != "Y" && $answr14Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">15. 1인당 봉사활동 참여시간을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num15" name="inum15" value="HTE-CS-15">
        <input type="hidden" id="note_15" name="note15" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_15_1" name="note15_1" value="<?php echo $note15Arr[0]?>">
			<input type="hidden" id="note_15_2" name="note15_2" value="<?php echo $note15Arr[1]?>">
			<input type="hidden" id="note_15_3" name="note15_3" value="<?php echo $note15Arr[2]?>">
        	<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
                        <select id="q15_a1" name="answr15_1" onchange="showValue(this,'15_1')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr15Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr15Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr15Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q15_a2" name="answr15_2" onchange="showValue(this,'15_2')">
                            <option value="">목표설정여부</option>
    						<option value="Y" <?if($answr15Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr15Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr15Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q15_a3" name="answr15_3" onchange="showValue(this,'15_3')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr15Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr15Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr15Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:시간/명</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
                    <td><input type="text" id="q15_a4" name="answr15_4" value="<?if($answr15Arr_text[3] == ""){echo "";}else{echo $answr15Arr_text[3];}?>"<?if($answr15Arr_option[0] != "Y" && $answr15Arr_option[0] == null && $answr15Arr_option[1] != "Y" && $answr15Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q15_a5" name="answr15_5" value="<?if($answr15Arr_text[4] == ""){echo "";}else{echo $answr15Arr_text[4];}?>"<?if($answr15Arr_option[0] != "Y" && $answr15Arr_option[0] == null && $answr15Arr_option[1] != "Y" && $answr15Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q15_a6" name="answr15_6" value="<?if($answr15Arr_text[5] == ""){echo "";}else{echo $answr15Arr_text[5];}?>"<?if($answr15Arr_option[0] != "Y" && $answr15Arr_option[0] == null && $answr15Arr_option[1] != "Y" && $answr15Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">16. ISO45001 등 국제적 안전보건경영시스템 표준 또는 이에 준하는 인증을 획득하였습니까?<span></p>
            <input type="hidden" id="i_num16" name="inum16" value="HTE-CS-16">
		    <input type="hidden" id="note_16" name="note16" value="<?php echo $note16; ?>">
        <div class="A a01">
			<input type="radio" name="answr16" id="q16_a1" onclick="answerChk(this,'16');" value="A" <?if($answr16 == "A"){?>checked<?}?>>
            <label for="q16_a1">상 : ISO45001 또는 이에 준하는 인증을 획득하였으며, 외부전문기관의 인증을 받고 있다.</label>
			<input type="radio" name="answr16" id="q16_a2" onclick="answerChk(this,'16');" value="B" <?if($answr16 == "B"){?>checked<?}?>>
            <label for="q16_a2">중 : ISO45001 또는 이에 준하는 인증의 획득하였으며, 내부심사원의 검토를 받고 있다.</label>
			<input type="radio" name="answr16" id="q16_a3" onclick="answerChk(this,'16');" value="C"<?if($answr16 == "C"){?>checked<?}?>>
            <label for="q16_a3">하 : ISO45001 또는 이에 준하는 인증을 획득하지 않았다.</label>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">17. 사업장, 협력업체 등 가치사슬 전반의 안전보건 현황을 관리할 수 있는 시스템을 구축하고 있습니까?<span></p>
            <input type="hidden" id="i_num17" name="inum17" value="HTE-CS-17">
		    <input type="hidden" id="note_17" name="note17" value="<?php echo $note17; ?>">
        <div class="A a01">
			<div>
				<input type="radio" name="answr17" id="q17_a1" onclick="answerChk(this,'17');" value="A" <?if($answr17 == "A"){?>checked<?}?>>
                <label for="q17_a1">상 : 내부 현황과 외부 동향을 종합하여 사업적 영향력을 분석할 수 있는 시스템이 구축되어 있다.</label>
				<input type="radio" name="answr17" id="q17_a2" onclick="answerChk(this,'17');" value="B" <?if($answr17 == "B"){?>checked<?}?>>
                <label for="q17_a2">중 : 내부 현황을 확인 및 조회할 수 있도록 DB화된 시스템이 구축되어 있다.</label>
				<input type="radio" name="answr17" id="q17_a3" onclick="answerChk(this,'17');" value="C" <?if($answr17 == "C"){?>checked<?}?>>
                <label for="q17_a3">하 : 내부 현황을 확인 및 조회하거나, 사업적 영향력을 분석하는 시스템이 없다.</label>
			</div>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">18. 사업장 재해 및 사고 건수를 집계하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num18" name="inum18" value="HTE-CS-18">
            <input type="hidden" id="note_18" name="note18" value="<?php echo $note18; ?>">
            <input type="hidden" id="note_18_1" name="note18_1" value="2019|2020|2021">
			<div>
				<input type="radio" name="answr18" id="q18_a1" onclick="answerChk(this,'18');" value="A" <?if($answr18[0] == "A"){?>checked<?}?>>
                <label for="q18_a1">상 : 전 사업장 및 하청업체/협력업체의 데이터를 집계한다.</label>
				<input type="radio" name="answr18" id="q18_a2" onclick="answerChk(this,'18');" value="B" <?if($answr18[0] == "B"){?>checked<?}?>>
                <label for="q18_a2">중 : 전 사업장의 데이터를 집계한다.</label>
				<input type="radio" name="answr18" id="q18_a3" onclick="answerChk(this,'18');" value="C" <?if($answr18[0] == "C"){?>checked<?}?>>
                <label for="q18_a3">하 : 일부 사업장의 데이터를 집계하거나 별도로 관리하지 않고 있다.</label>
			</div>
            </br><p class="unit">단위:건</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 재해 및 사고 건수</th>
					<th>2020년 재해 및 사고 건수</th>
					<th>2021년 재해 및 사고 건수</th>
				</tr>
				<tr>
					<td><input type="text" id="q18_a4" name="answr18_1" value="<?if($answr18Arr_text[1] == ""){echo "";}else{echo $answr18Arr_text[1];}?>"<?if($answr18[0] = "C" || $answr18[0] = null){?>readonly<?}?>></td>
					<td><input type="text" id="q18_a5" name="answr18_2" value="<?if($answr18Arr_text[2] == ""){echo "";}else{echo $answr18Arr_text[2];}?>"<?if($answr18[0] = "C" || $answr18[0] = null){?>readonly<?}?>></td>
					<td><input type="text" id="q18_a6" name="answr18_3" value="<?if($answr18Arr_text[3] == ""){echo "";}else{echo $answr18Arr_text[3];}?>"<?if($answr18[0] = "C" || $answr18[0] = null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">19. 직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num19" name="inum19" value="HTE-CS-19">
            <input type="hidden" id="note_19" name="note19" value="<?php echo $note19; ?>">
            <input type="hidden" id="note_19_1" name="note19_1" value="2019|2020|2021">
			<div>
				<input type="radio" name="answr19" id="q19_a1" onclick="answerChk(this,'19');" value="A" <?if($answr19[0] == "A"){?>checked<?}?>>
                <label for="q19_a1">상 : 전 사업장 및 하청업체/협력업체의 데이터를 집계한다.</label>
				<input type="radio" name="answr19" id="q19_a2" onclick="answerChk(this,'19');" value="B" <?if($answr19[0] == "B"){?>checked<?}?>>
                <label for="q19_a2">중 : 전 사업장의 데이터를 집계한다.</label>
				<input type="radio" name="answr19" id="q19_a3" onclick="answerChk(this,'19');" value="C" <?if($answr19[0] == "C"){?>checked<?}?>>
                <label for="q19_a3">하 : 일부 사업장의 데이터를 집계하거나 별도로 관리하지 않고 있다.</label>
			</div>
            </br><p class="unit">단위:건</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019년 직업상 질병 빈도(OIFR)</th>
					<th>2020년 직업상 질병 건수(OIFR)</th>
					<th>2021년 직업상 질병 건수(OIFR)</th>
				</tr>
				<tr>
                    <td><input type="text" id="q19_a4" name="answr19_1" value="<?if($answr19Arr_text[1] == ""){echo "";}else{echo $answr19Arr_text[1];}?>"<?if($answr19[0] = "C" || $answr19[0] = null){?>readonly<?}?>></td>
					<td><input type="text" id="q19_a5" name="answr19_2" value="<?if($answr19Arr_text[2] == ""){echo "";}else{echo $answr19Arr_text[2];}?>"<?if($answr19[0] = "C" || $answr19[0] = null){?>readonly<?}?>></td>
					<td><input type="text" id="q19_a6" name="answr19_3" value="<?if($answr19Arr_text[3] == ""){echo "";}else{echo $answr19Arr_text[3];}?>"<?if($answr19[0] = "C" || $answr19[0] = null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">20. 비정규직에 대한 차별, 정규직 전환 이슈를 어떻게 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num20" name="inum20" value="HTE-CS-20">
        <input type="hidden" id="note_20" name="note20" value="<?php echo $note20; ?>">
			<div>
				<input type="radio" name="answr20" id="q20_a1" onclick="answerChk(this,'20');" value="A" <?if($answr20 == "A"){?>checked<?}?>>
                <label for="q20_a1">상 : 사업장 외 하청/협력업체의 비정규직 리스크를 모니터링하고, 처우개선을 지원하고 있다.</label>
				<input type="radio" name="answr20" id="q20_a2" onclick="answerChk(this,'20');" value="B" <?if($answr20 == "B"){?>checked<?}?>>
                <label for="q20_a2">중 : 사업장 비정규직의 성과평가를 실시하고, 보상 및 처우개선을 하고 있다.</label>
				<input type="radio" name="answr20" id="q20_a3" onclick="answerChk(this,'20');" value="C" <?if($answr20 == "C"){?>checked<?}?>>
                <label for="q20_a3">하 : 비정규직 대우에 관한 관련 법/규제를 준수하고 있다.</label>
			</div>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">21. 장애인 고용 확대를 위해 어떤 조치를 취하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num21" name="inum21" value="HTE-CS-21">
        <input type="hidden" id="note_21" name="note21" value="<?php echo $note21; ?>">
			<div>
				<input type="radio" name="answr21" id="q21_a1" onclick="answerChk(this,'21');" value="A" <?if($answr21 == "A"){?>checked<?}?>>
                <label for="q21_a1">상 : 인원 확대, 자회사, 사회적 기업 등을 통한 고용을 시행/계획하고 있다.</label>
				<input type="radio" name="answr21" id="q21_a2" onclick="answerChk(this,'21');" value="B" <?if($answr21 == "B"){?>checked<?}?>>
                <label for="q21_a2">중 : 분담금 납부 등을 통해 규제를 대응하고 있다.</label>
				<input type="radio" name="answr21" id="q21_a3" onclick="answerChk(this,'21');" value="C" <?if($answr21 == "C"){?>checked<?}?>>
                <label for="q21_a3">하 : 관리하지 않는다.</label>
			</div>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">22. 공급망 행동강령을 보유하고 있습니까?<span></p>
		<div class="A float a01">
        <input type="hidden" id="i_num22" name="inum22" value="HTE-CS-26">
        <input type="hidden" id="note_22" name="note22" value="<?php echo $note22; ?>">
			<div class="sample">
				- 보유하고 있을 시: 예<br/>
				- 보유하고 있지 않을 시: 아니오<br/>
				- 내부 검토 중일 시: 내부 검토 중 (2023년 공급망 행동강령 수립의 경우)
			</div>
			<div>
				<input type="radio" name="answr22" id="q22_a1" onclick="answerChk(this,'22');" value="Y" <?if($answr22 == "Y"){?>checked<?}?>>
                <label for="q22_a1">예</label>
				<input type="radio" name="answr22" id="q22_a2" onclick="answerChk(this,'22');" value="X" <?if($answr22 == "X"){?>checked<?}?>>
                <label for="q22_a2">내부 검토 중</label>
				<input type="radio" name="answr22" id="q22_a3" onclick="answerChk(this,'22');" value="N" <?if($answr22 == "N"){?>checked<?}?>>
                <label for="q22_a3">아니오</label>
			</div>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">23. 공급망 ESG리스크 평가체계를 구축하고 있습니까?<span></p>
		<div class="A float a01">
        <input type="hidden" id="i_num23" name="inum23" value="HTE-CS-27">
        <input type="hidden" id="note_23" name="note23" value="<?php echo $note23; ?>">
			<div class="sample">
				- 보유하고 있을 시: 예<br/>
				- 보유하고 있지 않을 시: 아니오<br/>
				- 내부 검토 중일 시: 내부 검토 중 (2023년 내 공급망 ESG리스크 평가체계 수립 예정의 경우)
			</div>
			<div>
				<input type="radio" name="answr23" id="q23_a1" onclick="answerChk(this,'23');" value="Y" <?if($answr23 == "Y"){?>checked<?}?>>
                <label for="q23_a1">예</label>
				<input type="radio" name="answr23" id="q23_a2" onclick="answerChk(this,'23');" value="X" <?if($answr23 == "X"){?>checked<?}?>>
                <label for="q23_a2">내부 검토 중</label>
				<input type="radio" name="answr23" id="q23_a3" onclick="answerChk(this,'23');" value="N" <?if($answr23 == "N"){?>checked<?}?>>
                <label for="q23_a3">아니오</label>
			</div>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">24. 전체 협력사 수 대비 ESG리스크 평가(서면평가 포함) 시행 협력사의 비율을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num24" name="inum24" value="HTE-CS-22">
        <input type="hidden" id="note_24" name="note24" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_24_1" name="note24_1" value="<?php echo $note24Arr[0]?>">
			<input type="hidden" id="note_24_2" name="note24_2" value="<?php echo $note24Arr[1]?>">
			<input type="hidden" id="note_24_3" name="note24_3" value="<?php echo $note24Arr[2]?>">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
                    <td>
                        <select id="q24_a1" name="answr24_1" onchange="showValue(this,'24_1')">
                            <option value="">관리여부</option>
							<option value="Y" <?if($answr24Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr24Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr24Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q24_a2" name="answr24_2" onchange="showValue(this,'24_2')">
                            <option value="">목표설정여부</option>
							<option value="Y" <?if($answr24Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr24Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr24Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q24_a3" name="answr24_3" onchange="showValue(this,'24_3')">
                            <option value="">공개여부</option>
							<option value="Y" <?if($answr24Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr24Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr24Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q24_a4" name="answr24_4" value="<?if($answr24Arr_text[3] == ""){echo "";}else{echo $answr24Arr_text[3];}?>"<?if($answr24Arr_option[0] != "Y" && $answr24Arr_option[0] == null && $answr24Arr_option[1] != "Y" && $answr24Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q24_a5" name="answr24_5" value="<?if($answr24Arr_text[4] == ""){echo "";}else{echo $answr24Arr_text[4];}?>"<?if($answr24Arr_option[0] != "Y" && $answr24Arr_option[0] == null && $answr24Arr_option[1] != "Y" && $answr24Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q24_a6" name="answr24_6" value="<?if($answr24Arr_text[5] == ""){echo "";}else{echo $answr24Arr_text[5];}?>"<?if($answr24Arr_option[0] != "Y" && $answr24Arr_option[0] == null && $answr24Arr_option[1] != "Y" && $answr24Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">25. 전체 협력사 수 대비 ESG리스크 현장실사 실시 협력사의 비율을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num25" name="inum25" value="HTE-CS-23">
        <input type="hidden" id="note_25" name="note25" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_25_1" name="note25_1" value="<?php echo $note25Arr[0]?>">
			<input type="hidden" id="note_25_2" name="note25_2" value="<?php echo $note25Arr[1]?>">
			<input type="hidden" id="note_25_3" name="note25_3" value="<?php echo $note25Arr[2]?>">
        	<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
                    <td>
                        <select id="q25_a1" name="answr25_1" onchange="showValue(this,'25_1')">
                            <option value="">관리여부</option>
							<option value="Y" <?if($answr25Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr25Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr25Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q25_a2" name="answr25_2" onchange="showValue(this,'25_2')">
                            <option value="">목표설정여부</option>
							<option value="Y" <?if($answr25Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr25Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr25Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q25_a3" name="answr25_3" onchange="showValue(this,'25_3')">
                            <option value="">공개여부</option>
							<option value="Y" <?if($answr25Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr25Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr25Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q25_a4" name="answr25_4" value="<?if($answr25Arr_text[3] == ""){echo "";}else{echo $answr25Arr_text[3];}?>"<?if($answr25Arr_option[0] != "Y" && $answr25Arr_option[0] == null && $answr25Arr_option[1] != "Y" && $answr25Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q25_a5" name="answr25_5" value="<?if($answr25Arr_text[4] == ""){echo "";}else{echo $answr25Arr_text[4];}?>"<?if($answr25Arr_option[0] != "Y" && $answr25Arr_option[0] == null && $answr25Arr_option[1] != "Y" && $answr25Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q25_a6" name="answr25_6" value="<?if($answr25Arr_text[5] == ""){echo "";}else{echo $answr25Arr_text[5];}?>"<?if($answr25Arr_option[0] != "Y" && $answr25Arr_option[0] == null && $answr25Arr_option[1] != "Y" && $answr25Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">26. 전체 협력사 중 인권 평가(서면평가 포함) 시행 협력사의 비율을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num26" name="inum26" value="HTE-CS-28">
        <input type="hidden" id="note_26" name="note26" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_26_1" name="note26_1" value="<?php echo $note26Arr[0]?>">
			<input type="hidden" id="note_26_2" name="note26_2" value="<?php echo $note26Arr[1]?>">
			<input type="hidden" id="note_26_3" name="note26_3" value="<?php echo $note26Arr[2]?>">
            <table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
                    <td>
                        <select id="q26_a1" name="answr26_1" onchange="showValue(this,'26_1')">
                            <option value="">관리여부</option>
							<option value="Y" <?if($answr26Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr26Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr26Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q26_a2" name="answr26_2" onchange="showValue(this,'26_2')">
                            <option value="">목표설정여부</option>
							<option value="Y" <?if($answr26Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr26Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr26Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q26_a3" name="answr26_3" onchange="showValue(this,'26_3')">
                            <option value="">공개여부</option>
							<option value="Y" <?if($answr26Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr26Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr26Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q26_a4" name="answr26_4" value="<?if($answr26Arr_text[3] == ""){echo "";}else{echo $answr26Arr_text[3];}?>"<?if($answr26Arr_option[0] != "Y" && $answr26Arr_option[0] == null && $answr26Arr_option[1] != "Y" && $answr26Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q26_a5" name="answr26_5" value="<?if($answr26Arr_text[4] == ""){echo "";}else{echo $answr26Arr_text[4];}?>"<?if($answr26Arr_option[0] != "Y" && $answr26Arr_option[0] == null && $answr26Arr_option[1] != "Y" && $answr26Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q26_a6" name="answr26_6" value="<?if($answr26Arr_text[5] == ""){echo "";}else{echo $answr26Arr_text[5];}?>"<?if($answr26Arr_option[0] != "Y" && $answr26Arr_option[0] == null && $answr26Arr_option[1] != "Y" && $answr26Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">27. 전체 협력사 중 인권 현장실사 시행 협력사의 비율을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num27" name="inum27" value="HTE-CS-29">
        <input type="hidden" id="note_27" name="note27" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_27_1" name="note27_1" value="<?php echo $note27Arr[0]?>">
			<input type="hidden" id="note_27_2" name="note27_2" value="<?php echo $note27Arr[1]?>">
			<input type="hidden" id="note_27_3" name="note27_3" value="<?php echo $note27Arr[2]?>">
        	<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
                    <td>
                        <select id="q27_a1" name="answr27_1" onchange="showValue(this,'27_1')">
                            <option value="">관리여부</option>
							<option value="Y" <?if($answr27Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr27Arr_option[0] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr27Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q27_a2" name="answr27_2" onchange="showValue(this,'27_2')">
                            <option value="">목표설정여부</option>
							<option value="Y" <?if($answr27Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr27Arr_option[1] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr27Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q27_a3" name="answr27_3" onchange="showValue(this,'27_3')">
                            <option value="">공개여부</option>
							<option value="Y" <?if($answr27Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
                            <option value="N" <?if($answr27Arr_option[2] == "N"){?>selected<?}?>>NO</option>
                            <option value="X" <?if($answr27Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q27_a4" name="answr27_4" value="<?if($answr27Arr_text[3] == ""){echo "";}else{echo $answr27Arr_text[3];}?>"<?if($answr27Arr_option[0] != "Y" && $answr27Arr_option[0] == null && $answr27Arr_option[1] != "Y" && $answr27Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q27_a5" name="answr27_5" value="<?if($answr27Arr_text[4] == ""){echo "";}else{echo $answr27Arr_text[4];}?>"<?if($answr27Arr_option[0] != "Y" && $answr27Arr_option[0] == null && $answr27Arr_option[1] != "Y" && $answr27Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q27_a6" name="answr27_6" value="<?if($answr27Arr_text[5] == ""){echo "";}else{echo $answr27Arr_text[5];}?>"<?if($answr27Arr_option[0] != "Y" && $answr27Arr_option[0] == null && $answr27Arr_option[1] != "Y" && $answr27Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="Q c03"><span class="c03">사회</span><span class="txt">28. 인권리스크 관리를 위한 프로세스를 보유하고 있습니까?<span></p>
		<div class="A float a01">
        <input type="hidden" id="i_num28" name="inum28" value="HTE-CS-30">
        <input type="hidden" id="note_28" name="note28" value="<?php echo $note28; ?>">
			<div class="sample">
				- 보유하고 있을 시: 예<br/>
				- 보유하고 있지 않을 시: 아니오<br/>
				- 내부 검토 중일 시: 내부 검토 중 (2023년 내 인권리스크 관리 프로세스 수립 예정의 경우)
			</div>
			<div>
				<input type="radio" name="answr28" id="q28_a1" onclick="answerChk(this,'28');" value="Y" <?if($answr28 == "Y"){?>checked<?}?>>
                <label for="q28_a1">예</label>
				<input type="radio" name="answr28" id="q28_a2" onclick="answerChk(this,'28');" value="X" <?if($answr28 == "X"){?>checked<?}?>>
                <label for="q28_a2">내부 검토 중</label>
				<input type="radio" name="answr28" id="q28_a3" onclick="answerChk(this,'28');" value="N" <?if($answr28 == "N"){?>checked<?}?>>
                <label for="q28_a3">아니오</label>
			</div>
		</div>

		<p class="s_btn">
			<a href="survey02.php" class="prev">이전단계</a>
			<a href="javascript:fn_submit();" class="next">다음단계</a>
            <input type="hidden" id="subMode" name="subMode" value="<?php echo $subMode;?>">
		</p>
    </form>
	</div>
</body>
<script>
function answerChk(obj,num){
	var nameTmp = $(obj).attr('name');
	if($(obj).prop('checked')){
		$('input[type="radio"][name="'+nameTmp+'"]').prop('checked',false);
		$(obj).prop('checked', true);
	}
	
	var idTmp = $(obj).attr('id');
	var checkedText=$("label[for='"+idTmp+"']").text();
	$('input[name=note'+num+']').attr('value',checkedText);

	if(num == '3' && $('#'+idTmp).val() =='Y'){
		$("input[name='answr4[]']").attr('disabled',false);
	}else if(num == '3'){
		$("input[name='answr4[]']").attr('disabled',true);
		$("input[name='answr4[]']").attr('checked',false);
		$("#note_4").val("");
	}

    if(idTmp=="q18_a1" || idTmp=="q18_a2"){
		$('#q18_a4').removeProp('readonly');
        $('#q18_a5').removeProp('readonly');
        $('#q18_a6').removeProp('readonly');
	} else if(idTmp=="q18_a3"){
		$('#q18_a4').attr('readonly',true);
		$('#q18_a4').val("");
        $('#q18_a5').attr('readonly',true);
		$('#q18_a5').val("");
        $('#q18_a6').attr('readonly',true);
		$('#q18_a6').val("");
	}

    if(idTmp=="q19_a1" || idTmp=="q19_a2"){
		$('#q19_a4').removeProp('readonly');
        $('#q19_a5').removeProp('readonly');
        $('#q19_a6').removeProp('readonly');
	} else if(idTmp=="q19_a3"){
		$('#q19_a4').attr('readonly',true);
		$('#q19_a4').val("");
        $('#q19_a5').attr('readonly',true);
		$('#q19_a5').val("");
        $('#q19_a6').attr('readonly',true);
		$('#q19_a6').val("");
	}
}


function answerChk_4(obj,num){       
	var idTmp = $(obj).attr('id');
	var checkedText=$("label[for='"+idTmp+"']").text();

	var note = $('#note_4').val();
	if(note == ""){
		note = checkedText;
	} else {
		var noteArr = note.split('|');
		var check = noteArr.includes(checkedText);
		if(check){
			noteArr.splice(noteArr.indexOf(checkedText),1);
			note = noteArr+"";
			note = note.replace(",","|");
		} else{
			note += "|" + checkedText;
		}
	}
	$('#note_4').val(note);

}

function showValue(target,num){
       var answer = target.options[target.selectedIndex].text;
       $('input[name=note'+num+']').attr('value',answer);

        var selectOption1  = document.getElementById('q8_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q8_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q8_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q8_a4').attr('readonly',false);
            $('#q8_a5').attr('readonly',false);
            $('#q8_a6').attr('readonly',false);
        } else {
            $('#q8_a4').attr('readonly',true);
            $('#q8_a5').attr('readonly',true);
            $('#q8_a6').attr('readonly',true);
            $('#q8_a4').val("");
            $('#q8_a5').val("");
            $('#q8_a6').val("");
        }

		var selectOption1  = document.getElementById('q9_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q9_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q9_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q9_a4').attr('readonly',false);
            $('#q9_a5').attr('readonly',false);
            $('#q9_a6').attr('readonly',false);
        } else {
            $('#q9_a4').attr('readonly',true);
            $('#q9_a5').attr('readonly',true);
            $('#q9_a6').attr('readonly',true);
            $('#q9_a4').val("");
            $('#q9_a5').val("");
            $('#q9_a6').val("");
        }

		var selectOption1  = document.getElementById('q10_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q10_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q10_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q10_a4').attr('readonly',false);
            $('#q10_a5').attr('readonly',false);
            $('#q10_a6').attr('readonly',false);
			$('#q10_a7').attr('readonly',false);
            $('#q10_a8').attr('readonly',false);
            $('#q10_a9').attr('readonly',false);
			$('#q10_a10').attr('readonly',false);
            $('#q10_a11').attr('readonly',false);
            $('#q10_a12').attr('readonly',false);
        } else {
            $('#q10_a4').attr('readonly',true);
            $('#q10_a5').attr('readonly',true);
            $('#q10_a6').attr('readonly',true);
			$('#q10_a7').attr('readonly',true);
            $('#q10_a8').attr('readonly',true);
            $('#q10_a9').attr('readonly',true);
			$('#q10_a10').attr('readonly',true);
            $('#q10_a11').attr('readonly',true);
            $('#q10_a12').attr('readonly',true);
            $('#q10_a4').val("");
            $('#q10_a5').val("");
            $('#q10_a6').val("");
			$('#q10_a7').val("");
            $('#q10_a8').val("");
            $('#q10_a9').val("");
			$('#q10_a10').val("");
            $('#q10_a11').val("");
            $('#q10_a12').val("");
        }

		var selectOption1  = document.getElementById('q11_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q11_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q11_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q11_a4').attr('readonly',false);
            $('#q11_a5').attr('readonly',false);
            $('#q11_a6').attr('readonly',false);
        } else {
            $('#q11_a4').attr('readonly',true);
            $('#q11_a5').attr('readonly',true);
            $('#q11_a6').attr('readonly',true);
            $('#q11_a4').val("");
            $('#q11_a5').val("");
            $('#q11_a6').val("");
        }

		var selectOption1  = document.getElementById('q12_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q12_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q12_a4').attr('readonly',false);
            $('#q12_a5').attr('readonly',false);
            $('#q12_a6').attr('readonly',false);
			$('#q12_a7').attr('readonly',false);
            $('#q12_a8').attr('readonly',false);
            $('#q12_a9').attr('readonly',false);
			$('#q12_a10').attr('readonly',false);
            $('#q12_a11').attr('readonly',false);
            $('#q12_a12').attr('readonly',false);
        } else {
            $('#q12_a4').attr('readonly',true);
            $('#q12_a5').attr('readonly',true);
            $('#q12_a6').attr('readonly',true);
			$('#q12_a7').attr('readonly',true);
            $('#q12_a8').attr('readonly',true);
            $('#q12_a9').attr('readonly',true);
			$('#q12_a10').attr('readonly',true);
			$('#q12_a11').attr('readonly',true);
            $('#q12_a12').attr('readonly',true);
            $('#q12_a4').val("");
            $('#q12_a5').val("");
            $('#q12_a6').val("");
			$('#q12_a7').val("");
            $('#q12_a8').val("");
            $('#q12_a9').val("");
			$('#q12_a10').val("");
            $('#q12_a11').val("");
            $('#q12_a12').val("");
        }
		
		var selectOption1  = document.getElementById('q13_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q13_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q13_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q13_a4').attr('readonly',false);
            $('#q13_a5').attr('readonly',false);
            $('#q13_a6').attr('readonly',false);
        } else {
            $('#q13_a4').attr('readonly',true);
            $('#q13_a5').attr('readonly',true);
            $('#q13_a6').attr('readonly',true);
            $('#q13_a4').val("");
            $('#q13_a5').val("");
            $('#q13_a6').val("");
        }

		var selectOption1  = document.getElementById('q14_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q14_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q14_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q14_a4').attr('readonly',false);
            $('#q14_a5').attr('readonly',false);
            $('#q14_a6').attr('readonly',false);
        } else {
            $('#q14_a4').attr('readonly',true);
            $('#q14_a5').attr('readonly',true);
            $('#q14_a6').attr('readonly',true);
            $('#q14_a4').val("");
            $('#q14_a5').val("");
            $('#q14_a6').val("");
        }

		var selectOption1  = document.getElementById('q15_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q15_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q15_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q15_a4').attr('readonly',false);
            $('#q15_a5').attr('readonly',false);
            $('#q15_a6').attr('readonly',false);
        } else {
            $('#q15_a4').attr('readonly',true);
            $('#q15_a5').attr('readonly',true);
            $('#q15_a6').attr('readonly',true);
            $('#q15_a4').val("");
            $('#q15_a5').val("");
            $('#q15_a6').val("");
        }


		var selectOption1  = document.getElementById('q24_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q24_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q24_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q24_a4').attr('readonly',false);
            $('#q24_a5').attr('readonly',false);
            $('#q24_a6').attr('readonly',false);
        } else {
            $('#q24_a4').attr('readonly',true);
            $('#q24_a5').attr('readonly',true);
            $('#q24_a6').attr('readonly',true);
            $('#q24_a4').val("");
            $('#q24_a5').val("");
            $('#q24_a6').val("");
        }

		var selectOption1  = document.getElementById('q25_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q25_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q25_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q25_a4').attr('readonly',false);
            $('#q25_a5').attr('readonly',false);
            $('#q25_a6').attr('readonly',false);
        } else {
            $('#q25_a4').attr('readonly',true);
            $('#q25_a5').attr('readonly',true);
            $('#q25_a6').attr('readonly',true);
            $('#q25_a4').val("");
            $('#q25_a5').val("");
            $('#q25_a6').val("");
        }

		var selectOption1  = document.getElementById('q26_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q26_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q26_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q26_a4').attr('readonly',false);
            $('#q26_a5').attr('readonly',false);
            $('#q26_a6').attr('readonly',false);
        } else {
            $('#q26_a4').attr('readonly',true);
            $('#q26_a5').attr('readonly',true);
            $('#q26_a6').attr('readonly',true);
            $('#q26_a4').val("");
            $('#q26_a5').val("");
            $('#q26_a6').val("");
        }

		var selectOption1  = document.getElementById('q27_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q27_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        var selectOption3  = document.getElementById('q27_a3');
        selectOption3 = selectOption3.options[selectOption3.selectedIndex].value;

        if(selectOption1 == "Y" || selectOption2 == "Y"  ){
            $('#q27_a4').attr('readonly',false);
            $('#q27_a5').attr('readonly',false);
            $('#q27_a6').attr('readonly',false);
        } else {
            $('#q27_a4').attr('readonly',true);
            $('#q27_a5').attr('readonly',true);
            $('#q27_a6').attr('readonly',true);
            $('#q27_a4').val("");
            $('#q27_a5').val("");
            $('#q27_a6').val("");
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
		alert("안전보건 관리를 위한 협의체 또는 전담 조직이 있습니까? 문항을 체크해주세요.");
		$('input[name=answr1]:radio').focus();
		return false;
	}
	if($('input[name=answr2]:radio:checked').length < 1){
		alert("대외적으로 공개하는 안전보건 정책 또는 방침이 있습니까? 문항을 체크해주세요.");
		$('input[name=answr2]:radio').focus();
		return false;
	}

	if($('input[name=answr3]:radio:checked').length < 1){
		alert("인권정책을 보유하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr3]:radio').focus();
		return false;
	}

	if($('input[name=answr3]:radio:checked') == 'Y'){
		var answrCnt2 = $("input[name='answr4[]']:checkbox:checked").length;
		if(answrCnt2 < 1){
			alert("보유하고 있을 시 하단의 내용을 포함하고 있습니까? 1개 이상 문항에 체크해주세요.");
			$("input[name='answr4[]']").focus();
			return false;
		}
	}
	
	if($('input[name=answr5]:radio:checked').length < 1){
		alert("주 1회 휴무 보장을 위한 정책 및 방침이 확립되어 있습니까? 문항을 체크해주세요.");
		$('input[name=answr5]:radio').focus();
		return false;
	}

	if($('input[name=answr6]:radio:checked').length < 1){
		alert("기본급, 상여급, 지원비, 초과근무 시간에 따른 수당 등 세전 급여에 대한 구체적 정보, 갑근세, 의료보험비, 기타 회비 등 공제액을 상세하게 구분한 급여명세서를 근로자에게 제공합니까? 문항을 체크해주세요.");
		$('input[name=answr6]:radio').focus();
		return false;
	}

	if($('input[name=answr7]:radio:checked').length < 1){
		alert("최근 1년간 발생한 근로자의 비인도적 행위에 대한 모든 징계조치 사례를 기록하고 보관합니까? 문항을 체크해주세요.");
		$('input[name=answr7]:radio').focus();
		return false;
	}



	if($("#q8_a1").val().trim()==""){
		alert("노동조합 가입비율 문항을 선택해주세요");
				$("#q8_a1").focus();
		return false;
	}

	
	if($("#q8_a2").val().trim()==""){
	alert("노동조합 가입비율 문항을 선택해주세요");
			$("#q8_a2").focus();
	return false;
	}

	
	if($("#q8_a3").val().trim()==""){
	alert("노동조합 가입비율 문항을 선택해주세요");
			$("#q8_a3").focus();
	return false;
	}
	
	var reg = /^[-|+]?\d+\.?\d*$/;
	if($("#q8_a1").val()=="Y" || $("#q8_a2").val()=="Y"){                
	if($("#q8_a4").val().trim()==""){
	alert("노동조합 가입비율  문항을 입력해주세요");
			$("#q8_a4").focus();
		return false;
		}    

	if(!reg.test($("#q8_a4").val())){
		alert('노동조합 가입비율  숫자만 입력해주세요.');
		$("#q8_a4").focus();
		return false;
	}

    if($("#q8_a4").val().trim()>100){
		alert('100%이하로 입력해주세요.');
		$("#q8_a4").focus();
		return false;
	}
		
	
	if($("#q8_a5").val().trim()==""){
	alert("노동조합 가입비율  문항을 입력해주세요");
			$("#q8_a5").focus();
		return false;
		}   

	if(!reg.test($("#q8_a5").val())){
	alert('노동조합 가입비율  숫자만 입력해주세요.');
		$("#q8_a5").focus();
		return false;
		}
        
    if($("#q8_a5").val().trim()>100){
	alert('100%이하로 입력해주세요.');
		$("#q8_a5").focus();
		return false;
	}
	
	if($("#q8_a6").val().trim()==""){
	alert("노동조합 가입비율  문항을 입력해주세요");
			$("#q8_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q8_a6").val())){
		alert('노동조합 가입비율  숫자만 입력해주세요.');
		$("#q8_a6").focus();
		return false;
	}

    if($("#q8_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q8_a6").focus();
		return false;
	}
}

	if($("#q9_a1").val().trim()==""){
	alert("정규직 비율 문항을 선택해주세요");
			$("#q9_a1").focus();
	return false;
	}

	
	if($("#q9_a2").val().trim()==""){
	alert("정규직 비율 문항을 선택해주세요");
			$("#q9_a2").focus();
	return false;
	}

	
	if($("#q9_a3").val().trim()==""){
	alert("정규직 비율 문항을 선택해주세요");
			$("#q9_a3").focus();
	return false;
	}
	
	if($("#q9_a1").val()=="Y" || $("#q9_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q9_a4").val().trim()==""){
	alert("정규직 비율 문항을 입력해주세요");
			$("#q9_a4").focus();
		return false;
		}    

	if(!reg.test($("#q9_a4").val())){
		alert('정규직 비율 숫자만 입력해주세요.');
		$("#q9_a4").focus();
		return false;
	}

    if($("#q9_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q9_a4").focus();
		return false;
	}

		
	if($("#q9_a5").val().trim()==""){
	alert("정규직 비율  문항을 입력해주세요");
			$("#q9_a5").focus();
		return false;
		}   

	if(!reg.test($("#q9_a5").val())){
	alert('정규직 비율  숫자만 입력해주세요.');
		$("#q9_a5").focus();
		return false;
		}

    if($("#q9_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q9_a5").focus();
		return false;
	}
	
	if($("#q9_a6").val().trim()==""){
	alert("정규직 비율  문항을 입력해주세요");
			$("#q9_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q9_a6").val())){
		alert('정규직 비율  숫자만 입력해주세요.');
		$("#q9_a6").focus();
		return false;
	}

    if($("#q9_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q9_a6").focus();
		return false;
	}
}


	if($("#q10_a1").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출 문항을 선택해주세요");
			$("#q10_a1").focus();
	return false;
	}

	
	if($("#q10_a2").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출 문항을 선택해주세요");
			$("#q10_a2").focus();
	return false;
	}

	
	if($("#q10_a3").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출 문항을 선택해주세요");
			$("#q10_a3").focus();
	return false;
	}
	
	if($("#q10_a1").val()=="Y" || $("#q10_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q10_a4").val().trim()==""){
	alert("  교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a4").focus();
		return false;
		}    

	if(!reg.test($("#q10_a4").val())){
		alert('교육인원, 인당 교육시간, 교육지출  숫자만 입력해주세요.');
		$("#q10_a4").focus();
		return false;
	}

		
	if($("#q10_a5").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a5").focus();
		return false;
		}   

	if(!reg.test($("#q10_a5").val())){
	alert('교육인원, 인당 교육시간, 교육지출  숫자만 입력해주세요.');
		$("#q10_a5").focus();
		return false;
		}

	
	if($("#q10_a6").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a6").val())){
		alert('교육인원, 인당 교육시간, 교육지출 숫자만 입력해주세요.');
		$("#q10_a6").focus();
		return false;
	}

    if($("#q10_a7").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a7").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a7").val())){
		alert('교육인원, 인당 교육시간, 교육지출 숫자만 입력해주세요.');
		$("#q10_a7").focus();
		return false;
	}

    
    if($("#q10_a8").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a8").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a8").val())){
		alert('교육인원, 인당 교육시간, 교육지출 숫자만 입력해주세요.');
		$("#q10_a8").focus();
		return false;
	}


    if($("#q10_a9").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a9").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a9").val())){
		alert('교육인원, 인당 교육시간, 교육지출 숫자만 입력해주세요.');
		$("#q10_a9").focus();
		return false;
	}


    if($("#q10_a10").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a10").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a10").val())){
		alert('교육인원, 인당 교육시간, 교육지출 숫자만 입력해주세요.');
		$("#q10_a10").focus();
		return false;
	}


    if($("#q10_a11").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a11").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a11").val())){
		alert('교육인원, 인당 교육시간, 교육지출 숫자만 입력해주세요.');
		$("#q10_a11").focus();
		return false;
	}


    if($("#q10_a12").val().trim()==""){
	alert("교육인원, 인당 교육시간, 교육지출  문항을 입력해주세요");
			$("#q10_a12").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a12").val())){
		alert('교육인원, 인당 교육시간, 교육지출 숫자만 입력해주세요.');
		$("#q10_a12").focus();
		return false;
	}
}


    

	if($("#q11_a1").val().trim()==""){
	alert("1인당 복리후생비 문항을 선택해주세요");
			$("#q11_a1").focus();
	return false;
	}

	
	if($("#q11_a2").val().trim()==""){
	alert("1인당 복리후생비 문항을 선택해주세요");
			$("#q11_a2").focus();
	return false;
	}

	
	if($("#q11_a3").val().trim()==""){
	alert("1인당 복리후생비 문항을 선택해주세요");
			$("#q11_a3").focus();
	return false;
	}
	
	if($("#q11_a1").val()=="Y" || $("#q11_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q11_a4").val().trim()==""){
	alert("1인당 복리후생비  문항을 입력해주세요");
			$("#q11_a4").focus();
		return false;
		}    

	if(!reg.test($("#q11_a4").val())){
		alert('1인당 복리후생비  숫자만 입력해주세요.');
		$("#q11_a4").focus();
		return false;
	}

		
	if($("#q11_a5").val().trim()==""){
	alert("1인당 복리후생비  문항을 입력해주세요");
			$("#q11_a5").focus();
		return false;
		}   

	if(!reg.test($("#q11_a5").val())){
	alert('1인당 복리후생비  숫자만 입력해주세요.');
		$("#q11_a5").focus();
		return false;
		}
	
	if($("#q11_a6").val().trim()==""){
	alert("1인당 복리후생비  문항을 입력해주세요");
			$("#q11_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q11_a6").val())){
		alert('1인당 복리후생비 숫자만 입력해주세요.');
		$("#q11_a6").focus();
		return false;
	}
}


	if($("#q12_a1").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 선택해주세요");
			$("#q12_a1").focus();
	return false;
	}

	if($("#q12_a2").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 선택해주세요");
			$("#q12_a2").focus();
	return false;
	}
	
	if($("#q12_a1").val()=="Y" || $("#q12_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q12_a4").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a4").focus();
		return false;
		}    

	if(!reg.test($("#q12_a4").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a4").focus();
		return false;
	}

    if($("#q12_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a4").focus();
		return false;
	}

		
	if($("#q12_a5").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a5").focus();
		return false;
		}   

	if(!reg.test($("#q12_a5").val())){
	alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a5").focus();
		return false;
		}
	
    if($("#q12_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a5").focus();
		return false;
	}

	if($("#q12_a6").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q12_a6").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a6").focus();
		return false;
	}

    if($("#q12_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a6").focus();
		return false;
	}

    if($("#q12_a7").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a7").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q12_a7").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a7").focus();
		return false;
	}

    if($("#q12_a7").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a7").focus();
		return false;
	}

    if($("#q12_a8").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a8").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q12_a8").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a8").focus();
		return false;
	}

    if($("#q12_a8").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a8").focus();
		return false;
	}

    if($("#q12_a9").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a9").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q12_a9").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a9").focus();
		return false;
	}

    if($("#q12_a9").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a9").focus();
		return false;
	}

    if($("#q12_a10").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a10").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q12_a10").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a10").focus();
		return false;
	}

    if($("#q12_a10").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a10").focus();
		return false;
	}

    if($("#q12_a11").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a11").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q12_a11").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a11").focus();
		return false;
	}

    if($("#q12_a11").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a11").focus();
		return false;
	}

    if($("#q12_a12").val().trim()==""){
	alert("여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 문항을 입력해주세요");
			$("#q12_a12").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q12_a12").val())){
		alert('여성, 인종/민족, 국적, 종교, 기타 소수자에 대한 임직원 구성 비율 숫자만 입력해주세요.');
		$("#q12_a12").focus();
		return false;
	}

    if($("#q12_a12").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q12_a12").focus();
		return false;
	}
}

	if($("#q13_a1").val().trim()==""){
	alert("장애인 고용률 문항을 선택해주세요");
			$("#q13_a1").focus();
	return false;
	}

	
	if($("#q13_a2").val().trim()==""){
	alert("장애인 고용률 문항을 선택해주세요");
			$("#q13_a2").focus();
	return false;
	}

	
	if($("#q13_a3").val().trim()==""){
	alert("장애인 고용률 문항을 선택해주세요");
			$("#q13_a3").focus();
	return false;
	}
	
	if($("#q13_a1").val()=="Y" || $("#q13_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q13_a4").val().trim()==""){
	alert("장애인 고용률 문항을 입력해주세요");
			$("#q13_a4").focus();
		return false;
		}    

	if(!reg.test($("#q13_a4").val())){
		alert('장애인 고용률  숫자만 입력해주세요.');
		$("#q13_a4").focus();
		return false;
	}

    if($("#q13_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q13_a4").focus();
		return false;
	}

		
	if($("#q13_a5").val().trim()==""){
	alert("장애인 고용률 문항을 입력해주세요");
			$("#q13_a5").focus();
		return false;
		}   

	if(!reg.test($("#q13_a5").val())){
	alert('장애인 고용률  숫자만 입력해주세요.');
		$("#q13_a5").focus();
		return false;
		}
	
    if($("#q13_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q13_a5").focus();
		return false;
	}

	if($("#q13_a6").val().trim()==""){
	alert("장애인 고용률  문항을 입력해주세요");
			$("#q13_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q13_a6").val())){
		alert('장애인 고용률  숫자만 입력해주세요.');
		$("#q13_a6").focus();
		return false;
	}

    if($("#q13_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q13_a6").focus();
		return false;
	}
}
	
	if($("#q14_a1").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  문항을 선택해주세요");
			$("#q14_a1").focus();
	return false;
	}

	
	if($("#q14_a2").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 선택해주세요");
			$("#q14_a2").focus();
	return false;
	}

	
	if($("#q14_a3").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 선택해주세요");
			$("#q14_a3").focus();
	return false;
	}
	
	if($("#q14_a1").val()=="Y" || $("#q14_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q14_a4").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 입력해주세요");
			$("#q14_a4").focus();
		return false;
		}    

	if(!reg.test($("#q14_a4").val())){
		alert('산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  숫자만 입력해주세요.');
		$("#q14_a4").focus();
		return false;
	}

    if($("#q14_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q14_a4").focus();
		return false;
	}

		
	if($("#q14_a5").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 입력해주세요");
			$("#q14_a5").focus();
		return false;
		}   

	if(!reg.test($("#q14_a5").val())){
	alert('산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  숫자만 입력해주세요.');
		$("#q14_a5").focus();
		return false;
		}
	
    if($("#q14_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q14_a5").focus();
		return false;
	}
	if($("#q14_a6").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  문항을 입력해주세요");
			$("#q14_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q14_a6").val())){
		alert('산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  숫자만 입력해주세요.');
		$("#q14_a6").focus();
		return false;
	}

    if($("#q14_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q14_a6").focus();
		return false;
	}
}

	if($("#q15_a1").val().trim()==""){
	alert("1인당 봉사활동 참여시간  문항을 선택해주세요");
			$("#q15_a1").focus();
	return false;
	}

	
	if($("#q15_a2").val().trim()==""){
	alert("1인당 봉사활동 참여시간 문항을 선택해주세요");
			$("#q15_a2").focus();
	return false;
	}

	
	if($("#q15_a3").val().trim()==""){
	alert("1인당 봉사활동 참여시간 문항을 선택해주세요");
			$("#q15_a3").focus();
	return false;
	}
	
	if($("#q15_a1").val()=="Y" || $("#q15_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q15_a4").val().trim()==""){
	alert("1인당 봉사활동 참여시간 문항을 입력해주세요");
			$("#q15_a4").focus();
		return false;
		}    

	if(!reg.test($("#q15_a4").val())){
		alert('장1인당 봉사활동 참여시간  숫자만 입력해주세요.');
		$("#q15_a4").focus();
		return false;
	}

		
	if($("#q15_a5").val().trim()==""){
	alert("1인당 봉사활동 참여시간률 문항을 입력해주세요");
			$("#q15_a5").focus();
		return false;
		}   

	if(!reg.test($("#q15_a5").val())){
	alert('1인당 봉사활동 참여시간 숫자만 입력해주세요.');
		$("#q15_a5").focus();
		return false;
		}
	
	if($("#q15_a6").val().trim()==""){
	alert("1인당 봉사활동 참여시간  문항을 입력해주세요");
			$("#q15_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q15_a6").val())){
		alert('1인당 봉사활동 참여시간  숫자만 입력해주세요.');
		$("#q15_a6").focus();
		return false;
	}
}

	if($('input[name=answr16]:radio:checked').length < 1){
	alert("ISO45001 등 국제적 안전보건경영시스템 표준 또는 이에 준하는 인증을 획득하였습니까? 문항을 체크해주세요.");
	$('input[name=answr16]:radio').focus();
	return false;
	}


	if($('input[name=answr17]:radio:checked').length < 1){
			alert("사업장, 협력업체 등 가치사슬 전반의 안전보건 현황을 관리할 수 있는 시스템을 구축하고 있습니까? 문항을 체크해주세요.");
			$('input[name=answr17]:radio').focus();
			return false;
	}	

	if($('input[name=answr18]:radio:checked').length < 1){
		alert("사업장 재해 및 사고 건수를 집계하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr18]:radio').focus();
		return false;

	}

	//alert($("#q18_a1").val());

    if($("#q18_a1").is(':checked') || $("#q18_a2").is(':checked')){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q18_a4").val().trim()==""){
	alert("사업장 재해 및 사고 건수를 집계하고 있습니까? 문항을 입력해주세요");
			$("#q18_a4").focus();
		return false;
		}    

	if(!reg.test($("#q18_a4").val())){
		alert('사업장 재해 및 사고 건수를 집계하고 있습니까? 숫자만 입력해주세요.');
		$("#q18_a4").focus();
		return false;
	}

		
	if($("#q18_a5").val().trim()==""){
	alert("사업장 재해 및 사고 건수를 집계하고 있습니까? 문항을 입력해주세요");
			$("#q18_a5").focus();
		return false;
		}   

	if(!reg.test($("#q18_a5").val())){
	alert('사업장 재해 및 사고 건수를 집계하고 있습니까?  숫자만 입력해주세요.');
		$("#q18_a5").focus();
		return false;
		}
	
	if($("#q18_a6").val().trim()==""){
	alert("사업장 재해 및 사고 건수를 집계하고 있습니까?   문항을 입력해주세요");
			$("#q18_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q18_a6").val())){
		alert('사업장 재해 및 사고 건수를 집계하고 있습니까?   숫자만 입력해주세요.');
		$("#q18_a6").focus();
		return false;
	}
}


	if($('input[name=answr19]:radio:checked').length < 1){
		alert("직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr19]').focus();
		return false;

	}

    if($("#q19_a1").is(':checked') || $("#q19_a2").is(':checked')){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q19_a4").val().trim()==""){
	alert("직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까? 문항을 입력해주세요");
			$("#q19_a4").focus();
		return false;
		}    
	if(!reg.test($("#q19_a4").val())){
	alert('직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까?  숫자만 입력해주세요.');
		$("#q19_a4").focus();
		return false;
		}	

	if(!reg.test($("#q19_a5").val())){
		alert('직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까? 숫자만 입력해주세요.');
		$("#q19_a5").focus();
		return false;
	}
	if($("#q19_a5").val().trim()==""){
	alert("직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까? 문항을 입력해주세요");
			$("#q19_a5").focus();
		return false;
		}    
		
	if($("#q19_a6").val().trim()==""){
	alert("직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까? 문항을 입력해주세요");
			$("#q19_a6").focus();
		return false;
		}   

	if(!reg.test($("#q19_a6").val())){
	alert('직접고용 인원에 대한 직업상 질병 빈도(OIFR)를 관리하고 있습니까?  숫자만 입력해주세요.');
		$("#q19_a6").focus();
		return false;
		}
    }


	if($('input[name=answr20]:radio:checked').length < 1){
		alert("비정규직에 대한 차별, 정규직 전환 이슈를 어떻게 관리하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr20]').focus();
		return false;

	}


	if($('input[name=answr21]:radio:checked').length < 1){
		alert("장애인 고용 확대를 위해 어떤 조치를 취하고 있습니까? 문항을 체크해주세요.");
		$('input[name=answr21]:radio').focus();
		return false;

	}

	if($('input[name=answr22]:radio:checked').length < 1){
		alert("공급망 행동강령 유무 문항을 체크해주세요.");
		$('input[name=answr22]:radio').focus();
		return false;

	}

	if($('input[name=answr23]:radio:checked').length < 1){
		alert("공급망 ESG리스크 평가체계 구축 문항을 체크해주세요.");
		$('input[name=answr23]:radio').focus();
		return false;

	}
	
	if($("#q24_a1").val().trim()==""){
	alert("공급망 ESG리스크 평가 사업장 수(비율) 문항을 선택해주세요");
			$("#q24_a1").focus();
	return false;
	}

	
	if($("#q24_a2").val().trim()==""){
	alert("공급망 ESG리스크 평가 사업장 수(비율) 문항을 선택해주세요");
			$("#q24_a2").focus();
	return false;
	}

	
	if($("#q24_a3").val().trim()==""){
	alert("공급망 ESG리스크 평가 사업장 수(비율) 문항을 선택해주세요");
			$("#q24_a3").focus();
	return false;
	}
	
	if($("#q24_a1").val()=="Y" || $("#q24_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q24_a4").val().trim()==""){
	alert("공급망 ESG리스크 평가 사업장 수(비율) 문항을 입력해주세요");
			$("#q24_a4").focus();
		return false;
		}    

	if(!reg.test($("#q24_a4").val())){
		alert('공급망 ESG리스크 평가 사업장 수(비율)  숫자만 입력해주세요.');
		$("#q24_a4").focus();
		return false;
	}

    if($("#q24_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q24_a4").focus();
		return false;
	}

		
	if($("#q24_a5").val().trim()==""){
	alert("공급망 ESG리스크 평가 사업장 수(비율) 문항을 입력해주세요");
			$("#q24_a5").focus();
		return false;
		}   

	if(!reg.test($("#q24_a5").val())){
	alert('공급망 ESG리스크 평가 사업장 수(비율) 숫자만 입력해주세요.');
		$("#q24_a5").focus();
		return false;
		}
	
    if($("#q24_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q24_a5").focus();
		return false;
	}

	if($("#q24_a6").val().trim()==""){
	alert("공급망 ESG리스크 평가 사업장 수(비율)  문항을 입력해주세요");
			$("#q24_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q24_a6").val())){
		alert('공급망 ESG리스크 평가 사업장 수(비율)  숫자만 입력해주세요.');
		$("#q24_a6").focus();
		return false;
	}

    if($("#q24_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q24_a6").focus();
		return false;
	}
}


	if($("#q25_a1").val().trim()==""){
	alert("공급망 현장실사 실시 사업장 수(비율) 문항을 선택해주세요");
			$("#q25_a1").focus();
	return false;
	}

	
	if($("#q25_a2").val().trim()==""){
	alert("공급망 현장실사 실시 사업장 수(비율) 문항을 선택해주세요");
			$("#q25_a2").focus();
	return false;
	}

	
	if($("#q25_a3").val().trim()==""){
	alert("공급망 현장실사 실시 사업장 수(비율) 문항을 선택해주세요");
			$("#q25_a3").focus();
	return false;
	}
	
	if($("#q25_a1").val()=="Y" || $("#q25_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q25_a4").val().trim()==""){
	alert("공급망 현장실사 실시 사업장 수(비율) 문항을 입력해주세요");
			$("#q25_a4").focus();
		return false;
		}    

	if(!reg.test($("#q25_a4").val())){
		alert('공급망 현장실사 실시 사업장 수(비율)  숫자만 입력해주세요.');
		$("#q25_a4").focus();
		return false;
	}

    if($("#q25_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q25_a4").focus();
		return false;
	}

		
	if($("#q25_a5").val().trim()==""){
	alert("공급망 현장실사 실시 사업장 수(비율) 문항을 입력해주세요");
			$("#q25_a5").focus();
		return false;
		}   

	if(!reg.test($("#q25_a5").val())){
	alert('공급망 현장실사 실시 사업장 수(비율) 숫자만 입력해주세요.');
		$("#q25_a5").focus();
		return false;
		}

    if($("#q25_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q25_a5").focus();
		return false;
	}
	
	if($("#q25_a6").val().trim()==""){
	alert("공급망 현장실사 실시 사업장 수(비율)  문항을 입력해주세요");
			$("#q25_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q25_a6").val())){
		alert('공급망 현장실사 실시 사업장 수(비율)  숫자만 입력해주세요.');
		$("#q25_a6").focus();
		return false;
	}

    if($("#q25_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q25_a6").focus();
		return false;
	}
}

	if($("#q26_a1").val().trim()==""){
	alert("인권 서면평가 사업장 수(비율) 문항을 선택해주세요");
			$("#q26_a1").focus();
	return false;
	}

	
	if($("#q26_a2").val().trim()==""){
	alert("인권 서면평가 사업장 수(비율) 문항을 선택해주세요");
			$("#q26_a2").focus();
	return false;
	}

	
	if($("#q26_a3").val().trim()==""){
	alert("인권 서면평가 사업장 수(비율) 문항을 선택해주세요");
			$("#q26_a3").focus();
	return false;
	}
	

	if($("#q26_a1").val()=="Y" || $("#q26_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q26_a4").val().trim()==""){
	alert("인권 서면평가 사업장 수(비율) 문항을 입력해주세요");
			$("#q26_a4").focus();
		return false;
		}    

	if(!reg.test($("#q26_a4").val())){
		alert('인권 서면평가 사업장 수(비율)  숫자만 입력해주세요.');
		$("#q26_a4").focus();
		return false;
	}

    if($("#q26_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q26_a4").focus();
		return false;
	}
		
	if($("#q26_a5").val().trim()==""){
	alert("인권 서면평가 사업장 수(비율) 문항을 입력해주세요");
			$("#q26_a5").focus();
		return false;
		}   

	if(!reg.test($("#q26_a5").val())){
	alert('인권 서면평가 사업장 수(비율) 숫자만 입력해주세요.');
		$("#q26_a5").focus();
		return false;
		}
	
    if($("#q26_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q26_a5").focus();
		return false;
	}

	if($("#q26_a6").val().trim()==""){
	alert("인권 서면평가 사업장 수(비율)  문항을 입력해주세요");
			$("#q26_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q26_a6").val())){
		alert('인권 서면평가 사업장 수(비율)  숫자만 입력해주세요.');
		$("#q26_a6").focus();
		return false;
	}

    if($("#q26_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q26_a6").focus();
		return false;
	}
}

	if($("#q27_a1").val().trim()==""){
	alert("인권 현장실사 실시 사업장 수(비율) 선택해주세요");
			$("#q27_a1").focus();
	return false;
	}

	
	if($("#q27_a2").val().trim()==""){
	alert("인권 현장실사 실시 사업장 수(비율) 문항을 선택해주세요");
			$("#q27_a2").focus();
	return false;
	}

	
	if($("#q27_a3").val().trim()==""){
	alert("인권 현장실사 실시 사업장 수(비율) 문항을 선택해주세요");
			$("#q27_a3").focus();
	return false;
	}
	
	if($("#q27_a1").val()=="Y" || $("#q27_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q27_a4").val().trim()==""){
	alert("인권 현장실사 실시 사업장 수(비율) 문항을 입력해주세요");
			$("#q27_a4").focus();
		return false;
		}    

	if(!reg.test($("#q27_a4").val())){
		alert('인권 현장실사 실시 사업장 수(비율)  숫자만 입력해주세요.');
		$("#q27_a4").focus();
		return false;
	}

    if($("#q27_a4").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q27_a4").focus();
		return false;
	}

		
	if($("#q27_a5").val().trim()==""){
	alert("인권 현장실사 실시 사업장 수(비율) 문항을 입력해주세요");
			$("#q27_a5").focus();
		return false;
		}   

	if(!reg.test($("#q27_a5").val())){
	alert('인권 현장실사 실시 사업장 수(비율) 숫자만 입력해주세요.');
		$("#q27_a5").focus();
		return false;
		}

    if($("#q27_a5").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q2_a5").focus();
		return false;
	}
	
	if($("#q27_a6").val().trim()==""){
	alert("인권 현장실사 실시 사업장 수(비율)  문항을 입력해주세요");
			$("#q27_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q27_a6").val())){
		alert('인권 현장실사 실시 사업장 수(비율) 숫자만 입력해주세요.');
		$("#q27_a6").focus();
		return false;
	}

    if($("#q27_a6").val().trim()>100){
	alert('100% 이하로 입력해주세요.');
		$("#q2_a6").focus();
		return false;
	}
}

	if($('input[name=answr28]:radio:checked').length < 1){
		alert("공급망 행동강령 유무 문항을 체크해주세요.");
		$('input[name=answr28]:radio').focus();
		return false;

	}

	frm.submit();
}
</script>
</html>
