
<?php 

include "header.php";

?>
<?php

$btnname = "submit";
if (isset($_REQUEST['submit'])) {

    $imagename = "default.jfif";
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../chef/" . $filename;
    if ($filename == "") {
    } else {

        // Now let's move the uploaded image into the folder: image
        move_uploaded_file($tempname, $folder);
        $imagename = $filename;
    }


    $chefname = $_REQUEST['chefname'];
    $chefabout = $_REQUEST['chefabout'];
    $chefcat = $_REQUEST['options'];
    $onduty = $_REQUEST['onduty'];




    $addqry = "insert into chefmaster set cname='$chefname',title='$chefcat',descr='$chefabout',isactive='$onduty',img='$imagename '";

    $res = mysqli_query($conn, $addqry);

    if ($res) {
        echo '<script>
        window.location="mangechefs.php";
        </script>';
    } else {
        echo "data no submitted";
    }
}


//delete query


if (isset($_GET['id'])) {
    if (isset($_GET['action']) && $_GET['action'] == 'del') {
        $del_id = $_GET['id'];
        $del_qry = "delete from chefmaster where id ='$del_id'";
        $del_res = mysqli_query($conn, $del_qry);
        if ($del_res) {
            echo
            "<script>
            window.location'mangechefs.php.';
            </script>";
        } else {
            echo "error!!!";
        }
    } elseif (isset($_GET['action']) && $_GET['action'] == 'edit') {
        //data fetch for edit

        if ($_GET['action'] == "edit") {
            $edit_id = $_GET['id'];
            $show_qry = "select * from chefmaster where id= '$edit_id'";
            $show_res = mysqli_query($conn, $show_qry);
            $mydata = mysqli_fetch_assoc($show_res);

            $btnname = "update";
        }
        //update query

        if (isset($_REQUEST['update'])) {
            $chefname = $_REQUEST['chefname'];
            $chefabout = $_REQUEST['chefabout'];
            $chefcat = $_REQUEST['options'];
            $onduty = $_REQUEST['onduty'];
            $photoName = $_REQUEST['photo-name'];
            $imgupld = $_REQUEST['uploadfile'];

            echo $uptqry = "update chefmaster set cname='$chefname',descr='$chefabout',title='$chefcat',isactive='$onduty',img='$photoName' where id=$edit_id";
            $uptres = mysqli_query($conn, $uptqry);

            if ($uptres) {
                echo "Data updated";
            } else {
                echo "error";
            }

            echo "<script>window.location='mangechefs.php'</script>";
        }
    }
}

?>
<style>
    tr.bg-danger {
        background-color: red !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php" ?>
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
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Chef Name</label>

                            <input type="text" class="form-control" id="exampleFormControlInput1" value=" <?php if (isset($mydata)) echo $mydata['cname']; ?>" placeholder="Enter Chef Name" name="chefname" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Chef Catogary</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="options">

                                <option value="Chef-Owner" <?php if (isset($mydata) && $mydata['title'] == "Chef-Owner") {
                                                                echo "selected";
                                                            } ?>>Chef-Owner</option>
                                <option value="Executive Chef" <?php if (isset($mydata) && $mydata['title'] == "Executive Chef") {
                                                                    echo "selected";
                                                                } ?>>Executive Chef</option>
                                <option value="Sous Chef" <?php if (isset($mydata) && $mydata['title'] == "Sous Chef") {
                                                                echo "selected";
                                                            } ?>>Sous Chef</option>
                                <option value="Senior Chef" <?php if (isset($mydata) && $mydata['title'] == "Senior Chef") {
                                                                echo "selected";
                                                            } ?>>Senior Chef</option>
                                <option value="Pantry Chef" <?php if (isset($mydata) && $mydata['title'] == "Pantry Chef") {
                                                                echo "selected";
                                                            } ?>>Pantry Chef</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">About Chef's</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="chefabout"><?php if (isset($mydata)) echo trim($mydata['descr']); ?>
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Photo Name</label>
                            <input type="text" class="mt-3 mb-3" name="photo-name" value="<?php if (isset($mydata)) echo $mydata['img']; ?>" readonly>
                            <br>
                            <label for="exampleFormControlInput1">Chef's Photo</label>
                            <input type="file" class="form-control" id="exampleFormControlInput1" name="uploadfile">
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" value="1" name="onduty" checked <?php if (isset($mydata) && $mydata['isactive'] == "1") echo "checked"; ?>>
                            <label class="form-check-label">
                                Present
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="onduty" <?php if (isset($mydata) && $mydata['isactive'] == "0") echo "checked"; ?>>
                            <label class="form-check-label">
                                Resign
                            </label>
                        </div>
                        <button type="submit" name="<?php echo $btnname ?>" class="btn btn-primary btn-ml mt-5"><?php echo $btnname; ?></button>

                    </form>


                </div>
                <div class="col-md-6">
                    <h2>All chefs(<?= $count ?>)</h2>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">S. No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">cateogry</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //select query



                            $i = 1;
                            foreach ($get_res as $mydata) {
                                $rowclass = "";
                                if ($mydata['isactive'] == "0") {
                                    $rowclass = "bg-danger";
                                }
                            ?>

                                <tr class='<?= $rowclass ?>'>

                                    <td scope="row"><?php echo $i; ?></td>
                                    <td> <?php echo $mydata['cname']  ?></td>
                                    <td><?php echo $mydata['title']  ?></td>
                                    <td>
                                        <img src="../chef/<?php echo $mydata['img']  ?>" width="100px">
                                    </td>

                                    <td><?php echo $mydata['isactive'] == "1" ? "🟢" : "🔴";  ?></td>
                                    <td><a href='mangechefs.php?action=del&id=<?php echo $mydata["id"] ?>' class="btn btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                        <a href='mangechefs.php?action=edit&id=<?php echo $mydata["id"] ?>' class="btn btn-danger">
                                            Edit
                                        </a>
                                    </td>


                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
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