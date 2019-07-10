<?php 
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php'); 

$sql1 = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_TOPICS_PER_ROW'";
$sql2 = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_QUESTIONS_TO_SHOW'";

$results = mysqli_query($db,$sql1);
$results2 = mysqli_query($db,$sql2);

if(mysqli_num_rows($results)>0){
    while($row = mysqli_fetch_assoc($results)){
        $column[] = $row;
    }
}
$rows = $column[0]['value'];

if(mysqli_num_rows($results2)>0){
    while($row = mysqli_fetch_assoc($results2)){
        $question[] = $row;
    }
}
$questions = $question[0]['value'];

?>

<div class="container">
    <!--Check the CeremonyCreated and if Failed, display the error message-->
    
    <form action="modifyThePreferences.php" method="POST">
        <br>
        <h3 text-align="center">Modify the Preferences</h3> <br>
        
        <div class="form-group col-md-8">
            <?php echo "<label>Current Number of Topics Per Row: &nbsp;&nbsp; $rows</label>"; ?>
        </div>

        <div class="form-group col-md-8">
            <?php echo "<label>Current Number of Questions Per Quiz: &nbsp;&nbsp; $questions</label>"; ?>
        </div>

        <div class="form-group col-md-8">
                <label for="safe_link">New Number of Topics Per Row</label>
                <input type="int"  name="new_rows" maxlength="2" size="10" required title="Please enter number.">
        </div>

        <div class="form-group col-md-8">
                <label for="safe_link">New Number of Questions Per Quiz</label>
                <input type="int"  name="new_questions" maxlength="2" size="10" required title="Please enter number.">
        </div>

        <br>
        <div class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Preferences</button>
        </div>
        <br> <br>

    </form>
</div>

