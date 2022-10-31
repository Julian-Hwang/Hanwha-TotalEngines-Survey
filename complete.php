<?
include('_inc/inc.php');
include('_inc/db.php');
login_check();
?>
<!doctype html>
<html lang="ko">
<? include "./_inc/title.php"; ?>
<body id="background">

<div class="comp_box">
	<p class="text">
		<span>진단지 작성이 완료되셨습니까?</span>
		최종 제출하시려면 하단 버튼을 클릭해주세요
	</p>
	<p class="btn"><a href="javascript:endSurvey();">최종제출하기</a></p>
</div>

</body>
<script>
function endSurvey(){
	if(confirm("최종 제출 하시겠습니까?\n최종 제출 완료 시 설문지 수정이 불가능합니다.")){
		location.href="survey/complete_proc.php";
	}
}
</script>
</html>
