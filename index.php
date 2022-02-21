<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,600&display=swap');

    :root {
        --main-bg: rgb(50, 50, 50);
    }

    *{
        line-height: 1;
        font-family: 'Kanit', sans-serif;
        font-size: 20px;
        color: white;
    }
    body {
        max-width: 1024px;
        margin: auto;
        background-color: var(--main-bg);
        max-height: 100vh;
    }

    div {
        text-align: center;
        margin: auto;
        width: max-content;
    }

    textarea {
        background-color: var(--main-bg);
        border: 2px solid yellow;
        border-radius: 5px;
        resize: none;
        width: 1024px;
        height: 40vh;
        padding: 10px;
    }

    textarea:hover {
        outline: none;
    }

    button {
        cursor: pointer;
        margin: 10px;
        border: 2px solid yellow;
        border-radius: 5px;
        background-color: var(--main-bg);
        padding: 5px 10px;
        transition: outline-offset 0.1s linear;
    }

    button:hover {
        outline: 2px solid yellow;
        outline-offset: 2px;
    }

    .correct {
        color: green;
    }

    .wrong {
        color: red;
    }

    .results {
        display: inline-block;
        padding: 5px;
        border: 1px solid black;
        margin: 10px;
        border-radius: 5px;
    }

</style>

<?php

    $pspell = pspell_new("en");

    if (isset($_POST)){
        $words = explode(" ", $_POST['test']);
        $timer = $_POST['hidden'] / 100;
        $wordCount = count($words);
        $minutes = $timer / 60;
        $wpm = $wordCount / $minutes;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <div>

            <p>WPM CALCULATOR</p>
            <?php if($_POST == null) { ?>
                <p>Timer: <span id='timer'>0</span>s</p>
            <?php } ?>

            <?php 

                if(isset($_POST) && $_POST != null) {
                    echo "<p class='results'>WPM: " . number_format($wpm, 2, '.', '') . "</p>";
                    echo "<p class='results'>Words: " . count($words) . "</p>";
                    echo "<p class='results'>Time: {$timer}s</p>";
                }

                if(count($words) > 1){
                    echo "<hr>";

                    foreach ($words as $word) {
                        if (pspell_check($pspell, $word)) {
                            echo "<span class='correct'>{$word}</span> ";
                        } else {
                            echo "<span class='wrong'>{$word}</span> ";
                        }
                    }
                    echo "<hr>";
                }

                if($_POST == null){
                    ?>

                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post'>
                            <textarea name='test' id='test' cols='80' rows='10'></textarea><Br>
                            <input type='hidden' name='hidden' id='hidden' value=''>
                            <button type='submit'>Submit</button>
                        </form>



                <?php
                }
            ?>

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post'>
                <button type='submit'>Reset</button>
            </form>

        </div>
        
    </body>
</html>


<script>

    // Setup Variables
    let Interval;
    let timerHidden = document.getElementById('hidden');
    let timerDiv = document.getElementById('timer');
    let timerrrr = 0;
    let input = document.getElementById('test');

    // Textarea Event Listener 
    input.addEventListener('keypress', logKey);

    // Check for first key entered in textarea the remove Event Listener
    function logKey(e) {
        input.removeEventListener('keypress', logKey);
        startTimer();
    }

    // Start Timer
    function startTimer() {
        if (!Interval) {
            Interval = setInterval(timerEval, 10);
        }
    }

    // Display timer on page
    // Place timer value in hidden form field
    function timerEval(){
        timerrrr++;
        timerHidden.value = timerrrr;
        timerDiv.innerHTML = timerrrr / 100;
    }

    // Stop Timer If ESC key is pressed
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.key == "Escape") {
            myStopFunction();
        }
    };

    // Stop Timer 
    function myStopFunction() {
        clearInterval(Interval);
    }



</script>
