<?php $page_title = 'Create a Topic'; ?>
<?php include('header.php'); ?>

<div class="container">
    <!--Check the CeremonyCreated and if Failed, display the error message-->
    <?php
    if(isset($_GET['createTopic'])){
        if($_GET["createTopic"] == "topicFailed"){
            echo '<br><h3 align="center" class="bg-danger">FAILURE - The topic you tried to create already exists, Please Try Again!</h3>';
        }
    }

    ?>
    <form action="createTheTopic.php" method="POST">
        <br>
        <h3 text-align="center">Create A Topic</h3> <br>
        <div align="center" class="form-group col-md-8">
                <label for="safe_link">Topic</label>
                <input type="text"  name="topic" maxlength="50" size="50" required title="Please enter the question topic.">
        </div>

        <div align="center" class="form-group col-md-8">
                <label for="safe_link">Image Path</label>
                <input type="text"  name="image_name" maxlength="50" size="50" required title="Please enter the Image Name.">
        </div>

        <br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Topic</button>
        </div>
        <br> <br>

    </form>
</div>

