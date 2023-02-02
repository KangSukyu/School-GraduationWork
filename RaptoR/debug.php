<?php
    

    if (sizeof($od_paytype)>0) // 선택한 값이 1개라도 있는 경우

    {
    
        for($i=0;$i<4;$i++){ 
    
            if($od_paytype[$i]){ // 선택한 체크박스를 한개씩 붙여서 나열한다.
    
                $opt .= "'".$od_paytype[$i]."',"; // 작은 따옴표와 콤마를 붙여서 문자열을 만들어준다.
    
            }
    
        }
    
        $opt = substr($opt, 0, -1); // 문자열 마지막 문자(콤마) 삭제
    
        $SRCH_SQL .= " AND od_paytype in ({$opt})";
    
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>