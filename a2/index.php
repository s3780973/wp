<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>

    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">
    <script src='../wireframe.js'></script>

    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative:700|Pacifico&display=swap" rel="stylesheet"> <!-- Title -->
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cinzel&display=swap" rel="stylesheet">
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
                    <p>Welcome to the Lunardo Cinema!<br> We are very excited to announce our brand new Cinema after extensive improvements and renovations. From upgrading our seating to comfy leather recliners,
                        to overhauling our projector and sound systems, we hope to bring an all new movie experience for you, your friends and family!</p>
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
                    <p>Tickets for the Lunardo Cinema are available online or at our theatres. We offer discount ticket prices on
                        Mondays, Wednesdays and all weekdays at 12PM. First Class seating tickets are also available if your looking
                        for a special movie experience!</p>
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
                    <p>We are currently screening the following movies all weekdays and weekends</p>
                    <div class="movie">
                        <img src='../../media/avengers-endgame.png' />
                        <p class="title">Avengers: Engame M</p>
                        <p class="times">Times:<br>Wednesday - 9PM<br>Thursday - 9PM<br>Friday - 9PM<br>Saturday - 6PM<br>Sunday - 6PM</p>
                    </div>
                    <div class="movie">
                        <img src='../../media/top-end-wedding.png' />
                        <p class="title">Top End Wedding M</p>
                        <p class="times">Times:<br>Monday - 6PM<br>Tuesday - 6PM<br>Saturday - 3PM<br>Sunday - 3PM</p>
                    </div>
                    <div class="movie">
                        <img src='../../media/dumbo.png' />
                        <p class="title">Dumbo PG</p>
                        <p class="times">Times:<br>Monday - 12PM<br>Tuesday - 12PM<br>Wednesday - 6PM<br>Thursday - 6PM<br>Friday - 6PM<br>Saturday 12PM<br>Sunday - 12PM</p>
                    </div>
                    <div class="movie">
                        <img src='../../media/the-happy-prince.png' />
                        <p class="title">The Happy Prince MA</p>
                        <p class="times">Times:<br>Wednesday - 12PM<br>Thursday - 12PM<br>Friday - 12PM<br>Saturday 9PM<br>Sunday - 9PM</p>
                    </div class="synopsis">
                    <article>
                        <h2>The Avengers: Endgame (M)</h2>
                        <video controls>
                            <source src="../../media/avengers-trailer.mp4" type="video/mp4">
                            <source src="../../media/avengers-trailer.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                        <div class="synopsis">
                            <p class="title">Plot Description:</p>
                            <p>Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their vanquished allies for an epic showdown with Thanos -- the evil demigod who decimated the planet and the universe.</p>
                        </div>
                        <span class="title">Make a booking:</span>
                        <button type="button">Wednesday - 9PM</button>
                        <button type="button">Thursday - 9PM</button>
                        <button type="button">Friday - 9PM</button>
                        <button type="button">Saturday - 6PM</button>
                        <button type="button">Sunday - 6PM</button>
                    </article>
                </header>
            </section>

        </main>

        <!-- Footer -->
        <footer>
            <div>&copy;<script>
                    document.write(new Date().getFullYear());
                </script> John Patrikios (s3780973) | No Group. Last modified
                <?= date("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
            <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science
                Web Programming course at RMIT University in Melbourne, Australia.</div>
            <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
        </footer>

        <article id='Website Under Construction'>
            <!-- Creative Commons image sourced from https://pixabay.com/en/maintenance-under-construction-2422173/ and used for educational purposes only -->
            <img src='../../media/website-under-construction.png' alt='Website Under Construction' />
        </article>
    </div>

</body>

</html>