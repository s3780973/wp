<?php
include_once('tools.php');

if(!empty($_SESSION)) {
    $file = fopen("bookings.txt", "a");

    flock($file, LOCK_EX);
    //fputcsv($file, getFileData(), ",");
    flock($file, LOCK_UN);

    fclose($file);

} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html id="receipt" lang='en'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A4 Receipt</title>

    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">
    <script src='../wireframe.js'></script>

    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative:700|Pacifico&display=swap" rel="stylesheet">
    <!-- Title -->
	
	<script type="text/javascript" src="../a4/script.js"></script>
</head>

<body id="receipt">
    <section id="info">
        <div class="receipt">
            <h1>Lunardo Cinema</h1>
            <p style="text-align: center">ABN: 00 123 456 789</p>
            <br>
            <h2>Session Details</h2>
            <hr>
            <p>Title: <?php echo $MOVIE[$_SESSION["cart"]["movie"]["id"]]["title"]." (".$MOVIE[$_SESSION["cart"]["movie"]["id"]]["rating"],")"; ?></p>
            <p>Session: <?php echo $DAY_NAMES[$_SESSION["cart"]["movie"]["day"]]." ".$TIME_NAMES[$_SESSION["cart"]["movie"]["hour"]]; ?></p>
            <br>
            <h2>Customer Details</h2>
            <hr>
            <p>Name: <?php echo $_SESSION["cart"]["cust"]["name"]; ?></p>
            <p>Email: <?php echo $_SESSION["cart"]["cust"]["email"]; ?></p>
            <p>Mobile: <?php echo $_SESSION["cart"]["cust"]["mobile"]; ?></p>
            <p>Card Number: <?php echo $_SESSION["cart"]["cust"]["card"]; ?></p>
            <p>Card Expiry: <?php echo $_SESSION["cart"]["cust"]["expiry"]; ?></p>
            <br>
            <h2>Payment Information</h2>
            <hr>
            <?php
            foreach($_SESSION["cart"]["seats"] as $key => $value) {
              if(calculateSeatPrice($_SESSION["cart"], $key) > 0) {
                echo "<p>".$_SESSION["cart"]["seats"][$key]."x ".$SEAT_NAMES[$key].": $".sprintf("%.2f",calculateSeatPrice($_SESSION["cart"], $key))."<p>";
              }
            }
            ?>
            <br>
            <p>Total: $<?php echo sprintf("%.2f", calculateTotal($_SESSION["cart"])); ?></p>
            <p>Includes GST: $<?php echo sprintf("%.2f", calculateTotal($_SESSION["cart"]) / 11); ?></p>  
            <br><br><hr>
            <p style="text-align: center">Contact Us: Phone: 94 852 720 | Address: 512 Rasperry Road</p>

        </div>
    </section>

    <section id="tickets">
	<br>
        <?php generateTickets(); ?>
    </section> 

</body>

</html>