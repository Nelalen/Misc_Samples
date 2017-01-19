<?php
error_reporting(E_ALL | E_NOTICE);
ini_set('display_errors','1');

if(!isset($_SESSION)){
    session_start();
    }
   
?>

<html>
    <head>
        <title> Your Tickets</title>
    </head>
    <body>
        <h2> Here are your ticket numbers!</h2>

<?php
function lotteryNumbers($min_num, $max_num, $amount_of_num)
{
    $range = range($min_num, $max_num);
    shuffle($range);
    $numbers_array = array_slice($range, 0, $amount_of_num);
    natsort($numbers_array);
    return array_values($numbers_array);
}

if (isset($_POST['lotto649'])) {
        echo "<h2>LOTTO 6/49</h2>";
  $lotto_set = array();
        for ($i = 1; $i <= 6; $i++) {
            $lotto_set = lotteryNumbers(1, 49, 6);
            echo implode(",", $lotto_set) . "<br />";
        }
}

if (isset($_POST['lottomax'])) {
        echo "<h2>LOTTO MAX</h2>";
  $lotto_set = array();
        for ($i = 1; $i <= 6; $i++) {
            $lotto_set = lotteryNumbers(1, 49, 7);
            echo implode(",", $lotto_set) . "<br />";
        }
}

?>
  
    </body>
</html>
