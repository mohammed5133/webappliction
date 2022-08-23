<?php 
    require_once "include/header.php";
?>


<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM tdldepartments";
$result = mysqli_query($conn , $sql);

$i = 1;
$you = "";

?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>Manage Deparments</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>Department ID</th>
        <th>Department Name</th>
        <th>Department Short Name</th>
        <th>Department Code</th> 
        
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $DepartmentName= $rows["DepartmentName"];
            $DepartmentShortName= $rows["DepartmentShortName"];
            $DepartmentCode = $rows["DepartmentCode"];
              
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td><?php echo $DepartmentName; ?></td>
        <td> <?php echo $DepartmentShortName ; ?></td>
        <td> <?php echo $DepartmentCode ; ?></td>

        <!-- <td>  <?php 
            //     $edit_icon = "<a href='edit-employee.php?id= {$id}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
            //     $delete_icon = " <a href='delete-employee.php?id={$id}' id='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
            //     echo $edit_icon . $delete_icon;
            //  ?> 
        </td> -->

      
        

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').attr('href', 'add-dept.php');
                $('#linkBtn').text('Add Deparment');
                $('#addMsg').text('No Department Found!');
                $('#closeBtn').text('Remind Me Later!');
            })
         </script>
         ";
        }
    ?>
     </tr>
    </table>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>

<?php 
    require_once "include/footer.php";
?>