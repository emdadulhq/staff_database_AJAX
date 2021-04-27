<?php
    include_once "../vendor/autoload.php";

    use Ura\Dhura\Controller\Staff;

    $staff = new Staff;
    $user_id =  $_POST['id'];

    $data = $staff -> showStaff($user_id);

    $single_staff_data = $data -> fetch_assoc();

    echo json_encode($single_staff_data);