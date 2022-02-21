# WPM-Calculator
A quick Typing Speed Calculator in php and JS

## Calculate How Fast You Type
This is a quick project using basic HTML, CSS, PHP and Vanilla JS to test typing speed. 

## How It Works
When you type the first letter in the textarea, the onkeypress event fires on the first key stroke to start the timer and then removes the onkeypress event so that the timer is not called again on the second key stroke. 

Pressing ESC key stops the time for a quick way to end the timer whenever you are finished typing. 

On Submit the form submits with php back to the page itself and all words typed into the field are placed in the $_POST array.
The explode() function is used on the words in the $_POST array to separate from a full sentence into individual words.
These individual words are then put through the built-in PHP pspell() function to check for spelling errors. 
Words spelled correctly are given a class to display in green, incorrect words are classed to display in red.

The RESET button simply refreshes the page with an empty form submit back to the current page. 
The timer and Word Count are displayed as well as the Words-Per-Minute (WPM), which is simply calculated from the word count and timer. 
