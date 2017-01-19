<?php
error_reporting(E_ALL | E_NOTICE);
ini_set('display_errors','1');

if(!isset($_SESSION)){
    session_start();
    }
   
?>

<html>
    <head>
        <title> Choose Tickets</title>
    </head>
    <body>
        <h2> Choose your tickets</h2>
        

<form method="POST" action="yourtickets.php">
  <p><strong>Select your ticket(s):</strong><br>
      <label for="Lotto649">Six sets of LOTTO 6/49 numbers</label>
      <input type="checkbox" id="Lotto649" name="lotto649" value="Lotto 6/49"><br />
      <label for="LottoMAX">Six sets of LOTTO MAX numbers</label>
      <input type="checkbox" id="LottoMAX" name="lottomax" value="Lotto MAX"><br />

  <p><input type="submit" value="submit"/></p>
 
</form>

  
      
    </body>
</html>
