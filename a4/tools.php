<?php
session_start();

$MOVIE = [
  "ACT" => ["title" => "Avengers: Engame", "rating" => "M", "times" => ["WED" => "T21", "THU" => "T21", "FRI" => "T21", "SAT" => "T18", "SUN" => "T18"]],
  "RMC" => ["title" => "Top End Wedding", "rating" => "M","times" => ["MON" => "T18", "TUE" => "T18", "SAT" => "T15", "SUN" => "T15"]],
  "ANM" => ["title" => "Dumbo", "rating" => "PG","times" => ["MON" => "T12", "TUE" => "T12", "WED" => "T18", "THU" => "T18", "FRI" => "T18", "SAT" => "T12", "SUN" => "T12"]],
  "AHF" => ["title" => "The Happy Prince", "rating" => "M","times" => ["WED" => "T12", "THU" => "T12", "FRI" => "T12", "SAT" => "T21", "SUN" => "T21"]]
];

$DAY_NAMES = [
  "MON" => "Monday",
  "TUE" => "Tuesday",
  "WED" => "Wednesday",
  "THU" => "Thursday",
  "FRI" => "Friday",
  "SAT" => "Saturday",
  "SUN" => "Sunday"
];

$TIME_NAMES = [
  "T12" => "12:00PM",
  "T15" => "3:00PM",
  "T18" => "6:00PM",
  "T21" => "9:00PM"
];

$SEAT_NAMES = [
  "STA" => "Standard Adult",
  "STP" => "Standard Concession",
  "STC" => "Standard Child",
  "FCA" => "First Class Adult",
  "FCP" => "First Class Concession",
  "FCC" => "First Class Child"
];

function checkName($name) {
  return preg_match("/^[a-zA-Z \-.']{1,100}$/", $name);
}

function checkEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function checkMobile($mobile) {
  return preg_match("/^(\(04\)|04|\+614)( ?\d){8}$/", $mobile);
}

function checkCard($card) {
	//
}

function checkExpiry($expiry) {
  return strtotime($expiry) > strtotime(date("Y-m"), "+1 Months");
}

function showErrorAlert($string) {

  $alert = <<<ALERT
  <script>
  alert("$string");
  </script>
ALERT;

  echo $alert;
}

/** 
 * Checks if discount is active
 * @param $_POST prior to form submissiom
 * @param $_SESSION["cart"] after form submission
 */
function discount($array) {
  return strpos($array["movie"]["day"], "MON") !== false || strpos($array["movie"]["day"], "WED") !== false || strpos($array["movie"]["hour"], "T12") !== false;
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

/** Can only be called after $_SESSION is initialised */
function generateTickets() {
  foreach($_SESSION["cart"]["seats"] as $key => $value) {
    for($i = 0; $i < $_SESSION["cart"]["seats"][$key]; $i++) {
      generateTicket($key);
    }
  }
}

$seatCount = 0;
function generateTicket($seatID) {
  global $MOVIE;
  global $DAY_NAMES;
  global $TIME_NAMES;
  global $SEAT_NAMES;
  
  $title = $MOVIE[$_SESSION["cart"]["movie"]["id"]]["title"];
  $rating = $MOVIE[$_SESSION["cart"]["movie"]["id"]]["rating"];
  $day = $DAY_NAMES[$_SESSION["cart"]["movie"]["day"]];
  $time = $TIME_NAMES[$_SESSION["cart"]["movie"]["hour"]];
  $seat = $SEAT_NAMES[$seatID];

  $premium = ($seatID[0] == "F") ? "ticket-premium" : "ticket-standard";

  global $seatCount;
  $seatCount++;
  
  $ticket = <<<TICKET
  <div id="ticket" class= "$premium">
    <img src="../../media/barcode.png" style="float: right">
    <h2>Lunardo Cinema | ADMIT ONE</h2>
    <hr>
    <h2>$title ($rating)</h2>
    <p>$day $time | $seat<br>Location: Row D, Seat $seatCount</p>
  </div>
TICKET;

  echo($ticket);
}

/** Get the data to write to bookings.txt */
function getFileData() {
  global $DAY_NAMES;
  global $TIME_NAMES;

  $fileData = [
    date("Y-m-d h:m:s"),
    $_SESSION["cart"]["cust"]["name"],
    $_SESSION["cart"]["cust"]["email"],
    $_SESSION["cart"]["cust"]["mobile"],
    $_SESSION["cart"]["movie"]["id"],
    $DAY_NAMES[$_SESSION["cart"]["movie"]["day"]],
    $TIME_NAMES[$_SESSION["cart"]["movie"]["hour"]],
    $_SESSION["cart"]["seats"]["STA"],
    $_SESSION["cart"]["seats"]["STP"],
    $_SESSION["cart"]["seats"]["STC"],
    $_SESSION["cart"]["seats"]["FCA"],
    $_SESSION["cart"]["seats"]["FCP"],
    $_SESSION["cart"]["seats"]["FCC"],
    sprintf("%0.2f", calculateTotal($_SESSION["cart"]))
  ];

  return $fileData;
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