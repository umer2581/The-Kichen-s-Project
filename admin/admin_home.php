<?php
include "header.php";
// error_reporting(0);

if (isset($_REQUEST['submit'])) {
    $aboutus = $_REQUEST['aboutus'];
    $whywe = $_REQUEST['whywe'];
    $block1 = $_REQUEST['block1'];
    $block2 = $_REQUEST['block2'];
    $block3 = $_REQUEST['block3'];
    $id = $_REQUEST['id'];

    if ($id) {
        $updateqry = "update home_about set aboutus='$aboutus', whywe='$whywe', block1='$block1', block2='$block2', block3='$block3' where id='$id'";
        $res = mysqli_query($conn, $updateqry);
    } else {
        // insert a new record
        $addqry = "insert into home_about set aboutus='$aboutus', whywe='$whywe', block1='$block1', block2='$block2', block3='$block3'";
        $res = mysqli_query($conn, $addqry);
    }

    if ($res) {
        header('location:admin_home.php');
    } else {
        echo "data no submitted";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $uptqry = "select * from home_about where id='$id'";
    $qryres = mysqli_query($conn, $uptqry);
    $uptfin = mysqli_fetch_array($qryres);
}

$qry = "select * from home_about";
$result = mysqli_query($conn, $qry);
$finres = mysqli_fetch_array($result);

if (!$finres) {
    $finres = array(
        'aboutus' => '',
        'whywe' => '',
        'block1' => '',
        'block2' => '',
        'block3' => ''
    );
}

?>

<style>
    tr.bg-danger {
        background-color: red!important;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php"?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Chefs</h1>

            </div>

            <?php
            $getdata = "select * from chefmaster";
            $get_res = mysqli_query($conn, $getdata);
            $count = mysqli_num_rows($get_res);
           ?>

            <div class="row">
                <div class="col-md-6">
                    <h2>Add/Edit </h2>

                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php if (isset($uptfin)) echo $uptfin['id'];?>">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">About Us</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="aboutus"><?php if (isset($uptfin)) echo $uptfin['aboutus']; else echo $finres['aboutus'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Why We</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="whywe"><?php if (isset($uptfin)) echo $uptfin['whywe']; else echo $finres['whywe'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Block 1</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="block1"><?php if (isset($uptfin)) echo $uptfin['block1']; else echo $finres['block1'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Block 2</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="block2"><?php if (isset($uptfin)) echo $uptfin['block2']; else echo $finres['block2'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Block 3</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="block3"><?php if (isset($uptfin)) echo $uptfin['block3']; else echo $finres['block3'];?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-ml mt-3" name="submit">Submit</button>

                    </form>

                </div>

                <!-- shown data from database -->
                <div class="col-md-6">
                    <h2>Add/Edit </h2>

                    <form method="post" enctype="multipart/form-data">
                    <a href='admin_home.php?id=<?php echo $finres["id"]?>'>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">ABOUT VIEW</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="aboutus" readonly><?php echo $finres['aboutus'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Why We</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="whywe" readonly style="text-decoration: none;"><?php echo $finres['whywe'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Block 1</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="block1" readonly><?php echo $finres['block1'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Block 2</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="block2" readonly><?php echo $finres['block2'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Block 3</label>

                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="block3" readonly><?php echo $finres['block3'];?></textarea>
                        </div>
                        <a href='admin_home.php?id=<?php echo $finres["id"]?>'>
                            <button type="button" class="btn btn-primary mt-3" name="update">Edit</button>
                        </a>

                    </form>

                </div>
            </div>

        </main>
    </div>

</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>
</body>

</html>