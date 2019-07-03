<?php

include_once 'db_configuration.php';
include_once 'updateTheRoster.php';

if (isset($_POST['topic'])){

    $topic = mysqli_real_escape_string($db, $_POST['topic']);
    $question = mysqli_real_escape_string($db,$_POST['question']);
    $choice1 = mysqli_real_escape_string($db,$_POST['choice_1']);
    $choice2 = mysqli_real_escape_string($db,$_POST['choice_2']);
    $choice3 = mysqli_real_escape_string($db,$_POST['choice_3']);
    $choice4 = mysqli_real_escape_string($db,$_POST['choice_4']);
    $answer = mysqli_real_escape_string($db,$_POST['answer']);
    $imageName = mysqli_real_escape_string($db,$_POST['image_name']);
    $validate = true;
    $validate = emailValidate($answer);
    
    if($validate){
          
        mysqli_query($db, $update);
        $sql = "INSERT INTO questions(topic,question,choice_1,choice_2,choice_3,choice_4,answer,image_name)
                VALUES ('$topic','$question','$choice1','$choice2','$choice3','$choice4','$answer','$imageName')
                ";

                mysqli_query($db, $sql);
                header('location: questions_list.php?updatedRoster=Success');
                }     
        else{
            header('location: create_question.php?updatedRoster=answerFailed');
        }
       

}//end if

function emailValidate($answer){
    global $choice1,$choice2,$choice3,$choice4;
    if($answer == $choice1 or $answer == $choice2 or $answer == $choice3 or $answer == $choice4){
        return true;
    }else{
        return false;
    }      
}
?>