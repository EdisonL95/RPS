/**
 * The script for the rock paper scissors game. Referenced from my third assignment with adjustments to fit the website.
 */

window.addEventListener("load", function () {
    document.forms.lab3form.addEventListener("submit", check);
    /** Add an event listener for the submit button on the form that uses the function check(event) */
    const userButtons = document.querySelectorAll('.option')
    /** Get all the rock paper scissors buttons into an array using a queryselector, as a constant. */
    const compSelections = ['✊', '✋', '✌️']
    /** A constant of the string variant of the options the computer can choose from */
    let inputName = "Player";
    /** Name the user input. */
    let compPoints = 0;
    /** Current points of the computer */
    let compChoice = '';
    /** Current option choice of the computer */
    let userPoints = 0;
    /** Current points of the user */
    let userPointsHTML = document.getElementById("userpoints");
    /** Get the text that displays the users total points in the html file */
    let compPointsHTML = document.getElementById("computerpoints");
    /** Get the text that displays the computers total points in the html file */
    let winText = document.getElementById("result");
    /** Get the text that displays whether or not the user won or lost in the html file.*/
    let win = false;
    let loss = false;

    function check(event) {
        event.preventDefault(); /** Prevent default to not make the page redirect when form is submitted. */
    }

    /**
     * This foreach loop loops over the buttons in the userButtons array and adds an event listener for clicking and a function attached to each of them.
     * Function (event), takes an event, runs when the button is clicked
     * This function sets a variable text equal to the text of the button, then sets a randomized computer choice using the computerchoice() function
     * It then runs the text variable through the checkWin(userChoice) function to determine if they won or not.
     * After it checks the score to see if one of the players reached a score of 10.
     * @param {*} event takes an event
     */
    userButtons.forEach(userButton => userButton.addEventListener("click", function (event) {
        let text = userButton.textContent;
        computerChoice();
        checkWin(text);
        checkScore();
    }))

    /**
     * Get the reset button from the html file and adds an event listener to clicking it.
     * The function of the event listener refreshes the page on click.
     * @param {*} event takes an event
     */
    document.getElementById("replayButton").addEventListener("click", function (event) {
        event.preventDefault();
        location.reload();
    });


    /**
     * This function takes the users choice text value and compares it to the randomized computer choice.
     * @param {*} userChoice The text value of the button the user pressed for their choice in rock paper scissors.
     */
    function checkWin(userChoice) {
        if (compChoice === userChoice) {
            /** This checks if the choices are the same and results in a draw. Innerhtml on the text used to tell the user it is a draw. */
            winText.innerHTML = "<h2>Both selections were the same, draw.</h2>";
        } else if (compChoice === '✊' && userChoice === '✋') {
            /** If the user wins, userpoints gets added by 1, the variable is displayed on screen using an innerhtml
            and a winning message is displayed too. */
            userPoints += 1;
            userPointsHTML.innerHTML = userPoints;
            winText.innerHTML = "<h2>" + inputName + " chose paper, Computer chose rock. " + inputName + " won!</h2>";
        } else if (compChoice === '✊' && userChoice === '✌️') {
            /** If the computer wins, comppoints gets added by 1, the variable is displayed on screen using an innerhtml
            and a winning message for the computer is displayed too. */
            compPoints += 1;
            compPointsHTML.innerHTML = compPoints;
            winText.innerHTML = "<h2>" + inputName + " chose scissors, Computer chose rock. " + inputName + " lost!</h2>";
        } else if (compChoice === '✌️' && userChoice === '✊') {
            /** Process is repeated for each possible outcome. */
            userPoints += 1;
            userPointsHTML.innerHTML = userPoints;
            winText.innerHTML = "<h2>" + inputName + " chose rock, Computer chose scissors. " + inputName + " won!</h2>";
        } else if (compChoice === '✌️' && userChoice === '✋') {
            compPoints += 1;
            compPointsHTML.innerHTML = compPoints;
            winText.innerHTML = "<h2>" + inputName + " chose paper, Computer chose scissors. " + inputName + " lost!</h2>";
        } else if (compChoice === '✋' && userChoice === '✌️') {
            userPoints += 1;
            userPointsHTML.innerHTML = userPoints;
            winText.innerHTML = "<h2>" + inputName + " chose scissors, Computer chose paper. " + inputName + " won!</h2>";
        } else if (compChoice === '✋' && userChoice === '✊') {
            compPoints += 1;
            compPointsHTML.innerHTML = compPoints;
            winText.innerHTML = "<h2>" + inputName + " chose rock, Computer chose paper. " + inputName + " lost!</h2>";
        }
    }

    /**
     * This function takes no variables and returns nothing.
     * When called, it generates a random number between 0 to 2 using the math.random function.
     * This number is used to index through the potential selections array for the computer, takes the text value of that index and sets it
     * as the computers choice.
     */
    function computerChoice() {
        let compGen = Math.floor(Math.random() * 3);
        compChoice = compSelections[compGen];
    }

    /**
     * This function takes no variables and returns nothing.
     * This checks if either the computer or user is at 10 points.
     * It then sets the loss or win parameters to true or false depending on the outcome,
     * and uses an AJAX request to the php script to update the database with the corresponding outcome.
     */
    function checkScore() {
        if (compPoints === 10) {
            document.getElementById("divTwo").innerHTML = "<h2>The computer has won. Press the button to reload the game.</h2>"
            loss = true;
            let url = "server/updatescore.php?winparam=" + win + "&lossparam=" + loss;
            console.log(url);
            fetch(url, {
                credentials: 'include'
            })
            document.getElementById("replayButton").style.visibility = "visible";
        } else if (userPoints === 10) {
            document.getElementById("divTwo").innerHTML = "<h2>You have won. Press the button to reload the game.</h2>"
            win = true;
            let url = "server/updatescore.php?winparam=" + win + "&lossparam=" + loss;
            console.log(url);
            fetch(url, {
                credentials: 'include'
            })
            document.getElementById("replayButton").style.visibility = "visible";
        }
    }
});