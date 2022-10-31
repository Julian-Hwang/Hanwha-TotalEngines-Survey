<?php
include('./_inc/inc.php');
include('./_inc/db.php');
?>
<!doctype html>
<html lang="ko">
<?php include "./_inc/title.php"; ?>
<style>
.login_box .login input[type="password"]		{width:100%; background:#f5f5f5; padding:18px 20px; font:400 18px/21px "Noto Sans KR", sans-serif; color:#222; border-radius:5px; border:none; outline:2px solid #f5f5f5; -webkit-appearance: none; -moz-appearance: none; appearance: none;}
.login_box .login input[type="password"]:focus	{outline:2px solid #bbb;}
</style>
<body id="background">
  <form id="frm" action="login/login_proc_admin.php" method="post">
  <div class="login_box">
  	<p class="logo"><img src="./_img/logo_han.png" alt="한화토탈에너지스"><img src="./_img/logo_kpc.png" alt="한국생산성본부"></p>
  	<p class="login">
  		<span>관리자 로그인</span>
  		<input type="text" name="mb_id" placeholder="아이디 입력"/>
		<span></span>
		<input type="password" name="mb_pw" placeholder="패스워드 입력" onKeyPress="if(event.keyCode==13){frm.submit();}"/>
  	</p>
	<p class="login">
  		
  	</p>
  	<p class="btn"><a href="javascript:frm.submit();">확인</a></p>
  	<!--p class="tel">문의전화 010-7706-6091</p-->
  </div>
  </form>
</body>
</html>
