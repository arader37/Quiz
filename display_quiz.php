<?php 
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');

// functions
function getNumQuestionsForThisQuiz($quiz_topic){
    global $db; // tell the function to use to global variable $db
    $sql = "select count(topic) as c from questions where topic = '$quiz_topic'";
    $results = mysqli_query($db,$sql);

    $num_questions_found = 0;
    if(mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        $num_questions_found = $rows[0]['c']; // get the value of c for this first row that returned from the query
    }

    //echo "Found $num_questions_found questions for the quiz on topic $quiz_topic";
    return $num_questions_found;
}

function getNumQuestionsToShow(){
    global $db; // tell the function to use to global variable $db
    $sql = "select value from preferences where name = 'NO_OF_QUESTIONS_TO_SHOW'";
    $results = mysqli_query($db,$sql);

    $value = 0;
    if(mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        $value = $rows[0]['value'];
    }
    return $value;
}

function getQuestion($quiz_topic, $question_num){
    global $db; // tell the function to use to global variable $db
    $sql = "select id, question from questions where topic = '$quiz_topic' order by id ASC";
    $results = mysqli_query($db,$sql);

    $question = "Error";
    if ($question_num == 0)
        return $question; // return error as we cannot get the question 0-1 or -1 as it doesn't exist
    if(mysqli_num_rows($results)>0 && mysqli_num_rows($results)>=$question_num){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        $question = $rows[$question_num-1]['question'];
    }
    return $question;
}

function getAnswers($quiz_topic, $question_ID){
    global $db; // tell the function to use to global variable $db
    // use the quiz_topic and question_id to identify the correct question
    // this fixes a bug where the same question answers would be selected when multiple questions had
    // the same text/string (ie dances quiz)
    $sql = "select choice_1, choice_2, choice_3, choice_4 from questions where "
        . "topic = '$quiz_topic' and id = '$question_ID'";
    $results = mysqli_query($db,$sql);

    $answers = array();
    if(mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        $answers[0] = $rows[0]['choice_1'];
        $answers[1] = $rows[0]['choice_2'];
        $answers[2] = $rows[0]['choice_3'];
        $answers[3] = $rows[0]['choice_4'];
    }
    return $answers;
}

// decided against this method of correcting quiz
// commented out for now incase I decide to reuse it. It's unfinished.
/*
function getNumCorrectAnswers($quiz_topic, $users_answers_array){
    global $db; // tell the function to use to global variable $db

    $sql = "select answer from questions where topic = '$quiz_topic' order by id ASC";
    $results = mysqli_query($db,$sql);
    if(mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){
            $answers[] = $row;
        }
    }

    for ($i = 1; $i <= count($users_answers_array); $i++){
        $question_ID = getQuestionID($quiz_topic, $i);
        $sql = "select choice_1, choice_2, choice_3, choice_4 from questions where topic = '$quiz_topic' "
            . "and id = '$question_ID'";
        $results = mysqli_query($db,$sql);
        if(mysqli_num_rows($results) > 0
            && isset($_SESSION[$question_ID]) == true){
            if (getIdFromQuizABCD($_SESSION[$question_ID])){

            }
    }
}
*/

function isAnswerRight($quiz_topic, $question_num, $user_answer){
    global $db; // tell the function to use to global variable $db
    $question_ID = getQuestionID($quiz_topic, $question_num); // returns the id for this particular question
    $user_answer_ID = getIdFromQuizABCD($user_answer); // converts a,b,c,d to 1,2,3,4 or 5
    $sql = "select choice_1, choice_2, choice_3, choice_4, answer from questions where topic = '$quiz_topic' "
        . "and id = '$question_ID'";
    $results = mysqli_query($db,$sql);
    $correct_answer_ID = 0;
    if(mysqli_num_rows($results) > 0){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        if ($rows[0]['answer'] == $rows[0]['choice_1'])
            $correct_answer_ID =  1;
        else if ($rows[0]['answer'] == $rows[0]['choice_2'])
            $correct_answer_ID =  2;
        else if ($rows[0]['answer'] == $rows[0]['choice_3'])
            $correct_answer_ID =  3;
        else if ($rows[0]['answer'] == $rows[0]['choice_4'])
            $correct_answer_ID =  4;
        else $correct_answer_ID = 5;
        

        if ($user_answer_ID == $correct_answer_ID)
            return true;
        else
            return false;
    }
    return false;
}

