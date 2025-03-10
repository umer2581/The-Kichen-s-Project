<?php include('header.php'); ?>
<?php include('./admin/connections.php') ;


$menusqry = "select * from home_menus";
$menusfin = mysqli_query($conn, $menusqry);

$breakqry = "select * from breakfast";
$breakfin = mysqli_query($conn, $breakqry);


$lunchqry = "select * from lunch";
$lunchfin = mysqli_query($conn, $lunchqry);


$dinnerqry = "select * from dinner";
$dinnerfin = mysqli_query($conn, $dinnerqry);
?>

?>
<!-- Menu Section -->
<section id="menu" class="menu section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Our Menu</h2>
  <p><span>Check Our</span> <span class="description-title">Naaz's Menu</span></p>
</div><!-- End Section Title -->

<div class="container">

  <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

    <li class="nav-item">
      <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
        <h4>Starters</h4>
      </a>
    </li><!-- End tab nav item -->

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
        <h4>Breakfast</h4>
      </a><!-- End tab nav item -->

    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
        <h4>Lunch</h4>
      </a>
    </li><!-- End tab nav item -->

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
        <h4>Dinner</h4>
      </a>
    </li><!-- End tab nav item -->

  </ul>

  <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

    <div class="tab-pane fade active show" id="menu-starters">

      <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Starters</h3>
      </div>

      <div class="row gy-5">

      <?php $count = 0;
              foreach ($menusfin as $menusres) {
              ?>
                <?php if ($count < 6) { ?>
                  <div class="col-lg-4 menu-item">
                    <a href="assets/img/menu/<?php echo $menusres['foodimg']; ?>" class="glightbox"><img src="assets/img/menu/<?php echo $menusres['foodimg']; ?>" class="menu-img img-fluid" alt=""></a>
                    <h4><?php echo $menusres['foodname']; ?></h4>
                    <p class="ingredients">
                      <?php echo $menusres['fooddesc']; ?>
                    </p>
                    <p class="price">
                      <?php echo $menusres['foodprice']; ?>
                    </p>
                  </div><!-- Menu Item -->
                  <?php $count++; ?>
                <?php } ?>
              <?php } ?>

                  

      </div>
    </div><!-- End Starter Menu Content -->

    <div class="tab-pane fade" id="menu-breakfast">

      <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Breakfast</h3>
      </div>

      <div class="row gy-5">
      <?php $count = 0;
              foreach ($breakfin as $breakres) {
              ?>
              <?php if ($count < 6) { ?>

                <div class="col-lg-4 menu-item">
                  <a href="assets/img/menu/<?php echo $breakres['breakfastimg']; ?>" class="glightbox"><img src="assets/img/menu/<?php echo $breakres['breakfastimg']; ?>" class="menu-img img-fluid" alt=""></a>
                  <h4><?php echo $breakres['breakfastname']; ?></h4>
                  <p class="ingredients">
                    <?php echo $breakres['breakfastdesc']; ?>
                  </p>
                  <p class="price">
                    <?php echo $breakres['breakfastprice']; ?>
                  </p>
                </div><!-- Menu Item -->
                <?php $count++; ?>
                <?php } ?>
              <?php } ?>

  

          
      </div>
    </div><!-- End Breakfast Menu Content -->

    <div class="tab-pane fade" id="menu-lunch">

      <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Lunch</h3>
      </div>

      <div class="row gy-5">

      <?php $count = 0;
              foreach ($lunchfin as $lunchres) {
              ?>
              <?php if ($count < 6) { ?>

                <div class="col-lg-4 menu-item">
                  <a href="assets/img/menu/<?php echo $lunchres['lunchimg']; ?>" class="glightbox"><img src="assets/img/menu/<?php echo $lunchres['lunchimg']; ?>" class="menu-img img-fluid" alt=""></a>
                  <h4><?php echo $lunchres['lunchname']; ?></h4>
                  <p class="ingredients">
                    <?php echo $lunchres['lunchdesc']; ?>
                  </p>
                  <p class="price">
                    <?php echo $lunchres['lunchprice']; ?>
                  </p>
                </div><!-- Menu Item -->
                <?php $count++; ?>
                <?php } ?>
              <?php } ?>
      </div>
    </div><!-- End Lunch Menu Content -->

    <div class="tab-pane fade" id="menu-dinner">

      <div class="tab-header text-center">
        <p>Menu</p>
        <h3>Dinner</h3>
      </div>

      <div class="row gy-5">

        <div class="col-lg-4 menu-item">
          <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img src="assets/img/menu/menu-item-1.png" class="menu-img img-fluid" alt=""></a>
          <h4>Magnam Tiste</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $5.95
          </p>
        </div><!-- Menu Item -->

        <div class="col-lg-4 menu-item">
          <a href="assets/img/menu/menu-item-2.png" class="glightbox"><img src="assets/img/menu/menu-item-2.png" class="menu-img img-fluid" alt=""></a>
          <h4>Aut Luia</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $14.95
          </p>
        </div><!-- Menu Item -->

        <div class="col-lg-4 menu-item">
          <a href="assets/img/menu/menu-item-3.png" class="glightbox"><img src="assets/img/menu/menu-item-3.png" class="menu-img img-fluid" alt=""></a>
          <h4>Est Eligendi</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $8.95
          </p>
        </div><!-- Menu Item -->

        <div class="col-lg-4 menu-item">
          <a href="assets/img/menu/menu-item-4.png" class="glightbox"><img src="assets/img/menu/menu-item-4.png" class="menu-img img-fluid" alt=""></a>
          <h4>Eos Luibusdam</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $12.95
          </p>
        </div><!-- Menu Item -->

        <div class="col-lg-4 menu-item">
          <a href="assets/img/menu/menu-item-5.png" class="glightbox"><img src="assets/img/menu/menu-item-5.png" class="menu-img img-fluid" alt=""></a>
          <h4>Eos Luibusdam</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $12.95
          </p>
        </div><!-- Menu Item -->

        <div class="col-lg-4 menu-item">
          <a href="assets/img/menu/menu-item-6.png" class="glightbox"><img src="assets/img/menu/menu-item-6.png" class="menu-img img-fluid" alt=""></a>
          <h4>Laboriosam Direva</h4>
          <p class="ingredients">
            Lorem, deren, trataro, filede, nerada
          </p>
          <p class="price">
            $9.95
          </p>
        </div><!-- Menu Item -->

      </div>
    </div><!-- End Dinner Menu Content -->

  </div>

</div>

</section><!-- /Menu Section -->

<?php include('footer.php'); ?>