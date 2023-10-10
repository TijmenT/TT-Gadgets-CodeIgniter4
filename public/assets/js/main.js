function OpenBurger() {
    var x = document.getElementById("nav--mobile--links");
    x.style.transform = "translateX(0)";
    var y = document.getElementById("nav--mobile--icon--open")
    y.style.display = "none";
}

function CloseBurger() {
    var x = document.getElementById("nav--mobile--links");
    x.style.transform = "translateX(100%)";
    var y = document.getElementById("nav--mobile--icon--open")
    y.style.display = "block";
}





