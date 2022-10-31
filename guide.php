<?php
include('_inc/inc.php');
include('_inc/db.php');
login_check();
?>
<!doctype html>
<html lang="ko">
<?php include "_inc/title.php"; ?>
<body id="background" class="guide">
<p class="logo"><img src="_img/logo_han.png" alt="한화토탈에너지스"></p>
<div class="guide_box">
	<p class="tit" style= "text-align:center;">한화토탈에너지스 협력사 ESG 진단지표 작성안내</p>

	<p class="st top">A. 진단 개요</p>
	<div class="cont">
		본 진단지표는 한화토탈에너지 협력사 ESG 수준진단을 위해 관련 국내외 평가지표 및 가이드라인을 참고하여 개발되었습니다.<br/>
	</div>

	<p class="st">B. 작성 안내</p>
	<div class="cont">
		<p>응답가이드의 설명의 참고하여 상중하 3단계 중 한 가지를 선택해주십시오. 기타의견이 있으실 경우 설명을 작성해주십시오. 각 항목별로 현황에 대해 가감없이 작성하여 주시고, <span class="at_o">관련 내부문서(ex. 사업계획, 보고자료, 업무분장 등)나 대외공시자료를 첨부</span>하여 주십시오.</p>
		<div class="sample mt10">
			<span class="tit">※첨부예시</span>
			- (기업명)_(사업분야)_(파일명).ppt<br/>
		</div>
	</div>

	<p class="st">C. 사전동의사항 </p>
	<div class="cont">
		<p>EU 공급망 실사법은 내 활동하는 모든 기업 및 직·간접적으 로 연계된 공급업체를 대상으로 인권·사회·노동권, 환경, 거버넌스에 미치는 잠재적 또는 부정적 영향을 식별, 예방 및 해결하고 관련 자료 공개, 리스크 확인 및 평가, 관리 시스템 구축 여부에 대해 확인 및 검토하여 자체적으로 사회적 책임을 파악 및 개선하기 위한 의무를 부과하였습니다.</p>
		<ul class="dot_list">
			<li>2021. 3. EU 의회: 기업실사 및 기업 책임에 대한 결의안 채택</li>
			<li>2021. 6. 독일: 기업 공급망 실사법안 채택, 2023년 시행 예정</li>
			<li>2022. 2. EU 의회: 공급망 실사지침 초안 공개</li>
		</ul>

		<p>이에 한화토탈에너지스는 EU 공급망 실사법 내 협력사와 실사준수계약 체결 조항에 따라 <span class="at_o">1차 진단결과 (온라인 진단) 부정적, 잠재적 영향 확인시 보다 구체적인 예방조치 마련 및 시행 하고자 하며 참여 협력사 및 공급업체는 및 현장 방문 실사에 참여할 것에 동의</span>합니다.</p>
		<p class="mt10">본 진단지표의 응답 자료는 한화토탈에너지스의 협력사 현황진단 및 개선의 근거 자료로만 활용될 것이며 응답하신 정보는 개인정보 보호법 제15조(개인정보보호이용)에 의거하여 보호받을 수 있습니다. 또한 동법 제21조(개인정보의 파기)에 따라 진단 종료 후 파기됩니다.</p>
	</div>
	<div class="cont">
    <span><input type="checkbox" name="yes" id="agree"><label for="agree">동의합니다.</label></span>
    </div>
	<p class="st">D. 회신 안내</p>
	<div class="cont">
		2022년 <span class="at_o">10월 28일(금)</span>까지 회신하여 주시기 바랍니다.<br/>
		궁금하신 점이 있으신 경우 한화토탈에너지스 ESG경영팀 이기민 과장 (k87.lee@htpchem.com)<br/>
		혹은 당사와 컨택하는 한화토탈에너지스 담당자, <br/>
		한국생산성본부 김보비 팀장 (bbkim@kpc.or.kr / 02-398-7669),<br/>
		김준의 연구원 (jekim@svicenter.or.kr / 02-3702-0752)으로 연락 바랍니다.
	</div>

</div>
<p class="start"><a href="javascript:start();">시작하기</a></p>

</body>
<script>
    function start(){
        if($('#agree').is(':checked')){
            location.href = "survey01.php";
        } else {
            alert('C. 사전 동의사항 확인 및 동의 체크 후 진행해주세요.');
        }
    }
</script>
</html>
