<?php
include('_inc/inc.php');
include('_inc/db.php');

login_check();

$current = 8;

$member_id = $_SESSION['mb_id'];
$query = "SELECT 
			IDX 
		FROM 
			ESG_SURVEY_MASTER 
		WHERE REG_ID = '".$member_id."' 
		AND QUES_PHASE = '8' 
		AND SURVEY_NAME = '한화' 
		AND SURVEY_YEAR = 2022
		ORDER BY REG_DATE DESC";
$result = mysqli_query($dbconn, $query);

if(mysqli_num_rows($result)) {
	$subMode = "update";
	$numrow = mysqli_num_rows($result);

	for($i=0; $i<$numrow; $i++){
		$row[$i] = mysqli_fetch_array($result);
	}
}

?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="survey">
	<? include "./_inc/menu.php"; ?>

	<div class="contents">
		<p class="tit">3. 증빙자료제출</p>
		<div class="A">
			<div class="sample">한 문항에 첨부 가능한 파일 개수는 1개 입니다. 여러개 파일 업로드 필요 시 압축파일(zip)로 첨부 바랍니다.</div>
		</div>
		<form name="frm" id="frm" method="post" action="survey/survey08_proc.php" enctype="multipart/form-data">
		<input type="hidden" id="esmIdx" name="esmIdx" value="<? echo $row[0]["IDX"];?>">
		
		<? 
		$esmIdx = "SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '2' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022";
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CE-04'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer1 = $answerRow["ANSWER_CD"];
		if($answer1 != null && $answer1 != 'C'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CE-04' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file1id = $fileRow["FILE_ID"];
			$file1name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c02">환경</span><span class="txt">문서화된 환경정책 또는 환경방침을 보유하고 있습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num1" name="inum1" value="HTE-CE-04">
			<div class="sample">환경방침 자료 첨부</div>
			<div class="filebox">
			  <label for="file1">파일첨부</label>
			  <input type="file" id="file1" name="file1" class="upload-hidden">
				<input class="upload-name" id="fileName1" name="fileName1" value="파일선택" disabled="disabled">
				</input>
			</div>
			<a href="survey/download.php?file_id=<? echo $file1id; ?>" target="_blank" id="prevFile1"><? if($file1name != null){echo $file1name;}?></a>
		</div>
		<?}?>

		<? 
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CE-21'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer2 = $answerRow["ANSWER_CD"];
		if($answer2 != null && $answer2 != 'C'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CE-21' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file2id = $fileRow["FILE_ID"];
			$file2name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c02">환경</span><span class="txt">ISO14001 등 국제적 환경경영시스템 표준 또는 이에 준하는 인증을 획득하였습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num2" name="inum2" value="HTE-CE-21">
			<div class="sample">인증서 첨부</div>
			<div class="filebox">
			  <label for="file2">파일첨부</label>
				<input type="file" id="file2" name="file2" class="upload-hidden">
			  <input class="upload-name" id="fileName2" name="fileName2" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file2id; ?>" target="_blank" id="prevFile2"><? if($file2name != null){echo $file2name;}?></a>
		</div>
		<?}?>

		<? 
		$esmIdx = "SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '3' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022";
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CS-02'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer3 = $answerRow["ANSWER_CD"];
		if($answer3 != null && $answer3 != 'C'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CS-02' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file3id = $fileRow["FILE_ID"];
			$file3name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c03">사회</span><span class="txt">대외적으로 공개하는 안전보건 정책 또는 방침이 있습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num3" name="inum3" value="HTE-CS-02">
			<div class="sample">안전보건 정책 자료 첨부</div>
			<div class="filebox">
			  <label for="file3">파일첨부</label>
				<input type="file" id="file3" name="file3" class="upload-hidden">
			  <input class="upload-name" id="fileName3" name="fileName3" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file3id; ?>" target="_blank" id="prevFile3"><? if($file3name != null){echo $file3name;}?></a>
		</div>
		<?}?>

		<? 
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CS-03'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer4 = $answerRow["ANSWER_CD"];
		if($answer4 != null && $answer4 == 'Y'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CS-03' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file4id = $fileRow["FILE_ID"];
			$file4name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c03">사회</span><span class="txt">인권정책을 보유하고 있습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num4" name="inum4" value="HTE-CS-03">
			<div class="sample">인권정책 자료 첨부</div>
			<div class="filebox">
			  <label for="file4">파일첨부</label>
				<input type="file" id="file4" name="file4" class="upload-hidden">
			<input class="upload-name" id="fileName4" name="fileName4" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file4id; ?>" target="_blank" id="prevFile4"><? if($file4name != null){echo $file4name;}?></a>
		</div>
		<?}?>

		<? 
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CS-05'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer5 = $answerRow["ANSWER_CD"];
		if($answer5 != null && $answer5 == 'A'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CS-05' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file5id = $fileRow["FILE_ID"];
			$file5name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c03">사회</span><span class="txt">주 1회 휴무 보장을 위한 정책 및 방침이 확립되어 있습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num5" name="inum5" value="HTE-CS-05">
			<div class="sample">표준계약서, 근로계약서 등 관련내용 첨부</div>
			<div class="filebox">
			  <label for="file5">파일첨부</label>
				<input type="file" id="file5" name="file5" class="upload-hidden">
			  <input class="upload-name" id="fileName5" name="fileName5" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file5id; ?>" target="_blank" id="prevFile5"><? if($file5name != null){echo $file5name;}?></a>
		</div>
		<?}?>

		<? 
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CS-06'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer6 = $answerRow["ANSWER_CD"];
		if($answer6 != null && $answer6 != 'C'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CS-06' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file6id = $fileRow["FILE_ID"];
			$file6name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c03">사회</span><span class="txt">기본급, 상여급, 지원비, 초과근무 시간에 따른 수당 등 세전 급여에 대한 구체적 정보, 갑근세, 의료보험비, 기타 회비 등 공제액을 상세하게 구분한 급여명세서를 근로자에게 제공합니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num6" name="inum6" value="HTE-CS-06">
			<div class="sample">표준계약서, 근로계약서 등 관련내용 첨부</div>
			<div class="filebox">
			  <label for="file6">파일첨부</label>
				<input type="file" id="file6" name="file6" class="upload-hidden">
			  <input class="upload-name" id="fileName6" name="fileName6" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file6id; ?>" target="_blank" id="prevFile6"><? if($file6name != null){echo $file6name;}?></a>
		</div>
		<?}?>

		<? 
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CS-16'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer7 = $answerRow["ANSWER_CD"];
		if($answer7 != null && $answer7 != 'C'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CS-16' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file7id = $fileRow["FILE_ID"];
			$file7name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c03">사회</span><span class="txt">ISO45001 등 국제적 안전보건경영시스템 표준 또는 이에 준하는 인증을 획득하였습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num7" name="inum7" value="HTE-CS-16">
			<div class="sample">인증서  첨부</div>
			<div class="filebox">
			  <label for="file7">파일첨부</label>
				<input type="file" id="file7" name="file7" class="upload-hidden">
			  <input class="upload-name" id="fileName7" name="fileName7" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file7id; ?>" target="_blank" id="prevFile7"><? if($file7name != null){echo $file7name;}?></a>
		</div>
		<?}?>

		<? 
		$esmIdx = "SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = 4 AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022";
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-CG-01'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer8 = $answerRow["ANSWER_CD"];
		if($answer8 != null && $answer8 != 'C'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-CG-01' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file8id = $fileRow["FILE_ID"];
			$file8name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c00"><span class="c00">공통</span><span class="c04">지배구조</span><span class="txt">전사적 차원의 행동강령을 보유하고, 이를 공개하고 있습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num8" name="inum8" value="HTE-CG-01">
			<div class="sample">윤리경영, 반부패 관련 자료 첨부</div>
			<div class="filebox">
			  <label for="file8">파일첨부</label>
				<input type="file" id="file8" name="file8" class="upload-hidden">
			  <input class="upload-name" id="fileName8" name="fileName8" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file8id; ?>" target="_blank" id="prevFile8"><? if($file8name != null){echo $file8name;}?></a>
		</div>
		<?}?>

		<? 
		$esmIdx = "SELECT IDX FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$member_id."' AND QUES_PHASE = '7' AND SURVEY_NAME = '한화' AND SURVEY_YEAR = 2022";
		$query = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE ESM_IDX = ($esmIdx) AND QUES_CD = 'HTE-IL-02'";
		$proc = mysqli_query($dbconn,$query);
		$answerRow = mysqli_fetch_assoc($proc);
		$answer9 = $answerRow["ANSWER_CD"];
		if($answer9 != null && $answer9 == 'A'){
			$file_query = "SELECT FILE_ID, USR_FILE_NAME FROM ESG_FILE WHERE DEL_YN = 'N' AND ESM_IDX = '".$row[0]["IDX"]."' AND QUES_CD ='HTE-IL-02' ORDER BY REG_DATE DESC LIMIT 1";
			$file_proc = mysqli_query($dbconn,$file_query);
			$fileRow = mysqli_fetch_assoc($file_proc);
			$file9id = $fileRow["FILE_ID"];
			$file9name = $fileRow["USR_FILE_NAME"];
		?>
		<p class="Q c05"><span class="c05">운송</span><span class="c02">환경</span><span class="txt">초과근무 과다 통제, 휴무 보장 등 법적 근로기준을 준수하여 근무시간을 관리하는 정책 및 방침이 확립되어 있습니까?<span></p>
		<div class="A a01">
			<input type="hidden" id="i_num9" name="inum9" value="HTE-IL-02">
			<div class="sample">근로계약서 등 자료 첨부</div>
			<div class="filebox">
			  <label for="file9">파일첨부</label>
				<input type="file" id="file9" name="file9" class="upload-hidden">
			  <input class="upload-name" id="fileName9" name="fileName9" value="파일선택" disabled="disabled">
			</div>
			<a href="survey/download.php?file_id=<? echo $file9id; ?>" target="_blank" id="prevFile9"><? if($file9name != null){echo $file9name;}?></a>
		</div>
		<?}?>

		<p class="s_btn">
			<a href="survey07.php" class="prev">이전단계</a>
			<a href="javascript:fnsubmit();" class="comp">최종제출</a>
			<input type="hidden" id="subMode" name="subMode" value="<?php echo $subMode;?>">
		</p>
		</form>
	</div>
