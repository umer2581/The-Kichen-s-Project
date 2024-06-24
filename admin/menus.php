<?php
include "header.php";
$btnname = "submit";
if (isset($_REQUEST['submit'])) {
    if (isset($_FILES['uploadfile'])) {
        $imagename = "default.jfif";
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu" . $filename;
        if ($filename == "") {
        } else {
            move_uploaded_file($tempname, $folder);
            $imagename = $filename;
        }
    } else {
        $imagename = "default.jfif";
    }
    $fname = $_REQUEST['fname'];
    $fprice = $_REQUEST['fprice'];
    $fdesc = $_REQUEST['fdesc'];

    $qry = "insert into home_menus set foodname='$fname',foodprice='$fprice',fooddesc='$fdesc',foodimg='$imagename'";
    $result = mysqli_query($conn, $qry);

    if ($result) {
        header('location:menus.php');
        exit;
    } else {
        echo "data not submitted";
    }
}

if (isset($_GET['id'])) {
    if (isset($_GET['action']) && $_GET['action'] == 'del') {
        $del_id = $_GET['id'];
        $del_qry = "delete from home_menus where id ='$del_id'";
        $del_res = mysqli_query($conn, $del_qry);
        if ($del_res) {
            echo
            "<script>
            window.location='menus.php';
            </script>";
        } else {
            echo "error!!!";
        }
    } elseif (isset($_GET['action']) && $_GET['action'] == 'edit') {
        //data fetch for edit

        if ($_GET['action'] == "edit") {
            $edit_id = $_GET['id'];
            $show_qry = "select * from home_menus where id= '$edit_id'";
            $show_res = mysqli_query($conn, $show_qry);
            $mydata = mysqli_fetch_assoc($show_res);

            $btnname = "update";
        }
    }
}

if (isset($_REQUEST['update'])) {
    $edit_id = $_REQUEST['edit_id'];
    $foodname = $_REQUEST['fname'];
    $foodprice = $_REQUEST['fprice'];
    $fooddesc = $_REQUEST['fdesc'];
    $fimg = $_REQUEST['uploadfile'];

    if (isset($_FILES['uploadfile'])) {
        $imagename = "default.jfif";
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu" . $filename;
        if ($filename == "") {
        } else {
            move_uploaded_file($tempname, $folder);
            $imagename = $filename;
        }
    } else {
        $imagename = $mydata['foodimg'];
    }

    $uptqry = "update home_menus set foodname='$foodname',foodprice='$foodprice',fooddesc='$fooddesc',foodimg='$imagename' where id=$edit_id";
    $uptres = mysqli_query($conn, $uptqry);

    if ($uptres) {
        echo "Data updated";
    } else {
        echo "error";
    }

    echo "<script>window.location='menus.php'</script>";
}

$getdata = "select * from home_menus";
$get_res = mysqli_query($conn, $getdata);

?>


<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php" ?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Starters</h1>

            </div>
            <form method="post" enctype="multipart/form-data">
                <?php if (isset($mydata)) {?>
                    <input type="hidden" name="edit_id" value="<?php echo $mydata['id'];?>">
                <?php }?>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Food name</label>
                        <input type="text" class="form-control" value="<?php if (isset($mydata)) echo $mydata['foodname'];?>" aria-label="Event Name" name="fname">
                    </div>
                    <div class="col">
                        <label for="">Food Price</label>
                        <input type="text" class="form-control" placeholder="Event Price" aria-label="Event Price" name="fprice" value=" <?php if (isset($mydata)) echo $mydata['foodprice']; ?>" >

                    </div>

                </div>
                <div class="row g-3 mt-4">
                    <div class="col">
                        <label for="">Food Description</label>
                        <input type="text" class="form-control" placeholder="Event Description" aria-label="Event image" name="fdesc"value=" <?php if (isset($mydata)) echo $mydata['fooddesc']; ?>" >
                        <button type="submit" name="<?php echo $btnname;?>" class="btn btn-dark mt-3"><?php echo $btnname;?></button>
                    </div>
                    <div class="col">
                        <label for="">Food Image</label>
                        <input type="file" class="form-control" placeholder="Event Image" aria-label="Event image" name="uploadfile" value=" <?php if (isset($mydata)) echo $mydata['foodimg']; ?>" >

                    </div>

                </div>
            </form>

            <table class="table table-striped table-dark mt-4">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Price</th>
                        <th scope="col">Event Description</th>
                        <th scope="col">Event Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($get_res as $getdata) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $getdata['foodname']; ?></td>
                            <td><?php echo $getdata['foodprice']; ?></td>
                            <td><?php echo $getdata['fooddesc']; ?></td>
                            <td><?php echo $getdata['foodimg']; ?></td>
                            <td><a href='menus.php?action=del&id=<?php echo $getdata["id"] ?>' class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                                <a href='menus.php?action=edit&id=<?php echo $getdata["id"] ?>' class="btn btn-danger">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>





        </main>
    </div>
</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>
</body>

</html>