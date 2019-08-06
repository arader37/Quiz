<?php

require 'bin/functions.php';
require 'db_configuration.php';


$query = "SELECT * FROM topics";

$GLOBALS['order'] = mysqli_query($db, $query);
$GLOBALS['image_name'] = mysqli_query($db, $query);
$GLOBALS['topic'] = mysqli_query($db, $query);

?>

<?php $page_title = 'Quiz Master > Topics'; ?>
<?php include('header.php'); 
    $page="questions_list.php";
    verifyLogin($page);

?>
<style>
    #title {
        text-align: center;
        color: darkgoldenrod;
    }
    thead input {
        width: 100%;
    }
    .thumbnailSize{
        height: 100px;
        width: 100px;
        transition:transform 0.25s ease;
    }
    .thumbnailSize:hover {
        -webkit-transform:scale(3.5);
        transform:scale(3.5);
    }


</style>
<!-- Page Content -->
<br><br>
<div class="container-fluid">
    <?php
            if(isset($_GET['createQuestion'])){
                if($_GET["createQuestion"] == "Success"){
                    echo '<br><h3>Success! Your question has been added!</h3>';
                }
            }

            if(isset($_GET['questionUpdated'])){
                if($_GET["questionUpdated"] == "Success"){
                    echo '<br><h3>Success! Your question has been modified!</h3>';
                }
            }

            if(isset($_GET['questionDeleted'])){
                if($_GET["questionDeleted"] == "Success"){
                    echo '<br><h3>Success! Your question has been deleted!</h3>';
                }
            }

            if(isset($_GET['createTopic'])){
                if($_GET["createTopic"] == "Success"){
                    echo '<br><h3>Success! Your topic has been added!</h3>';
                }
            }

    ?>
    
    <h2 id="title">Topic List</h2><br>
    
    <div id="customerTableView">
        <button><a class="btn btn-sm" href="createTopic.php">Create a Topic</a></button>
        <table class="table table-striped" id="ceremoniesTable">
            <div class="table responsive">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Image Name</th>
                    <th>Topic</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($order->num_rows > 0) {
                    // output data of each row
                    while($row = $order->fetch_assoc()) {

                        echo    '<tr>
                                    <td>'.$row["order"].' </span> </td>
                                    <td>'.$row["image_name"].' </span> </td>
                                    <td>'.$row["topic"].'</td>
                                    <td><a class="btn btn-warning btn-sm" href="modifyTopic.php?id='.$row["order"].'">Modify</a></td>                                  
                                    <td><a class="btn btn-danger btn-sm" href="deleteTopic.php?id='.$row["order"].'">Delete</a></td> 
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
        
        $('#ceremoniesTable').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
            
            
        );

        $('#ceremoniesTable thead tr').clone(true).appendTo( '#ceremoniesTable thead' );
        $('#ceremoniesTable thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#ceremoniesTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>
</body>
</html>
