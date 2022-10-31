<?php
include('../_inc/inc.php');
include('../_inc/db.php');

// && isset($_POST['mb_pw'])
if(isset($_POST['mb_id']) ){
    $mb_id = mysqli_real_escape_string($dbconn, $_POST['mb_id']);
    // $mb_pw = mysqli_real_escape_string($dbconn, $_POST['mb_pw']);

    if(empty($mb_id)){
        echo "<script> alert('아이디를 입력해주세요.'); location.href='../login.php';</script>";
        exit();
    } else {
        $sql = "SELECT * FROM ESG_MEMBER WHERE MEMBER_ID = '$mb_id'";
        $result = mysqli_query($dbconn,$sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);

            $_SESSION['mb_id'] = $row['MEMBER_ID'];
            $_SESSION['mb_name'] = $row['MEMBER_NAME'];
            $_SESSION['mb_idx'] = $row['IDX'];
            $_SESSION['admin'] = "";

            $query = "SELECT * FROM ESG_SURVEY_MASTER WHERE SURVEY_NAME = '한화' AND SURVEY_YEAR = '2022' AND REG_ID = '$mb_id' ORDER BY QUES_PHASE DESC LIMIT 1";
            $q_result = mysqli_query($dbconn, $query);
            $q_row = mysqli_fetch_assoc($q_result);

            if($q_row['SUBMIT_YN'] == 'Y'){
                $_SESSION['submited'] = $q_row['SUBMIT_YN'];
                echo "<script> alert('최종 제출 완료되어 답변 수정이 불가합니다.'); location.href='../survey01.php';</script>";
            }

            $sql = "SELECT * FROM ESG_ANSWER WHERE REG_ID = '$mb_id' and QUES_CD = 'HTE-G-00'";
            $levelresult = mysqli_query($dbconn,$sql);
    
            $level_row = mysqli_fetch_assoc($levelresult);
            
            if($level_row['ANSWER_CD'] == 'A'){//중소기업
                switch ($q_row['QUES_PHASE']) {
                    case '1': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey01.php';</script>";break;
                    case '2': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey02_1.php';</script>";break;
                    case '3': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey03_1.php';</script>";break;
                    case '4': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey04_1.php';</script>";break;
                    case '5': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey05_1.php';</script>";break;
                    case '6': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey06_1.php';</script>";break;
                    case '7': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey07_1.php';</script>";break;
                    case '8': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey08.php';</script>";break;
                    default: header("location: ../guide.php"); break;
                  }
            }else if($level_row['ANSWER_CD'] == 'B'){//중견기업
                switch ($q_row['QUES_PHASE']) {
                    case '1': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey01.php';</script>";break;
                    case '2': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey02_2.php';</script>";break;
                    case '3': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey03_2.php';</script>";break;
                    case '4': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey04.php';</script>";break;
                    case '5': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey05.php';</script>";break;
                    case '6': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey06.php';</script>";break;
                    case '7': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey07.php';</script>";break;
                    case '8': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey08.php';</script>";break;
                    default: header("location: ../guide.php"); break;
                  }
            }else if($level_row['ANSWER_CD'] == 'C'){//대기업
                switch ($q_row['QUES_PHASE']) {
                    case '1': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey01.php';</script>";break;
                    case '2': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey02.php';</script>";break;
                    case '3': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey03.php';</script>";break;
                    case '4': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey04.php';</script>";break;
                    case '5': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey05.php';</script>";break;
                    case '6': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey06.php';</script>";break;
                    case '7': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey07.php';</script>";break;
                    case '8': echo "<script> alert('마지막으로 저장 된 페이지로 이동합니다.'); location.href='../survey08.php';</script>";break;
                    default: header("location: ../guide.php"); break;
                  }
            }else{
                echo "<script> location.href='../guide.php';</script>";
            }


        } else {
            echo "<script> alert('아이디가 일치하지 않습니다.'); location.href='../login.php';</script>";
        }
    }
} else {
    echo "<script> alert('알 수 없는 에러.'); location.href='../login.php';</script>";
}
?>

