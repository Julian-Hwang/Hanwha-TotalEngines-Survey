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
				LIMIT 9";

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

    $answr5 = $row[3]["ANSWR"];
    $answr5Arr = explode('|', $answr5);
    $answr_text5 = $row[4]["CONT"];
    $answr5Arr_text = explode('|', $answr_text5);

    $answr6 = $row[5]["CONT"];
    $answr6Arr = explode('|', $answr6);
    $answr_option6 = $row[5]["ANSWR"];
    $answr6Arr_option = explode('|', $answr_option6);
	$answr_text6 = $row[5]["CONT"];	
    $answr6Arr_text = explode('|', $answr_text6);

    $answr7 = $row[6]["CONT"];
    $answr7Arr = explode('|', $answr7);
    $answr_option7 = $row[6]["ANSWR"];
    $answr7Arr_option = explode('|', $answr_option7);
	$answr_text7 = $row[6]["CONT"];	
    $answr7Arr_text = explode('|', $answr_text7);

    $answr8 = $row[7]["CONT"];
    $answr8Arr = explode('|', $answr8);
    $answr_option8 = $row[7]["ANSWR"];
    $answr8Arr_option = explode('|', $answr_option8);
	$answr_text8 = $row[7]["CONT"];	//10191031수정
    $answr8Arr_text = explode('|', $answr_text8);

    $answr9 = $row[8]["ANSWR"];

	$note1 = $row[0]["CONT"];
    $note2 = $row[1]["CONT"];
    $note3 = $row[2]["CONT"];
    $note4 = $row[3]["CONT"];
    $note5 = $row[4]["CONT"];
	$note5Arr = explode('|', $note5);
    $note6 = $row[5]["CONT"];
	$note6Arr = explode('|', $note6);
    $note7 = $row[6]["CONT"];
	$note7Arr = explode('|', $note7);
    $note8 = $row[7]["CONT"];
	$note8Arr = explode('|', $note8);
    $note9 = $row[8]["CONT"];
    
}
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>

	<div class="contents">
	<form name="frm" id="frm" action="survey/survey04_proc.php" method="post">
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
		
		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">6. 고객 데이터 유출, 도난, 분실 건수를 관리하고 있습니까?</span></p>
		<div class="A a01">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<td>
						<select id="q6_a1" name="answr6_1" onchange="showValue1(this,'6_1','6')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr6Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr6Arr_option[0] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr6Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q6_a2" name="answr6_2" onchange="showValue1(this,'6_2','6')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr6Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr6Arr_option[1] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr6Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br>
            <p class="unit">단위:건</p>
			<table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q6_a3" name="answr6_3" value="<?if($answr6Arr_text[2] != ""){echo $answr6Arr[2];}?>" <?if($answr6Arr_option[0] != "Y" && $answr6Arr_option[0] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q6_a4" name="answr6_4" value="<?if($answr6Arr_text[3] != ""){echo $answr6Arr[3];}?>" <?if($answr6Arr_option[0] != "Y" && $answr6Arr_option[0] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q6_a5" name="answr6_5" value="<?if($answr6Arr_text[4] != ""){echo $answr6Arr[4];}?>" <?if($answr6Arr_option[0] != "Y" && $answr6Arr_option[0] == null){?>readonly<?}?>></td>
				</tr>
                
			</table>
            
            <input type="hidden" id="i_num6" name="inum6" value="HTE-CG-06">
			<input type="hidden" id="note_6" name="note6" value="관리여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_6_1" name="note6_1" value="<?php echo $note6Arr[0]?>">
            <input type="hidden" id="note_6_2" name="note6_2" value="<?php echo $note6Arr[1]?>">
            <input type="hidden" id="note_6_3" name="note6_3" value="<?php echo $note6Arr[2]?>">
			<input type="hidden" id="note_6_4" name="note6_4" value="<?php echo $note6Arr[3]?>">
			<input type="hidden" id="note_6_5" name="note6_5" value="<?php echo $note6Arr[4]?>">
		</div>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">7. 반독점/반경쟁적 행위와 관련하여 발생된 벌금 및 합의금 총액을 관리하고 있습니까?</span></p>
		<div class="A a01">
			<table>
                <colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                <tr>
					<td>
                        <select id="q7_a1" name="answr7_1" onchange="showValue1(this,'7_1','7')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr7Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr7Arr_option[0] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr7Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q7_a2" name="answr7_2" onchange="showValue1(this,'7_2','7')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr7Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr7Arr_option[1] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr7Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br>
            <p class="unit">단위:원</p>
            <table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q7_a3" name="answr7_3" value="<?if($answr7Arr_text[2] != ""){echo $answr7Arr[2];}?>" <?if($answr7Arr_option[0] != "Y" && $answr7Arr_option[0] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q7_a4" name="answr7_4" value="<?if($answr7Arr_text[3] != ""){echo $answr7Arr[3];}?>" <?if($answr7Arr_option[0] != "Y" && $answr7Arr_option[0] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q7_a5" name="answr7_5" value="<?if($answr7Arr_text[4] != ""){echo $answr7Arr[4];}?>" <?if($answr7Arr_option[0] != "Y" && $answr7Arr_option[0] == null){?>readonly<?}?>></td>
				</tr>
			</table>
			<input type="hidden" id="i_num7" name="inum7" value="HTE-CG-07">
			<input type="hidden" id="note_7" name="note7" value="관리여부|공개여부|2019|2020|2021"> <!--가운데 목표설정 삭제-->
            <input type="hidden" id="note_7_1" name="note7_1" value="<?php echo $note7Arr[0]?>">
            <input type="hidden" id="note_7_2" name="note7_2" value="<?php echo $note7Arr[1]?>">
            <input type="hidden" id="note_7_3" name="note7_3" value="<?php echo $note7Arr[2]?>">
			<input type="hidden" id="note_7_4" name="note7_4" value="<?php echo $note7Arr[3]?>">
			<input type="hidden" id="note_7_5" name="note7_5" value="<?php echo $note7Arr[4]?>">
		</div>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">8. 행동강령 및 반부패 관련 법규 위반 건수</span></p>
		<div class="A a01">
			<table>
                <colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                <tr>
					<td>
                        <select id="q8_a1" name="answr8_1" onchange="showValue(this,'8_1','8')">
                            <option value="">관리여부</option>
    						<option value="Y" <?if($answr8Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr8Arr_option[0] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr8Arr_option[0] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q8_a2" name="answr8_2" onchange="showValue(this,'8_2','8')">
                            <option value="">목표설정여부</option>
    						<option value="Y" <?if($answr8Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr8Arr_option[1] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr8Arr_option[1] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
					<td>
						<select id="q8_a3" name="answr8_3" onchange="showValue(this,'8_3','8')">
                            <option value="">공개여부</option>
    						<option value="Y" <?if($answr8Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
    						<option value="N" <?if($answr8Arr_option[2] == "N"){?>selected<?}?>>NO</option>
    						<option value="X" <?if($answr8Arr_option[2] == "X"){?>selected<?}?>>모름</option>
						</select>
					</td>
				</tr>
			</table>
            </br>
            <p class="unit">단위:건</p>
            <table class="mt10">
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
					<td><input type="text" id="q8_a4" name="answr8_4" value="<?if($answr8Arr_text[3] != ""){echo $answr8Arr[3];}?>" <?if($answr8Arr_option[0] != "Y" && $answr8Arr_option[0] == null && $answr8Arr_option[1] != "Y" && $answr8Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q8_a5" name="answr8_5" value="<?if($answr8Arr_text[4] != ""){echo $answr8Arr[4];}?>" <?if($answr8Arr_option[0] != "Y" && $answr8Arr_option[0] == null && $answr8Arr_option[1] != "Y" && $answr8Arr_option[1] == null){?>readonly<?}?>></td>
					<td><input type="text" id="q8_a6" name="answr8_6" value="<?if($answr8Arr_text[5] != ""){echo $answr8Arr[5];}?>" <?if($answr8Arr_option[0] != "Y" && $answr8Arr_option[0] == null && $answr8Arr_option[1] != "Y" && $answr8Arr_option[1] == null){?>readonly<?}?>></td>
				</tr>
			</table>
			<input type="hidden" id="i_num8" name="inum8" value="HTE-CG-08">
			<input type="hidden" id="note_8" name="note8" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
            <input type="hidden" id="note_8_1" name="note8_1" value="<?php echo $note8Arr[0]?>">
            <input type="hidden" id="note_8_2" name="note8_2" value="<?php echo $note8Arr[1]?>">
            <input type="hidden" id="note_8_3" name="note8_3" value="<?php echo $note8Arr[2]?>">
			<input type="hidden" id="note_8_4" name="note8_4" value="<?php echo $note8Arr[3]?>">
			<input type="hidden" id="note_8_5" name="note8_5" value="<?php echo $note8Arr[4]?>">
			<input type="hidden" id="note_8_6" name="note8_6" value="<?php echo $note8Arr[5]?>">
		</div>

		<p class="Q c04"><span class="c04">지배구조</span><span class="txt">9. 사업장 윤리경영 및 반부패 리스크 관리를 위한 내부 협의체 등 의사결정/내부보고 구조가 있습니까?</span></p>
		<div class="A a01">
			<input type="radio" name="answr9" id="q9_a1" onclick="answerChk(this,'9');" value="A" <?if($answr9 == "A"){?>checked<?}?>><label for="q9_a1">상 : 전사 단위로 윤리경영 및 반부패 관련 사항을 내부보고 또는 협의한다.</label>
			<input type="radio" name="answr9" id="q9_a2" onclick="answerChk(this,'9');" value="B" <?if($answr9 == "B"){?>checked<?}?>><label for="q9_a2">중 : 사업장 단위로 옴부즈맨, 핫라인제도 등 대응방안을 내부보고 또는 협의한다.</label>
			<input type="radio" name="answr9" id="q9_a3" onclick="answerChk(this,'9');" value="C" <?if($answr9 == "C"){?>checked<?}?>><label for="q9_a3">하 : 윤리·준법 리스크 관련 의사결정/내부보고 구조가 없다.</label>
            <input type="hidden" id="i_num9" name="inum9" value="HTE-CG-09">
            <input type="hidden" id="note_9" name="note9" value="<?php echo $note9; ?>">
		</div>

		<p class="s_btn">
			<a href="survey03.php" class="prev">이전단계</a>
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

    function showValue1(target,num,num1){
    	var answer = target.options[target.selectedIndex].text;
    	$('input[name=note'+num+']').attr('value',answer);

        var selectOption1  = document.getElementById('q'+num1+'_a1');
        selectOption1 = selectOption1.options[selectOption1.selectedIndex].value;
        var selectOption2  = document.getElementById('q'+num1+'_a2');
        selectOption2 = selectOption2.options[selectOption2.selectedIndex].value;
        if(selectOption1 == "Y"){
            $('#q'+num1+'_a3').attr('readonly',false);
            $('#q'+num1+'_a4').attr('readonly',false);
            $('#q'+num1+'_a5').attr('readonly',false);
        } else {
            $('#q'+num1+'_a3').attr('readonly',true);
            $('#q'+num1+'_a4').attr('readonly',true);
            $('#q'+num1+'_a5').attr('readonly',true);
            $('#q'+num1+'_a3').val("");
            $('#q'+num1+'_a4').val("");
            $('#q'+num1+'_a5').val("");
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

        for(var i=1; i<=2; i++){
			if($("#q6_a"+i).val().trim()==""){
	      		alert("6번 문항을 선택해주세요.");
				$("#q6_a"+i).focus();
	      		return false;
			}
	    }
		
		var reg = /^[-|+]?\d+\.?\d*$/;
		var year = 2019;
        if($("#q6_a1").val()=="Y" || $("#q6_a2").val()=="Y"){
            for(var i=3; i<=5; i++){
                if($("#q6_a"+i).val().trim() == ""){
                    alert("6번 비율을 입력해주세요.");
                    $("#q6_a"+i).focus();
                    return false;
                }
                if(!reg.test($("#q6_a"+i).val())){
                    alert(year+"년 비율에 숫자만 입력해주세요.");
                    $("#q6_a"+i).focus();
                    return false;
                }
                year++;
            }
        }
        
        for(var i=1; i<=2; i++){
			if($("#q7_a"+i).val().trim()==""){
	      		alert("7번 문항을 선택해주세요.");
				$("#q7_a"+i).focus();
	      		return false;
			}
	    }

		var reg = /^[-|+]?\d+\.?\d*$/;
		var year = 2019;
        if($("#q7_a1").val()=="Y" || $("#q7_a2").val()=="Y"){
            for(var i=3; i<=5; i++){
                if($("#q7_a"+i).val().trim() == ""){
                    alert("7번 비율을 입력해주세요.");
                    $("#q7_a"+i).focus();
                    return false;
                }
                if(!reg.test($("#q7_a"+i).val())){
                    alert(year+"년 비율에 숫자만 입력해주세요.");
                    $("#q7_a"+i).focus();
                    return false;
                }
                year++;
            }
        }

        for(var i=1; i<=3; i++){
			if($("#q8_a"+i).val().trim()==""){
	      		alert("8번 문항을 선택해주세요.");
				$("#q8_a"+i).focus();
	      		return false;
			}
	    }
		
		var reg = /^[-|+]?\d+\.?\d*$/;
		var year = 2019;
        if($("#q8_a1").val()=="Y" || $("#q8_a2").val()=="Y"){
            for(var i=4; i<=6; i++){
                if($("#q8_a"+i).val().trim() == ""){
                    alert("8번 비율을 입력해주세요.");
                    $("#q8_a"+i).focus();
                    return false;
                }
                if(!reg.test($("#q8_a"+i).val())){
                    alert(year+"년 비율에 숫자만 입력해주세요.");
                    $("#q8_a"+i).focus();
                    return false;
                }
                year++;
            }
        }
        if($('input[name=answr9]:radio:checked').length < 1){
			alert("9번 문항에 체크해주세요.");
			$('input[name=answr9]:radio').focus();
			return false;
		}

        frm.submit();
	}
</script>
</html>
