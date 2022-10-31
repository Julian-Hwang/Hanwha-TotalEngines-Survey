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
			LIMIT 26";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}

	for($i=1; $i<27; $i++){
		${"answr".$i} = $row[$i-1]["ANSWR"];
	}

	for($i=11; $i<21; $i++){
		${"answr_option".$i} = $row[$i-1]["ANSWR"];
	}

	for($i=11; $i<21; $i++){
		${"answr_text".$i} = $row[$i-1]["CONT"];
	}

	for($i=11; $i<21; $i++){
		${"answr".$i} = $row[$i-1]["CONT"];
	}

	for($i=11; $i<21; $i++){
		${"answr".$i."Arr_option"} = explode('|', ${"answr_option".$i});
	}

	for($i=11; $i<21; $i++){
		${"answr".$i."Arr_text"} = explode('|', ${"answr_text".$i});
	}

	for($i=9; $i<27; $i++){
		${"answr".$i."Arr"} = explode('|', ${"answr".$i});
	}

  	for($i=1; $i<27; $i++){
    ${"note".$i} = $row[$i-1]["CONT"];
	}

  	for($i=9; $i<27; $i++){
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
		<form name="frm" id="frm" action="survey/survey02_proc.php" method="post">
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

			<p class="Q c02"><span class="c02">환경</span><span class="txt">9. SBTi, TCFD 등 기후변화 관련 이니셔티브에 가입하거나 이와 연계하여 기후변화 목표를 수립하고 있습니까? <span></p>
			<input type="hidden" id="i_num9" name="inum9" value="HTE-CE-09">
			<input type="hidden" id="note_9" name="note9" value="관리여부|목표설정여부|공개여부">
			<div class="A a01">
				<input type="hidden" id="note_9_1" name="note9_1" value="<?php echo $note9Arr[0]?>">
				<input type="hidden" id="note_9_2" name="note9_2" value="<?php echo $note9Arr[1]?>">
				<input type="hidden" id="note_9_3" name="note9_3" value="<?php echo $note9Arr[2]?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="r01_09" name="answr9_1" class="check9" onchange="showValue(this,'9_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr9Arr[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr9Arr[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr9Arr[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="r02_09" name="answr9_2" class="check9" onchange="showValue(this,'9_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr9Arr[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr9Arr[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr9Arr[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="r03_09" name="answr9_3" class="check9" onchange="showValue(this,'9_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr9Arr[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr9Arr[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr9Arr[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">10. 전사 기후변화 거버넌스 구축 차원에서 이사회 또는 경영진의 책임을 확인할 수 있는 조직이나 보고체계를 갖추고 있습니까?<span></p>
			<input type="hidden" id="i_num10" name="inum10" value="HTE-CE-10">
			<input type="hidden" id="note_10" name="note10" value="관리여부|목표설정여부|공개여부">
			<div class="A a01">
				<input type="hidden" id="note_10_1" name="note10_1" value="<?php echo $note10Arr[0]?>">
				<input type="hidden" id="note_10_2" name="note10_2" value="<?php echo $note10Arr[1]?>">
				<input type="hidden" id="note_10_3" name="note10_3" value="<?php echo $note10Arr[2]?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="r01_10" name="answr10_1" class="check10" onchange="showValue(this,'10_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr10Arr[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr10Arr[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr10Arr[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="r02_10" name="answr10_2" class="check10" onchange="showValue(this,'10_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr10Arr[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr10Arr[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr10Arr[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="r03_10" name="answr10_3" class="check10" onchange="showValue(this,'10_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr10Arr[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr10Arr[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr10Arr[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">11. Scope1 + Scope2 배출량을 관리하고 있습니까?<span></p>
			<div class="A a01">
			<input type="hidden" id="i_num11" name="inum11" value="HTE-CE-11">
			<input type="hidden" id="note_11" name="note11" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
			<input type="hidden" id="note_11_1" name="note11_1" value="<?php echo $note11Arr[0]?>">
			<input type="hidden" id="note_11_2" name="note11_2" value="<?php echo $note11Arr[1]?>">
			<input type="hidden" id="note_11_3" name="note11_3" value="<?php echo $note11Arr[2]?>">
			<input type="hidden" id="note_11_4" name="note11_4" value="<?php echo $note11Arr[3]?>">
			<input type="hidden" id="note_11_5" name="note11_5" value="<?php echo $note11Arr[4]?>">
			<input type="hidden" id="note_11_6" name="note11_6" value="<?php echo $note11Arr[5]?>">
				<div class="sample">
					- Scope1(직접배출): 기업이 소유, 통제하는 발생원에서 발생한 온실가스 배출<br/>
					- Scope2(간접배출): 기업이 구입하여 소비한 전기, 스팀 생산으로 배출된 온실가스 배출<br/><br/>

					1) 관리여부: 직접/간접 온실가스 배출량의 정량적인 수치를 구하기 위하여 귀사의 배출 경계범위 및 배출원 별 산정 방법론을 설정하고 배출량 값을 도출하고 있는가?<br/>
					2) 목표설정: 기준연도를 설정하고, 각각의 배출량에 대한 목표를 설정하고 있는가?(eg: 차년도에는 Scope 1+2 합산 30t CO2e이하의 배출량을 달성하겠다 등)<br/>
					3) 공개여부: 귀사가 설정한 경계범위 및 방법론에 따라 산정된 배출량을 보고서 또는 홈페이지를 통해 대외공개하고 있는가?
				</div>
               
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q11_a1" name="answr11_1" onchange="showValue(this,'11_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr11Arr_option[0] == "Y"){?>selected<?}?> >YES</option>
								<option value="N" <?if($answr11Arr_option[0] == "N"){?>selected<?}?> >NO</option>
								<option value="X" <?if($answr11Arr_option[0] == "X"){?>selected<?}?> >모름</option>
							</select>
						</td>
						<td>
							<select id="q11_a2" name="answr11_2" onchange="showValue(this,'11_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr11Arr_option[1] == "Y"){?>selected<?}?> >YES</option>
								<option value="N" <?if($answr11Arr_option[1] == "N"){?>selected<?}?> >NO</option>
								<option value="X" <?if($answr11Arr_option[1] == "X"){?>selected<?}?> >모름</option>
							</select>
						</td>
						<td>
							<select id="q11_a3" name="answr11_3" onchange="showValue(this,'11_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr11Arr_option[2] == "Y"){?>selected<?}?> >YES</option>
								<option value="N" <?if($answr11Arr_option[2] == "N"){?>selected<?}?> >NO</option>
								<option value="X" <?if($answr11Arr_option[2] == "X"){?>selected<?}?> >모름</option>
							</select>
						</td>
					</tr>
				</table>

				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:tCO2-eq</p>                  
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q11_a4" name="answr11_4" value="<?if($answr11Arr_text[0] == ""){echo "";}else{echo $answr11Arr[3];}?>"<?if($answr11Arr_option[0] != "Y" && $answr11Arr_option[0] == null && $answr11Arr_option[1] != "Y" && $answr11Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q11_a5" name="answr11_5" value="<?if($answr11Arr_text[4] == ""){echo "";}else{echo $answr11Arr[4];}?>"<?if($answr11Arr_option[0] != "Y" && $answr11Arr_option[0] == null && $answr11Arr_option[1] != "Y" && $answr11Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q11_a6" name="answr11_6" value="<?if($answr11Arr_text[5] == ""){echo "";}else{echo $answr11Arr[5];}?>"<?if($answr11Arr_option[0] != "Y" && $answr11Arr_option[0] == null && $answr11Arr_option[1] != "Y" && $answr11Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>
            
			<!-- 문제 번호 주의 //db에 24번 문항 -->
			<p class="Q c02"><span class="c02">환경</span><span class="txt">12.  Scope 3 배출량을 관리하고 있습니까?<span></p>
			<div class="A a01">

				<input type="hidden" id="i_num24" name="inum24" value="HTE-CE-24">
				<input type="hidden" id="note_24" name="note24" value="관리여부|목표설정여부|공개여부">
				<input type="hidden" id="note_24_1" name="note24_1" value="<?php echo $note24Arr[0]?>">
				<input type="hidden" id="note_24_2" name="note24_2" value="<?php echo $note24Arr[1]?>">
				<input type="hidden" id="note_24_3" name="note24_3" value="<?php echo $note24Arr[2]?>">

				<div class="sample">
					※Scope3(기타 간접배출)<br/>
					기업이 소유하거나 통제하지 않는 시설에서 발생한 온실가스 배출<br/>
					ex. 출장, 통근, 판매제품의 가공, 사용 폐기 시 발생되는 온실가스 배출량<br/><br/>

					1) 관리여부: 공급망 온실가스 배출량의 정량적인 수치를 구하기 위하여 귀사의 공급망 배출 경계범위 및 배출원 별 산정 방법론을 설정하고 배출량 값을 도출하고 있는가?<br/>
					2) 목표설정: 기준연도를 설정하고, 각각의 배출량에 대한 목표를 설정하고 있는가?(eg: 차년도에는 Scope 3에서 100t CO2e이하의 배출량을 달성하겠다 등)<br/>
					3) 공개여부: 귀사가 설정한 경계범위 및 방법론에 따라 산정된 배출량을 보고서 또는 홈페이지를 통해 대외공개하고 있는가?
				</div>
                <p class="unit">단위:tCO2-eq</p>
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q24_a1" name="answr24_1" onchange="showValue(this,'24_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr24Arr[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr24Arr[0] == "N"){?>selected<?}?>>NO</option>
								<option value="A" <?if($answr24Arr[0] == "A"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q24_a2" name="answr24_2" onchange="showValue(this,'24_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr24Arr[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr24Arr[1] == "N"){?>selected<?}?>>NO</option>
								<option value="A" <?if($answr24Arr[1] == "A"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q24_a3" name="answr24_3" onchange="showValue(this,'24_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr24Arr[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr24Arr[2] == "N"){?>selected<?}?>>NO</option>
								<option value="A" <?if($answr24Arr[2] == "A"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">13. 에너지 사용 절감량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num12" name="inum12" value="HTE-CE-12">
				<input type="hidden" id="note_12" name="note12" value="관리여부|목표설정여부|공개여부|2019사용량|2020사용량|2021사용량|2019절감량|2020절감량|2021절감량">
				<input type="hidden" id="note_12_1" name="note12_1" value="<?php echo $note12Arr[0];?>">
				<input type="hidden" id="note_12_2" name="note12_2" value="<?php echo $note12Arr[1];?>">
				<input type="hidden" id="note_12_3" name="note12_3" value="<?php echo $note12Arr[2];?>">
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
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr12Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr12Arr_option[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr12Arr_option[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q12_a3" name="answr12_3" onchange="showValue(this,'12_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr12Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr12Arr_option[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr12Arr_option[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:TJ</p>
					<tr>
						<th>2019년 사용량</th>
						<th>2020년 사용량</th>
						<th>2021년 사용량</th>
					</tr>
					<tr>
						<td><input type="text" id="q12_a4" name="answr12_4" value="<?if($answr12Arr_text[3] == ""){echo "";}else{echo $answr12Arr[3];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q12_a5" name="answr12_5" value="<?if($answr12Arr_text[4] == ""){echo "";}else{echo $answr12Arr[4];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q12_a6" name="answr12_6" value="<?if($answr12Arr_text[5] == ""){echo "";}else{echo $answr12Arr[5];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
					</table>

					<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<th>2019년 절감량</th>
						<th>2020년 절감량</th>
						<th>2021년 절감량</th>
					</tr>
					<tr>
						<td><input type="text" id="q12_a7" name="answr12_7" value="<?if($answr12Arr_text[6] == ""){echo "";}else{echo $answr12Arr[3];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q12_a8" name="answr12_8" value="<?if($answr12Arr_text[7] == ""){echo "";}else{echo $answr12Arr[3];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q12_a9" name="answr12_9" value="<?if($answr12Arr_text[8] == ""){echo "";}else{echo $answr12Arr[3];}?>"<?if($answr12Arr_option[0] != "Y" && $answr12Arr_option[0] == null && $answr12Arr_option[1] != "Y" && $answr12Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">14. 신·재생에너지 사용량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num13" name="inum13" value="HTE-CE-13">
				<input type="hidden" id="note_13" name="note13" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_13_1" name="note13_1" value="<?php echo $note13Arr[0];?>">
				<input type="hidden" id="note_13_2" name="note13_2" value="<?php echo $note13Arr[1];?>">
				<input type="hidden" id="note_13_3" name="note13_3" value="<?php echo $note13Arr[2];?>">
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
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:kWh</p>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q13_a4" name="answr13_4" value="<?if($answr13Arr_text[3] == ""){echo "";}else{echo $answr13Arr[3];}?>"<?if($answr13Arr_option[0] != "Y" && $answr13Arr_option[0] == null && $answr13Arr_option[1] != "Y" && $answr13Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q13_a5" name="answr13_5" value="<?if($answr13Arr_text[4] == ""){echo "";}else{echo $answr13Arr[4];}?>"<?if($answr13Arr_option[0] != "Y" && $answr13Arr_option[0] == null && $answr13Arr_option[1] != "Y" && $answr13Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q13_a6" name="answr13_6" value="<?if($answr13Arr_text[5] == ""){echo "";}else{echo $answr13Arr[5];}?>"<?if($answr13Arr_option[0] != "Y" && $answr13Arr_option[0] == null && $answr13Arr_option[1] != "Y" && $answr13Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
					

				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">15. 총 원∙부자재 구매액 대비 녹색자재 구매액의 비율을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num14" name="inum14" value="HTE-CE-14">
				<input type="hidden" id="note_14" name="note14" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_14_1" name="note14_1" value="<?php echo $note14Arr[0];?>">
				<input type="hidden" id="note_14_2" name="note14_2" value="<?php echo $note14Arr[1];?>">
				<input type="hidden" id="note_14_3" name="note14_3" value="<?php echo $note14Arr[2];?>">
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
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:%</p>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q14_a4" name="answr14_4" value="<?if($answr14Arr_text[3] == ""){echo "";}else{echo $answr14Arr[3];}?>"<?if($answr14Arr_option[0] != "Y" && $answr14Arr_option[0] == null && $answr14Arr_option[1] != "Y" && $answr14Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q14_a5" name="answr14_5" value="<?if($answr14Arr_text[4] == ""){echo "";}else{echo $answr14Arr[4];}?>"<?if($answr14Arr_option[0] != "Y" && $answr14Arr_option[0] == null && $answr14Arr_option[1] != "Y" && $answr14Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q14_a6" name="answr14_6" value="<?if($answr14Arr_text[5] == ""){echo "";}else{echo $answr14Arr[5];}?>"<?if($answr14Arr_option[0] != "Y" && $answr14Arr_option[0] == null && $answr14Arr_option[1] != "Y" && $answr14Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">16. 용수 사용량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num15" name="inum15" value="HTE-CE-15">
				<input type="hidden" id="note_15" name="note15" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_15_1" name="note15_1" value="<?php echo $note15Arr[0];?>">
				<input type="hidden" id="note_15_2" name="note15_2" value="<?php echo $note15Arr[1];?>">
				<input type="hidden" id="note_15_3" name="note15_3" value="<?php echo $note15Arr[2];?>">
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
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:m3</p>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q15_a4" name="answr15_4" value="<?if($answr15Arr_text[3] == ""){echo "";}else{echo $answr15Arr[3];}?>"<?if($answr15Arr_option[0] != "Y" && $answr15Arr_option[0] == null && $answr15Arr_option[1] != "Y" && $answr15Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q15_a5" name="answr15_5" value="<?if($answr15Arr_text[4] == ""){echo "";}else{echo $answr15Arr[4];}?>"<?if($answr15Arr_option[0] != "Y" && $answr15Arr_option[0] == null && $answr15Arr_option[1] != "Y" && $answr15Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q15_a6" name="answr15_6" value="<?if($answr15Arr_text[5] == ""){echo "";}else{echo $answr15Arr[5];}?>"<?if($answr15Arr_option[0] != "Y" && $answr15Arr_option[0] == null && $answr15Arr_option[1] != "Y" && $answr15Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">17. 용수 재사용량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num16" name="inum16" value="HTE-CE-16">
				<input type="hidden" id="note_16" name="note16" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_16_1" name="note16_1" value="<?php echo $note16Arr[0];?>">
				<input type="hidden" id="note_16_2" name="note16_2" value="<?php echo $note16Arr[1];?>">
				<input type="hidden" id="note_16_3" name="note16_3" value="<?php echo $note16Arr[2];?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q16_a1" name="answr16_1" onchange="showValue(this,'16_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr16Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr16Arr_option[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr16Arr_option[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q16_a2" name="answr16_2" onchange="showValue(this,'16_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr16Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr16Arr_option[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr16Arr_option[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q16_a3" name="answr16_3" onchange="showValue(this,'16_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr16Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr16Arr_option[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr16Arr_option[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:m3</p>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q16_a4" name="answr16_4" value="<?if($answr16Arr_text[3] == ""){echo "";}else{echo $answr16Arr[3];}?>"<?if($answr16Arr_option[0] != "Y" && $answr16Arr_option[0] == null && $answr16Arr_option[1] != "Y" && $answr16Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q16_a5" name="answr16_5" value="<?if($answr16Arr_text[4] == ""){echo "";}else{echo $answr16Arr[4];}?>"<?if($answr16Arr_option[0] != "Y" && $answr16Arr_option[0] == null && $answr16Arr_option[1] != "Y" && $answr16Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q16_a6" name="answr16_6" value="<?if($answr16Arr_text[5] == ""){echo "";}else{echo $answr16Arr[5];}?>"<?if($answr16Arr_option[0] != "Y" && $answr16Arr_option[0] == null && $answr16Arr_option[1] != "Y" && $answr16Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">18. 폐기물 배출량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num17" name="inum17" value="HTE-CE-17">
				<input type="hidden" id="note_17" name="note17" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_17_1" name="note17_1" value="<?php echo $note17Arr[0];?>">
				<input type="hidden" id="note_17_2" name="note17_2" value="<?php echo $note17Arr[1];?>">
				<input type="hidden" id="note_17_3" name="note17_3" value="<?php echo $note17Arr[2];?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q17_a1" name="answr17_1" onchange="showValue(this,'17_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr17Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr17Arr_option[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr17Arr_option[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q17_a2" name="answr17_2" onchange="showValue(this,'17_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr17Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr17Arr_option[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr17Arr_option[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q17_a3" name="answr17_3" onchange="showValue(this,'17_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr17Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr17Arr_option[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr17Arr_option[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
                    <br><p class="unit">단위:Ton</p>
					<tr>
						<td><input type="text" id="q17_a4" name="answr17_4" value="<?if($answr17Arr_text[3] == ""){echo "";}else{echo $answr17Arr[3];}?>"<?if($answr17Arr_option[0] != "Y" && $answr17Arr_option[0] == null && $answr17Arr_option[1] != "Y" && $answr17Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q17_a5" name="answr17_5" value="<?if($answr17Arr_text[4] == ""){echo "";}else{echo $answr17Arr[4];}?>"<?if($answr17Arr_option[0] != "Y" && $answr17Arr_option[0] == null && $answr17Arr_option[1] != "Y" && $answr17Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q17_a6" name="answr17_6" value="<?if($answr17Arr_text[5] == ""){echo "";}else{echo $answr17Arr[5];}?>"<?if($answr17Arr_option[0] != "Y" && $answr17Arr_option[0] == null && $answr17Arr_option[1] != "Y" && $answr17Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">19. 폐기물 재활용량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num18" name="inum18" value="HTE-CE-18">
				<input type="hidden" id="note_18" name="note18" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_18_1" name="note18_1" value="<?php echo $note18Arr[0];?>">
				<input type="hidden" id="note_18_2" name="note18_2" value="<?php echo $note18Arr[1];?>">
				<input type="hidden" id="note_18_3" name="note18_3" value="<?php echo $note18Arr[2];?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q18_a1" name="answr18_1" onchange="showValue(this,'18_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr18Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr18Arr_option[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr18Arr_option[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q18_a2" name="answr18_2" onchange="showValue(this,'18_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr18Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr18Arr_option[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr18Arr_option[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q18_a3" name="answr18_3" onchange="showValue(this,'18_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr18Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr18Arr_option[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr18Arr_option[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:Ton</p>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q18_a4" name="answr18_4" value="<?if($answr18Arr_text[3] == ""){echo "";}else{echo $answr18Arr[3];}?>"<?if($answr18Arr_option[0] != "Y" && $answr18Arr_option[0] == null && $answr18Arr_option[1] != "Y" && $answr18Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q18_a5" name="answr18_5" value="<?if($answr18Arr_text[4] == ""){echo "";}else{echo $answr18Arr[4];}?>"<?if($answr18Arr_option[0] != "Y" && $answr18Arr_option[0] == null && $answr18Arr_option[1] != "Y" && $answr18Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q18_a6" name="answr18_6" value="<?if($answr18Arr_text[5] == ""){echo "";}else{echo $answr18Arr[5];}?>"<?if($answr18Arr_option[0] != "Y" && $answr18Arr_option[0] == null && $answr18Arr_option[1] != "Y" && $answr18Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">20. 대기오염물질 배출 총량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num19" name="inum19" value="HTE-CE-19">
				<input type="hidden" id="note_19" name="note19" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_19_1" name="note19_1" value="<?php echo $note19Arr[0];?>">
				<input type="hidden" id="note_19_2" name="note19_2" value="<?php echo $note19Arr[1];?>">
				<input type="hidden" id="note_19_3" name="note19_3" value="<?php echo $note19Arr[2];?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q19_a1" name="answr19_1" onchange="showValue(this,'19_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr19Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr19Arr_option[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr19Arr_option[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q19_a2" name="answr19_2" onchange="showValue(this,'19_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr19Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr19Arr_option[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr19Arr_option[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q19_a3" name="answr19_3" onchange="showValue(this,'19_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr19Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr19Arr_option[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr19Arr_option[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:kg</p>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q19_a4" name="answr19_4" value="<?if($answr19Arr_text[3] == ""){echo "";}else{echo $answr19Arr[3];}?>"<?if($answr19Arr_option[0] != "Y" && $answr19Arr_option[0] == null && $answr19Arr_option[1] != "Y" && $answr19Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q19_a5" name="answr19_5" value="<?if($answr19Arr_text[4] == ""){echo "";}else{echo $answr19Arr[4];}?>"<?if($answr19Arr_option[0] != "Y" && $answr19Arr_option[0] == null && $answr19Arr_option[1] != "Y" && $answr19Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q19_a6" name="answr19_6" value="<?if($answr19Arr_text[5] == ""){echo "";}else{echo $answr19Arr[5];}?>"<?if($answr19Arr_option[0] != "Y" && $answr19Arr_option[0] == null && $answr19Arr_option[1] != "Y" && $answr19Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">21. 수질오염물질 배출 총량을 관리하고 있습니까?<span></p>
			<div class="A a01">
				<input type="hidden" id="i_num20" name="inum20" value="HTE-CE-20">
				<input type="hidden" id="note_20" name="note20" value="관리여부|목표설정여부|공개여부|2019|2020|2021">
				<input type="hidden" id="note_20_1" name="note20_1" value="<?php echo $note20Arr[0];?>">
				<input type="hidden" id="note_20_2" name="note20_2" value="<?php echo $note20Arr[1];?>">
				<input type="hidden" id="note_20_3" name="note20_3" value="<?php echo $note20Arr[2];?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q20_a1" name="answr20_1" onchange="showValue(this,'20_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr20Arr_option[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr20Arr_option[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr20Arr_option[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q20_a2" name="answr20_2" onchange="showValue(this,'20_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr20Arr_option[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr20Arr_option[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr20Arr_option[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q20_a3" name="answr20_3" onchange="showValue(this,'20_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr20Arr_option[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr20Arr_option[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr20Arr_option[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
				<table class="mt10">
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
                    <br><p class="unit">단위:kg</p>
					<tr>
						<th>2019</th>
						<th>2020</th>
						<th>2021</th>
					</tr>
					<tr>
						<td><input type="text" id="q20_a4" name="answr20_4" value="<?if($answr20Arr_text[3] == ""){echo "";}else{echo $answr20Arr[3];}?>"<?if($answr20Arr_option[0] != "Y" && $answr20Arr_option[0] == null && $answr20Arr_option[1] != "Y" && $answr20Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q20_a5" name="answr20_5" value="<?if($answr20Arr_text[4] == ""){echo "";}else{echo $answr20Arr[4];}?>"<?if($answr20Arr_option[0] != "Y" && $answr20Arr_option[0] == null && $answr20Arr_option[1] != "Y" && $answr20Arr_option[1] == null){?>readonly<?}?>></td>
						<td><input type="text" id="q20_a6" name="answr20_6" value="<?if($answr20Arr_text[5] == ""){echo "";}else{echo $answr20Arr[5];}?>"<?if($answr20Arr_option[0] != "Y" && $answr20Arr_option[0] == null && $answr20Arr_option[1] != "Y" && $answr20Arr_option[1] == null){?>readonly<?}?>></td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">22. ISO14001 등 국제적 환경경영시스템 표준 또는 이에 준하는 인증을 획득하였습니까?<span></p>
			<input type="hidden" id="i_num21" name="inum21" value="HTE-CE-21">
			<input type="hidden" id="note_21" name="note21" value="<?php echo $note21?>">
			<div class="A a01">
				<input type="radio" id="q21_a1" name="answr21" onclick="answerChk(this,'21');" value="A" <?if($answr21 == "A"){?>checked<?}?>>
				<label for="q21_a1">상 : ISO14001 또는 이에 준하는 인증을 획득하였으며, 외부전문기관의 인증을 받고 있다.</label>
				<input type="radio" id="q21_a2" name="answr21" onclick="answerChk(this,'21');" value="B" <?if($answr21 == "B"){?>checked<?}?>>
				<label for="q21_a2">중 : ISO14001 또는 이에 준하는 인증의 획득하였으며, 내부심사원의 검토를 받고 있다.</label>
				<input type="radio" id="q21_a3" name="answr21" onclick="answerChk(this,'21');" value="C" <?if($answr21 == "C"){?>checked<?}?>>
				<label for="q21_a3">하 : ISO14001 또는 이에 준하는 인증을 획득하지 않았다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">23. 사업장 활동에 요구되는 환경 인허가, 라이선스 등록이 모두 구비되어 있고 유효합니까?<br/>(오염물질 배출 시설 허가증, 폐기물 배출 신고서 등)<span></p>
			<input type="hidden" id="i_num22" name="inum22" value="HTE-CE-22">
			<input type="hidden" id="note_22" name="note22" value="<?php echo $note22?>">
			<div class="A a01">
				<input type="radio" id="q22_a1" name="answr22" onclick="answerChk(this,'22');" value="A" <?if($answr22 == "A"){?>checked<?}?>>
				<label for="q22_a1">상 : 사업장 활동에 요구되는 환경 인허가, 라이선스 등록이 모두 구비되어 있고 유효하다.</label>
				<input type="radio" id="q22_a2" name="answr22" onclick="answerChk(this,'22');" value="B" <?if($answr22 == "B"){?>checked<?}?>>
				<label for="q22_a2">중 : 사업장 활동에 요구되는 환경 인허가, 라이선스 등록의 유효기간이 경과되었다.</label>
				<input type="radio" id="q22_a3" name="answr22" onclick="answerChk(this,'22');" value="C" <?if($answr22 == "C"){?>checked<?}?>>
			<label for="q22_a3">하 : 사업장 활동에 요구되는 환경 인허가, 라이선스 등록을 보유하지 않고 있다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">24. 수질오염물질 배출 환경 검사 보고서(오염물질 배출, 소음진동 자가 측정 기록부)가 구비되어 있고 인허가/라이선스 조건을 충족시킵니까?<span></p>
			<input type="hidden" id="i_num23" name="inum23" value="HTE-CE-23">
			<input type="hidden" id="note_23" name="note23" value="<?php echo $note23?>">
			<div class="A a01">
				<input type="radio" id="q23_a1" name="answr23" onclick="answerChk(this,'23');" value="A" <?if($answr23 == "A"){?>checked<?}?>>
				<label for="q23_a1">상 : 환경 검사 보고서가 구비되어 있고 인허가/라이선스 조건을 충족시킨다.</label>
				<input type="radio" id="q23_a2" name="answr23" onclick="answerChk(this,'23');" value="B" <?if($answr23 == "B"){?>checked<?}?>>
				<label for="q23_a2">중 : 환경 검사 보고서가 구비되어 있다.</label>
				<input type="radio" id="q23_a3" name="answr23" onclick="answerChk(this,'23');" value="C" <?if($answr23 == "C"){?>checked<?}?>>
				<label for="q23_a3">하 : 환경 검사 보고서가 구비되어 있지 않다.</label>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">25. 전환 리스크(정책/법률/기술/시장/평판) 또는 물리적 리스크(기상이변/해수면상승 등)에 대한 리스크를 식별하기 위한 관리 절차를 운영하고 있습니까?<span></p>

				<div class="A a01">
				<div class="sample">
					1) 관리여부 : 기후변화로 인한 비즈니스 리스크를 식별하고 있다.<br/>
					2) 목표설정여부: 기후변화로 인한 비즈니스 리스크의 범위를 확장할 계획이다.<br/>
					3) 공개여부 : 기후변화로 인한 비즈니스 리스크를 보고서나 홈페이지를 통해 대외공개하고 있다.
				</div>
				<input type="hidden" id="i_num25" name="inum25" value="HTE-CE-25">
				<input type="hidden" id="note_25" name="note25" value="관리여부|목표설정여부|공개여부">
				<input type="hidden" id="note_25_1" name="note25_1" value="<?php echo $note25Arr[0];?>">
				<input type="hidden" id="note_25_2" name="note25_2" value="<?php echo $note25Arr[1];?>">
				<input type="hidden" id="note_25_3" name="note25_3" value="<?php echo $note25Arr[2];?>">
				<table>
					<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup>
					<tr>
						<td>
							<select id="q25_a1" name="answr25_1" onchange="showValue(this,'25_1')">
								<option value="">관리여부</option>
								<option value="Y" <?if($answr25Arr[0] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr25Arr[0] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr25Arr[0] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q25_a2" name="answr25_2" onchange="showValue(this,'25_2')">
								<option value="">목표설정여부</option>
								<option value="Y" <?if($answr25Arr[1] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr25Arr[1] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr25Arr[1] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
						<td>
							<select id="q25_a3" name="answr25_3" onchange="showValue(this,'25_3')">
								<option value="">공개여부</option>
								<option value="Y" <?if($answr25Arr[2] == "Y"){?>selected<?}?>>YES</option>
								<option value="N" <?if($answr25Arr[2] == "N"){?>selected<?}?>>NO</option>
								<option value="X" <?if($answr25Arr[2] == "X"){?>selected<?}?>>모름</option>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<p class="Q c02"><span class="c02">환경</span><span class="txt">26 기후변화 리스크를 전사 리스크 관리 체계 내에 통합하여 관리하고 있습니까?<span></p>
			<input type="hidden" id="i_num26" name="inum26" value="HTE-CE-26">
			<input type="hidden" id="note_26" name="note26" value="<?php echo $note26?>">
			<div class="A a01">
				<input type="radio" id="q26_a1" name="answr26" onclick="answerChk(this,'26');" value="A" <?if($answr26 == "A"){?>checked<?}?>>
				<label for="q26_a1">상 : 기후변화 리스크를 전사 리스크 관리 체계 내에 통합하여 관리하고 있다. </label>
				<input type="radio" id="q26_a2" name="answr26" onclick="answerChk(this,'26');" value="B" <?if($answr26 == "B"){?>checked<?}?>>
				<label for="q26_a2">중 : 기후변화 리스크를 전사 리스크 관리 체계 내에 통합할 계획을 수립하였다.</label>
				<input type="radio" id="q26_a3" name="answr26" onclick="answerChk(this,'26');" value="C" <?if($answr26 == "C"){?>checked<?}?>>
				<label for="q26_a3">하 : 기후변화 리스크를 별도로 관리한다 or 별도의 기후변화 리스크를 관리하지 않고 있다. </label>
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
       
        } else{
            $('#q11_a4').attr('readonly',true);
			$('#q11_a5').attr('readonly',true);
			$('#q11_a6').attr('readonly',true);
			$('#q11_a4').val("");
			$('#q11_a5').val("");
			$('#q11_a6').val("");
        }
    
    
       var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption4  = document.getElementById('q12_a1');
        selectOption4 = selectOption4.options[selectOption4.selectedIndex].value;


        var selectOption5  = document.getElementById('q12_a2');
        selectOption5 = selectOption5.options[selectOption5.selectedIndex].value;


        var selectOption6  = document.getElementById('q12_a3');
        selectOption6 = selectOption6.options[selectOption6.selectedIndex].value;

		if(selectOption4 == "Y" || selectOption5 == "Y"  ){
            $('#q12_a4').attr('readonly',false);
            $('#q12_a5').attr('readonly',false);
            $('#q12_a6').attr('readonly',false);
			$('#q12_a7').attr('readonly',false);
            $('#q12_a8').attr('readonly',false);
            $('#q12_a9').attr('readonly',false);
       
        }
        
        else{
            $('#q12_a4').attr('readonly',true);
			$('#q12_a5').attr('readonly',true);
			$('#q12_a6').attr('readonly',true);
			$('#q12_a7').attr('readonly',true);
            $('#q12_a8').attr('readonly',true);
            $('#q12_a9').attr('readonly',true);
			$('#q12_a4').val("");
			$('#q12_a5').val("");
			$('#q12_a6').val("");
			$('#q12_a7').val("");
			$('#q12_a8').val("");
			$('#q12_a9').val("");
        }
       
        var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption7  = document.getElementById('q13_a1');
        selectOption7 = selectOption7.options[selectOption7.selectedIndex].value;


        var selectOption8  = document.getElementById('q13_a2');
        selectOption8 = selectOption8.options[selectOption8.selectedIndex].value;


        var selectOption9  = document.getElementById('q13_a3');
        selectOption9 = selectOption9.options[selectOption9.selectedIndex].value;

        if(selectOption7 == "Y" || selectOption8 == "Y" ){
            $('#q13_a4').attr('readonly',false);
            $('#q13_a5').attr('readonly',false);
            $('#q13_a6').attr('readonly',false);

        }    

        else{
			$('#q13_a4').attr('readonly',true);
			$('#q13_a5').attr('readonly',true);
			$('#q13_a6').attr('readonly',true);
			$('#q13_a4').val("");
			$('#q13_a5').val("");
			$('#q13_a6').val("");
        }
       
        var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption10  = document.getElementById('q14_a1');
        selectOption10 = selectOption10.options[selectOption10.selectedIndex].value;


        var selectOption11  = document.getElementById('q14_a2');
        selectOption11 = selectOption11.options[selectOption11.selectedIndex].value;


        var selectOption12  = document.getElementById('q14_a3');
        selectOption12 = selectOption12.options[selectOption12.selectedIndex].value;

        if(selectOption10 == "Y" || selectOption11 == "Y" ){
            $('#q14_a4').attr('readonly',false);
            $('#q14_a5').attr('readonly',false);
            $('#q14_a6').attr('readonly',false);

        }    

        else{
			$('#q14_a4').attr('readonly',true);
			$('#q14_a5').attr('readonly',true);
			$('#q14_a6').attr('readonly',true);
			$('#q14_a4').val("");
			$('#q14_a5').val("");
			$('#q14_a6').val("");
        }

        var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption13  = document.getElementById('q15_a1');
        selectOption13 = selectOption13.options[selectOption13.selectedIndex].value;


        var selectOption14  = document.getElementById('q15_a2');
        selectOption14 = selectOption14.options[selectOption14.selectedIndex].value;


        var selectOption15  = document.getElementById('q15_a3');
        selectOption15 = selectOption15.options[selectOption15.selectedIndex].value;


        if(selectOption13 == "Y" || selectOption14 == "Y" ){
            $('#q15_a4').attr('readonly',false);
            $('#q15_a5').attr('readonly',false);
            $('#q15_a6').attr('readonly',false);

        }    

        else{
			$('#q15_a4').attr('readonly',true);
			$('#q15_a5').attr('readonly',true);
			$('#q15_a6').attr('readonly',true);
			$('#q15_a4').val("");
			$('#q15_a5').val("");
			$('#q15_a6').val("");
        }
       

      
		var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption16  = document.getElementById('q16_a1');
        selectOption16 = selectOption16.options[selectOption16.selectedIndex].value;


        var selectOption17  = document.getElementById('q16_a2');
        selectOption17 = selectOption17.options[selectOption17.selectedIndex].value;


        var selectOption18  = document.getElementById('q16_a3');
        selectOption18 = selectOption18.options[selectOption18.selectedIndex].value;

        if(selectOption16 == "Y" || selectOption17 == "Y" ){
			$('#q16_a4').attr('readonly',false);
            $('#q16_a5').attr('readonly',false);
            $('#q16_a6').attr('readonly',false);
        }     
		
        else{
			$('#q16_a4').attr('readonly',true);
			$('#q16_a5').attr('readonly',true);
			$('#q16_a6').attr('readonly',true);
			$('#q16_a4').val("");
			$('#q16_a5').val("");
			$('#q16_a6').val("");
        }

		var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption19  = document.getElementById('q17_a1');
        selectOption19 = selectOption19.options[selectOption19.selectedIndex].value;


        var selectOption20  = document.getElementById('q17_a2');
        selectOption20 = selectOption20.options[selectOption20.selectedIndex].value;


        var selectOption21  = document.getElementById('q17_a3');
        selectOption21 = selectOption21.options[selectOption21.selectedIndex].value;

        if(selectOption19 == "Y" || selectOption20 == "Y" ){
			$('#q17_a4').attr('readonly',false);
            $('#q17_a5').attr('readonly',false);
            $('#q17_a6').attr('readonly',false);
        }     
		
        else{
			$('#q17_a4').attr('readonly',true);
			$('#q17_a5').attr('readonly',true);
			$('#q17_a6').attr('readonly',true);
			$('#q17_a4').val("");
			$('#q17_a5').val("");
			$('#q17_a6').val("");
        }

		var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption22  = document.getElementById('q18_a1');
        selectOption22 = selectOption22.options[selectOption22.selectedIndex].value;


        var selectOption23  = document.getElementById('q18_a2');
        selectOption23 = selectOption23.options[selectOption23.selectedIndex].value;


        var selectOption24  = document.getElementById('q18_a3');
        selectOption24 = selectOption24.options[selectOption24.selectedIndex].value;

        if(selectOption22 == "Y" || selectOption23 == "Y" ){
			$('#q18_a4').attr('readonly',false);
            $('#q18_a5').attr('readonly',false);
            $('#q18_a6').attr('readonly',false);
        }     
		
        else{
			$('#q18_a4').attr('readonly',true);
			$('#q18_a5').attr('readonly',true);
			$('#q18_a6').attr('readonly',true);
			$('#q18_a4').val("");
			$('#q18_a5').val("");
			$('#q18_a6').val("");
        }

		var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption25  = document.getElementById('q19_a1');
        selectOption25 = selectOption25.options[selectOption25.selectedIndex].value;


        var selectOption26  = document.getElementById('q19_a2');
        selectOption26 = selectOption26.options[selectOption26.selectedIndex].value;


        var selectOption27  = document.getElementById('q19_a3');
        selectOption27 = selectOption27.options[selectOption27.selectedIndex].value;

        if(selectOption25 == "Y" || selectOption26 == "Y" ){
			$('#q19_a4').attr('readonly',false);
            $('#q19_a5').attr('readonly',false);
            $('#q19_a6').attr('readonly',false);
        }     
		
        else{
			$('#q19_a4').attr('readonly',true);
			$('#q19_a5').attr('readonly',true);
			$('#q19_a6').attr('readonly',true);
			$('#q19_a4').val("");
			$('#q19_a5').val("");
			$('#q19_a6').val("");
        }

		var answer = target.options[target.selectedIndex].text;
        $('input[name=note'+num+']').attr('value',answer);

        var selectOption28  = document.getElementById('q20_a1');
        selectOption28 = selectOption28.options[selectOption28.selectedIndex].value;


        var selectOption29  = document.getElementById('q20_a2');
        selectOption29 = selectOption29.options[selectOption29.selectedIndex].value;


        var selectOption30  = document.getElementById('q20_a3');
        selectOption30 = selectOption30.options[selectOption30.selectedIndex].value;

        if(selectOption28 == "Y" || selectOption29 == "Y" ){
            $('#q20_a4').attr('readonly',false);
            $('#q20_a5').attr('readonly',false);
            $('#q20_a6').attr('readonly',false);
        }     
		
        else{
			$('#q20_a4').attr('readonly',true);
			$('#q20_a5').attr('readonly',true);
			$('#q20_a6').attr('readonly',true);
			$('#q20_a4').val("");
			$('#q20_a5').val("");
			$('#q20_a6').val("");
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


	if($("#r01_09").val().trim()==""){
		alert("이니셔티브 연계 문항을 선택해주세요.");
		$("#r01_09").focus();
		return false;
	}

	if($("#r02_09").val().trim()==""){
		alert("이니셔티브 연계 문항을 선택해주세요.");
		$("#r02_09").focus();
		return false;
	}

	if($("#r03_09").val().trim()==""){
		alert("이니셔티브 연계 문항을 선택해주세요.");
		$("#r03_09").focus();
		return false;
	}


	if($("#r01_10").val().trim()==""){
		alert("기후변화 관련 이사회 및 경영진 책임 문항을 선택해주세요.");
		$("#r01_10").focus();
		return false;
	}

	if($("#r02_10").val().trim()==""){
		alert("기후변화 관련 이사회 및 경영진 책임 문항을 선택해주세요.");
		$("#r02_10").focus();
		return false;
	}

	if($("#r03_10").val().trim()==""){
		alert("기후변화 관련 이사회 및 경영진 책임 문항을 선택해주세요.");
		$("#r03_10").focus();
		return false;
	}


	if($("#q11_a1").val().trim()==""){
		alert("Scope1 + Scope2 배출량 문항을 선택해주세요");
		$("#q11_a1").focus();
		return false;
	}


	if($("#q11_a2").val().trim()==""){
		alert("Scope1 + Scope2 배출량 문항을 선택해주세요");
		$("#q11_a2").focus();
		return false;
	}


	if($("#q11_a3").val().trim()==""){
		alert("Scope1 + Scope2 배출량 문항을 선택해주세요");
		$("#q11_a3").focus();
		return false;
	}

	var reg = /^[-|+]?\d+\.?\d*$/; 
   	if($("#q11_a1").val()=="Y" || $("#q11_a2").val()=="Y"){             
		if($("#q11_a4").val().trim()==""){
			alert("Scope1 + Scope2 배출량 문항을 입력해주세요");
			$("#q11_a4").focus();
			return false;
		}    

		if(!reg.test($("#q11_a4").val())){
			alert('Scope1 + Scope2 배출량 숫자만 입력해주세요.');
			$("#q11_a4").focus();
			return false;
		}
	
		
		if($("#q11_a5").val().trim()==""){
			alert("Scope1 + Scope2 배출량 문항을 입력해주세요");
			$("#q11_a5").focus();
			return false;
		}   

		if(!reg.test($("#q11_a5").val())){
			alert('Scope1 + Scope2 배출량 숫자만 입력해주세요.');
			$("#q11_a5").focus();
			return false;
		}

		if($("#q11_a6").val().trim()==""){
			alert("Scope1 + Scope2 배출량 문항을 입력해주세요");
			$("#q11_a6").focus();
			return false;
		}   
																																						
		if(!reg.test($("#q11_a6").val())){
			alert('Scope1 + Scope2 배출량 숫자만 입력해주세요.');
			$("#q11_a6").focus();
			return false;
		}
	}

	if($("#q24_a1").val().trim()==""){
		alert("Scope3 배출량 문항을 선택해주세요");
		$("#q24_a1").focus();
		return false;
	}


	if($("#q24_a2").val().trim()==""){
		alert("Scope3 배출량 문항을 선택해주세요");
		$("#q24_a2").focus();
		return false;
	}


	if($("#q24_a3").val().trim()==""){
		alert("Scope3 배출량 문항을 선택해주세요");
		$("#q24_a3").focus();
		return false;
	}

	if($("#q12_a1").val().trim()==""){
		alert("에너지 사용 절감량(율) 문항을 선택해주세요");
		$("#q12_a1").focus();
		return false;
	}


	if($("#q12_a2").val().trim()==""){
		alert("에너지 사용 절감량(율) 문항을 선택해주세요");
		$("#q12_a2").focus();
		return false;
	}


	if($("#q12_a3").val().trim()==""){
		alert("에너지 사용 절감량(율) 문항을 선택해주세요");
		$("#q12_a3").focus();
		return false;
	}

	var reg = /^[-|+]?\d+\.?\d*$/;   
	if($("#q12_a1").val()=="Y" || $("#q12_a2").val()=="Y"){               
		if($("#q12_a4").val().trim()==""){
			alert("에너지 사용 절감량(율) 문항을 입력해주세요");
			$("#q12_a4").focus();
			return false;
		}    

		if(!reg.test($("#q12_a4").val())){
			alert('에너지 사용 절감량(율) 숫자만 입력해주세요.');
			$("#q12_a4").focus();
			return false;
		}

			
		if($("#q12_a5").val().trim()==""){
			alert("에너지 사용 절감량(율) 문항을 입력해주세요");
			$("#q12_a5").focus();
			return false;
		}   

		if(!reg.test($("#q12_a5").val())){
			alert('에너지 사용 절감량(율) 숫자만 입력해주세요.');
			$("#q12_a5").focus();
			return false;
		}

		if($("#q12_a6").val().trim()==""){
			alert("에너지 사용 절감량(율) 문항을 입력해주세요");
			$("#q12_a6").focus();
			return false;
		}   
																																						
		if(!reg.test($("#q12_a6").val())){
			alert('에너지 사용 절감량(율) 숫자만 입력해주세요.');
			$("#q12_a6").focus();
			return false;
		}
	}

	if($("#q12_a1").val()=="Y" || $("#q12_a2").val()=="Y"){  
	if($("#q12_a7").val().trim()==""){
		alert("에너지 사용 절감량(율) 문항을 입력해주세요");
		$("#q12_a7").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q12_a7").val())){
		alert('에너지 사용 절감량(율) 숫자만 입력해주세요.');
		$("#q12_a7").focus();
		return false;
	}

	if($("#q12_a8").val().trim()==""){
		alert("에너지 사용 절감량(율) 문항을 입력해주세요");
		$("#q12_a8").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q12_a8").val())){
		alert('에너지 사용 절감량(율) 숫자만 입력해주세요.');
		$("#q12_a8").focus();
		return false;
	}

	if($("#q12_a9").val().trim()==""){
		alert("에너지 사용 절감량(율) 문항을 입력해주세요");
		$("#q12_a9").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q12_a9").val())){
		alert('에너지 사용 절감량(율) 숫자만 입력해주세요.');
		$("#q12_a9").focus();
		return false;
	}
}
	if($("#q13_a1").val()=="Y" || $("#q13_a2").val()=="Y"){  
	if($("#q13_a1").val().trim()==""){
		alert("신·재생에너지 사용량(율) 문항을 선택해주세요");
		$("#q13_a1").focus();
		return false;
	}


	if($("#q13_a2").val().trim()==""){
		alert("신·재생에너지 사용량(율) 문항을 선택해주세요");
		$("#q13_a2").focus();
		return false;
	}


	if($("#q13_a3").val().trim()==""){
		alert("신·재생에너지 사용량(율) 문항을 선택해주세요");
		$("#q13_a3").focus();
		return false;
	}

	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q13_a4").val().trim()==""){
		alert("신·재생에너지 사용량(율) 문항을 입력해주세요");
		$("#q13_a4").focus();
		return false;
	}    

	if(!reg.test($("#q13_a4").val())){
		alert('신·재생에너지 사용량(율) 숫자만 입력해주세요.');
		$("#q13_a4").focus();
		return false;
	}

		
	if($("#q13_a5").val().trim()==""){
		alert("신·재생에너지 사용량(율) 문항을 입력해주세요");
		$("#q13_a5").focus();
		return false;
	}   

	if(!reg.test($("#q13_a5").val())){
		alert('신·재생에너지 사용량(율) 숫자만 입력해주세요.');
		$("#q13_a5").focus();
		return false;
	}

	if($("#q13_a6").val().trim()==""){
		alert("신·재생에너지 사용량(율) 문항을 입력해주세요");
		$("#q13_a6").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q13_a6").val())){
		alert('신·재생에너지 사용량(율) 숫자만 입력해주세요.');
		$("#q13_a6").focus();
		return false;
	}
}

	
	if($("#q14_a1").val().trim()==""){
		alert("총 원∙부자재 구매액 대비 녹색자재 구매액 문항을 선택해주세요");
		$("#q14_a1").focus();
		return false;
	}


	if($("#q14_a2").val().trim()==""){
		alert("총 원∙부자재 구매액 대비 녹색자재 구매액 문항을 선택해주세요");
		$("#q14_a2").focus();
		return false;
	}


	if($("#q14_a3").val().trim()==""){
		alert("총 원∙부자재 구매액 대비 녹색자재 구매액 문항을 선택해주세요");
		$("#q14_a3").focus();
		return false;
	}

	if($("#q14_a1").val()=="Y" || $("#q14_a2").val()=="Y"){  
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q14_a4").val().trim()==""){
		alert("총 원∙부자재 구매액 대비 녹색자재 구매액 문항을 입력해주세요");
		$("#q14_a4").focus();
		return false;
	}    

	if(!reg.test($("#q14_a4").val())){
		alert('총 원∙부자재 구매액 대비 녹색자재 구매액 숫자만 입력해주세요.');
		$("#q14_a4").focus();
		return false;
	}

		
	if($("#q14_a5").val().trim()==""){
		alert("신총 원∙부자재 구매액 대비 녹색자재 구매액 문항을 입력해주세요");
		$("#q14_a5").focus();
		return false;
	}   

	if(!reg.test($("#q14_a5").val())){
		alert('총 원∙부자재 구매액 대비 녹색자재 구매액 숫자만 입력해주세요.');
		$("#q14_a5").focus();
		return false;
	}

	if($("#q14_a6").val().trim()==""){
		alert("총 원∙부자재 구매액 대비 녹색자재 구매액 문항을 입력해주세요");
		$("#q14_a6").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q14_a6").val())){
		alert('총 원∙부자재 구매액 대비 녹색자재 구매액 숫자만 입력해주세요.');
		$("#q14_a6").focus();
		return false;
	}
}


	if($("#q15_a1").val().trim()==""){
		alert("용수 사용량 문항을 선택해주세요");
		$("#q15_a1").focus();
		return false;
	}


	if($("#q15_a2").val().trim()==""){
		alert("용수 사용량 문항을 선택해주세요");
		$("#q15_a2").focus();
		return false;
	}


	if($("#q15_a3").val().trim()==""){
		alert("용수 사용량 문항을 선택해주세요");
		$("#q15_a3").focus();
		return false;
	}

	if($("#q15_a1").val()=="Y" || $("#q15_a2").val()=="Y"){  
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q15_a4").val().trim()==""){
		alert("용수 사용량 문항을 입력해주세요");
		$("#q15_a4").focus();
		return false;
	}    

	if(!reg.test($("#q15_a4").val())){
		alert('용수 사용량 숫자만 입력해주세요.');
		$("#q15_a4").focus();
		return false;
	}

		
	if($("#q15_a5").val().trim()==""){
		alert("용수 사용량 문항을 입력해주세요");
		$("#q15_a5").focus();
		return false;
	}   

	if(!reg.test($("#q15_a5").val())){
		alert('용수 사용량 숫자만 입력해주세요.');
		$("#q15_a5").focus();
		return false;
	}

	if($("#q15_a6").val().trim()==""){
		alert("용수 사용량 문항을 입력해주세요");
		$("#q15_a6").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q15_a6").val())){
		alert('용수 사용량 숫자만 입력해주세요.');
		$("#q15_a6").focus();
		return false;
	}
}

	if($("#q16_a1").val().trim()==""){
		alert("용수 재사용량 문항을 선택해주세요");
		$("#q16_a1").focus();
		return false;
	}


	if($("#q16_a2").val().trim()==""){
		alert("용수 재사용량 문항을 선택해주세요");
		$("#q16_a2").focus();
		return false;
	}


	if($("#q16_a3").val().trim()==""){
		alert("용수 재사용량 문항을 선택해주세요");
		$("#q16_a3").focus();
		return false;
	}

	if($("#q16_a1").val()=="Y" || $("#q16_a2").val()=="Y"){  
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q16_a4").val().trim()==""){
		alert("용수 재사용량 문항을 입력해주세요");
		$("#q16_a4").focus();
		return false;
	}    

	if(!reg.test($("#q16_a4").val())){
		alert('용수 재사용량 숫자만 입력해주세요.');
		$("#q16_a4").focus();
		return false;
	}

		
	if($("#q16_a5").val().trim()==""){
		alert("용수 재사용량 문항을 입력해주세요");
		$("#q16_a5").focus();
		return false;
	}   

	if(!reg.test($("#q16_a5").val())){
		alert('용수 재사용량 숫자만 입력해주세요.');
		$("#q16_a5").focus();
		return false;
	}

	if($("#q16_a6").val().trim()==""){
		alert("용수 재사용량 문항을 입력해주세요");
		$("#q16_a6").focus();
		return false;
	}
	
	if(!reg.test($("#q16_a6").val())){
		alert('용수 재사용량 숫자만 입력해주세요.');
		$("#q16_a6").focus();
		return false;
	}
}

	if($("#q17_a1").val().trim()==""){
		alert("폐기물 배출량 문항을 선택해주세요");
		$("#q17_a1").focus();
		return false;
	}


	if($("#q17_a2").val().trim()==""){
		alert("폐기물 배출량 문항을 선택해주세요");
		$("#q17_a2").focus();
		return false;
	}


	if($("#q17_a3").val().trim()==""){
		alert("폐기물 배출량 문항을 선택해주세요");
		$("#q17_a3").focus();
		return false;
	}

	if($("#q17_a1").val()=="Y" || $("#q17_a2").val()=="Y"){  
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q17_a4").val().trim()==""){
		alert("폐기물 배출량 문항을 입력해주세요");
		$("#q17_a4").focus();
		return false;
	}    

	if(!reg.test($("#q17_a4").val())){
		alert('폐기물 배출량 숫자만 입력해주세요.');
		$("#q17_a4").focus();
		return false;
	}

		
	if($("#q17_a5").val().trim()==""){
		alert("폐기물 배출량 문항을 입력해주세요");
		$("#q17_a5").focus();
		return false;
	}   

	if(!reg.test($("#q17_a5").val())){
		alert('폐기물 배출량 숫자만 입력해주세요.');
		$("#q17_a5").focus();
		return false;
	}

	if($("#q17_a6").val().trim()==""){
		alert("폐기물 배출량 문항을 입력해주세요");
		$("#q17_a6").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q17_a6").val())){
		alert('폐기물 배출량 숫자만 입력해주세요.');
		$("#q17_a6").focus();
		return false;
	}
}

	if($("#q18_a1").val().trim()==""){
		alert("폐기물 재활용량 문항을 선택해주세요");
		$("#q18_a1").focus();
		return false;
	}


	if($("#q18_a2").val().trim()==""){
		alert("폐기물 재활용량 문항을 선택해주세요");
		$("#q18_a2").focus();
		return false;
	}


	if($("#q18_a3").val().trim()==""){
		alert("폐기물 재활용량 문항을 선택해주세요");
		$("#q18_a3").focus();
		return false;
	}

	if($("#q18_a1").val()=="Y" || $("#q18_a2").val()=="Y"){  
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q18_a4").val().trim()==""){
		alert("폐기물 재활용량 문항을 입력해주세요");
		$("#q18_a4").focus();
		return false;
	}    

	if(!reg.test($("#q18_a4").val())){
		alert('폐기물 재활용량 숫자만 입력해주세요.');
		$("#q18_a4").focus();
		return false;
	}

		
	if($("#q18_a5").val().trim()==""){
		alert("폐기물 재활용량 문항을 입력해주세요");
		$("#q18_a5").focus();
		return false;
	}   

	if(!reg.test($("#q18_a5").val())){
		alert('폐기물 재활용량 숫자만 입력해주세요.');
		$("#q18_a5").focus();
		return false;
	}

	if($("#q18_a6").val().trim()==""){
		alert("폐기물 재활용량 문항을 입력해주세요");
		$("#q18_a6").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q18_a6").val())){
		alert('폐기물 재활용량 숫자만 입력해주세요.');
		$("#q18_a6").focus();
		return false;
	}
}
	if($("#q19_a1").val().trim()==""){
		alert("대기오염물질 배출 총량 문항을 선택해주세요");
		$("#q19_a1").focus();
		return false;
	}


	if($("#q19_a2").val().trim()==""){
		alert("대기오염물질 배출 총량 문항을 선택해주세요");
		$("#q19_a2").focus();
		return false;
	}


	if($("#q19_a3").val().trim()==""){
		alert("대기오염물질 배출 총량 문항을 선택해주세요");
		$("#q19_a3").focus();
		return false;
	}

	if($("#q19_a1").val()=="Y" || $("#q19_a2").val()=="Y"){  
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q19_a4").val().trim()==""){
		alert("대기오염물질 배출 총량 문항을 입력해주세요");
		$("#q19_a4").focus();
		return false;
	}    

	if(!reg.test($("#q19_a4").val())){
		alert('대기오염물질 배출 총량을 숫자만 입력해주세요.');
		$("#q19_a4").focus();
		return false;
	}

		
	if($("#q19_a5").val().trim()==""){
		alert("대기오염물질 배출 총량 문항을 입력해주세요");
		$("#q19_a5").focus();
		return false;
	}   

	if(!reg.test($("#q19_a5").val())){
		alert('대기오염물질 배출 총량을 숫자만 입력해주세요.');
		$("#q19_a5").focus();
		return false;
	}

	if($("#q19_a6").val().trim()==""){
		alert("대기오염물질 배출 총량 문항을 입력해주세요");
		$("#q19_a6").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q19_a6").val())){
		alert('대기오염물질 배출 총량을 숫자만 입력해주세요.');
		$("#q19_a6").focus();
		return false;
	}
}
	if($("#q20_a1").val().trim()==""){
		alert("수질오염물질 배출 총량 문항을 선택해주세요");
		$("#q20_a1").focus();
		return false;
	}


	if($("#q20_a2").val().trim()==""){
		alert("수질오염물질 배출 총량 문항을 선택해주세요");
		$("#q20_a2").focus();
		return false;
	}


	if($("#q20_a3").val().trim()==""){
		alert("수질오염물질 배출 총량 문항을 선택해주세요");
		$("#q20_a3").focus();
		return false;
	}

	if($("#q20_a1").val()=="Y" || $("#q20_a2").val()=="Y"){  
	var reg = /^[-|+]?\d+\.?\d*$/;                
	if($("#q20_a4").val().trim()==""){
		alert("수질오염물질 배출 총량 문항을 입력해주세요");
		$("#q20_a4").focus();
		return false;
	}    

	if(!reg.test($("#q20_a4").val())){
		alert('수질오염물질 배출 총량을 숫자만 입력해주세요.');
		$("#q20_a4").focus();
		return false;
	}

		
	if($("#q20_a5").val().trim()==""){
		alert("수질오염물질 배출 총량 문항을 입력해주세요");
		$("#q20_a5").focus();
		return false;
	}   

	if(!reg.test($("#q20_a5").val())){
		alert('수질오염물질 배출 총량을 숫자만 입력해주세요.');
		$("#q20_a5").focus();
		return false;
	}

	if($("#q20_a6").val().trim()==""){
		alert("수질오염물질 배출 총량 문항을 입력해주세요");
		$("#q20_a6").focus();
		return false;
	}   
																																					
	if(!reg.test($("#q20_a6").val())){
		alert('수질오염물질 배출 총량을 숫자만 입력해주세요.');
		$("#q20_a6").focus();
		return false;
	}
}
	if($('input[name=answr21]:radio:checked').length < 1){
		alert("ISO14001 등 국제적 환경경영시스템 표준 또는 이에 준하는 인증을 획득하였습니까? 문항을 체크해주세요.");
		$('input[name=answr21]:radio').focus();
		return false;
	}

	if($('input[name=answr22]:radio:checked').length < 1){
		alert("사업장 활동에 요구되는 환경 인허가, 라이선스 등록이 모두 구비되어 있고 유효합니까? 문항을 체크해주세요.");
		$('input[name=answr22]:radio').focus();
		return false;
	}

	if($('input[name=answr23]:radio:checked').length < 1){
		alert("수질오염물질 배출 환경 검사 보고서(오염물질 배출, 소음진동 자가 측정 기록부)가 구비되어 있고 인허가/라이선스 조건을 충족시킵니까? 문항을 체크해주세요.");
		$('input[name=answr23]:radio').focus();
		return false;
	}

	if($("#q25_a1").val().trim()==""){
		alert("기후변화 위험 식별 프로세스 문항을 선택해주세요");
		$("#q25_a1").focus();
		return false;
	}


	if($("#q25_a2").val().trim()==""){
		alert("기후변화 위험 식별 프로세스 문항을 선택해주세요");
		$("#q25_a2").focus();
		return false;
	}


	if($("#q25_a3").val().trim()==""){
		alert("기후변화 위험 식별 프로세스 문항을 선택해주세요");
		$("#q25_a3").focus();
		return false;
	}

	if($('input[name=answr26]:radio:checked').length < 1){
		alert("조직 리스크 관리와의 통합 여부 문항을 선택해주세요.");
		$('input[name=answr26]:radio').focus();
		return false;
	}
	
	frm.submit();
}
	
	
</script>
</html>
