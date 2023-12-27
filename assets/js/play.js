var countdownDuration = 1;
var countdownExecuted = false;

function updateCountdown() {
    document.getElementById('countdown').innerText = countdownDuration;
}

function startCountdown() {
    if (!countdownExecuted) {
        countdownExecuted = true;

        updateCountdown();

        var countdownInterval = setInterval(function () {
            countdownDuration--;

            if (countdownDuration < 0) {
                clearInterval(countdownInterval);
                document.getElementById('countdown').style.display = 'none';
                document.getElementById('questionContent').style.display = 'block';
                document.getElementById('text').style.display = 'none';
            } else {
                updateCountdown();
            }

        }, 1000);
    }
}

window.onload = startCountdown;


document.addEventListener('DOMContentLoaded', function () {
    var answerRadios = document.querySelectorAll('.answer-radio');
    var nextButton = document.getElementById('next');

    answerRadios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            nextButton.style.display = 'block';
        });
    });
});

