<html lang="utf-8">
<body>
<?php
include ("./include/adminHeader.php");
include('../_inc/inc.php');
include('../_inc/db.php');

login_check();
admin_check();

    $sql1 =  "SELECT * FROM  ESG_MEMBER WHERE IDX = {$_GET['idx']}";

    $result1 = mysqli_query($dbconn, $sql1);
  
    $row1 = mysqli_fetch_array($result1);

    // $article1 = array(
    //     'MEMBER_ID' => $row1['MEMBER_ID'],
    //     'MEMBER_NAME' => $row1['MEMBER_NAME'],
    //     'MEMBER_TEL' => $row1['MEMBER_TEL'],
    //     'COM_NAME' => $row1['COM_NAME']
    // );  
    // -- <!--(SELECT QUES_PHASE FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$row1['MEMBER_ID']."' ORDER BY QUES_PHASE DESC LIMIT 1) ABC,
    $sql2 = "SELECT 
    ESM.SURVEY_NAME, 
    ESM.SURVEY_YEAR,
    ESM.SUBMIT_YN,
    ESM.SUBMIT_DATE,
    QUES_PHASE AS ABC,
    (SELECT QUES_PHASE FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$row1['MEMBER_ID']."' ORDER BY QUES_PHASE DESC LIMIT 1) ABC,
    (SELECT REG_DATE FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$row1['MEMBER_ID']."' ORDER BY QUES_PHASE LIMIT 1) REGDATE,
    (SELECT MOD_DATE FROM ESG_SURVEY_MASTER WHERE REG_ID = '".$row1['MEMBER_ID']."' ORDER BY MOD_DATE DESC LIMIT 1) MODDATE
    FROM ESG_SURVEY_MASTER AS ESM
    WHERE ESM.REG_ID = '".$row1['MEMBER_ID']."'";
    
    $result2 = mysqli_query($dbconn, $sql2);
  
    $row2 = mysqli_fetch_array($result2);

    // $article2 = array(
    //     'SURVEY_NAME' => $row2['SURVEY_NAME'],
    //     'SURVEY_YEAR' => $row2['SURVEY_YEAR'],
    //     'QUES_PHASE' => $row2['QUES_PHASE'],
    //     'REG_DATE' => $row2['REG_DATE'],
    //     'MOD_DATE' => $row2['MOD_DATE']
    // );     
?>
<script src="/admin/_js/edu.js" language="JavaScript" type="text/javascript"></script>
<script>
$(document).ready(function(){
	
});

function fn_submit(){
	if(checkForm("frm")){
		if(checkFileForm()){
			//$("#frm").submit();
			Editor.save();
		}
	}
}
</script>



</head>
<div id="wrap">
	<div id="header">
		<div class="menu_wrap">
			<h1 class="logo"><a href="/esg/admin/survey.php"><img src="/esg/admin/_img/comn/logo1.png" alt="kpcesg"/></a></h1> <!--200px*50px-->
			<ul class="menu">
				<li class="menu_memnber"><a href="/esg/admin/survey.php" class="on">ESG ?????? ??????</a></li>
			</ul>
		</div>

		<p class="gnb">
			<a class="my" href="#">admin <img src="/esg/admin/_img/comn/my.png" alt="??????ID"/>
			<a href="../login/logout.php" class="logout"><img src="/esg/admin/_img/comn/logout.png" alt="????????????"/></a>
		</p>
	</div>
    <!--?????? ??????-->
    <div id="container">
        <div id="left">
        <ul class="left_menu">

            <li>
                <a>ESG ?????? ??????</a>	
            </li>

        </ul>
    </div>
    <div id="contents">
            <ol class="loca">
                <li><img class="mt5 mr5" src="/esg/admin/_img/comn/home_img.png" alt="????????????"/>???????????? ??????</li>
                <li>ESG ?????? ??????</li>
            </ol>
            <h2>ESG ?????? ??????</h2>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
            <div class="ta_cont mt20">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                <table class="bbs_write" >                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                    <colgroup> 
                        <col width="10%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <tbody>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                        <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            <th colspan="8" style="text-align:center">????????? ??????</th>
                        </tr>	                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                        <tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            <th>????????? ?????????</th>
                            <td colspan="7"><?=$row1['MEMBER_ID']?></td>
                        </tr>			
                        <tr>
                            <th>????????? ??????</th>
                            <td colspan="7"><?= $row1['MEMBER_NAME']; ?></td>
                        </tr>
                        <tr>
                            <th>????????? ?????????</th>
                            <td colspan="7"><?= $row1['MEMBER_TEL']; ?></td>
                        </tr>
                        <tr>
                            <th>?????????</th>
                            <td colspan="7"><?= $row1['COM_NAME']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ta_cont mt20">
                <table class="bbs_write" >
                    <colgroup> 
                        <col width="10%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th colspan="8" style="text-align:center">?????? ??????</th>	
                    </tr>       
                    <tr>
                        <th>????????????</span></th>
                        <td colspan="3"><?= $row2['SURVEY_NAME']; ?></td>
                        <th>????????????</th>
                        <td colspan="3"><?= $row2['SURVEY_YEAR']; ?></td>
                    </tr>
                    <tr>
                        <th>???????????????</th>
                        <td colspan="3"><?= $row2['SUBMIT_DATE'] ?></td>
                        <th>????????????</th>
                        <td colspan="3"><? 
                        if($row['SUBMIT_DATE'] != null){
                                echo "??????????????????";
                            } else if($row2['ABC']  == "1"){
                                echo "????????????";             
                            } else if($row2['ABC'] == "2"){
                                echo "???????????? > ??????";
                            } else if($row2['ABC'] == "3"){
                                echo "???????????? > ??????";
                            } else if($row2['ABC'] == "4"){
                                echo "???????????? > ????????????";
                            } else if($row2['ABC'] == "5" || $row2['ABC'] == "6" || $row2['ABC'] == "7"){
                                echo "???????????? > ????????????";
                            } else if($row2['ABC'] == "8"){
                                echo "????????????";
                            }
                            ?>
                        </td>    
                    </tr>
                    <tr>
                        <th>???????????????</th>
                        <td colspan="3"><?= $row2['REGDATE'] ?></td>
                        <th>???????????????</th>
                        <td colspan="3"><?= $row2['MODDATE'] ?></td>
                    </tr>	
                    </tbody>
                </table>       
            </div> 

            <!--??????-->
            <div class="ta_cont mt10">
                <table class="table01">
                    <colgroup>
                        <col width="5%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                <thead>
                    <tr>
                        <th class="c">No</th>
                        <th class="c">????????????</th>
                        <th class="c">?????????</th>
                        <th class="c">??????</th>
                        <th class="c">???????????????</th>
                        <th class="c">???????????????</th>
                        <th class="c">??????</th>
                    <tr>
                </thead>
                <tbody>
                    <?php
                    $sql3 = "SELECT 
                    ESM.SURVEY_NAME, 
                    ESM.SURVEY_YEAR,
                    ESM.SUBMIT_YN,
                    ESM.SUBMIT_DATE,
                    ESM.QUES_PHASE,
                    ESM.REG_DATE,
                    ESM.MOD_DATE,
                    (SELECT COUNT(*) FROM ESG_ANSWER WHERE REG_ID = '".$row1['MEMBER_ID']."' AND QUES_PHASE = ESM.QUES_PHASE ) COUNT,
                    (SELECT SUM(ANSWER_POINT) FROM ESG_ANSWER WHERE REG_ID = '".$row1['MEMBER_ID']."' AND QUES_PHASE = ESM.QUES_PHASE ) POINT
                    FROM ESG_SURVEY_MASTER AS ESM
                    WHERE ESM.REG_ID = '".$row1['MEMBER_ID']."'";
                    
                    $result3 = mysqli_query($dbconn, $sql3);
                    
                    $sql_ans = "SELECT ANSWER_CD FROM ESG_ANSWER WHERE REG_ID = '".$row1['MEMBER_ID']."' and QUES_CD = 'HTE-G-00'";
                    $levelresult = mysqli_query($dbconn,$sql_ans);
                    $level_row = mysqli_fetch_assoc($levelresult);
                    
                    $i = 1;
                    while($row3 = mysqli_fetch_array($result3)) {
                        switch ($row3['QUES_PHASE']) {
                            case '1': $url= "../survey01.php";break;
                            case '2': 
                                if($level_row['ANSWER_CD'] == 'A'){$url= "../survey02_1.php";} 
                                else if($level_row['ANSWER_CD'] == 'B'){$url= "../survey02_2.php";} 
                                else if($level_row['ANSWER_CD'] == 'C'){$url= "../survey02.php";}
                                break;
                            case '3':
                                if($level_row['ANSWER_CD'] == 'A'){$url= "../survey03_1.php";} 
                                else if($level_row['ANSWER_CD'] == 'B'){$url= "../survey03_2.php";} 
                                else if($level_row['ANSWER_CD'] == 'C'){$url= "../survey03.php";}
                                break;
                            case '4':
                                if($level_row['ANSWER_CD'] == 'A'){$url= "../survey04_1.php";} 
                                else{$url= "../survey04.php";}
                                break;
                            case '5':
                                if($level_row['ANSWER_CD'] == 'A'){$url= "../survey05_1.php";} 
                                else {$url= "../survey05.php";} 
                                break;
                            case '6':
                                if($level_row['ANSWER_CD'] == 'A'){$url= "../survey06_1.php";} 
                                else {$url= "../survey06.php";}
                                break;
                            case '7': 
                                if($level_row['ANSWER_CD'] == 'A'){$url= "../survey07_1.php";} 
                                else {$url= "../survey07.php";}
                                break;
                            case '8': $url= "../survey08.php";break;
                            default: return false; break;
                        }
                    ?>
                    <tr>
                        <td class="c"><?= $i; ?></td> 
                        <td class="c">
                            <? 
                            if($row3['QUES_PHASE']  == "1"){
                                echo "????????????";             
                            } else if($row3['QUES_PHASE'] == "2"){
                                echo "???????????? > ??????";
                            } else if($row3['QUES_PHASE'] == "3"){
                                echo "???????????? > ??????";
                            } else if($row3['QUES_PHASE'] == "4"){
                                echo "???????????? > ????????????";
                            } else if($row3['QUES_PHASE'] == "5" || $row3['QUES_PHASE'] == "6" || $row3['QUES_PHASE'] == "7"){
                                echo "???????????? > ????????????";
                            } else if($row3['QUES_PHASE'] == "8"){
                                echo "????????????";
                            }
                            ?>
                        <td class="c"><?= $row3['COUNT'];?></td> 
                        <td class="c"><?= $row3['POINT'];?></td> 
                        <td class="c"><?= $row3['REG_DATE']; ?></td>
                        <td class="c"><?= $row3['MOD_DATE']; ?></td>

                        <td class="c">
                            <a href="#" onclick="detail('<? echo $url;?>')" class="y_btn">??????</a>
                        </td>
                    </tr>
                    <?php $i++;} 
                    
                    $mysqli = "SELECT SUM(ANSWER_POINT) AS POINTS FROM ESG_ANSWER WHERE REG_ID = '".$row1['MEMBER_ID']."'";
                    $result = mysqli_query($dbconn, $mysqli);

                    $row_p = mysqli_fetch_array($result)
                    ?>
                    <tr>
                        <th colspan="3" class="c">??? ?????? </th> 
                        <td colspan="4" style="text-align:left"> <?php echo $row_p['POINTS'] ?></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="c">?????? ?????? </th> 
                        <td colspan="4" style="text-align:left"> <?php  ?></td>
                    </tr>
                </tbody>
                
            </table>
        </div>
        <p class="c mt20">
            <a id="gBtn1" href="survey.php" class="b_btn_big"><span>????????????</span></a>
        </p>
    </div>
    <div id="copyright">
        <p>Copyright ??? 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
    </div>
</div>

</body>
<script>
function detail(url){
    <?
        $_SESSION['mb_idx'] = $row1['IDX'];
        $_SESSION['mb_id'] = $row1['MEMBER_ID'];
        $_SESSION['mb_name'] = $row1['MEMBER_NAME'];
    ?>
    window.open(url,"_blank");
}
</script>
</html>

