/* Insert your javascript here */
var movie = {
    "ACT": { "name": "Avengers: Endgame", "times": ["Wednesday 9:00PM", "Thursday 9:00PM", "Friday 9:00PM", "Saturday 6:00PM", "Sunday 6:00PM"], "time_codes": ["WED T21", "THU T21", "FRI T21", "SAT T18", "SUN T18"] },
    "RMC": { "name": "Top End Wedding", "times": ["Monday 6:00PM", "Tuesday 6:00PM", "Saturday 3:00PM", "Sunday 3:00PM"], "time_codes": ["MON T18", "TUE T18", "SAT T15", "SUN T15"] },
    "ANM": { "name": "Dumbo", "times": ["Monday 12:00PM", "Tuesday 12:00PM", "Wednesday 6:00PM", "Thursday 6:00PM", "Friday 6:00PM", "Saturday 12:00PM", "Sunday 12:00PM"], "time_codes": ["MON T12", "TUE T12", "WED T18", "THU T18", "FRI T18", "SAT T12", "SUN T12"] },
    "AHF": { "name": "The Happy Prince", "times": ["Wednesday 12:00PM", "Thursday 12:00PM", "Friday 12:00PM", "Saturday 9:00PM", "Sunday 9:00PM"], "time_codes": ["WED T12", "THU T12", "FRI T12", "SAT T21", "SUN T21"] }
};
var moviePanels = ["ACT", "RMC", "ANM", "AHF"];

// <--------------------------------------------- SCROLL PANE --------------------------------------------->

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

// <------------------------------------------ DISPLAY SYNOPSIS -------------------------------------------->

function displaySynopsis(movie) {
    for (let i = 0; i < moviePanels.length; i++) {
        if (i != movie) {
            document.getElementById("synopsis" + moviePanels[i]).style.display = "none";
        } else {
            document.getElementById("synopsis" + moviePanels[i]).style.display = "inline-block";
            window.location.href = "#synopsis" + moviePanels[i];
        }
    }
}

// <-------------------------------------------- BOOKING FORM ---------------------------------------------->

/** Generate options in select box (Args: amount) */
function genOptions(amount) {
    for (let i = 1; i <= amount; i++) {
        document.write("<option value='" + i + "'>" + i + "</option>");
    }
}

var discount = false;

function updateForm(movieGenre, timeID) {
    document.getElementById("booking_form").style.display = "block";
    window.location.href = "#booking_form";

    document.getElementById("booking_title").innerHTML = movie[movieGenre].name + " - " + movie[movieGenre].times[timeID];
    document.getElementById("movie-id").value = movieGenre;

    var daytime = document.getElementById("movie-day").value = movie[movieGenre].time_codes[timeID].split(" ");

    document.getElementById("movie-day").value = daytime[0];
    document.getElementById("movie-hour").value = daytime[1].trim();

    var time = movie[movieGenre].time_codes[timeID];
    if (time.includes("MON") || time.includes("WED") || time.includes("T12")) {
        discount = true;
    } else discount = false;

    calculate();
}

function calculate() {
    var totalSTA = (document.getElementById("seats-STA").value) * (discount ? 14.00 : 19.80);
    var totalSTP = (document.getElementById("seats-STP").value) * (discount ? 12.50 : 17.50);
    var totalSTC = (document.getElementById("seats-STC").value) * (discount ? 11.00 : 15.30);
    var totalFCA = (document.getElementById("seats-FCA").value) * (discount ? 24.00 : 30.00);
    var totalFCP = (document.getElementById("seats-FCP").value) * (discount ? 22.50 : 27.00);
    var totalFCC = (document.getElementById("seats-FCC").value) * (discount ? 21.00 : 24.00);

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
    if (mobile.match("^(\\(04\\)|04|\\+614)( ?\\d){8}$")) {
        document.getElementById("mobile-invalid").style.visibility = "hidden"
        return true;
    } else {
        document.getElementById("mobile-invalid").style.visibility = "visible";
        return false;
    }
}

function checkCard() {
    var card = document.getElementById("cust-card").value; //
    if (card.match("^(?:4\\d{3}|5[1-5]\\d{2}|6011|3[47]\\d{2})([- ]?)\\d{4}\\1\\d{4}\\1\\d{4}$")) {
        document.getElementById("card-invalid").style.visibility = "hidden"
        return true;
    } else {
        document.getElementById("card-invalid").style.visibility = "visible";
        return false;
    }
}

function getMinDate() {
    let today = new Date(),
        month = "0" + (today.getMonth() + 1), //January is 0
        year = today.getFullYear();

    let date = year + "-" + month;

    document.getElementById("cust-expiry").setAttribute("min", date);
    document.getElementById("cust-expiry").setAttribute("value", date);
}

function validateForm() {
    var validate = calculate() && checkName() && checkMobile() && checkCard() ? true : false;
    return validate;
}