<?php
    include_once "../vendor/autoload.php";

    use Ura\Dhura\Controller\Staff;


    $staff = new Staff;
    $data = $staff -> allStaff();

    $i = 1;
    while($d = $data -> fetch_assoc()) :
        ?>


        <tr>
            <td><?php echo $i;$i++; ?></td>
            <td><?php echo $d['name']; ?></td>
            <td><?php echo $d['email']; ?></td>
            <td><?php echo $d['cell']; ?></td>
            <td><img src="photos/staff/<?php echo $d['photo']; ?>" alt=""></td>
            <td>
                <a id="staff_view_modal" show_id="<?php echo $d['id']; ?>" class="btn btn-sm btn-info" href="#">View</a>
                <a id="staff_update" edit_id="<?php echo $d['id']; ?>" class="btn btn-sm btn-warning" href="#">Edit</a>
                <a id="delete_data" del_id="<?php echo $d['id']; ?>" class="btn btn-sm btn-danger" href="#">Delete</a>
            </td>
        </tr>




    <?php

    endwhile;