</body>
<script language="javascript">
function fnsubmit(){
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
	
		<?if($answer1 != null){?>
			if($("input[name=file1]").val() == "" && $("#fileName1").val() == "파일선택" && $("#prevFile1").text() == "") {
				alert("환경방침 자료를 첨부해주세요.");
				$("input[name=file1]").focus();
				return false;
			}
		<?}?>

		<?if($answer2 != null){?>
			if($("input[name=file2]").val() == "" && $("#fileName2").val() == "파일선택" && $("#prevFile2").text() == "") {
				alert("인증서 첨부 파일을 선택해주세요.");
				$("input[name=file2]").focus();
				return false;
			}
		<?}?>

		<?if($answer3 != null){?>
			if($("input[name=file3]").val() == "" && $("#fileName3").val() == "파일선택" && $("#prevFile3").text() == "") {
				alert("안전보건 정책 자료 첨부파일을 선택해주세요.");
				$("input[name=file3]").focus();
				return false;
			}
		<?}?>

		<?if($answer4 != null){?>
			if($("input[name=file4]").val() == "" && $("#fileName4").val() == "파일선택" && $("#prevFile4").text() == "") {
				alert("인권정책 자료 첨부파일을 선택해주세요.");
				$("input[name=file4]").focus();
				return false;
			}
		<?}?>
		
		<?if($answer5 != null){?>
			if($("input[name=file5]").val() == "" && $("#fileName5").val() == "파일선택" && $("#prevFile5").text() == "") {
				alert("주 1회 휴무 보장을 위한 정책 및 방침에 대 첨부파일을 선택해주세요.");
				$("input[name=file5]").focus();
				return false;
			}
		<?}?>

		<?if($answer6 != null){?>
			if($('input[name=file6]').val() == "" && $("#fileName6").val() == "파일선택" && $("#prevFile6").text() == "") {
				alert("공제액에 대한 첨부파일을 선택해주세요.");
				$("input[name=file6]").focus();
				return false;
			}
		<?}?>

		<?if($answer7 != null){?>
			if($('input[name=file7]').val() == "" && $("#fileName7").val() == "파일선택" && $("#prevFile7").text() == "") {
				alert("인증서 첨부파일을 선택해주세요.");
				$("input[name=file7]").focus();
				return false;
			}
		<?}?>

		<?if($answer8 != null){?>
			if($('input[name=file8]').val() == "" && $("#fileName8").val() == "파일선택" && $("#prevFile8").text() == "") {
				alert("윤리경영, 반부패 관련 자료 첨부파일을 선택해주세요.");
				$("input[name=file8]").focus();
				return false;
			}
		<?}?>

		<?if($answer9 != null){?>
			if($('input[name=file9]').val() == "" && $("#fileName9").val() == "파일선택" && $("#prevFile9").text() == "") {
				alert("근무시간을 관리하는 정책 및 방침 첨부파일을 선택해주세요.");
				$("input[name=file9]").focus();
				return false;
			}
		<?}?>

		frm.submit();
}
</script>
</html>
