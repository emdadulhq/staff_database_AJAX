<?php
    include_once "../vendor/autoload.php";

    use Ura\Dhura\Controller\Staff;

    $staff = new Staff;
    $user_id =  $_POST['id'];


    $data = $staff -> deleteStaff($user_id);

    if ($data){
        echo '<p class="alert alert-success"> Staff deleted successful !<button class="close" data-dismiss="alert">&times;</button></p>';
    }