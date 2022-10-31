<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 1;

$member_id = $_SESSION['mb_id'];
$query = "	SELECT
			ESM_IDX,
            ANSWER_CD AS ANSWR,
            ANSWER_CONT AS CONT,
            ANSWER_NOTE AS NOTE
        FROM
            ESG_ANSWER
        WHERE REG_ID = '".$member_id."'
        AND QUES_PHASE = '1'
		ORDER BY REG_DATE DESC, QUES_NUM
		LIMIT 12";

$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow+1; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}
    $answr0 = $row[0]["ANSWR"];
	$answr1 = $row[1]["ANSWR"];
	$answr2 = $row[2]["CONT"];
	$answr2Arr = explode('|', $answr2);
	$answr3 = $row[3]["ANSWR"];
	$answr4 = $row[4]["ANSWR"];
	$answr5 = $row[5]["CONT"];
	//$answr5Arr = explode('|', $answr5);
	$answr6 = $row[6]["ANSWR"];
	$answr7 = $row[7]["ANSWR"];
	$answr8 = $row[8]["ANSWR"];
	$answr9 = $row[9]["ANSWR"];
	$answr10 = $row[10]["ANSWR"];
	$answr11 = $row[11]["ANSWR"];
	$answr11Arr = explode('|', $answr11);

    $note0 = $row[0]["CONT"];
	$note1 = $row[1]["CONT"];
	$note3 = $row[3]["CONT"];
	$note4 = $row[4]["CONT"];
	$note6 = $row[6]["CONT"];
	$note7 = $row[7]["CONT"];
	$note8 = $row[8]["CONT"];
	$note9 = $row[9]["CONT"];
	$note10 = $row[10]["CONT"];
	$note11 = $row[11]["CONT"];
	$note11Arr = explode('|', $note11);
}
?>
<!doctype html>
<html lang="ko">
<?php include "./_inc/title.php"; ?>
<body id="survey" style="min-width:1300px;">
	<?php include "./_inc/menu.php"; ?>

	<div class="contents">
		<form name="frm" id="frm" action="survey/survey01_proc.php" method="post">
		<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["ESM_IDX"];?>">
		<p class="tit">1.일반사항</p>

        <p class="Q c01"><span class="c01">일반</span><span class="txt">1. 귀사는 기업 분류 상 중소/중견/대기업 중 어느 군에 속해 있습니까?<span></p>
			<input type="hidden" id="i_num0" name="inum0" value="HTE-G-00">
			<input type="hidden" id="note_0" name="note0" value="<?php echo $note0 ?>">
			<div class="A float a01">
			<input type="radio" id="q0_a1" name="answr0" onclick="answerChk(this,0);" value="A" <?if($answr0 == "A"){?>checked<?}?>><label for="q0_a1">중소기업</label>
			<input type="radio" id="q0_a2" name="answr0" onclick="answerChk(this,0);" value="B" <?if($answr0 == "B"){?>checked<?}?>><label for="q0_a2">중견기업</label>
			<input type="radio" id="q0_a3" name="answr0" onclick="answerChk(this,0);" value="C" <?if($answr0 == "C"){?>checked<?}?>><label for="q0_a3">대기업</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">2. 총 임직원 수는 몇 명입니까? (2021년 말 기준)<span></p>
			<input type="hidden" id="i_num1" name="inum1" value="HTE-G-01">
			<input type="hidden" id="note_1" name="note1" value="<?php echo $note1 ?>">
			<div class="A float a01">
			<input type="radio" id="q1_a1" name="answr1" onclick="answerChk(this,1);" value="A" <?if($answr1 == "A"){?>checked<?}?>><label for="q1_a1">1~100명</label>
			<input type="radio" id="q1_a2" name="answr1" onclick="answerChk(this,1);" value="B" <?if($answr1 == "B"){?>checked<?}?>><label for="q1_a2">100~200명</label>
			<input type="radio" id="q1_a3" name="answr1" onclick="answerChk(this,1);" value="C" <?if($answr1 == "C"){?>checked<?}?>><label for="q1_a3">200~300명</label>
			<input type="radio" id="q1_a4" name="answr1" onclick="answerChk(this,1);" value="D" <?if($answr1 == "D"){?>checked<?}?>><label for="q1_a4">300~400명</label>
			<input type="radio" id="q1_a5" name="answr1" onclick="answerChk(this,1);" value="E" <?if($answr1 == "E"){?>checked<?}?>><label for="q1_a5">400~500명</label>
            <input type="radio" id="q1_a6" name="answr1" onclick="answerChk(this,1);" value="F" <?if($answr1 == "F"){?>checked<?}?>><label for="q1_a6">500명 이상</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">3. 총 매출액은 얼마입니까?<span></p>
			<input type="hidden" id="i_num2" name="inum2" value="HTE-G-02">
			<input type="hidden" id="note_2" name="note2" value="2019|2020|2021">
			<div class="A float a01">
			<div class="sample">외부공시 (사업보고서 기준) 3개년</br>외부 공시 없을 경우 회계장부 또는 부가가치세 신고∙납부 실적 등의 자료 기준 3개년 매출액</div><!-- 응답가이드 -->
			<p class="unit">단위:원</p>
			<table>
				<colgroup><col width="*"></colgroup><!-- 내용따라 넓이조정 -->
				<tr>
					<th>2019</th>
					<th>2020</th>
					<th>2021</th>
				</tr>
				<tr>
                    <td><input type="text" id="q2_a1" name="answr2_1" value="<?if($answr2Arr[0] != ""){echo $answr2Arr[0];}?>"/></td>
                    <td><input type="text" id="q2_a2" name="answr2_2" value="<?if($answr2Arr[1] != ""){echo $answr2Arr[1];}?>"/></td>
                    <td><input type="text" id="q2_a3" name="answr2_3" value="<?if($answr2Arr[2] != ""){echo $answr2Arr[2];}?>"/></td>
				</tr>
			</table>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">4. 한국표준산업분류 기준 어느 산업에 소속되어 있으십니까?</span></p>
		<input type="hidden" id="i_num3" name="inum3" value="HTE-G-03">
		<input type="hidden" id="note_3" name="note3" value="<?php echo $note3 ?>">
		<div class="A float a01">
			<input type="radio" id="q3_a1" name="answr3" onclick="answerChk(this,3);" value="A" <?if($answr3 == "A"){?>checked<?}?>><label for="q3_a1" >화학제조</label>
			<input type="radio" id="q3_a2" name="answr3" onclick="answerChk(this,3);" value="B" <?if($answr3 == "B"){?>checked<?}?>><label for="q3_a2" >건설</label>
			<input type="radio" id="q3_a3" name="answr3" onclick="answerChk(this,3);" value="C" <?if($answr3 == "C"){?>checked<?}?>><label for="q3_a3" >운송</label>
			<input type="radio" id="q3_a4" name="answr3" onclick="answerChk(this,3);" value="D" <?if($answr3 == "D"){?>checked<?}?>><label for="q3_a4" >기타</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">5. 한화토탈에너지스 외 타 기업으로부터 진단 요청을 받으신 적 있으십니까?</span></p>
		<input type="hidden" id="i_num4" name="inum4" value="HTE-G-04">
		<input type="hidden" id="note_4" name="note4" value="<?php echo $note4 ?>">
		<div class="A float a01">
			<input type="radio" id="q4_a1" name="answr4" onclick="answerChk(this,4);" value="Y" <?if($answr4 == "Y"){?>checked<?}?>><label for="q4_a1">예</label>
			<input type="radio" id="q4_a2" name="answr4" onclick="answerChk(this,4);" value="N" <?if($answr4 == "N"){?>checked<?}?>><label for="q4_a2">아니오</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">6. 진단 요청을 받은 횟수를 작성해주십시오.</span></p>
		<input type="hidden" id="i_num5" name="inum5" value="HTE-G-05">
		<input type="hidden" id="note_5" name="note5" value="요청횟수">
		<div class="A float a01">
			<table>
				<colgroup><col width="20%"><col width="*"></colgroup><!-- 내용따라 넓이조정 -->
				<tr>
					<th>요청횟수</th>
					<th><!--기업명--></th>
				</tr>
				<tr>
					<td><input type="text" id="q5_a1" name="answr5" value="<?echo $answr5?>" <?if($answr4== "N" || $answr4 == null){?>readonly<?}?>></td>
					<td><!--<input type="text">--></td>	
				</tr>
			</table>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">7. 귀사의 경영을 위해 ESG가 필요하다고 생각하십니까?</span></p>
		<input type="hidden" id="i_num6" name="inum6" value="HTE-G-06">
		<input type="hidden" id="note_6" name="note6" value="<?php echo $note6 ?>">
		<div class="A float a01">
			<input type="radio" id="q6_a1" name="answr6" onclick="answerChk(this,6);" value="A" <?if($answr6 == "A"){?>checked<?}?>><label for="q6_a1">매우 그렇다</label>
			<input type="radio" id="q6_a2" name="answr6" onclick="answerChk(this,6);" value="B" <?if($answr6 == "B"){?>checked<?}?>><label for="q6_a2">그렇다</label>
			<input type="radio" id="q6_a3" name="answr6" onclick="answerChk(this,6);" value="C" <?if($answr6 == "C"){?>checked<?}?>><label for="q6_a3">보통이다</label>
			<input type="radio" id="q6_a4" name="answr6" onclick="answerChk(this,6);" value="D" <?if($answr6 == "D"){?>checked<?}?>><label for="q6_a4">그렇지 않다</label>
			<input type="radio" id="q6_a5" name="answr6" onclick="answerChk(this,6);" value="E" <?if($answr6 == "E"){?>checked<?}?>><label for="q6_a5">매우 그렇지 않다</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">8. 귀사의 CEO(대표이사)의 ESG 필요성, 인지도 수준은 어느 정도이십니까?</span></p>
		<input type="hidden" id="i_num7" name="inum7" value="HTE-G-07">
		<input type="hidden" id="note_7" name="note7" value="<?php echo $note7 ?>">
		<div class="A float a01">
			<input type="radio" id="q7_a1" name="answr7" onclick="answerChk(this,7);" value="A" <?if($answr7 == "A"){?>checked<?}?>><label for="q7_a1">매우 높다</label>
			<input type="radio" id="q7_a2" name="answr7" onclick="answerChk(this,7);" value="B" <?if($answr7 == "B"){?>checked<?}?>><label for="q7_a2">높다</label>
			<input type="radio" id="q7_a3" name="answr7" onclick="answerChk(this,7);" value="C" <?if($answr7 == "C"){?>checked<?}?>><label for="q7_a3">보통이다</label>
			<input type="radio" id="q7_a4" name="answr7" onclick="answerChk(this,7);" value="D" <?if($answr7 == "D"){?>checked<?}?>><label for="q7_a4">낮다</label>
			<input type="radio" id="q7_a5" name="answr7" onclick="answerChk(this,7);" value="E" <?if($answr7 == "E"){?>checked<?}?>><label for="q7_a5">매우 낮다</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">9. 귀사의 임직원의 ESG에 대한 필요성, 인지도 수준은 어느 정도이십니까?</span></p>
		<input type="hidden" id="i_num8" name="inum8" value="HTE-G-08">
		<input type="hidden" id="note_8" name="note8" value="<?php echo $note8 ?>">
		<div class="A float a01">
			<input type="radio" id="q8_a1" name="answr8" onclick="answerChk(this,8);" value="A" <?if($answr8 == "A"){?>checked<?}?>><label for="q8_a1">매우 높다</label>
			<input type="radio" id="q8_a2" name="answr8" onclick="answerChk(this,8);" value="B" <?if($answr8 == "B"){?>checked<?}?>><label for="q8_a2">높다</label>
			<input type="radio" id="q8_a3" name="answr8" onclick="answerChk(this,8);" value="C" <?if($answr8 == "C"){?>checked<?}?>><label for="q8_a3">보통이다</label>
			<input type="radio" id="q8_a4" name="answr8" onclick="answerChk(this,8);" value="D" <?if($answr8 == "D"){?>checked<?}?>><label for="q8_a4">낮다</label>
			<input type="radio" id="q8_a5" name="answr8" onclick="answerChk(this,8);" value="E" <?if($answr8 == "E"){?>checked<?}?>><label for="q8_a5">매우 낮다</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">10. 향후 ESG경영 강화를 위한 프로그램에 적극 참여하실 의향이 있으십니까?</span></p>
		<input type="hidden" id="i_num9" name="inum9" value="HTE-G-09">
		<input type="hidden" id="note_9" name="note9" value="<?php echo $note9 ?>">
		<div class="A float a01">
			<input type="radio" id="q9_a1" name="answr9" onclick="answerChk(this,9);" value="A" <?if($answr9 == "A"){?>checked<?}?>><label for="q9_a1">매우 그렇다</label>
			<input type="radio" id="q9_a2" name="answr9" onclick="answerChk(this,9);" value="B" <?if($answr9 == "B"){?>checked<?}?>><label for="q9_a2">그렇다</label>
			<input type="radio" id="q9_a3" name="answr9" onclick="answerChk(this,9);" value="C" <?if($answr9 == "C"){?>checked<?}?>><label for="q9_a3">보통이다</label>
			<input type="radio" id="q9_a4" name="answr9" onclick="answerChk(this,9);" value="D" <?if($answr9 == "D"){?>checked<?}?>><label for="q9_a4">그렇지 않다</label>
			<input type="radio" id="q9_a5" name="answr9" onclick="answerChk(this,9);" value="E" <?if($answr9 == "E"){?>checked<?}?>><label for="q9_a5">매우 그렇지 않다</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">11. ESG경영이 기업의 비즈니스 운영에 영향을 미친다고 생각하십니까?</span></p>
		<input type="hidden" id="i_num10" name="inum10" value="HTE-G-10">
		<input type="hidden" id="note_10" name="note10" value="<?php echo $note10 ?>">
		<div class="A float a01">
			<input type="radio" id="q10_a1" name="answr10" onclick="answerChk(this,10);" value="A" <?if($answr10 == "A"){?>checked<?}?>><label for="q10_a1">매우 그렇다</label>
			<input type="radio" id="q10_a2" name="answr10" onclick="answerChk(this,10);" value="B" <?if($answr10 == "B"){?>checked<?}?>><label for="q10_a2">그렇다</label>
			<input type="radio" id="q10_a3" name="answr10" onclick="answerChk(this,10);" value="C" <?if($answr10 == "C"){?>checked<?}?>><label for="q10_a3">보통이다</label>
			<input type="radio" id="q10_a4" name="answr10" onclick="answerChk(this,10);" value="D" <?if($answr10 == "D"){?>checked<?}?>><label for="q10_a4">그렇지 않다</label>
			<input type="radio" id="q10_a5" name="answr10" onclick="answerChk(this,10);" value="E" <?if($answr10 == "E"){?>checked<?}?>><label for="q10_a5">매우 그렇지 않다</label>
		</div>

		<p class="Q c01"><span class="c01">일반</span><span class="txt">12. ESG경영을 위해 가장 중요한 요소가 무엇이라 생각하십니까? (1,2,3위 선택)</span></p>
		<div class="A float a01">
			<div class="sample">CEO 의지, 정부 정책 및 규제, 투자기관 및 투자자 요청, 고객사 요청, 실무자의 자발적 참여</div>
			<input type="hidden" id="i_num11" name="inum11" value="HTE-G-11">
            <input type="hidden" id="note_11" name="note11" value="1위|2위|3위">
			<input type="hidden" id="note_11_1" name="note11_1" value="<?php echo $note11Arr[0]?>">
			<input type="hidden" id="note_11_2" name="note11_2" value="<?php echo $note11Arr[1]?>">
			<input type="hidden" id="note_11_3" name="note11_3" value="<?php echo $note11Arr[2]?>">
			<table>
				<colgroup><col width="*"><col width="33%"><col width="33%"></colgroup><!-- 내용따라 넓이조정 -->
				<tr>
					<td>
						<select id="q11_a1" name="answr11_1" class="check11" onchange="showValue(this,'11_1')">
							<option value="">1위 선택</option>
							<option value="A" <?if($answr11Arr[0] == "A"){?>selected<?}?>>CEO 의지</option>
							<option value="B" <?if($answr11Arr[0] == "B"){?>selected<?}?>>정부 정책 및 규제</option>
							<option value="C" <?if($answr11Arr[0] == "C"){?>selected<?}?>>투자기관 및 투자자 요청</option>
							<option value="D" <?if($answr11Arr[0] == "D"){?>selected<?}?>>고객사 요청</option>
							<option value="E" <?if($answr11Arr[0] == "E"){?>selected<?}?>>실무자의 자발적 참여</option>
						</select>
					</td>
					<td>
						<select id="q11_a2" name="answr11_2" class="check11" onchange="showValue(this,'11_2')">
							<option value="">2위 선택</option>
							<option value="A" <?if($answr11Arr[1] == "A"){?>selected<?}?>>CEO 의지</option>
							<option value="B" <?if($answr11Arr[1] == "B"){?>selected<?}?>>정부 정책 및 규제</option>
							<option value="C" <?if($answr11Arr[1] == "C"){?>selected<?}?>>투자기관 및 투자자 요청</option>
							<option value="D" <?if($answr11Arr[1] == "D"){?>selected<?}?>>고객사 요청</option>
							<option value="E" <?if($answr11Arr[1] == "E"){?>selected<?}?>>실무자의 자발적 참여</option>
						</select>
					</td>
					<td>
						<select id="q11_a3" name="answr11_3" class="check11" onchange="showValue(this,'11_3')">
							<option value="">3위 선택</option>
							<option value="A" <?if($answr11Arr[2] == "A"){?>selected<?}?>>CEO 의지</option>
							<option value="B" <?if($answr11Arr[2] == "B"){?>selected<?}?>>정부 정책 및 규제</option>
							<option value="C" <?if($answr11Arr[2] == "C"){?>selected<?}?>>투자기관 및 투자자 요청</option>
							<option value="D" <?if($answr11Arr[2] == "D"){?>selected<?}?>>고객사 요청</option>
							<option value="E" <?if($answr11Arr[2] == "E"){?>selected<?}?>>실무자의 자발적 참여</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
		
		<p class="s_btn">
			<a href="guide.php" class="prev">이전단계</a>
			<a href="javascript:fn_submit();" class="next">다음단계</a>
			<input type="hidden" id="subMode" name="subMode" value="<?php echo $subMode;?>">
		</p>
		</form>
	</div>
