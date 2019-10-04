<?php
  session_start();

// Put your PHP functions and modules here

function checkName($name) {
  return ($name == "a") ? true : false;

}

function checkEmail($email) {

}

function checkMobile($mobile) {

}

function checkCard($card) {

}

function checkExpiry($expiry) {

}

function php2js( $arr, $arrName ) {
  $lineEnd="";
  echo "<script>\n";
  echo "/* Generated with A4's php2js() function */";
  echo "  var $arrName = ".json_encode($arr, JSON_PRETTY_PRINT);
  echo "</script>\n\n";
}


function printMyCode() {
  $lines = file($_SERVER['SCRIPT_FILENAME']);
  echo "<pre class='mycode'><ol>";
  foreach ($lines as $line)
     echo '<li>'.rtrim(htmlentities($line)).'</li>';
  echo '</ol></pre>';
}


?>