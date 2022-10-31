<?php

    function abccheck($answr,$pnts1,$pnts2,$pnts3){
        if($answr == "A"){
			$pnts = $pnts1;
		}elseif($answr == "B"){
			$pnts = $pnts2;
		}elseif($answr == "C"){
			$pnts = $pnts3;	
		}
        return $pnts;
    }

    function abccheck1($answr,$pnts1,$pnts2,$pnts3){
        if($answr == "Y"){
			$pnts = $pnts1;
		}elseif($answr == "X"){
			$pnts = $pnts2;
		}elseif($answr == "N"){
			$pnts = $pnts3;	
		}
        return $pnts;
    }

    function ynxcheck($answr1,$answr2,$answr3,$p1,$p2,$p3){
        if($answr1 == "Y"){
            $pnt1=$p1;
        } else if($answr1 == "N"){
            $pnt1=$p2;
        } else if($answr1 == "X"){
            $pnt1=$p3;
        }
        if($answr2 == "Y"){
            $pnt2=$p1;
        } else if($answr2 == "N"){
            $pnt2=$p2;
        } else if($answr2 == "X"){
            $pnt2=$p3;
        }
        if($answr3 == "Y"){
            $pnt3=$p1;
        } else if($answr3 == "N"){
            $pnt3=$p2;
        } else if($answr3 == "X"){
            $pnt3=$p3;
        }
        return $pnt1+$pnt2+$pnt3;
    }
    function ynxcheck1($answr1,$answr2,$p1,$p2,$p3){
        if($answr1 == "Y"){
            $pnt1=$p1;
        } else if($answr1 == "N"){
            $pnt1=$p2;
        } else if($answr1 == "X"){
            $pnt1=$p3;
        }
        if($answr2 == "Y"){
            $pnt2=$p1;
        } else if($answr2 == "N"){
            $pnt2=$p2;
        } else if($answr2 == "X"){
            $pnt2=$p3;
        }
        return $pnt1+$pnt2;
    }

    function yearscheck($year1,$year2,$year3,$p1,$p2,$p3){
        //p1 = 1, p2 = 0, p3 = 0.5
        /* if(2019 < 2020 ) 2개년 상향 = 0.5점
        3개년 상향? = 1점
        
        if 2개년 하향 = 0.5감점
        3개년 하향? = 1점 감점 */

       // $pnts = 0;

        if($year1 < $year2){ //0.5부터 시작
            if($year2 < $year3){
                return $p1;
            }
            else if($year2 > $year3){
                return $p2;
            }
            else if($year2 = $year3){
                return $p3;
            }
        }
        if($year1 > $year2){ //-0.5부터 시작
            if($year2 < $year3){
                return $p2;
            }
            else if($year2 > $year3){
                return $p1*-1;
            }
            else if($year2 = $year3){
                return $p3*-1;
            }
        }
        if($year1 = $year2){ //0부터 시작
            if($year2 < $year3){
                return $p3;
            }
            else if($year2 > $year3){
                return $p3*-1;
            }
            else if($year2 = $year3){
                return $p2;
            }
        }

		return $pnts;
    }

    function checkcount($answr,$p1,$p2,$p3){
        $count = count($answr);
        if($count>=1 && $count<5){
            return $p1;
        }else if($count>=5 && $count<9){
            return $p2;
        }else if($count>=9 && $count<=11){
            return $p3;
        }else{
            return "0";
        }
    }
?>