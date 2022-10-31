<?php
include('./_inc/inc.php');
include('_inc/db.php');
?>
<!doctype html>
<html lang="ko">
<?php include "./_inc/title.php"; ?>
<body id="background">
  <?php
      if($isLogin){
          header("location: guide.php");
          exit();
      } else {
  ?>
  <form id="frm" action="login/login_proc.php" method="post">
  <div class="login_box">
  	<p class="logo"><img src="_img/logo_han.png" alt="한화토탈에너지스"><img src="_img/logo_kpc.png" alt="한국생산성본부"></p>
  	<p class="login">
  		<span>담당자 이메일</span>
  		<input type="text" name="mb_id"/>
  	</p>
  	<p class="btn"><a href="javascript:frm.submit();">확인</a></p>
  	<!--p class="tel">문의전화 010-7706-6091</p-->
  </div>
  </form>
  <?php } ?>
</body>
</html>
