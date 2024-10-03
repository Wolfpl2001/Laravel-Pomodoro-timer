
var time1 = 25 * 60; // 25 minutes for first timer
var time2 = 5 * 60; // 15 minutes for second timer
var interval1, interval2; // Separate intervals for both timers
var firstTimerRunning = false; // Flag to check if the first timer is running
var secondTimerRunning = false; // Flag to check if the second timer is running

// Function to display time in MM:SS format
function displayTime(time, elementId) {
    var minutes = Math.floor(time / 60);
    var seconds = time % 60;

    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    document.getElementById(elementId).innerHTML = minutes + ":" + seconds;
}

// Function to reset the timer display back to the initial placeholder
function resetTimerDisplay(elementId, initialTime) {
    var minutes = Math.floor(initialTime / 60);
    var seconds = initialTime % 60;

    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    document.getElementById(elementId).innerHTML = minutes + ":" + seconds;
}

// Function to start the first timer
function startFirstTimer() {
    if (secondTimerRunning) {
        alert("You cannot start the first timer while the second one is running!");
        return;
    }

    clearInterval(interval1); // Clear any previous interval for the first timer
    var timer1 = time1;
    firstTimerRunning = true;
    document.getElementById("startFirstTimerButton").disabled = true; // Disable first timer button
    document.getElementById("startSecondTimerButton").disabled = true; // Disable second timer button while timer is running

    interval1 = setInterval(function() {
        if (--timer1 < 0) {
            clearInterval(interval1);
            alert("First timer's up!");
            firstTimerRunning = false;
            resetTimerDisplay('timer1', time1); // Reset the display to initial time
            document.getElementById("startSecondTimerButton").disabled = false; // Enable second timer button when first timer ends
        } else {
            displayTime(timer1, 'timer1');
        }
    }, 1000);
}

// Function to start the second timer
function startSecondTimer() {
    if (firstTimerRunning) {
        alert("You cannot start the second timer while the first one is running!");
        return;
    }

    clearInterval(interval2); // Clear any previous interval for the second timer
    var timer2 = time2;
    secondTimerRunning = true;
    document.getElementById("startSecondTimerButton").disabled = true; // Disable second timer button
    document.getElementById("startFirstTimerButton").disabled = true; // Disable first timer button while timer is running

    interval2 = setInterval(function() {
        if (--timer2 < 0) {
            clearInterval(interval2);
            alert("Break's up!");
            secondTimerRunning = false;
            resetTimerDisplay('timer2', time2); // Reset the display to initial time
            document.getElementById("startFirstTimerButton").disabled = false; // Enable first timer button when second timer ends
        } else {
            displayTime(timer2, 'timer2');
        }
    }, 1000);
}