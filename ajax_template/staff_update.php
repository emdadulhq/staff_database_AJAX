<?php
    include_once "../vendor/autoload.php";

    use Ura\Dhura\Controller\Staff;

    $staff = new Staff;

    //Form Data get
    $id =$_POST['id'];
    $name =$_POST['name'];
    $email =$_POST['email'];
    $cell =$_POST['cell'];
    $old_photo =$_POST['old_photo'];

    // File
    $file_name = $_FILES['new_photo']['name'];
    $file_tmp_name = $_FILES['new_photo']['tmp_name'];
    $unique_name = md5(time().rand()) . $file_name;

    if (!empty($file_name)){
        move_uploaded_file( $file_tmp_name, '../photos/staff/' . $unique_name );
        $photo_name = $unique_name;
        unlink('../photos/staff/'. $old_photo);
    }else{
        $photo_name = $old_photo;
    }

    $data = $staff -> staffUpdate($name, $email, $cell, $photo_name, $id);




    if( $data ){
        echo '<p class="alert alert-success"> Staff updated successful !<button class="close" data-dismiss="alert">&times;</button></p>';
    }

