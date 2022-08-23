<?php 
    require_once "include/header.php";
?>


<?php  

        $nameErr = $emailErr = $genderErr = $dobErr = $passErr = $salaryErr = $DepartmentNameErr = $phoneErr = $adressErr = $emp_imgErr = $emp_scan_decisionErr = $jop_typeErr = $emp_typeErr = $dobErr = $date_empErr = "";
        $name = $email = $dob = $pass = $gender = $salary = $DepartmentName = $phone = $adress = $emp_img = $emp_scan_decision = $jop_type = $emp_type = $dop = $date_emp = "";
        

        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["gender"]) ){
                $genderErr ="<p style='color:red'> * gender is required</p>";
            }else {
                $gender = $_REQUEST["gender"];
            }


            if( empty($_REQUEST["dob"]) ){
                $dobErr = "<p style='color:red'> * Date of Bright is required</p>";
            }else {
                $dob = $_REQUEST["dob"];
            }

            if( empty($_REQUEST["name"]) ){
                $nameErr = "<p style='color:red'> * Name is required</p>";
            }else {
                $name = $_REQUEST["name"];
            }

            if( empty($_REQUEST["salary"]) ){
                $salaryErr = "<p style='color:red'> * Salary is required</p>";
                $salary = "";
            }else {
                $salary = $_REQUEST["salary"];
            }

            if( empty($_REQUEST["email"]) ){
                $emailErr = "<p style='color:red'> * Email is required</p> ";
            }else{
                $email = $_REQUEST["email"];
            }

            if( empty($_REQUEST["pass"]) ){
                $passErr = "<p style='color:red'> * Password is required</p> ";
            }else{
                $pass = md5($_REQUEST["pass"]);
            }

            if( empty($_REQUEST["DepartmentName"]) ){
                $DepartmentNameErr = "<p style='color:red'> * Department Name is required</p> ";
            }else{
                $DepartmentName = $_REQUEST["DepartmentName"];
            }

            if( empty($_REQUEST["phone"]) ){
                $phoneErr = "<p style='color:red'> * Phone is required</p> ";
            }else{
                $phone = $_REQUEST["phone"];
            }

            if( empty($_REQUEST["adress"]) ){
                $adressErr = "<p style='color:red'> * adress is required</p> ";
            }else{
                $adress = $_REQUEST["adress"];
            }

            if( empty($_REQUEST["emp_img"]) ){
                $emp_imgErr = "<p style='color:red'> * Empolyee Image is required</p> ";
            }else{
                $emp_img = $_REQUEST["emp_img"];
            }

            if( empty($_REQUEST["emp_scan_decision"]) ){
                $emp_scan_decisionErr = "<p style='color:red'> * Empolyee Scan Desision is required</p> ";
            }else{
                $emp_scan_decision = $_REQUEST["emp_scan_decision"];
            }

            if( empty($_REQUEST["jop_type"]) ){
                $jop_typeErr = "<p style='color:red'> * Job Type is required</p> ";
            }else{
                $jop_type = $_REQUEST["jop_type"];
            }

            if( empty($_REQUEST["emp_type"]) ){
                $emp_typeErr = "<p style='color:red'> * Employee Type is required</p> ";
            }else{
                $emp_type = $_REQUEST["emp_type"];
            }

            if( empty($_REQUEST["date_emp"]) ){
                $date_empErr = "<p style='color:red'> * Employed Date is required</p> ";
            }else{
                $emp_date = $_REQUEST["date_emp"];
            }


            if( !empty($name) && !empty($email) && !empty($pass) && !empty($salary) && !empty($DepartmentName) && !empty($emp_img)){

                // database connection
                require_once "../connection.php";

                $sql_select_query = "SELECT email FROM employee WHERE email = '$email' ";
                $r = mysqli_query($conn , $sql_select_query);

                if( mysqli_num_rows($r) > 0 ){
                    $emailErr = "<p style='color:red'> * Email Already Register</p>";                                                       
                } else{
                    $sql = "INSERT INTO employee( name , email , password , dob, gender , salary, DepartmentName, phone, adress, emp_img, emp_scan_decision, job_type, emp_type, date_emp ) VALUES( '$name' , '$email' , '$pass' , '$dob' , '$gender', '$salary', '$DepartmentName', '$adress', '$phone', '$emp_img', '$emp_scan_decision', '$jop_type', '$emp_type', '$dop'  )  ";
                    $result = mysqli_query($conn , $sql);
                    if($result){
                     $name = $email = $dob = $gender = $pass = $salary = $DepartmentName = $phone = $adress = $emp_img = $emp_scan_decision = $jop_type = $emp_type = $dop = $date_emp = "";
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-employee.php');
                            $('#linkBtn').text('View Employees');
                            $('#addMsg').text('Employee Added Successfully!');
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
                                    <h4 class="text-center">اضافة موظف جديد</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >الأسم الرباعي</label>
                                    <input type="text" class="form-control" value="<?php echo $name; ?>"  name="name" >
                                   <?php echo $nameErr; ?>
                                </div>


                                <div class="form-group">
                                    <label >البريد الإلكتروني</label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"  name="email" >     
                                    <?php echo $emailErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >كلمة المرور </label>
                                    <input type="password" class="form-control" value="<?php echo $pass; ?>" name="pass" > 
                                    <?php echo $passErr; ?>           
                                </div>

                                <div class="form-group">
                                    <label >الراتب</label>
                                    <input type="number" class="form-control" value="<?php echo $salary; ?>" name="salary" >  
                                    <?php echo $salaryErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >تاريخ الميلاد</label>
                                    <input type="date" class="form-control" value="<?php echo $dob; ?>" name="dob" >  
                                    <?php echo $dobErr; ?> 
                                </div>

                                <div class="form-group form-check form-check-inline">
                                    <label class="form-check-label" >الجنس </label><br>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "ذكر" ){ echo "checked"; } ?>  value="ذكر"  selected>
                                    <label class="form-check-label" >ذكر</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "انثى" ){ echo "checked"; } ?>  value="انثى">
                                    <label class="form-check-label" >انثى</label>
                                </div>
                            
                                <div class="form-group">
                                    <label >رقم الهاتف</label>
                                    <input type="text" class="form-control" value="<?php echo $phone; ?>" name="phone" > 
                                    <?php echo $phoneErr; ?> 
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label">القسم التابع له</label>
                                            <select class="custom-select" name="DepartmentName">
                                                <option value="">اختيار القسم</option>
                                            <?php
                                                require_once "../connection.php";
                                                //$sql_query = "SELECT * FROM tdldepartments ";
                                                $sql = "SELECT * FROM tdldepartments";
                                                $result = mysqli_query($conn , $sql);
                                                $i = 1;
                                                
                                                if( mysqli_num_rows($result) > 0)
                                                
                                                    while( $rows = mysqli_fetch_assoc($result) )
                                                    {
                                                        $DepartmentName= $rows["DepartmentName"];
                                                        
                                                        
                                                    }
                                                    ?>
                                                    <option value="<?php echo $DepartmentName; ?>"><?php echo $DepartmentName; ?></option>
                                                    <?php $i++;?>
                                                                                                    
                                            
                                            </select>
                                            <?php echo $DepartmentNameErr; ?> 
                                        </div>

                                        <div class="form-group">
                                    <label > العنوان</label>
                                    <input type="text" class="form-control" value="<?php echo $adress; ?>" name="adress" > 
                                    <?php echo $adressErr; ?> 
                                </div>

                                <div class="form-group">
                                    <label > الصورة الشخصية</label>
                                    <input type="file" class="form-control" value="<?php echo $emp_img; ?>" name="emp_img" > 
                                    <?php echo $emp_imgErr; ?> 
                                </div>

                                <div class="form-group">
                                    <label > نسخة من قرار التوظيف</label>
                                    <input type="file" class="form-control" value="<?php echo $emp_scan_decision; ?>" name="emp_scan_decision" > 
                                    <?php echo $emp_scan_decisionErr; ?> 
                                </div>
                                <div class="form-group">
                                    <label > نوع العمل</label>
                                    <input type="text" class="form-control" value="<?php echo $jop_type; ?>" name="jop_type" > 
                                    <?php echo $jop_typeErr; ?> 
                                </div>

                                <div class="form-group">
                                            <label class="col-form-label">نوع التوظيف</label>
                                            <select class="custom-select" name="emp_type" autocomplete="off">
                                                <option value=""> تحديد النوع</option>
                                            
                                                <option value="former">تعيين دائم</option>
							                    <option value="employment_contract">عقد توظيف</option>
                                                <option value="employment_transfer">نقل</option>
                                                <option value="employment_scar">ندب</option>
                                                <option value="employment_ioan">اعارة</option>
                                            
                                            </select>
                                            <?php echo $emp_typeErr; ?> 
                                        </div>
                    <div class="form-group">
                                    <label >تاريخ التوظيف</label>
                                    <input type="date" class="form-control" value="<?php echo $date_emp; ?>" name="date_emp" >  
                                    <?php echo $date_empErr; ?>
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

