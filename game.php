<?php
/**
 * The php file for the main game. Contains jQuery scripts to display game views and contains all the html elements of the game.
 */

//** Include Header */
include "header.php";


//** If user accesses this page not logged in redirect to the index. */
if (!isset($_SESSION['userID'])){
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Rock Paper Scissors</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rps.css">
    <script src="script/game.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<script>
    //** Setup the jquery script */
    $(document).ready(function() {
        $("#divTwo").hide(); //** Hide the divs that are used in the game until ready. */
        $("#closeHelp").hide(); //** Hide the close help button */
        $("form").submit(function() { //** When the play button is pressed, unhide the first div, and show the game. */
            $("#divOne").hide();
            $("#divTwo").fadeIn(4000);
        })

        //** This function for the help button on press shows the instructions. */
        $("#helpButton").click(function() {
            $("#helpText").html("<p>Click any one of the rock, paper or scissor buttons to play!</p>" +
                "<p>The computer will randomly select a choice, first to 10 wins!</p>");
            $("#closeHelp").show();
            $("#helpButton").hide();
        })

        //** The close help button removes the instructions. */
        $("#closeHelp").click(function() {
            $("#closeHelp").hide();
            $("#helpButton").show();
            $("#helpText").html("");
        })
    });
</script>


<body>
    <div id="content">
        <div id="subdivGame">
            <div id="divOne">
                <h2>ROCK PAPER SCISSORS!</h2>
                <h3>Press the button to play!</h3>
                <form id="lab3form">
                    <input type="submit" value="PLAY!" id = "playButton">
                </form>
            </div>

            <div id="divTwo">
                <h2>ROCK PAPER SCISSORS! FIRST TO 10 WINS</h2>
                <div id="scoreboard">
                    <div id='inputname'>Player</div>
                    <span id='userpoints'> 0 </span>|<span id='computerpoints'> 0 </span>
                    <div id='compname'>Computer</div>
                </div>

                <div id="result">
                    <h2>Pick rock, paper or scissors!</h2>
                </div>

                <div class="options">
                    <button class='option' id='optionbutton'>✊</button>
                    <button class='option' id='optionbutton'>✋</button>
                    <button class='option' id='optionbutton'>✌️</button>
                </div>

                <div id="help">
                    <button id='helpButton'>Help</button>
                    <div id='helpText'>
                        <p></p>
                    </div>
                    <button id='closeHelp'> Close Help</button>
                </div>
            </div>
            <button id='replayButton' style = "visibility: hidden">Play Again!</button>
        </div>
    </div>
</body>

</html>