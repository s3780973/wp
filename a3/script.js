/* Insert your javascript here */
var movie = {
    "ACT": { "name": "Avengers: Endgame", "times": ["Wednesday 9:00PM", "Thursday 9:00PM", "Friday 9:00PM", "Saturday 6:00PM", "Sunday 6:00PM"] },
    "RMC": { "name": "Top End Wedding", "times": ["Monday 6:00PM", "Tuesday 6:00PM", "Saturday 3:00PM", "Sunday 3:00PM"] },
    "ANM": { "name": "Dumbo", "times": ["Monday 12:00PM", "Tuesday 12:00PM", "Wednesday 6:00PM", "Thursday 6:00PM", "Friday 6:00PM", "Saturday 12:00PM", "Sunday 12:00PM"] },
    "AHF": { "name": "The Happy Prince", "times": ["Wednesday 12:00PM", "Thursday 12:00PM", "Friday 12:00PM", "Saturday 9:00PM", "Sunday 9:00PM"] }
};
var moviePanels = ["ACT", "RMC", "ANM", "AHF"];

window.onscroll = function() {
    var sections = document.getElementsByTagName('main')[0].getElementsByTagName('section');

    var navLinks = document.getElementsByTagName('nav')[0].getElementsByTagName('a');

    let n = -1;
    while (n < sections.length - 1 && sections[n + 1].offsetTop <= window.scrollY + 5) {
        n++;
    }

    for (let a = 0; a < navLinks.length; a++) {
        navLinks[a].classList.remove("active");
    }

    if (n >= 0) {
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
    if (name.match("^[a-zA-Z \-.']{1,100}$")) {
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
    if (mobile.match("")) {
        document.getElementById("mobile-invalid").style.visibility = "hidden"
        return true;
    } else {
        document.getElementById("mobile-invalid").style.visibility = "visible";
        return false;
    }
}

function checkCard() {
    var card = document.getElementById("cust-card").value;
    if (card.match("^5[1-5][0-9]{0,14}|^(222[1-9]|2[3-6]\\d{2}|27[0-1]\\d|2720)[0-9]{0,12}$")) {
        document.getElementById("card-invalid").style.visibility = "hidden"
        return true;
    } else {
        document.getElementById("card-invalid").style.visibility = "visible";
        return false;
    }
}

function validateForm() {
    var validate = calculate() && checkName() && checkMobile() && checkCard() ? true : false;
    return validate;
}