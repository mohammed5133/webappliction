<?php 
    require_once "include/header.php";
?>


<?php  

        $DepartmentNameErr = $DepartmentShortNameErr = $DepartmentCodeErr = "";
        $DepartmentName = $DepartmentShortName = $DepartmentCode ="";


        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["DepartmentName"]) ){
                $DepartmentNameErr ="<p style='color:red'> * departmentname is required</p>";
            }else {
                $DepartmentName = $_REQUEST["DepartmentName"];
            }


            if( empty($_REQUEST["DepartmentShortName"]) ){
                $DepartmentShortNameErr = "<p style='color:red'> * departmentshortname is required</p>";
            }else {
                $DepartmentShortName = $_REQUEST["DepartmentShortName"];
            }

            if( empty($_REQUEST["DepartmentCode"]) ){
                $DepartmentCodeErr = "<p style='color:red'> * deptcode is required</p>";
            }else {
                $DepartmentCode = $_REQUEST["DepartmentCode"];
            }

            if( !empty($DepartmentName) && !empty($DepartmentShortName) && !empty($DepartmentCode) ){

                // database connection
                require_once "../connection.php";

                $sql_select_query = "SELECT DepartmentName FROM tdldepartments WHERE DepartmentName = '$DepartmentName' ";
                $r = mysqli_query($conn , $sql_select_query);

                if( mysqli_num_rows($r) > 0 ){
                    $DepartmentNameErr = "<p style='color:red'> * departmentname Already Register</p>";
                } else{

                    $sql = "INSERT INTO tdldepartments(DepartmentName,DepartmentCode,DepartmentShortName) VALUES('$DepartmentName', '$DepartmentCode', '$DepartmentShortName' )  ";
                    $result = mysqli_query($conn , $sql);
                    if($result){
                     $DepartmentName = $DepartmentShortName = $DepartmentCode = "";
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-department.php');
                            $('#linkBtn').text('View Departments');
                            $('#addMsg').text('Department Added Successfully!');
                            $('#closeBtn').text('Add More?');
                        })
                     </script>
                     ";
                    }
                    
                }

            }
        }

?>



<div style=""> 
<div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">                       
                                    <h4 class="text-center">Add New Department</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Department Name</label>
                                    <input type="text" class="form-control" value="<?php echo $DepartmentName; ?>"  name="DepartmentName" >
                                   <?php echo $DepartmentNameErr; ?>
                                </div>


                                <div class="form-group">
                                    <label >Department Short Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $DepartmentShortName; ?>"  name="DepartmentShortName" >     
                                    <?php echo $DepartmentShortNameErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >dept Code </label>
                                    <input type="text" class="form-control" value="<?php echo $DepartmentCode; ?>" name="DepartmentCode" > 
                                    <?php echo $DepartmentCodeErr; ?>           
                                </div>


                               
                                <br>

                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>


