<?php $page_title = 'Create a Question'; ?>
<?php include('header.php'); ?>
<?php 
    $mysqli = NEW MySQLi('localhost','root','','quiz_master');
    $resultset = $mysqli->query("SELECT DISTINCT topic FROM topics ORDER BY topic ASC");   
?>
<link href="css/form.css" rel="stylesheet">
<div class="container">
    <!--Check the CeremonyCreated and if Failed, display the error message-->
    <?php
    if(isset($_GET['createQuestion'])){
        if($_GET["createQuestion"] == "answerFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
        }
    }

    ?>
    <form action="createTheQuestion.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 text-align="center">Create A Question</h3> <br>
        
        <div align="center" class="form-group col-md-8">
            <label for="safe_link">Topic</label><br>
            <select name="topic">
            <?php 
            while($rows = $resultset->fetch_assoc()){
                $topic=$rows['topic']; 
                echo"<option Value='$topic'>$topic</option>";}?>
            </select>
        </div>

        
                <label for="safe_link">Question</label>
                <input type="text"  name="question" maxlength="50" size="50" required title="Please enter a question.">
                <br>
                <label for="safe_link">Choice 1</label>
                <input type="text"  name="choice_1" maxlength="50" size="50" required title="Please enter answer 1.">
                <br>
                <label for="safe_link">Choice 2</label>
                <input type="text"  name="choice_2" maxlength="50" size="50" required title="Please enter answer 2.">
                <br>
                <label for="safe_link">Choice 3</label>
                <input type="text"  name="choice_3" maxlength="50" size="50" required title="Please enter answer 3.">
                <br>
                <label for="safe_link">Choice 4</label>
                <input type="text"  name="choice_4" maxlength="50" size="50" required title="Please enter answer 4.">
                <br>
                <label for="safe_link">Answer</label>
                <input type="text"  name="answer" maxlength="50" size="50" required title="Please enter the answer.">
                <br>
                <label for="safe_link">Image Path</label>
                <input type="file" name="fileToUpload" id="fileToUpload" maxlength="50" size="50" title="Please enter the Image Name.">
        

        <br><br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Question</button>
        </div>
        <br> <br>

    </form>
</div>

