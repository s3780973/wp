<?php
include_once('tools.php');

if(!empty($_SESSION)) {
    $numSeats = $_SESSION["cart"]["seats"]["STA"];
    echo $numSeats;

} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang='en'>

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

<body>
    <section id="info">
        <div class="receipt">
            <h2>Booking Successful!</h2>
            <h2>Company Details</h2>
            <hr>
            <p>Name</p>
            <p class="price">Lunardo Cinema</p>
            <p>ABN Number</p>
            <p class="price">00 123 456 789</p>
            <p>Address</p>
            <p class="price">512 Raspberry Rd</p>
            <h2>Customer Details</h2>
            <hr>
            <p>Name: <?php echo $_SESSION["cart"]["cust"]["name"]; ?></p>
            <p>Email: <?php echo $_SESSION["cart"]["cust"]["email"]; ?></p>
            <p>Mobile: <?php echo $_SESSION["cart"]["cust"]["mobile"]; ?></p>
            <p>Card Number: <?php echo $_SESSION["cart"]["cust"]["card"]; ?></p>
            <p>Card Expiry: <?php echo $_SESSION["cart"]["cust"]["expiry"]; ?></p>
            <h2>Payment Information</h2>
            <hr>
            <?php generateSeatPricesHTML(); ?>
            <br>
            <p>Total: $<?php echo sprintf("%.2f", calculateTotal($_SESSION["cart"])); ?></p>
            <p>Total GST: $<?php echo sprintf("%.2f", calculateTotal($_SESSION["cart"]) / 11); ?></p>   
        </div>
    </section>

    <section id="tickets">
        <?php generateTickets(); ?>
    </section> 

    <?php 
    preShow($_SESSION);
    ?>

</body>

</html>