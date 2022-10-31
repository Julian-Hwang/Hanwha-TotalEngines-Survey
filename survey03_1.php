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
				LIMIT 10";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}


    for($i=1; $i<11; $i++){
        ${"answr".$i} = $row[$i-1]["ANSWR"];
	}
    $answr4 = $row[3]["ANSWR"];

	for($i=8; $i<11; $i++){
        ${"answr_option".$i} = $row[$i-1]["ANSWR"];
	}
	for($i=8; $i<11; $i++){
        ${"answr_text".$i} = $row[$i-1]["CONT"];
	}

    $answr4Arr = explode('|', $answr4);
	for($i=8; $i<11; $i++){
        ${"answr".$i."Arr_option"} = explode('|', ${"answr_option".$i});
	}
	for($i=8; $i<11; $i++){
        ${"answr".$i."Arr_text"} = explode('|', ${"answr_text".$i});
	}


    for($i=8; $i<11; $i++){
        ${"answr".$i."Arr"} = explode('|', ${"answr".$i});
	}
    
    for($i=1; $i<11; $i++){
        ${"note".$i} = $row[$i-1]["CONT"];
	}

	for($i=8; $i<11; $i++){
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
	<form name="frm" id="frm" action="survey/survey03_1_proc.php" method="post">
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

        <!-- 14번 -> 10번 -->
		<p class="Q c03"><span class="c03">사회</span><span class="txt">10. 산업재해율을 관리하고 있습니까?<span></p>
		<div class="A a01">
        <input type="hidden" id="i_num10" name="inum10" value="HTE-CS-14">
        <input type="hidden" id="note_10" name="note10" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
        <div class="sample">
         - 산출방법: (당해연도 재해자) / (연평균 상시근로자) X 100
		</div>
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
            </br><p class="unit">단위:%</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
                    <td><input type="text" id="q10_a4" name="answr10_4" value="<?if($answr10Arr_text[3] == ""){echo "";}else{echo $answr10Arr_text[3];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a5" name="answr10_5" value="<?if($answr10Arr_text[4] == ""){echo "";}else{echo $answr10Arr_text[4];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q10_a6" name="answr10_6" value="<?if($answr10Arr_text[5] == ""){echo "";}else{echo $answr10Arr_text[5];}?>"<?if($answr10Arr_option[0] != "Y" && $answr10Arr_option[0] == null && $answr10Arr_option[1] != "Y" && $answr10Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
		</div>

		<p class="s_btn">
			<a href="survey02_1.php" class="prev">이전단계</a>
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
        } else {
            $('#q10_a4').attr('readonly',true);
            $('#q10_a5').attr('readonly',true);
            $('#q10_a6').attr('readonly',true);
            $('#q10_a4').val("");
            $('#q10_a5').val("");
            $('#q10_a6').val("");
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
		alert('100%이하로 입력해주세요.');
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
	alert("정규직 비율  문항을 입력해주세요");
			$("#q9_a4").focus();
		return false;
		}    

	if(!reg.test($("#q9_a4").val())){
		alert('정규직 비율  숫자만 입력해주세요.');
		$("#q9_a4").focus();
		return false;
	}

    if($("#q9_a4").val().trim()>100){
		alert('100%이하로 입력해주세요.');
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
	alert('100%이하로 입력해주세요.');
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
		alert('100%이하로 입력해주세요.');
		$("#q9_a6").focus();
		return false;
	}
}
	
    // 14번 -> 10번
	if($("#q10_a1").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  문항을 선택해주세요");
			$("#q10_a1").focus();
	return false;
	}

	
	if($("#q10_a2").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 선택해주세요");
			$("#q10_a2").focus();
	return false;
	}

	
	if($("#q10_a3").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 선택해주세요");
			$("#q10_a3").focus();
	return false;
	}
	
    if($("#q10_a1").val()=="Y" || $("#q10_a2").val()=="Y"){
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q10_a4").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 입력해주세요");
			$("#q10_a4").focus();
		return false;
		}    

	if(!reg.test($("#q10_a4").val())){
		alert('산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  숫자만 입력해주세요.');
		$("#q10_a4").focus();
		return false;
	}

    if($("#q10_a4").val().trim()>100){
		alert('100%이하로 입력해주세요.');
		$("#q10_a4").focus();
		return false;
	}

		
	if($("#q10_a5").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자) 문항을 입력해주세요");
			$("#q10_a5").focus();
		return false;
		}   

	if(!reg.test($("#q10_a5").val())){
	alert('산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  숫자만 입력해주세요.');
		$("#q10_a5").focus();
		return false;
		}
    
    if($("#q10_a5").val().trim()>100){
		alert('100%이하로 입력해주세요.');
		$("#q10_a5").focus();
		return false;
	}
	
	if($("#q10_a6").val().trim()==""){
	alert("산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  문항을 입력해주세요");
			$("#q10_a6").focus();
		return false;
		}   
																																					
	if(!reg.test($("#q10_a6").val())){
		alert('산업재해율 = (당해연도 재해자) / (연평균 상시근로자)  숫자만 입력해주세요.');
		$("#q10_a6").focus();
		return false;
	}

    if($("#q10_a6").val().trim()>100){
		alert('100%이하로 입력해주세요.');
		$("#q10_a6").focus();
		return false;
	}
}


	frm.submit();
}
</script>
</html>