</body>
<script language="javascript">

	<?if($subMode == "update"){?>
		$(document).ready(function(){
         	$("input[name='answr0']").attr('onclick',"alert('기업분류는 변경 할 수 없습니다. 관리자에게 문의해주세요.');return false;");
			$("input[name='answr3']").attr('onclick',"alert('산업군은 변경 할 수 없습니다. 관리자에게 문의해주세요.');return false;");
      	});
   	<?}?>

	function answerChk(obj,num){
		var nameTmp = $(obj).attr('name');
		if($(obj).prop('checked')){
			$('input[type="radio"][name="'+nameTmp+'"]').prop('checked',false);
			$(obj).prop('checked', true);
		}

		var idTmp = $(obj).attr('id');
		var checkedText=$("label[for='"+idTmp+"']").text();
		$('input[name=note'+num+']').attr('value',checkedText);

		if(idTmp=="q4_a1"){
			$('#q5_a1').removeProp('readonly');
		} else if(idTmp=="q4_a2"){
			$('#q5_a1').attr('readonly',true);
			$('#q5_a1').val("");
		}
	}

	function showValue(target,num){
		var answer = target.options[target.selectedIndex].text;
		var answerVal = target.options[target.selectedIndex].value;
		
		var selectOption1 = document.getElementById("q11_a1");
		var text1 = selectOption1.options[selectOption1.selectedIndex].text;
 		var value1 = selectOption1.options[selectOption1.selectedIndex].value;
		
		var selectOption2 = document.getElementById("q11_a2");
		var text2 = selectOption2.options[selectOption2.selectedIndex].text;
		var value2 = selectOption2.options[selectOption2.selectedIndex].value;
		
		var selectOption3 = document.getElementById("q11_a3");
		var text3 = selectOption3.options[selectOption3.selectedIndex].text;
		var value3 = selectOption3.options[selectOption3.selectedIndex].value;

		if(num == "11_1"){
			if(answer == text2 || answer == text3){
				alert("중복 선택 입니다.");
				$("#q11_a1").val("");
			} else {
				$('input[name=note'+num+']').attr('value',answer);
			}
		} 
		if(num == "11_2"){
			if(answer == text1 || answer == text3){
				alert("중복 선택 입니다.");
				$("#q11_a2").val("");
			} else {
				$('input[name=note'+num+']').attr('value',answer);
			}
		}
		if(num == "11_3"){
			if(answer == text1 || answer == text2){
				alert("중복 선택 입니다.");
				$("#q11_a3").val("");
			} else {
				$('input[name=note'+num+']').attr('value',answer);
			}
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
		
		if($row[0]["SUBMIT_YN"] != NULL && $row[0]["SUBMIT_YN"] == 'Y'){
		?>
			alert("최종 제출 완료되어 답변 수정이 불가합니다. 페이지 이동은 좌측 메뉴를 통해 가능합니다.");
			return false;
		<?}?>

		if($('input[name=answr1]:radio:checked').length < 1){
			alert("총 임직원 수는 몇 명입니까? 문항을 체크해주세요.");
			$('input[name=answr1]:radio').focus();
			return false;
		}

		var reg = /^[-|+]?\d+\.?\d*$/;
		var year = 2019;
		for(var i=1; i<4; i++){
			if($("#q2_a"+i).val().trim() == ""){
				alert(year+"년 매출액을 입력해주세요.");
				$("#q2_a"+i).focus();
				return false;
			}
			if(!reg.test($("#q2_a"+i).val())){
				alert(year+"년 매출액에 숫자만 입력해주세요.");
				$("#q2_a"+i).focus();
				return false;
			}
			year++;
		}

		if($('input[name=answr3]:radio:checked').length < 1){
			alert("한국표준산업분류 기준 어느 산업에 소속되어 있으십니까? 문항에 체크해주세요.");
			$('input[name=answr3]:radio').focus();
			return false;
		}

		if($('input[name=answr4]:radio:checked').length < 1){
			alert("한화토탈에너지스 외 타 기업으로부터 진단 요청을 받으신 적 있으십니까? 문항에 체크해주세요.");
			$('input[name=answr4]:radio').focus();
			return false;
		}


        if($("#q4_a1").is(':checked')){
			if($("#q5_a1").val().trim() == ""){
				alert("요청횟수를 입력해주세요.");
				$("#q5_a1").focus();
				return false;
			}

			if(!reg.test($("#q5_a1").val())){
				alert('요청횟수에 숫자만 입력해주세요.');
				$("q5_a1").focus();
				return false;
			}
        }

		if($('input[name=answr6]:radio:checked').length < 1){
			alert("귀사의 경영을 위해 ESG가 필요하다고 생각하십니까? 문항에 체크해주세요.");
			$('input[name=answr6]:radio').focus();
			return false;
		}

		if($('input[name=answr7]:radio:checked').length < 1){
			alert("귀사의 CEO(대표이사)의 ESG 필요성, 인지도 수준은 어느정도이십니까?  문항에 체크해주세요.");
			$('input[name=answr7]:radio').focus();
			return false;
		}

		if($('input[name=answr8]:radio:checked').length < 1){
			alert("귀사의 임직원의 ESG에 대한 필요성, 인지도 수준은 어느정도이십니까? 문항에 체크해주세요.");
			$('input[name=answr8]:radio').focus();
			return false;
		}

		if($('input[name=answr9]:radio:checked').length < 1){
			alert("향후 ESG경영 강화를 위한 프로그램에 적극 참여하실 의향이 있으십니까? 문항에 체크해주세요.");
			$('input[name=answr9]:radio').focus();
			return false;
		}

		if($('input[name=answr10]:radio:checked').length < 1){
			alert("ESG경영이 기업의 비즈니스 운영에 영향을 미친다고 생각하십니까? 문항에 체크해주세요.");
			$('input[name=answr10]:radio').focus();
			return false;
		}

		for(var i=1; i<4; i++){
			if($("#q11_a"+i).val().trim()==""){
	      alert("ESG경영을 위해 가장 중요한 요소가 무엇이라 생각하십니까? 문항을 선택해주세요.");
				$("#a11_a"+i).focus();
	      return false;
	    }
		}

    frm.submit();
	}

</script>
</html>
