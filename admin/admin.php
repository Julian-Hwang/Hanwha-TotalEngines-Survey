<html lang="utf-8">
<body>
<?php
include("./include/adminHeader.php");
include('../_inc/inc.php');
include('../_inc/db.php');
   
login_check();
admin_check();

$sql = "SELECT 
        EM.IDX,
        EM.MEMBER_ID, 
        EM.MEMBER_NAME
        FROM ESG_MEMBER EM 
        where EM.REG_ID = 'esgadm'";

$result = mysqli_query($dbconn, $sql);

?>

<div id="wrap">
	<div id="header">
		<div class="menu_wrap">
			<h1 class="logo"><a href="/esg/admin/survey.php"><img src="/esg/admin/_img/comn/logo1.png" alt="kpcesg"/></a></h1> <!--200px*50px-->
			<ul class="menu">
				<!-- <li class="menu_memnber"><a href="/esg/admin/admin.php" class="on">관리자 관리</a></li>
                <li class="menu_memnber"><a href="/esg/admin/survey.php" class="on">ESG 설문 관리</a></li> -->
			</ul>
		</div>

		<p class="gnb">
			<a class="my" href="#"><? echo $_SESSION['MEMBER_NAME'];?> <img src="/esg/admin/_img/comn/my.png" alt="나의ID"/>
			<a href="../login/logout.php" class="logout"><img src="/esg/admin/_img/comn/logout.png" alt="로그아웃"/></a>
		</p>
	</div>

	<div id="container">
		<div id="left">
			<ul class="left_menu">
				<li>
					<a href="/esg/admin/survey.php">ESG 설문 관리</a>
                    <a href="/esg/admin/admin.php">관리자 계정 관리</a>
				</li>
			</ul>
		</div>
		<div id="contents">
			<ol class="loca">
				<li><img class="mt5 mr5" src="/esg/admin/_img/comn/home_img.png" alt="나의설정"/> 홈</li>
				<li>관리자 계정 관리</li>
			</ol>
            <h2>관리자 계정 관리</h2>
            <form name="frm" id="frm"  action="/esg/admin/survey.php" method="get">
                <input type="hidden" name="SubmitMode"	id="SubmitMode"	value=""/>
                <input type="hidden" name="idx" id="idx"  value="">

                <div class="ta_cont mt10">
                <table class="table01">
                    <colgroup>
                        <col width="10%">
                        <col width="*">
                        <col width="35%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="c">No</th>
                            <th class="c">관리자 아이디</th>
                            <th class="c">관리자 이름</th>
                            <th class="c">관리</th>
                        <tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    while($row =(mysqli_fetch_array($result))) {
                    ?>
                        <tr>
                            <td class="c"><?= $i; ?></td>
                            <td class="c"><?= $row['MEMBER_ID']; ?></td>
                            <td class="c"><?= $row['MEMBER_NAME']; ?></td>
                            <td class="c">
                                <a href="#" class="y_btn">관리</a>
                            </td>
                        </tr>
                    <?php $i++;} ?>
                </tbody>
            </table>
            </div>
            <!-- <p class="r mt20"><a href="account/reg_member.php" class="r_btn_big"><span>등록</span></a></p> -->
            </form>	
        </div>
    </div>

    <div id="copyright">
        <p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
    </div>
</div>
</body>
<script>

</script>
</html>
