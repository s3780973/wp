<?php
session_start();

$MOVIE = [
  "ACT" => ["title" => "Avengers: Engame", "rating" => "M", "times" => ["WED" => "T21", "THU" => "T21", "FRI" => "T21", "SAT" => "T18", "SUN" => "T18"]],
  "RMC" => ["title" => "Top End Wedding", "rating" => "M","times" => ["MON" => "T18", "TUE" => "T18", "SAT" => "T15", "SUN" => "T15"]],
  "ANM" => ["title" => "Dumbo", "rating" => "PG","times" => ["MON" => "T12", "TUE" => "T12", "WED" => "T18", "THU" => "T18", "FRI" => "T18", "SAT" => "T12", "SUN" => "T12"]],
  "AHF" => ["title" => "The Happy Prince", "rating" => "M","times" => ["WED" => "T12", "THU" => "T12", "FRI" => "T12", "SAT" => "T21", "SUN" => "T21"]]
];

$SEATS = [
  "STA" => "Standard Adult",
  "STP" => "Standard Concession",
  "STC" => "Standard Child",
  "FCA" => "First Class Adult",
  "FCP" => "First Class Concession",
  "FCC" => "First Class Child"
];

/** 
 * Checks if discount is active
 * @param $_POST prior to form submissiom
 * @param $_SESSION["cart"] after form submission
 */
function discount($array) {
  return (strpos($array["movie"]["day"], "MON") !== false || strpos($array["movie"]["day"], "WED") !== false || strpos($array["movie"]["hour"], "T12") !== false) ? true : false;
}

function contains($needle, $haystack)
{
    return strpos($haystack, $needle) !== false;
}

// Put your PHP functions and modules here

function checkName($name) {
  return preg_match("/^[a-zA-Z \-.']{1,100}$/", $name) ? true : false;
}

function checkEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
}

function checkMobile($mobile) {
  return preg_match("/^(\(04\)|04|\+614)( ?\d){8}$/", $mobile) ? true : false;
}

function checkCard($card) {

}

function checkExpiry($expiry) {
  return strtotime($expiry) > strtotime(date("Y-m"), "+1 Months") ? true : false;
}

/**
 * Calculate total price for seats
 * @param $_POST prior to form submission
 * @param $_SESSION["cart"] after form submission
 */
function calculateTotal($array) {
  $total = 0;
  
  foreach($array["seats"] as $key => $value) {
    $total += calculateSeatPrice($array, $key);
  }

  return $total;
}

function calculateSeatPrice($array, $seatCode) {
  $price = 0;
  switch($seatCode) {
    case "STA":
    $price = ($array["seats"][$seatCode]) * (discount($array) ? 14.00 : 19.80);
    break;
    case "STP":
    $price = ($array["seats"][$seatCode]) * (discount($array) ? 12.50 : 17.50);
    break;
    case "STC":
    $price = ($array["seats"][$seatCode]) * (discount($array) ? 11.00 : 15.30);
    break;
    case "FCA":
    $price = ($array["seats"][$seatCode]) * (discount($array) ? 24.00 : 30.00);
    break;
    case "FCP":
    $price = ($array["seats"][$seatCode]) * (discount($array) ? 22.50 : 27.00);
    break;
    case "FCC":
    $price = ($array["seats"][$seatCode]) * (discount($array) ? 21.00 : 24.00);
    break;
  }

  return $price;
}

/** Generate seat prices for receipt using $_SESSION data */
function generateSeatPricesHTML() {
  global $SEATS;

  foreach($_SESSION["cart"]["seats"] as $key => $value) {
    if(calculateSeatPrice($_SESSION["cart"], $key) > 0) {
      echo "<p>".$_SESSION["cart"]["seats"][$key]."x ".$SEATS[$key]." Ticket: $".sprintf("%.2f",calculateSeatPrice($_SESSION["cart"], $key))."<p>";
    }
  }

}

/** Can only be called after $_SESSION is initialised */
function generateTickets() {
  foreach($_SESSION["cart"]["seats"] as $key => $value) {
    for($i = 0; $i < $_SESSION["cart"]["seats"][$key]; $i++) {
      generateTicket($key);
    }
  }
}

$seatCount = 0;
function generateTicket($type) {
  global $SEATS;
  global $MOVIE;
  
  $title = $MOVIE[$_SESSION["cart"]["movie"]["id"]]["title"];
  $rating = $MOVIE[$_SESSION["cart"]["movie"]["id"]]["rating"];

  global $seatCount;
  $seatCount++;
  
  $ticket = <<<TICKET
  <div class = "ticket">
    <img src="../../media/barcode.png" style="float: right">
    <h2>Lunardo Cinema | ADMIT ONE</h2>
    <hr>
    <h2>$title (M)</h2>
    <p>Wednesday 7:30PM | {$SEATS[$type]}<br>Row D | Seat $seatCount</p>
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