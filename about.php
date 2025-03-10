<?php include('header.php');
include ('./admin/connections.php');
$get_data = "select * from home_about";
$get_qry = mysqli_query($conn, $get_data);
$arr_data = mysqli_fetch_array($get_qry);
?>
    
        <section id="aboutus back">
            <h6 class="text-center" style="padding-top: 20px;">ABOUT US</h6>
            <H2 class="text-center" style="padding-top: 20px; padding-bottom: 20px;">LEARN MORE ABOUT US</H2>
            
                <div class="container">
                    <div class="row">
                        <div class="col-7">
                            <img src="./assest1/images/about.jpg" class="w-100">
                            <div class="book" style="margin-top: 20px;">
                                <h2>Book A Table</h2>
                                <p>123456789</p>
                            </div>
                        </div>
                        <div class="col-5">
                            <p><?php echo $arr_data['aboutus'] ?>
                                
                                </p>
                                <img src="./assest1/images/about-2.jpg" style="width: 90%; margin: 40px;" alt="">
                        </div>
                    </div>
                </div>
            </section>
        

            <?php include("footer.php"); ?>