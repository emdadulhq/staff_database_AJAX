<?php
    include_once "../vendor/autoload.php";

    use Ura\Dhura\Controller\Staff;

    $staff = new Staff;

    $search =  $_POST['search'];

   $data =  $staff -> staffSearch($search);

    while($d = $data -> fetch_assoc()) :

        ?>

<li>
    <div class="search-result clearfix">
        <div class="staff-photo float-left">
            <img style="width: 70px;height: 70px; border-radius:10px;" src="photos/staff/<?php echo $d['photo'];  ?>" alt="">
        </div>
        <div class="staff-info float-left ml-3 mt-3">
            <h4><?php echo $d['name']; ?></h4>
            <h4><?php echo $d['cell']; ?></h4>
        </div>
    </div>
</li>

<?php endwhile; ?>