<?php
session_start();

$MOVIE = [
  "ACT" => ["title" => "Avengers: Engame", "rating" => "M", "times" => ["WED" => "T21", "THU" => "T21", "FRI" => "T21", "SAT" => "T18", "SUN" => "T18"]],
  "RMC" => ["title" => "Top End Wedding", "rating" => "M","times" => ["MON" => "T18", "TUE" => "T18", "SAT" => "T15", "SUN" => "T15"]],
  "ANM" => ["title" => "Dumbo", "rating" => "PG","times" => ["MON" => "T12", "TUE" => "T12", "WED" => "T18", "THU" => "T18", "FRI" => "T18", "SAT" => "T12", "SUN" => "T12"]],
  "AHF" => ["title" => "The Happy Prince", "rating" => "M","times" => ["WED" => "T12", "THU" => "T12", "FRI" => "T12", "SAT" => "T21", "SUN" => "T21"]]
];

// Put your PHP functions and modules here

function checkName($name) {
  return preg_match("/^[a-zA-Z \-.']{1,100}$/", $name) ? true : false;
}

function checkEmail($email) {

}

function checkMobile($mobile) {

}

function checkCard($card) {

}

function checkExpiry($expiry) {
  
}

/** Can only be called after $_SESSION is initialised */
function generateTickets() {
  $seats = $_SESSION["cart"]["seats"];
  for($i = 0; $i < $seats["STA"]; $i++) {
    generateTicket("STA");
  }
  for($i = 0; $i < $seats["STP"]; $i++) {
    generateTicket("STP");
  }
  for($i = 0; $i < $seats["STC"]; $i++) {
    generateTicket("STC");
  }
  for($i = 0; $i < $seats["FCA"]; $i++) {
    generateTicket("FCA");
  }
  for($i = 0; $i < $seats["FCP"]; $i++) {
    generateTicket("FCP");
  }
  for($i = 0; $i < $seats["FCC"]; $i++) {
    generateTicket("FCC");
  }
}

$seatCount = 0;
function generateTicket($type) {
  $seat = "";
  global $MOVIE;
  
  $title = $MOVIE[$_SESSION["cart"]["movie"]["id"]]["title"];
  $rating = $MOVIE[$_SESSION["cart"]["movie"]["id"]]["rating"];

  global $seatCount;
  $seatCount++;
  
  switch($type) {
    case "STA":
    $seat = "Standard Adult";
    break;
    case "STP":
    $seat = "Standard Concession";
    break;
    case "STC":
    $seat = "Standard Child";
    break;
    case "FCA":
    $seat = "First Class Adult";
    break;
    case "FCP":
    $seat = "First Class Concession";
    break;
    case "FCC":
    $seat = "First Class Child";
    break;
    default:
    $seat = "Unknown Seat";
  }
  
  $ticket = <<<TICKET
  <div class = "ticket">
    <img src="../../media/barcode.png" style="float: right">
    <h2>Lunardo Cinema | ADMIT ONE</h2>
    <hr>
    <h2>$title (M)</h2>
    <p>Wednesday 7:30PM | $seat<br>Row D | Seat $seatCount</p>
  </div>
TICKET;

  echo($ticket);
}

function php2js( $arr, $arrName ) {
  $lineEnd="";
  echo "<script>\n";
  echo "/* Generated with A4's php2js() function */";
  echo "  var $arrName = ".json_encode($arr, JSON_PRETTY_PRINT);
  echo "</script>\n\n";
}

function preShow( $arr, $returnAsString=false ) {
  $ret  = '<pre>' . print_r($arr, true) . '</pre>';
  if ($returnAsString)
    return $ret;
  else 
    echo $ret; 
}


function printMyCode() {
  $lines = file($_SERVER['SCRIPT_FILENAME']);
  echo "<pre class='mycode'><ol>";
  foreach ($lines as $line)
    echo '<li>'.rtrim(htmlentities($line)).'</li>';
  echo '</ol></pre>';
}


?>