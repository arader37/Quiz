<?php

include_once 'db_configuration.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $topic = mysqli_real_escape_string($db, $_POST['topic']);
    $question = mysqli_real_escape_string($db, $_POST['question']);
    $choice_1 = mysqli_real_escape_string($db, $_POST['choice_1']);
    $choice_2 = mysqli_real_escape_string($db, $_POST['choice_2']);
    $choice_3 = mysqli_real_escape_string($db, $_POST['choice_3']);
    $choice_4 = mysqli_real_escape_string($db, $_POST['choice_4']);
    $answer = mysqli_real_escape_string($db, $_POST['answer']);
    $imageName = mysqli_real_escape_string($db, $_POST['image_name']);
    

    $sql = "UPDATE questions
        SET topic = '$topic',
            question = '$question',
            choice_1 = '$choice_1',
            choice_2 = '$choice_2',
            choice_3 = '$choice_3',
            choice_4 = '$choice_4',
            answer = '$answer',
            image_name = '$imageName'            
           
        WHERE id = '$id'";

    mysqli_query($db, $sql);
    header('location: questions_list.php?questionUpdated=Success');
}//end if
?>
