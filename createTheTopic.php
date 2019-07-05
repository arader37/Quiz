<?php

include_once 'db_configuration.php';

if (isset($_POST['topic'])){

    $topic = mysqli_real_escape_string($db, $_POST['topic']);
    $imageName = mysqli_real_escape_string($db,$_POST['image_name']);
    $validate = true;
    
    
    if($validate){
          
        $sql = "INSERT INTO topics(topic,image_name)
                VALUES ('$topic','$imageName')
                ";

                mysqli_query($db, $sql);
                header('location: questions_list.php?createTopic=Success');
                }     
        else{
            header('location: create_question.php?createQuestion=answerFailed');
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