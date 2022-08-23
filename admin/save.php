if(mysqli_num_rows($section) > 0){
    $section = mysqli_query($conn, $sql_query);
                                             foreach($section as $se){
                                                     echo "<option value=".$se['id'].">".$se['DepartmentName']."</option>";
                                             }
                                             }
                                                 <option value="AdminAff">الشؤون الإدارية</option>
                                                 <option value="PublicRela">العلاقات العامة</option>
                                                 <option value="FollowInsp">المتابعة والتفتيش</option>
                                                 <option value="Media_and_Communication">الإعلام والتواصل</option>
                                                ?>