function saveTimers(timer1, timer2) {
    fetch('/timers', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            WorkTime: timer1,
            BreakTime: timer2
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Timers saved:', data.message);
    })
    .catch(error => {
        console.error('Error saving timers:', error);
    });
}

function loadTimers() {
    fetch('/timers/latest', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.WorkTime && data.BreakTime) {
            // Ustaw wartości timerów
            WorkTime = data.WorkTime;
            BreakTime = data.BreakTime;
            displayTime(WorkTime, 'timer1');
            displayTime(BreakTime, 'timer2');
        }
    })
    .catch(error => {
        console.error('Error loading timers:', error);
    });
}

var WorkTime = 25 * 60; // 25 minutes for work timer
var BreakTime = 5 * 60;  // 5 minutes for break timer

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

// Function to start the work timer
function startFirstTimer() {
    if (secondTimerRunning) {
        alert("You cannot start the work timer while the break timer is running!");
        return;
    }

    clearInterval(interval1); // Clear any previous interval for the work timer
    var timer1 = WorkTime;
    firstTimerRunning = true;
    document.getElementById("startFirstTimerButton").disabled = true; // Disable work timer button
    document.getElementById("startSecondTimerButton").disabled = true; // Disable break timer button while timer is running

    // Start saving the timer automatically every 5 seconds
    var saveInterval = setInterval(function() {
        if (firstTimerRunning) {
            saveTimers(timer1, BreakTime);
        } else {
            clearInterval(saveInterval); // Clear save interval if the timer stops
        }
    }, 2000); // Save every 2 seconds

    interval1 = setInterval(function() {
        if (--timer1 < 0) {
            clearInterval(interval1);
            firstTimerRunning = false;
            clearInterval(saveInterval); // Stop saving when the timer ends
            alert("Work timer's up!");
            resetTimerDisplay('timer1', WorkTime); // Reset the display to initial time
            document.getElementById("startSecondTimerButton").disabled = false; // Enable break timer button when work timer ends
        } else {
            displayTime(timer1, 'timer1');
        }
    }, 1000);
}

// Function to start the break timer
function startSecondTimer() {
    if (firstTimerRunning) {
        alert("You cannot start the break timer while the work timer is running!");
        return;
    }

    clearInterval(interval2); // Clear any previous interval for the break timer
    var timer2 = BreakTime;
    secondTimerRunning = true;
    document.getElementById("startSecondTimerButton").disabled = true; // Disable break timer button
    document.getElementById("startFirstTimerButton").disabled = true; // Disable work timer button while timer is running

    // Start saving the timer automatically every 5 seconds
    var saveInterval = setInterval(function() {
        if (secondTimerRunning) {
            saveTimers(WorkTime, timer2);
        } else {
            clearInterval(saveInterval); // Clear save interval if the timer stops
        }
    }, 5000); // Save every 5 seconds

    interval2 = setInterval(function() {
        if (--timer2 < 0) {
            clearInterval(interval2);
            secondTimerRunning = false;
            clearInterval(saveInterval); // Stop saving when the timer ends
            alert("Break's up!");
            resetTimerDisplay('timer2', BreakTime); // Reset the display to initial time
            document.getElementById("startFirstTimerButton").disabled = false; // Enable work timer button when break timer ends
        } else {
            displayTime(timer2, 'timer2');
        }
    }, 1000);
}

// Load timers when the page is loaded
window.onload = function() {
    loadTimers(); // Load saved timers from the server
};
