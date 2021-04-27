<?php
    include_once "../vendor/autoload.php";

    use Ura\Dhura\Controller\Staff;

    $staff = new Staff;

    $email =  $_POST['email'];


    $status = $staff -> emailCheck($email);

    if($status == true) {
        echo "ok";
    }else if($status == false) {
        echo 'not';
    }

