<?php
    include_once "../vendor/autoload.php";

    use Ura\Dhura\Controller\Staff;



    $staff = new Staff;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];

    // files
    $file_name = $_FILES['photo']['name'];
    $file_name_tmp = $_FILES['photo']['tmp_name'];
    $unique_name = md5(time().rand()) . $file_name ;

    move_uploaded_file($file_name_tmp, '../photos/staff/'. $unique_name);


    $data = $staff -> createStaff($name, $email, $cell, $unique_name);

    if ($data){
        echo '<p class="alert alert-success"> Staff added successful !<button class="close" data-dismiss="alert">&times;</button></p>';
    }

