<?php include('header.php'); ?>
<?php
include "./admin/connections.php";

$get_data = "select * from chefmaster";
$get_qry = mysqli_query($conn, $get_data);
?>
<section class="container">
  <h6 class="text-center ">CHEFS</h6>
  <h2 class="text-center pt-4 pb-5">Our Proffesional Chefs</h2>
  <div class="row g-5">
    <?php foreach ($get_qry as $val) { ?>
      <?php if($val['isactive']==1){ ?>
      <div class="col-md-4" data-aos="flip-left" data-aos-duration="1500">
        <div class="card" style="width: 22rem;">
          <img src="./chef/<?php echo $val['img']; ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h2 class="text-center"><?php echo $val['cname']; ?></h2>
            <h6 class="text-center"><?php echo $val['title']; ?></h6>
            <p class="card-text"><?php echo $val['descr']; ?></p>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php } ?>
  </div>




</section>
<?php include('footer.php'); ?>