function checkQuiz($quiz_topic, $num_questions_to_show){
    // returns the number of questions the user got correct in this quiz
    $num_correct = 0;
    $num_incorrect = 0;
    for ($i = 1; $i <= $num_questions_to_show; $i++){
        $question_ID = $quiz_topic . "Q" . $i;
        if (isset($_SESSION[$question_ID]) 
            && isAnswerRight($quiz_topic, $i, $_SESSION[$question_ID]) == true){
            $num_correct++;
        } else{
            $num_incorrect++;
        }
    }
    return $num_correct;
}

function getIdFromQuizABCD($abcd_string){
    if ($abcd_string == "A")
        return 1;
    else if ($abcd_string == "B")
        return 2;
    else if ($abcd_string == "C")
        return 3;
    else if ($abcd_string == "D")
        return 4;
    else return 5;
}

function getQuestionID($quiz_topic, $current_page){
    global $db; // tell the function to use to global variable $db
    $sql = "select id from questions where topic = '$quiz_topic'";
    $results = mysqli_query($db,$sql);

    if ($current_page < 1)
        return 0;
    if(mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        $id = $rows[$current_page-1]['id'];
    }
    return $id;
}

function getImageAddress($quiz_topic, $question_ID){
    global $db; // tell the function to use to global variable $db
    $sql = "select image_name from questions where topic = '$quiz_topic' and id = '$question_ID'";
    $results = mysqli_query($db,$sql);

    $image_address = "Error";
    if(mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        $image_address = $rows[0]['image_name'];
    }
    return $image_address;
}

function resetUserQuizAnswers($quiz_topic, $num_questions){
    for ($i = 1; $i <= $num_questions; $i++){
        $question_ID = $quiz_topic . "Q" . $i;
        $_SESSION[$question_ID] = '0';
    }
}
?>

