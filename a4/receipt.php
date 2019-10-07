<?php
include_once('tools.php');

if(!empty($_SESSION)) {
    $numSeats = $_SESSION["cart"]["seats"]["STA"];
    echo $numSeats;

} else {
    header("Location: index.php");
}

preShow($_SESSION);
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
        <div id="receipt">
        </div>
    </section>

    <section id="tickets">
        <div class = "ticket">
            <img src="../../media/barcode.png" style="float: right">
            <h2>Lunardo Cinema | ADMIT ONE</h2>
            <hr>
            <h2>Test Ticket (M)</h2>
            <p>Wednesday 7:30PM | Seat</p>
        </div>
        <?php generateTickets(); ?>
    </section> 

</body>

</html>