<?php

require 'bin/functions.php';
require 'db_configuration.php';


$query = "SELECT * FROM questions";

$GLOBALS['id'] = mysqli_query($db, $query);
$GLOBALS['topic'] = mysqli_query($db, $query);
$GLOBALS['question'] = mysqli_query($db, $query);
$GLOBALS['choice_1'] = mysqli_query($db, $query);
$GLOBALS['choice_2'] = mysqli_query($db, $query);
$GLOBALS['choice_3'] = mysqli_query($db, $query);
$GLOBALS['choice_4'] = mysqli_query($db, $query);
$GLOBALS['answer'] = mysqli_query($db, $query);
$GLOBALS['image_name'] = mysqli_query($db, $query);



?>

<?php $page_title = 'Training Table'; ?>
<?php include('header.php'); ?>

<!-- Page Content -->
<div class="container-fluid">
    <?php
            if(isset($_GET['updatedRoster'])){
                if($_GET["updatedRoster"] == "Success"){
                    echo '<br><h3>Success! The Training Schedule has been updated!</h3>';
                }
            }

    ?>
    <!-- Page Heading -->
    <h1 class="my-4">
        <?php
        //Display Admin view if an admin is logged in.
        //This gives full access to all CRUD functions
        
        ?>
    </h1>
    
    <div id="customerTableView">
        <button><a class="btn btn-sm" href="create_question.php">Create Question</a></button>
        <table class="table table-striped" id="ceremoniesTable">
            <div class="table responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Question</th>
                    <th>Choice 1</th>
                    <th>Choice 2</th>
                    <th>Choice 3</th>
                    <th>Choice 4</th>
                    <th>Answer</th>
                    <th>Image Name</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($id->num_rows > 0) {
                    // output data of each row
                    while($row = $id->fetch_assoc()) {

                        echo    '<tr>
                                    <td>'.$row["id"].'</td>
                                    <td>'.$row["topic"].' </span> </td>
                                    <td>'.$row["question"].'</td>
                                    <td>'.$row["choice_1"].'</td>
                                    <td>'.$row["choice_2"].' </span> </td>
                                    <td>'.$row["choice_3"].'</td>
                                    <td>'.$row["choice_4"].'</td>
                                    <td>'.$row["answer"].' </span> </td>
                                    <td>'.$row["image_name"].'</td>
                                </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else
                ?>
                </tbody>
            </div>
        </table>
    </div>
</div>

<!-- /.container -->
<!-- Footer -->
    <footer class="page-footer text-center">
        <p>Created for ICS 325 Summer Project "Team Alligators"</p>
    </footer>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


<script type="text/javascript" language="javascript">
    $(document).ready( function () {
        $('#tableResults').DataTable( {
            dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'csv' , 'pdf'
                ] }
        );

        $('#ceremoniesTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );
    } );
</script>
</body>
</html>
