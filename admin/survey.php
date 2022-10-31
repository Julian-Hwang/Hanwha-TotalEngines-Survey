<html lang="utf-8">
<body>
<?php
include("./include/adminHeader.php");
include('../_inc/inc.php');
include('../_inc/db.php');
   
login_check();
admin_check();

$surveyYear = $_GET['surveyYear'];

$last = $_GET['last'];
$category = $_GET['search_keyfield'];
$search = $_GET['search_keyword'];
$Sdate = $_GET['startDate'];
$Edate = $_GET['endDate'];


$condition = "1=1";
if($search != "")
{

    if($category == "all"){
    $condition = "$condition"."  AND EM.MEMBER_ID like '%{$search}%'
    OR EM.MEMBER_NAME like  '%{$search}%'
    OR EM.COM_NAME like '%{$search}%'
    OR ESM.SURVEY_NAME like '%{$search}%'
    ";
    }

    if($category == "REG_ID" ) {
        $condition = "$condition"." AND "." EM.MEMBER_ID like '%{$search}%'";
    }
    
    if($category == "MEMBER_NAME" ) {
        $condition = "$condition"." AND "." EM.MEMBER_NAME like '%{$search}%'";
    }
    
    if($category == "COM_NAME" ) {
        $condition = "$condition"." AND "." EM.COM_NAME like '%{$search}%'";
    }
    
    if($category == "SURVEY_NAME" ) {
        $condition = "$condition"." AND "." ESM.SURVEY_NAME like '%{$search}%'";
    }
}

if($surveyYear != "") {
    $condition = "$condition"." AND "." ESM.SURVEY_YEAR like '$surveyYear'";
}

if($last != "") {
    if($last == "X"){
        $condition = "$condition"." AND "." ESM.SUBMIT_YN is null";
    }else{
        $condition = "$condition"." AND "." ESM.SUBMIT_YN like '$last'";
    }
    
}

