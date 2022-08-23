

<?php 
    require_once "include/header.php";
?>

<?php 
 

//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM emp_leave WHERE status = 'pending' ";
$result = mysqli_query($conn , $sql);

$i = 1;

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
    <h4 class="text-center pb-3">Leave Requests</h4>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Date</th>
        <th>Asp Title</th>
        <th>Asp Detail</th>
        <th>procese</th> 
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $date= $rows["date"];
            $email= $rows["email"];
            $AspTitle = $rows["AspTitle"];
            $AspDetail = $rows["AspDetail"]; 
            $id = $rows["id"];   
            ?>
        <tr>
        <td><?php echo "$i."; ?></td>
        <td><?php echo date("jS F", strtotime($date)); ?></td>
        <td><?php echo $AspTitle; ?></td> 
        <td><?php echo $AspDetail; ?></td> 


        <td><?php  echo "<a href='accept-leave.php?id={$id}' class='btn btn-sm btn-outline-primary mr-2'>Accept </a>" ;
                    echo "<a href='cancel-leave.php?id={$id}' class='btn btn-sm btn-outline-danger'>Cancel </a>" ;?>  
        </td> 

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').hide();
                $('#addMsg').text('No Asp Requests Found');
                $('#closeBtn').text('Ok, Understood');
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
