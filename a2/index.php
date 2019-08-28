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
</head>

<body>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header class="heading">
            <img src='../../media/cinema-logo.png'/>
			<span>Lunardo Cinema</span>
			<img class="right" src='../../media/cinema-logo.png'/>

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
                    <p> Welcome to the Lunardo Cinema! <br> We are very excited to announce our brand new Cinema after extensive improvements and renovations. From upgrading our seating to comfy leather recliners,
                    to overhauling our projector and sound systems, we hope to bring an all new movie experience for you, friends and family. </p>
                </header>
            </section>

            <!-- Prices -->
            <section id="prices">
                <header class="topic">
                    <h2>Prices</h2>
                </header>
            </section>

            <!-- Now Showing -->
            <section id="now_showing">
                <header class="topic">
                    <h2>Now Showing</h2>
                </header>
            </section>

        </main>

        <!-- Footer -->
        <footer>
            <div>&copy;<script>
                document.write(new Date().getFullYear());
                </script> Put your name(s), student number(s) and group name here. Last modified
                <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
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