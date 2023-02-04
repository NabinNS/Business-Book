// side bar js
let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
    });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});
//Get current time in the navbar
function currentTime() {
    var date = new Date();
    var currentHours = date.getHours();
    var currentMinutes = date.getMinutes();
    var currentSeconds = date.getSeconds();
    var currentDate = date.toLocaleDateString();

    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = currentHours < 12 ? "AM" : "PM";

    // Convert the hours component to 12-hour format if needed
    currentHours = currentHours > 12 ? currentHours - 12 : currentHours;

    // Convert an hours component of "0" to "12"
    currentHours = currentHours == 0 ? 12 : currentHours;

    var time =
        currentDate +
        "      " +
        currentHours +
        " : " +
        currentMinutes +
        " : " +
        currentSeconds +
        "  " +
        timeOfDay;

    document.getElementById("clock").innerText = time;
    setInterval(currentTime, 1000);
}
currentTime();
//end code for time in navbar
