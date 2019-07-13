<?php 
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');

// functions
function getNumQuestionsForThisQuiz($quiz_name){
    global $db; // tell the function to use to global variable $db
    $sql = "select count(topic) as c from questions where topic = '$quiz_name'";
    $results = mysqli_query($db,$sql);

    $num_questions_found = 0;
    if(mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){
            $rows[] = $row;
        }
        $num_questions_found = $rows[0]['c']; // get the value of c for this first row that returned from the query
    }

    //echo "Found $num_questions_found questions for the quiz on topic $quiz_name";
    return $num_questions_found;
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
            echo "<h2 style='color:red;'>Missing/Invalid Quiz Topic</h2>";
        } else{
            $quiz_topic = $_GET['topic'];
            $current_page = 1;
            if (isset($_GET['page']) == true){
                $current_page = $_GET['page'];
            }
            $num_questions = getNumQuestionsForThisQuiz($quiz_topic);

            echo "<h2>Quiz: $quiz_topic</h2>";
            echo "<h6>Page: $current_page of $num_questions</h6>";
        }
    ?>
    </div>
    </body>
</html>