<html>
    <head>
        <title>QuizMaster Quiz</title>
    </head>
    <style>
        .image {
            width: 100px;
            height: 100px;
            padding: 20px 20px 20px 20px;
            transition: transform .2s;
        }
        .image:hover {
            transform: scale(1.2)
        }
        #table_1 {
            border-spacing: 300px 0px;
        }
        #table_2 {
            margin-left: auto;
            margin-right: auto;
        }
        #silc {
            width: 300;
            height: 85;
        }
        #welcome {
            text-align: center;
        }
        #directions {
            text-align: center;
        }
        #title {    
            color: black;        
            text-align: center;
        }
        #quiz_content {
            padding: 15px;
        }
        a:visited, a:link, a:active {
            text-decoration: none;
        }
    </style>
    <body>
    <div id="quiz_content">
    <?php
        if(isset($_GET['topic']) == false){
            echo "<h4 style='color:red;'>Error: Missing/Invalid Quiz Topic</h4>";
            exit();
        }
        $quiz_topic = $_GET['topic'];
        $current_page = 1;
        if (isset($_GET['page']) == true){
            $current_page = $_GET['page'];
        }
        $next_page = $current_page+1;
        $previous_page = $current_page-1;
        $num_questions = getNumQuestionsForThisQuiz($quiz_topic);
        $num_questions_to_show = getNumQuestionsToShow();
        if ($num_questions_to_show > $num_questions)
            $num_questions_to_show = $num_questions; // be sure that num_questions_to_show is not greater than num questions in the quiz
        $question_session_ID = $quiz_topic . "Q" . $current_page;
        // calculate the number of questions to display (based on NO_OF_QUESTIONS_TO_SHOW database attribute value)
        // this value is placed at the top ie (Page 1 of 20)
        $displayed_num_questions = $num_questions_to_show < $num_questions ? $num_questions_to_show : $num_questions;

        echo "<h2 style='display:inline;'>Quiz: $quiz_topic</h2>";
        if (isset($_GET['quiz_finished']) == false)
            echo "<pre style='display:inline;'>               </pre><button id='resetQuizBtn'>Reset Quiz</button><br>";
        echo "<h6>Page: $current_page of $num_questions_to_show</h6>";

        // not needed for now (as per professor's recommendation)
        // if ($num_questions < $num_questions_to_show){
        //     echo "<h4 style='color:red;'>Error: This quiz currently has under the minimum "
        //         . "number of required questions ($num_questions_to_show)</h4>";
        //     exit();
        // }


        // check if a previous page's selection needs to be updated in the user's session data
        // this is how the quiz saves the user's answered questions
        if (isset($_GET['previous_selection']) && isset($_GET['previous_page'])){
            $previous_selection = $_GET['previous_selection'];
            $previous_question_session_ID = $quiz_topic . "Q" . $_GET['previous_page'];
            $_SESSION[$previous_question_session_ID] = $previous_selection;
        }


        // check if we need to reset the user's session saved answers if they have just started this quiz
        if ($current_page == 1 && 
            (isset($_SESSION[$question_session_ID]) == false || $_SESSION[$question_session_ID] == '0')){
            // it doesn't appear as though the user has already answered this question
            // this means they are likely starting the quiz for the first time
            // so we should reset all of their answers to the questions in this quiz to '0'
            resetUserQuizAnswers($quiz_topic, $num_questions);
            echo "**Reset the user's question answers**";
        }
        else if (isset($_GET['reset_quiz'])){
            // user has pressed button to reset the quiz manually
            resetUserQuizAnswers($quiz_topic, $num_questions);
            echo "**Reset the user's question answers by request**";
        }


        // check if the user has finished the quiz
        if (isset($_GET['quiz_finished'])){
            // tally up correct and incorrect answers
            $num_correct = checkQuiz($quiz_topic, $num_questions_to_show);
            $num_incorrect = $num_questions_to_show - $num_correct;
            echo "<div style='text-align:center'><h3 style='color:green'>Congratulations!</h3>";
            echo "<h4>You got $num_correct out of $num_questions_to_show questions correct!</h4>";
            echo "<img id='congratsi' style='width:200px; height:200px;' src='Images/about_images/thumbsup.jpg'></div>";
            exit();
        }


        // generate quiz question
        $question = getQuestion($quiz_topic, $current_page);
        if ($question == "Error"){
            // unexpected error occurred while looking up this question in the quiz
            echo "<h4 style='color:red'>Error occurred while looking up question #$current_page</h4>";
            exit();
        }
        $question_ID = getQuestionID($quiz_topic, $current_page);
        $answers = getAnswers($quiz_topic, $question_ID);
        if (count($answers) <= 1){
            echo "<h4 style='color:red'>Error occurred while looking up answers for question #$current_page</h4>";
            exit();
        }
        $image_address = getImageAddress($quiz_topic, $question_ID);


        // create html code for the image
        $a_checked = ($_SESSION[$question_session_ID]=='A') ? 'checked' : '';
        $b_checked = ($_SESSION[$question_session_ID]=='B') ? 'checked' : '';
        $c_checked = ($_SESSION[$question_session_ID]=='C') ? 'checked' : '';
        $d_checked = ($_SESSION[$question_session_ID]=='D') ? 'checked' : '';
        echo "
        <p><img id='q_image' src='$image_address' style='max-height:250px;width:auto;' alt='img not found'></p>
        <p id='question'>Q$current_page. $question</p>
        <form>
        <input type ='radio' name='choices' id='choice_1' value='A' $a_checked>
        <label for='choice_1' id='choice_1_label'>$answers[0]</label>
        <br>
        <input type ='radio' name='choices' id='choice_2' value='B' $b_checked>
        <label for='choice_2' id='choice_2_label'>$answers[1]</label>
        <br>
        <input type ='radio' name='choices' id='choice_3' value='C' $c_checked>
        <label for='choice_3' id='choice_3_label'>$answers[2]</label>
        <br>
        <input type ='radio' name='choices' id='choice_4' value='D' $d_checked>
        <label for='choice_4' id='choice_4_label'>$answers[3]</label>
        <br>
        </form>";
    ?>

    <button id="previousBtn" type="button">Previous</button>
    <button id="submitBtn" type="button">Submit</button>
    <button id="nextBtn" type="button">Next</button>

    <script>
    // assign event listeners to the three buttons so our functions are triggered when they are clicked
    var next_btn = document.getElementById("nextBtn");
    if (next_btn) {
        next_btn.addEventListener("click", nextQuestion);
    }

    var previous_btn = document.getElementById("previousBtn");
    if (previous_btn) {
        previous_btn.addEventListener("click", previousQuestion);
    }

    var submit_btn = document.getElementById("submitBtn");
    if (submit_btn) {
        submit_btn.addEventListener("click", showResults);
    }

    var reset_quiz_btn = document.getElementById("resetQuizBtn");
    if (reset_quiz_btn) {
        reset_quiz_btn.addEventListener("click", resetQuiz);
    }


    // checking if any of the buttons should be disabled (ie previous button on first page of the quiz)
    // this code will execute and disable these buttons in that case
    <?php
    if ($current_page == 1){
        echo "document.getElementById('previousBtn').disabled = true;";
    }
    if ($current_page == $num_questions_to_show){
        echo "document.getElementById('nextBtn').disabled = true;";
    }
    ?>


    // functions for performing operations based on which buttons are clicked
    function getSelection(){
        if (document.getElementById("choice_1").checked == true){
            return "A";
        }
        else if (document.getElementById("choice_2").checked == true){
            return "B";
        }
        else if (document.getElementById("choice_3").checked == true){
            return "C";
        }
        else if (document.getElementById("choice_4").checked == true){
            return "D";
        }
        return "0";
    }

    // responsible for redirecting user to next question page
    function nextQuestion(){
        var selection = getSelection();
        if (selection != "0"){
            var nextPage = "<?php echo "./display_quiz.php?topic=$quiz_topic&page=$next_page&previous_page=$current_page&previous_selection=" ?>";
            nextPage = nextPage + selection;
            window.location.href = nextPage;
        } else{
            window.location.href = "<?php echo "./display_quiz.php?topic=$quiz_topic&page=$next_page" ?>";
        }
    }

    // responsible for redirecting user to previous question page
    function previousQuestion(){
        var selection = getSelection();
        if (selection != "0"){
            var nextPage = "<?php echo "./display_quiz.php?topic=$quiz_topic&page=$previous_page&previous_page=$current_page&previous_selection=" ?>";
            nextPage = nextPage + selection;
            window.location.href = nextPage;
        } else{
            window.location.href = "<?php echo "./display_quiz.php?topic=$quiz_topic&page=$previous_page" ?>";
        }
    }

    // responsible for loading the quiz results
    function showResults(){
        var selection = getSelection();
        if (selection != "0"){
            var nextPage = "<?php echo "./display_quiz.php?topic=$quiz_topic&page=$current_page&quiz_finished=true&previous_page=$current_page&previous_selection=" ?>";
            nextPage = nextPage + selection;
            window.location.href = nextPage;
        } else{
            window.location.href = "<?php echo "./display_quiz.php?topic=$quiz_topic&page=$current_page&quiz_finished=true" ?>";
        }
    }

    // responsible for resetting the quiz's saved answers
    function resetQuiz(){
        // reloads the page and specifies the parameter to manually reset the quiz
        window.location.href = "<?php echo "./display_quiz.php?topic=$quiz_topic&page=1&reset_quiz=true" ?>";
    }
    </script>

    </div>
    </body>
</html>