if($Sdate && $Edate != "" ) {
    $condition = "$condition"." AND "." DATE_FORMAT(ESM.SUBMIT_DATE,'%Y-%m-%d')  BETWEEN '$Sdate' AND  '$Edate'";
}
else if($Sdate != "" ) {
    $condition = "$condition"." AND "." DATE_FORMAT(ESM.SUBMIT_DATE,'%Y-%m-%d') >= '$Sdate'";
}
else if($Edate != "" ) {
    $condition = "$condition"." AND "." DATE_FORMAT(ESM.SUBMIT_DATE,'%Y-%m-%d')  <= '$Edate'";
}

    /* 검색된 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
    $sql = "SELECT 
    EM.IDX,
    EM.MEMBER_ID, 
    EM.MEMBER_NAME, 
    EM.MEMBER_PHONE, 
    EM.MEMBER_TEL, 
    EM.COM_NAME,
    ESM.SURVEY_NAME, 
    ESM.SURVEY_YEAR, 
    (SELECT SM.REG_DATE FROM ESG_SURVEY_MASTER SM WHERE EM.MEMBER_ID = SM.REG_ID AND SM.QUES_PHASE = '1' LIMIT 1) AS sDate, 
    (SELECT SM.MOD_DATE FROM ESG_SURVEY_MASTER SM WHERE EM.MEMBER_ID = SM.REG_ID ORDER BY SM.MOD_DATE DESC LIMIT 1) AS eDate, 
    (SELECT SM.SUBMIT_DATE FROM ESG_SURVEY_MASTER SM WHERE EM.MEMBER_ID = SM.REG_ID LIMIT 1) AS subDate, 
    (SELECT SM.QUES_PHASE FROM ESG_SURVEY_MASTER SM WHERE EM.MEMBER_ID = SM.REG_ID ORDER BY SM.QUES_PHASE DESC LIMIT 1) AS qPhase 
    FROM ESG_MEMBER EM 
    LEFT JOIN ESG_SURVEY_MASTER ESM 
    ON EM.MEMBER_ID = ESM.REG_ID 
    where $condition
    AND EM.REG_ID != 'test'
    AND EM.REG_ID != 'esgadm'
    GROUP BY EM.IDX,ESM.SURVEY_NAME,ESM.SURVEY_YEAR
    ORDER BY ESM.REG_DATE DESC, ESM.SUBMIT_DATE DESC";

    $result = mysqli_query($dbconn, $sql);

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $row_num = mysqli_num_rows($result); //게시판 총 레코드 수
    $list = 20; //한 페이지에 보여줄 개수
    $block_ct = 5; //블록당 보여줄 페이지 개수

    $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
    $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
    $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

    $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
    if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
    $total_block = ceil($total_page/$block_ct); //블럭 총 개수
    $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

    $sql2 = $sql." LIMIT $start_num, $list";  
    $result2 = mysqli_query($dbconn, $sql2);

?>
<style>
    .cal{ height: 38px; }
</style>
<div id="wrap">
	<div id="header">
		<div class="menu_wrap">
			<h1 class="logo"><a href="/esg/admin/survey.php"><img src="/esg/admin/_img/comn/logo1.png" alt="kpcesg"/></a></h1> <!--200px*50px-->
			<ul class="menu">
				<!--<li class="menu_memnber"><a href="/esg/admin/admin.php" class="on">관리자 관리</a></li>-->
                <li class="menu_memnber"><a href="/esg/admin/survey.php" class="on">ESG 설문 관리</a></li> 
			</ul>
		</div>

		<p class="gnb">
			<a class="my" href="">admin <img src="/esg/admin/_img/comn/my.png" alt="나의ID"/>
			<a href="../login/logout.php" class="logout"><img src="/esg/admin/_img/comn/logout.png" alt="로그아웃"/></a>
		</p>
	</div>

	<div id="container">
		<div id="left">
			<ul class="left_menu">
				<li>
					<a href="/esg/admin/survey.php">ESG 설문 관리</a>
                    <!-- <a href="/esg/admin/admin.php">관리자 계정 관리</a> -->
				</li>
			</ul>
		</div>
		<div id="contents">
			<ol class="loca">
				<li><img class="mt5 mr5" src="/esg/admin/_img/comn/home_img.png" alt="나의설정"/> 홈</li>
				<li>ESG 설문 관리</li>
			</ol>
            <h2>ESG 설문 관리</h2>
            <form name="frm" id="frm"  action="/esg/admin/survey.php" method="get">
                <input type="hidden" name="SubmitMode"	id="SubmitMode"	value=""/>
                <input type="hidden" name="idx" id="idx"  value="">

                <ul class="search_c">
                    <li>
                        <p class="tit">설문연도</p>
                        <select name="surveyYear">
                        <option value="">전체</option>
                        <!-- <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option> -->
                        <option value="2022" <? if($_GET['surveyYear'] == '2022'){ ?> selected <? } ?> >2022</option>
                        </select>
                    </li>

                    <li>
                        <p class="tit">최종제출여부</p>
                        <select name="last">
                        <option value="">전체</option>
                        <option value="Y" <? if($_GET['last'] == 'Y'){ ?> selected <? } ?> > 제출완료</option>
                        <option value="N" <? if($_GET['last'] == 'N'){ ?> selected <? } ?> > 진행중</option>
                        <option value="X" <? if($_GET['last'] == 'X'){ ?> selected <? } ?> > 미진행</option>
                        </select>
                    </li>

                    <li>
                        <p class="tit">최종제출일</p>
                        <input type="text" value="<? echo $_GET['startDate'];?>" id="scheSdate" name="startDate" class="nor cal"> ~ <input type="text" value="<? echo $_GET['endDate'];?>" id="scheEdate" name="endDate" class="nor cal">
                    </li>

                    <li>
                        <p class="tit">검색구분</p>
                        <div class="search">
                            <p class="f_l">
                                <select class="select01" name="search_keyfield" id="search_keyfield" class="customSelect" style="cursor:pointer">
                                    <option value="all" <? if($_GET['search_keyfield'] == 'all'){ ?> selected <? } ?>  >전체</option>
                                    <option value="REG_ID" <? if($_GET['search_keyfield'] == 'REG_ID'){ ?> selected <? } ?>> 사용자 아이디</option>
                                    <option value="MEMBER_NAME" <? if($_GET['search_keyfield'] == 'MEMBER_NAME'){ ?> selected <? } ?> >사용자 이름</option>
                                    <option value="COM_NAME"<? if($_GET['search_keyfield'] == 'COM_NAME'){ ?> selected <? } ?> >기업명</option>
                                    <option value="SURVEY_NAME"<? if($_GET['search_keyfield'] == 'SURVEY_NAME'){ ?> selected <? } ?> >캠패인명</option>
                                </select>
                            </p>
                            <p class="re_info">
                                <input type="text" class="nor" name="search_keyword" id="search_keyword" value="<? echo $_GET['search_keyword']; ?>" placeholder="검색어를 입력해주세요" style="width:220px;">
                                <a href="javascript:frm.submit()" class="dark_btn">검색</a>
                            </p>
                        </div>
                    </li>
                </ul>

                <div class="ta_cont mt10">
                <table class="table01">
                <colgroup>
                    <col width="4%">
                    <col width="8%">
                    <col width="*">
                    <col width="6%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="6%">
                    <col width="7%">
                    <col width="7%">
                    <col width="7%">
                    <col width="6%">
                    <col width="6%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="c">No</th>
                        <th class="c">캠페인명</th>
                        <th class="c">사용자 아이디</th>
                        <th class="c">사용자 이름</th>
                        <th class="c">회사 내선번호</th>
                        <th class="c">사용자 연락처</th>
                        <th class="c">기업명</th>
                        <th class="c">설문연도</th>
                        <th class="c">최초시작일</th>
                        <th class="c">최근수정일</th>
                        <th class="c">최종제출일</th>
                        <th class="c">완료단계</th>
                        <th class="c">관리</th>
                    <tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row =(mysqli_fetch_array($result2))) {
                ?>
                            <tr>
                                <td class="c"><?= $start_num+$i; ?></td>
                                <td class="c">한화</td>
                                <!-- <td class="c"> $row['SURVEY_NAME']; </td> -->
                                <td class="c"><?= $row['MEMBER_ID']; ?></td>
                                <td class="c"><?= $row['MEMBER_NAME']; ?></td>
                                <td class="c"><?= $row['MEMBER_PHONE']; ?></td>
                                <td class="c"><?= $row['MEMBER_TEL']; ?></td>
                                <td class="c"><?= $row['COM_NAME']; ?></td>
                                <td class="c"><?= $row['SURVEY_YEAR']; ?></td>
                                <td class="c"><?= $row['sDate']; ?></td>
                                <td class="c"><?= $row['eDate']; ?></td>
                                <td class="c"><?= $row['subDate']; ?></td>
                                <td class="c">
                                    <? if($row['subDate'] != null){
                                        echo "최종제출완료";
                                    } else if($row['qPhase']  == "1"){
                                        echo "일반사항";             
                                    } else if($row['qPhase'] == "2"){
                                        echo "수준진단 > 환경";
                                    } else if($row['qPhase'] == "3"){
                                        echo "수준진단 > 사회";
                                    } else if($row['qPhase'] == "4"){
                                        echo "수준진단 > 지배구조";
                                    } else if($row['qPhase'] == "5" || $row['qPhase'] == "6" || $row['qPhase'] == "7"){
                                        echo "수준진단 > 산업특화";
                                    } else if($row['qPhase'] == "8"){
                                        echo "증빙자료";
                                    }
                                    ?>

                                </td>
                                <td class="c">
                                    <a href="./admin_Detail.php?idx=<?= $row['IDX']?>" class="y_btn">관리</a>
                                </td>
                            </tr>
                            <?php $i++;} ?>
                        </tbody>
                    </table>
                 
                <p class="pagenation">
                <?php

                    $searchCon = "SubmitMode=".$_GET['SubmitMode']."&idx=".$_GET['idx']."&surveyYear=".$_GET['surveyYear']."&last=".$_GET['last']."&startDate=".$_GET['startDate']."&endDate=".$_GET['endDate']."&search_keyfield=".$_GET['search_keyfield']."&search_keyword=".$_GET['search_keyword']."";
                    
                    if($page <= 1)
                    { 
                        echo "<a class='prev_next'><img src='/esg/admin/_img/comn/first.png' alt='맨처음'></a>"; 
                    }else{
                        echo "<a class='prev_next' href='?$searchCon&page=1'><img src='/esg/admin/_img/comn/first.png' alt='맨처음'></a>"; 
                    }
                    if($page <= 1)
                    { 
                        echo "<a class='prev_next'><img src='/esg/admin/_img/comn/prev.png' alt='이전으로'></a>";
                    }else{
                        $pre = $page-1; 
                        echo "<a class='prev_next' href='?$searchCon&page=$pre'><img src='/esg/admin/_img/comn/prev.png' alt='이전으로'></a>"; 
                    }
                    for($i=$block_start; $i<=$block_end; $i++){ 
                        if($page == $i){ 
                        echo "<a class='on'><strong>$i</strong></a>"; 
                        }else{
                        echo "<a href='?$searchCon&page=$i'>$i</a>";
                        }
                    }
                    if($block_num >= $total_block){
                        echo "<a class='prev_next'><img src='/esg/admin/_img/comn/next.png' alt='다음으로'></a>";
                    }else{
                        $next = $page + 1; 
                        echo "<a class='prev_next' href='?$searchCon&page=$next'><img src='/esg/admin/_img/comn/next.png' alt='다음으로'></a>"; 
                    }
                    if($page >= $total_page){ 
                        echo "<a class='prev_next'><img src='/esg/admin/_img/comn/last.png' alt='맨마지막'></a>";
                    }else{
                        echo "<a class='prev_next' href='?$searchCon&page=$total_page'><img src='/esg/admin/_img/comn/last.png' alt='맨마지막'></a>"; 
                    }
                ?>
                </p>
            </div>
            </form>	
        </div>
    </div>

    <div id="copyright">
        <p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
    </div>
</div>
</body>
<script>
$(document).ready(function(){
    //datepicker
    $(".cal").datepicker({
        changeMonth: true,
        changeYear: true
    });
    $('#scheSdate').datepicker();
    $('#scheSdate').datepicker("option", "maxDate", $("#scheEdate").val());
    $('#scheSdate').datepicker("option", "onClose", function ( selectedDate ) {
        $("#scheEdate").datepicker( "option", "minDate", selectedDate );
    });
    $('#scheEdate').datepicker();
    $('#scheEdate').datepicker("option", "minDate", $("#scheSdate").val());
    $('#scheEdate').datepicker("option", "onClose", function ( selectedDate ) {
        $("#scheSdate").datepicker( "option", "maxDate", selectedDate );
    });	
});
</script>
</html>
