<?php

//******************************* funtion that will choose  a synomyme randomly
function syn_choose($s) {
    $final = "";
    $syn = "";
    $check = true;
    for ($j = 0; $j < strlen($s); $j++) {
        if ($s[$j] == '{')
            $check = false;
        if ($s[$j] == '}') {
            $check = true;
            $t = explode("|", $syn);
            $k = rand(0, (count($t) - 1));
            $final.=$t[$k];
            $syn = "";
        }
        if ($check && $s[$j] != '{' && $s[$j] != '}')
            $final .= $s[$j];
        if (!$check && $s[$j] != '{' && $s[$j] != '}')
            $syn .= $s[$j];
    }

    return $final;
}

//************** end function -********************
//getting datas
$GENDER = $_POST['gender'];
if ($GENDER == "male") {
    $He = "He";
    $he = "he";
    $His = "His";
    $his = "his";
    $Him = "Him";
    $him = "him";
    $himself = "himself";  
}

if ($GENDER == "female") {
    $He = "She";
    $he = "she";
    $His = "Her";
    $his = "her";
    $Him = "Her";
    $him = "her";
    $himself = "herself";
}

$NAME = $_POST['name'];
$POSTITLE = $_POST['postitle'];
$POSDESC = $_POST['posdescr'];
$COMPANY = $_POST['company'];
$SKILLS = $_POST['skills'];

// group of sentences
$group_1 = "";
$group_1[] = "$NAME is {a great|the best} $POSDESC at $COMPANY. $His $SKILLS as $POSTITLE are (unique|exceptional). Working with $him is always interesting and productive.";
$group_1[] = "Working with $NAME is always fascinating. $NAME is {a great|the best} $POSDESC at $COMPANY. $His $SKILLS as $POSTITLE are (unique|exceptional).";
$group_1[] = "$NAME's $SKILLS as $POSTITLE are (unique|exceptional). $NAME was amazing $POSDESC at $COMPANY.";

// result that will be sent to html
$result = "";
$i = rand(0, (count($group_1) - 1));
$result[] = syn_choose($group_1[$i]);

// sending data
echo json_encode($result);
?>