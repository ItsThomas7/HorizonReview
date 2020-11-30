// Open en close de login box
function openLogin() {
    document.getElementById("loginForm").style.display = "block";
}

function closeLogin() {
    document.getElementById("loginForm").style.display = "none";
}

// Score formulier tabs
var currentTab = 0; // Current tab is first
showTab(currentTab); // Display current tab

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";

    // Maakt vorige/volgende buttons dynamisch
    if(n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if(n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Bevestig";
    } else {
        document.getElementById("nextBtn").innerHTML = "Volgende";
    }

    // Laat zien welke stap de gebruiker is
    fixStepIndicator(n);
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");

    // Exit functie als een veld in form niet valid is
    if (n == 1 && !validateForm()) return false;

    x[currentTab].style.display = "none";
    currentTab = currentTab + n;

    // Als form compleet is, submit de form
    if(currentTab >= x.length){
        document.getElementById("scoreForm").submit();
        return false;
    }

    // Anders laat volgende tab zien
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");

    // Loop die elk input veld in de current tab checkt
    for (i = 0; i < y.length; i++){
        // Als veld leeg is
        if(y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }

    // Als valid true is, markeer step als finished
    if(valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid;
}

function fixStepIndicator(n) {
    // Verwijder "active" class van elke step...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++){
        x[i].className = x[i].className.replace(" active", "");
    }
    // ... En voegt deze vervolgens toe aan de current step
    x[n].className += " active";
}

// Selecteer alle werkproces checkboxes
document.getElementById('select-all').onclick = function() {
    var checkboxes = document.getElementsByName('wProces');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}