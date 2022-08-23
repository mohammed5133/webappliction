<?php

require_once "include/header.php";
?>

<?php 



$AspTitleErr = $AspDetailErr = $dateErr = "";
$AspTitle = $AspDetail = $date ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if( empty($_REQUEST["AspTitle"]) ){
        $AspTitleErr = "<p style='color:red'>* AspTitle is Required</p>";    
    }else{
        $AspTitle = $_REQUEST["AspTitle"];
    }
 
    if( empty($_REQUEST["AspDetail"]) ){
        $AspDetailErr = "<p style='color:red'>* AspDetail is Required</p>";    
    }else{
        $AspDetail = $_REQUEST["AspDetail"];
    }
    if( empty($_REQUEST["date"]) ){
        $dateErr = "";    
    }else{
        $date = $_REQUEST["date"];
    }
     
   

        if( !empty($AspTitle) && !empty($AspDetail) ){
          
            // database connection 
            require_once "../connection.php";

            $sql = "INSERT INTO emp_leave( AspTitle , AspDetail , date , email , status ) VALUES( '$AspTitle' , '$AspDetail' , '$date' , '$_SESSION[email_emp]' , 'pending' )";
            $result = mysqli_query($conn , $sql);
            if($result){
                $AspTitle = $AspDetail = $date = "";
                echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#addMsg').text('Asp Applied , Please Wait until it is approved!!');
                $('#linkBtn').attr('href', 'leave-status.php');
                $('#linkBtn').text('Check Leave Status');
                $('#closeBtn').text('Apply Another');
            })
        </script>
        ";
            }
        }
}
?>


<div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6 pt-5">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                              
                                    <h4 class="text-center">تقديم تظلم</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                
                                    <div class="form-group">
                                        <label >موضوع التظلم</label>
                                        <input type="text" class="form-control" value="<?php echo $AspTitle; ?> " name="AspTitle" >  
                                        <?php echo $AspTitleErr; ?>           
                                    </div>

                                    <div class="form-group">
                                        <label > تفاصيل التظلم</label>
                                        <textarea type="text" class="form-control"  value="<?php echo $AspDetail; ?>"  name="AspDetail" rows="4" ></textarea>
                                        <?php echo $AspDetailErr; ?>
                                    </div>
                                    <div class="form-group">
                                        <label >التاريخ</label>
                                        <input type="date" class="form-control"  value="<?php echo $date; ?>"  name="date" >
                                        <?php echo $dateErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="ارسال" class="btn btn-primary btn-lg w-100 " name="signin" >
                                    </div>
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