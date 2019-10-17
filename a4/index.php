<?php
include_once('tools.php');

$totalPrice = 0;

$ERROR = [
    "name" => ["valid" => false, "message" => "Names can include letters a-z, ( ' ), ( _ ) or ( - )"],
    "email" => ["valid" => false, "message" => "Emails must be in the format example@email.com"],
    "mobile" => ["valid" => false, "message" => "Mobile must be an Australian number"],
    "card" => ["valid" => false, "message" => "Card numbers must include 15-19 numbers"],
    "expiry" => ["valid" => false, "message" => "Expiry must be at least 1 month ahead from today"],
    "totalPrice" => ["valid" => false, "message" => "You must buy at least 1 ticket"],
    "movieID" => ["valid" => false, "message" => "Stop trying to hack our website! (Invalid movie id)"],
    "time" => ["valid" => false, "message" => "Stop trying to hack our website! (Invalid movie date and time)"],
    "seats" => ["valid" => false, "message" => "Stop trying to hack our website! (Invalid seat amount)"]
];

$errorCount = 0;

if(!empty($_POST)) {
	
	//<--------- VALIDATION --------->

    //validate name
    if(!empty($_POST['cust']['name'])) {
        $name = $_POST["cust"]['name'];
        $ERROR["name"]["valid"] = checkName($name);
    }

    //validate email
    if(!empty($_POST['cust']['email'])) {
        $email = $_POST["cust"]['email'];
        $ERROR["email"]["valid"] = checkEmail($email);
    }

    //validate mobile
    if(!empty($_POST['cust']['mobile'])) {
        $mobile = $_POST["cust"]['mobile'];
        $ERROR["mobile"]["valid"] = checkMobile($mobile);
    }

    //validate card
    if(!empty($_POST['cust']['card'])) {
        $card = $_POST["cust"]['card'];
        $ERROR["card"]["valid"] = checkName($name);
    }

    //validate expiry
    if(!empty($_POST['cust']['expiry'])) {
        $expiry = $_POST["cust"]['expiry'];
        $ERROR["expiry"]["valid"] = @checkExpiry($expiry);
    }

    //valite seats (price must be more than $0 and cannot buy negative or greater than 10 seats)
    if(!empty($_POST['seats'])) {
        $totalPrice = calculateTotal($_POST);
        $ERROR["totalPrice"]["valid"] = $totalPrice > 0;

        $seatErrorCount = 0;
        foreach($_POST["seats"] as $key => $value) {
            if($value < 0 || $value > 10) {
                $seatErrorCount++;
            }
        }

        $ERROR["seats"]["valid"] = $seatErrorCount === 0;
    }

    //validate movie id
    if(!empty($_POST["movie"]["id"])) {
        $movieID = $_POST["movie"]["id"];
        
		global $MOVIE;
        $ERROR["movieID"]["valid"] = array_key_exists($movieID, $MOVIE);
    }

    //validate movie day and time
	if(!empty($_POST["movie"]["day"]) && !empty($_POST["movie"]["hour"])) {
		$day = $_POST["movie"]["day"];
		$time = $_POST["movie"]["hour"];
		
		global $MOVIE;
		$ERROR["time"]["valid"] = ($time == @$MOVIE[$_POST["movie"]["id"]]["times"][$day]);
	}
		
	//<------- ERROR DETECTION -------->
    
    //Check for errors and if present, increment the error count
    foreach($ERROR as $item) {
        if(!$item["valid"]) $errorCount++;
    }

	//If no errors, submit and redirect to ticket page
	//Redirects to receipt.php
    if($errorCount == 0) {
        $_SESSION["cart"] = $_POST;
        header("Location: receipt.php");
    }
    
    //<----------- ALERTS ----------->
	
	//Show alert if hidden movieID field is invalid
    if(!$ERROR["movieID"]["valid"]) {
        showErrorAlert($ERROR["movieID"]["message"]);
    }
	
	//Show alert if hidden time and hour field is invalid
	if(!$ERROR["time"]["valid"]) {
		showErrorAlert($ERROR["time"]["message"]);
    }

    //Show alert if seat values are invalid
    if(!$ERROR["seats"]["valid"]) {
        showErrorAlert($ERROR["seats"]["message"]);
    }
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 4</title>

    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">
    <script src='../wireframe.js'></script>

    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative:700|Pacifico&display=swap" rel="stylesheet">
    <!-- Title -->
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cinzel&display=swap" rel="stylesheet">
	
	<script type="text/javascript" src="../a4/script.js"></script>
</head>

<body>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header class="heading">
            <img src='../../media/cinema-logo.png' />
            <span>Lunardo Cinema</span>
            <img class="right" src='../../media/cinema-logo.png' />

        </header>

        <!-- Nav -->
        <nav id="navbar">
            <ul>
                <li><a href="#about_us">About Us</a></li>
                <li><a href="#prices">Prices</a></li>
                <li><a href="#now_showing">Now Showing</a></li>
            </ul>
        </nav>

        <!-- Main -->
        <main>

            <!-- About Us -->
            <section id="about_us">
                <header class="topic">
                    <h2>About Us</h2>
                    <p>Welcome to the Lunardo Cinema!
                        <br> We are very excited to announce our brand new Cinema after extensive improvements and renovations. From upgrading our seating to comfy leather recliners, to overhauling our projector and sound systems, we hope to bring an all new movie experience for you, your friends and family!</p>
                    <h2>Whats New</h2>
                    <div>
                        <p class="title">Standard Seating</p>
                        <p class="desc">Our new standard seats have been made a lot softer and much more comfier, perfect for those lengthy films!</p>
                        <img src='../../media/standard-seat.png' />
                    </div>
                    <div>
                        <p class="title">First Class Seating</p>
                        <p>Our first class seats have been replaced with recliners and now include a food tray, no need to fear the front rows anymore!</p>
                        <img src='../../media/first-class-seat.png' />
                    </div>
                    <div>
                        <p class="title">Projectors</p>
                        <p>With our brand new Dolby 3D projectors, you can choose to now watch your favourite movies in 3D!</p>
                        <img src='../../media/projector.png' />
                    </div>
                    <div>
                        <p class="title">Sound System</p>
                        <p>Our brand new Dolby sound system now allows sound to come from all over the room, giving an immersive experience!</p>
                        <img src='../../media/sound-system.png' />
                    </div>
                </header>
            </section>

            <!-- Prices -->
            <section id="prices">
                <header class="topic">
                    <h2>Prices</h2>
                    <p>Tickets for the Lunardo Cinema are available online or at our theatres. We offer discount ticket prices on Mondays, Wednesdays and all weekdays at 12PM. First Class seating tickets are also available if your looking for a special movie experience!</p>
                    <div>
                        <h2>Standard Seating</h2>
                        <table>
                            <tr>
                                <th>Seat</th>
                                <th>Mondays, Wednesdays and Weekdays 12PM</th>
                                <th>Other Times</th>
                            </tr>
                            <tr>
                                <td>Adult</td>
                                <td>$14.00</td>
                                <td>$19.80</td>
                            </tr>
                            <tr>
                                <td>Concession</td>
                                <td>$12.50</td>
                                <td>$17.50</td>
                            </tr>
                            <tr>
                                <td>Child</td>
                                <td>$11.00</td>
                                <td>$15.30</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <h2>First Class Seating</h2>
                        <table>
                            <tr>
                                <th>Seat</th>
                                <th>Mondays, Wednesdays and Weekdays 12PM</th>
                                <th>Other Times</th>
                            </tr>
                            <tr>
                                <td>Adult</td>
                                <td>$24.00</td>
                                <td>$30.00</td>
                            </tr>
                            <tr>
                                <td>Concession</td>
                                <td>$22.50</td>
                                <td>$27.00</td>
                            </tr>
                            <tr>
                                <td>Child</td>
                                <td>$21.00</td>
                                <td>$24.00</td>
                            </tr>
                        </table>
                    </div>
                </header>
            </section>

            <!-- Now Showing -->
            <section id="now_showing">
                <header class="topic">
                    <h2>Now Showing</h2>
                    <p>We are currently screening the following movies all weekdays and weekends
                        <br>(Click a movie to show synopsis)</p>
                    <div class="movie" id="moviePanelATN" onclick='displaySynopsis(0)'>
                        <img src='../../media/avengers-endgame.png' />
                        <p class="title">Avengers: Engame M</p>
                        <p class="times">Times:
                            <br>Wednesday 9PM
                            <br>Thursday 9PM
                            <br>Friday 9PM
                            <br>Saturday 6PM
                            <br>Sunday 6PM</p>
                    </div>
                    <div class="movie" id="moviePanelRMC" onclick='displaySynopsis(1)'>
                        <img src='../../media/top-end-wedding.png' />
                        <p class="title">Top End Wedding M</p>
                        <p class="times">Times:
                            <br>Monday 6PM
                            <br>Tuesday 6PM
                            <br>Saturday 3PM
                            <br>Sunday 3PM</p>
                    </div>
                    <div class="movie" id="moviePanelANM" onclick='displaySynopsis(2)'>
                        <img src='../../media/dumbo.png' />
                        <p class="title">Dumbo PG</p>
                        <p class="times">Times:
                            <br>Monday 12PM
                            <br>Tuesday 12PM
                            <br>Wednesday 6PM
                            <br>Thursday 6PM
                            <br>Friday 6PM
                            <br>Saturday 12PM
                            <br>Sunday 12PM</p>
                    </div>
                    <div class="movie" id="moviePanelAHF" onclick='displaySynopsis(3)'>
                        <img src='../../media/the-happy-prince.png' />
                        <p class="title">The Happy Prince MA</p>
                        <p class="times">Times:
                            <br>Wednesday 12PM
                            <br>Thursday 12PM
                            <br>Friday 12PM
                            <br>Saturday 9PM
                            <br>Sunday 9PM</p>
                    </div class="synopsis">

                    <article id="synopsisACT">
                        <h2>The Avengers: Endgame (M)</h2>
                        <div class="synopsis">
                            <p class="title">Plot Description:</p>
                            <p>Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their vanquished allies for an epic showdown with Thanos -- the evil demigod who decimated the planet and the universe.</p>
                        </div>
                        <iframe src="https://www.youtube.com/embed/TcMBFSGVi1c"></iframe>
                        <span class="title">Make a booking:</span>
                        <button type="button" onclick='updateForm("ACT", 0)'>Wednesday 9PM</button>
                        <button type="button" onclick='updateForm("ACT", 1)'>Thursday 9PM</button>
                        <button type="button" onclick='updateForm("ACT", 2)'>Friday 9PM</button>
                        <button type="button" onclick='updateForm("ACT", 3)'>Saturday 6PM</button>
                        <button type="button" onclick='updateForm("ACT", 4)'>Sunday 6PM</button>
                    </article>

                    <article id="synopsisRMC">
                        <h2>Top End Wedding (M)</h2>
                        <div class="synopsis">
                            <p class="title">Plot Description:</p>
                            <p>Lauren and Ned have 10 days to find Lauren's mother who has gone AWOL in the remote far north of Australia so that they can reunite her parents and pull off their dream wedding.</p>
                        </div>
                        <iframe src="https://www.youtube.com/embed/j5ZXCCM-IVo"></iframe>
                        <span class="title">Make a booking:</span>
                        <button type="button" onclick='updateForm("RMC", 0)'>Monday 6PM</button>
                        <button type="button" onclick='updateForm("RMC", 1)'>Tuesday 6PM</button>
                        <button type="button" onclick='updateForm("RMC", 2)'>Saturday 3PM</button>
                        <button type="button" onclick='updateForm("RMC", 3)'>Sunday 3PM</button>
                    </article>

                    <article id="synopsisANM">
                        <h2>Dumbo (PG)</h2>
                        <div class="synopsis">
                            <p class="title">Plot Description:</p>
                            <p>A young circus elephant is born with comically large ears and given the cruel nickname Dumbo. One day at a show, he is taunted by a group of kids, inciting his mother into a rage that gets her locked up. After Dumbo's ears cause an accident that injures many of the other elephants, he is made to dress like a clown and perform dangerous stunts. Everything changes when Dumbo discovers that his enormous ears actually allow him to fly, and he astounds everyone at the circus with his new talent.</p>
                        </div>
                        <iframe src="https://www.youtube.com/embed/7NiYVoqBt-8"></iframe>
                        <span class="title">Make a booking:</span>
                        <button type="button" onclick='updateForm("ANM", 0)'>Monday 12PM</button>
                        <button type="button" onclick='updateForm("ANM", 1)'>Tuesday 12PM</button>
                        <button type="button" onclick='updateForm("ANM", 2)'>Wednesday 6PM</button>
                        <button type="button" onclick='updateForm("ANM", 3)'>Thursday 6PM</button>
                        <button type="button" onclick='updateForm("ANM", 4)'>Friday 6PM</button>
                        <button type="button" onclick='updateForm("ANM", 5)'>Saturday 12PM</button>
                        <button type="button" onclick='updateForm("ANM", 6)'>Sunday 12PM</button>
                    </article>

                    <article id="synopsisAHF">
                        <h2>The Happy Prince (MA)</h2>
                        <div class="synopsis">
                            <p class="title">Plot Description:</p>
                            <p>His body ailing, Oscar Wilde lives out his last days in exile, observing the difficulties and failures surrounding him with ironic detachment, humour, and the wit that defined his life.</p>
                        </div>
                        <iframe src="https://www.youtube.com/embed/4HmN9r1Fcr8"></iframe>
                        <span class="title">Make a booking:</span>
                        <button type="button" onclick='updateForm("AHF", 0)'>Wednesday 12PM</button>
                        <button type="button" onclick='updateForm("AHF", 1)'>Thursday 12PM</button>
                        <button type="button" onclick='updateForm("AHF", 2)'>Friday 12PM</button>
                        <button type="button" onclick='updateForm("AHF", 3)'>Saturday 9PM</button>
                        <button type="button" onclick='updateForm("AHF", 4)'>Sunday 9PM</button>
                    </article>
                </header>
            </section>

            <article id="booking_form">
            <!-- action="https://titan.csit.rmit.edu.au/~e54061/wp/lunardo-formtest.php" -->
                <form id="booking" action="index.php"  method="post"> <!-- onsubmit="return validateForm()" -->
                    <h2 id="booking_title">Default Movie Title</h2>
                    
                    <input id="movie-id" name="movie[id]" type="hidden">
                    <input id="movie-day" name="movie[day]" type="hidden">
                    <input id="movie-hour" name="movie[hour]" type="hidden">
                    
                    <div id="seating">
                    <h2>Standard Seating</h2>
                        <div class="wrap">
                            <label for="seats-STA">Adults</label>
                            <select id="seats-STA" name="seats[STA]" value="<?php echo isset($_POST["seats"]["STA"]) ? $_POST["seats"]["STA"] : 0; ?>" onchange="calculate()">
                                <option value=0>Please select</option>
                                <script>
                                    genOptions(10);
                                </script>
                            </select>
                            <br>
                            </select>
                            <label for="seats-STP">Concession</label>
                            <select id="seats-STP" name="seats[STP]" onchange="calculate()">
                                <option value=0>Please select</option>
                                <script>
                                    genOptions(10);
                                </script>
                            </select>
                            <br>
                            <label for="seats-STC">Children</label>
                            <select id="seats-STC" name="seats[STC]" onchange="calculate()">
                                <option value=0>Please select</option>
                                <script>
                                    genOptions(10);
                                </script>
                            </select>
                        </div>
                        
                        <h2>First Class Seating</h2>
                        <div class="wrap">
                            <label for="seats-FCA">Adults</label>
                            <select id="seats-FCA" name="seats[FCA]" onchange="calculate()">
                                <option value=0>Please select</option>
                                <script>
                                    genOptions(10);
                                </script>
                            </select>
                            <br>
                            <label for="seats-FCP">Concession</label>
                            <select id="seats-FCP" name="seats[FCP]" onchange="calculate()">
                                <option value=0>Please select</option>
                                <script>
                                    genOptions(10);
                                </script>
                            </select>
                            <br>
                            <label for="seats-FCC">Children</label>
                            <select id="seats-FCC" name="seats[FCC]" onchange="calculate()">
                                <option value=0>Please select</option>
                                <script>
                                    genOptions(10);
                                </script>
                            </select>
                        </div>
                    </div>
                    <div id="cust_details">
                        <label for="cust-name">Name</label>
                        <input id="cust-name" name="cust[name]" type="text" placeholder="Enter full name" value="<?php echo isset($_POST["cust"]["name"]) ? $_POST["cust"]["name"] : ""; ?>" oninput="'checkName()'">
                        <br>   
                        <p class="error" id="name-invalid"><?php echo $ERROR["name"]["valid"] ? "" : $ERROR["name"]["message"] ?></p>    
                        <label for="cust-email">Email</label>
                        <input id="cust-email" name="cust[email]" type="email" placeholder="Enter email" value="<?php echo isset($_POST["cust"]["email"]) ? $_POST["cust"]["email"] : ""; ?>">
                        <br>
						<p class="error" id="email-invalid"><?php echo $ERROR["email"]["valid"] ? "" : $ERROR["email"]["message"] ?></p>
                        <label for="cust-mobile">Mobile</label>
                        <input id="cust-mobile" name="cust[mobile]" type="tel" placeholder="Enter mobile" value="<?php echo isset($_POST["cust"]["mobile"]) ? $_POST["cust"]["mobile"] : ""; ?>" oninput="'checkMobile()'">
                        <br>
						<p class="error" id="mobile-invalid"><?php echo $ERROR["mobile"]["valid"] ? "" : $ERROR["mobile"]["message"] ?></p>  
                        <label for="cust-card">Credit Card</label>
                        <input id="cust-card" name="cust[card]" type="text" placeholder="Enter credit card number" value="<?php echo isset($_POST["cust"]["card"]) ? $_POST["cust"]["card"] : ""; ?>" oninput="'checkCard()'">
                        <br>
						<p class="error" id="card-invalid"><?php echo $ERROR["card"]["valid"] ? "" : $ERROR["card"]["message"] ?></p>  
                        <label for="cust-expiry">Expiry</label>
                        <input id="cust-expiry" name="cust[expiry]" type="month" placeholder = "Enter credit card expiry" value="<?php echo isset($_POST["cust"]["expiry"]) ? $_POST["cust"]["expiry"] : ""; ?>" onclick="'getMinDate()'">
                        <br>
                        <p class="error" id="expiry-invalid"><?php echo $ERROR["expiry"]["valid"] ? "" : $ERROR["expiry"]["message"] ?></p>
                        <br>
                        <p class="error" id="price-invalid"><?php echo $ERROR["totalPrice"]["valid"] ? "" : $ERROR["totalPrice"]["message"] ?></p>
                    </div>
                    <input id="submit_button" type="submit" value="Submit">
                    <h2 id="total">Total: $0.00</h2>
                </form>
                </article>

        </main>

        <!-- Footer -->
        <footer>
            <div>&copy;
                <script>
                    document.write(new Date().getFullYear());
                </script> John Patrikios (s3780973) | No Group. Last modified
                <?= date("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
            <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
            <div>
                <button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button>
            </div>
        </footer>

        <?php
        preShow($_POST);
        preShow($_SESSION);
        printMyCode();
        ?>
    </div>
</body>

</html>