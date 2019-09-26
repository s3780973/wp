/* Insert your javascript here */
var movie = {
    "ACT": { "name": "Avengers: Endgame", "times": ["Wednesday 9:00PM", "Thursday 9:00PM", "Friday 9:00PM", "Saturday 6:00PM", "Sunday 6:00PM"] },
    "RMC": ["e", "e"],
    "ANM": ["er", "eue"],
    "AHF": ["eye, eie"]
};
var moviePanels = ["ATN", "RMC", "ANM", "AHF"];

window.onscroll = function() {
    var sections = document.getElementsByTagName('main')[0].getElementsByTagName('section');

    var navLinks = document.getElementsByTagName('nav')[0].getElementsByTagName('a');

    let n = -1;
    while(n < sections.length - 1 && sections[n + 1].offsetTop <= window.scrollY + 5) {
        n++;
    }

    for(let a = 0; a < navLinks.length; a++) {
        navLinks[a].classList.remove("active");
    }
    this.console.log(sections);
    this.console.log(navLinks);
    console.log(n + "  "+ navLinks[n]);

    if(n >= 0) {
        navLinks[n].classList.add("active");
    }
}

// <------------------------------------------------------------------------ DISPLAY SYNOPSIS ------------------------------------------------------------------->

function displaySynopsis(movie) {
    for (var i = 0; i < moviePanels.length; i++) {
        if (i != movie) {
            document.getElementById("synopsis" + moviePanels[i]).style.display = "none";
        } else {
            document.getElementById("synopsis" + moviePanels[i]).style.display = "inline-block";
            window.location.href = "#synopsis" + moviePanels[i];
        }
    }
}

// <-------------------------------------------------------------------------- BOOKING FORM --------------------------------------------------------------------->

var discount = false;

function updateForm(movieGenre, timeID) {
    document.getElementById("booking_form").style.display = "block";
    window.location.href = "#booking_form";

    document.getElementById("booking_title").innerHTML = movie[movieGenre].name + " - " + movie[movieGenre].times[timeID];
    document.getElementById("movie-id").value = movieGenre;
    var daytime = document.getElementById("movie-day").value = movie[movieGenre].times[timeID].split(" ");
    document.getElementById("movie-day").value = daytime[0];
    document.getElementById("movie-hour").value = daytime[1].trim();

    var time = movie[movieGenre].times[timeID];
    if (time.includes("Monday") || time.includes("Wednesday") || time.includes("12:00PM")) {
        discount = true;
    } else discount = false;

    calculate();
}

function genOptions(amount) {
    for (var i = 1; i <= amount; i++) {
        document.write("<option value='" + i + "'>" + i + "</option>");
    }
}

function calculate() {
    var numSTA = parseInt(document.getElementById("seats-STA").value);
    var numSTP = parseInt(document.getElementById("seats-STP").value);
    var numSTC = parseInt(document.getElementById("seats-STC").value);
    var numFCA = parseInt(document.getElementById("seats-FCA").value);
    var numFCP = parseInt(document.getElementById("seats-FCP").value);
    var numFCC = parseInt(document.getElementById("seats-FCC").value);

    var priceSTA = discount ? 14.00 : 19.80;
    var priceSTP = discount ? 12.50 : 17.50;
    var priceSTC = discount ? 11.00 : 15.30;
    var priceFCA = discount ? 24.00 : 30.00;
    var priceFCP = discount ? 22.50 : 27.00;
    var priceFCC = discount ? 21.00 : 24.00;

    var totalSTA = numSTA * priceSTA;
    var totalSTP = numSTP * priceSTP;
    var totalSTC = numSTC * priceSTC;
    var totalFCA = numFCA * priceFCA;
    var totalFCP = numFCP * priceFCP;
    var totalFCC = numFCC * priceFCC;

    var total = totalSTA + totalSTP + totalSTC + totalFCA + totalFCP + totalFCC;
    document.getElementById("total").innerHTML = "Total: $" + total.toFixed(2);

    return total > 0 ? true : false;
}

function checkName() {
    var name = document.getElementById("cust-name").value;
    if (name.match("^[a-z ,.'-]+$")) {
        document.getElementById("name-invalid").style.visibility = "hidden"
        return true;
    } else {
        document.getElementById("name-invalid").style.visibility = "visible";
        return false;
    }
}

function checkEmail() {}

function checkMobile() {
    var mobile = document.getElementById("cust-mobile").value;
    return mobile.match("jim") ? true : false;
}

function checkCard() {
    var card = document.getElementById("cust-card").value;
    return card.match("100") ? true : false;
}

function nameValid(check) {
    check ? document.getElementById("name-invalid").style.visibility = "hidden" : document.getElementById("name-invalid").style.visibility = "visible";
    return check;
}

function validateForm() {
    var validate = calculate() && checkName() && checkMobile() && checkCard() ? true : false;
    return validate;
}