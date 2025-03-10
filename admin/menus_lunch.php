<?php 
include "header.php";

$btnname = "submit";

// Handle Insert Operation
if (isset($_REQUEST['submit'])) {
    if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['name'] != "") {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu" . $filename;
        
        if (move_uploaded_file($tempname, $folder)) {
            $imagename = $filename;
        } else {
            $imagename = "default.jfif";
        }
    } else {
        $imagename = "default.jfif";
    }

    $lname = $_REQUEST['lname'];
    $lprice = $_REQUEST['lprice'];
    $ldesc = $_REQUEST['ldesc'];

    $qry = "INSERT INTO lunch (lunchname, lunchprice, lunchdesc, lunchimg) 
            VALUES ('$lname', '$lprice', '$ldesc', '$imagename')";
    $result = mysqli_query($conn, $qry);

    if ($result) {
        header('location:menus_lunch.php');
        exit;
    } else {
        echo "Data not submitted";
    }
}

// Handle Delete Operation
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'del') {
    $del_id = $_GET['id'];
    $del_qry = "DELETE FROM lunch WHERE id ='$del_id'";
    $del_res = mysqli_query($conn, $del_qry);
    
    if ($del_res) {
        echo "<script>window.location='menus_lunch.php';</script>";
    } else {
        echo "Error deleting data!";
    }
}

// Handle Edit Fetch
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $edit_id = $_GET['id'];
    $show_qry = "SELECT * FROM lunch WHERE id= '$edit_id'";
    $show_res = mysqli_query($conn, $show_qry);
    $mydata = mysqli_fetch_assoc($show_res);

    $btnname = "update";
}

// Handle Update Operation
if (isset($_REQUEST['update'])) {
    $edit_id = $_REQUEST['edit_id'];
    $lname = $_REQUEST['lname'];
    $lprice = $_REQUEST['lprice'];
    $ldesc = $_REQUEST['ldesc'];

    // Fetch old image name
    $fetch_img_query = "SELECT lunchimg FROM lunch WHERE id = '$edit_id'";
    $fetch_img_result = mysqli_query($conn, $fetch_img_query);
    $fetch_img_row = mysqli_fetch_assoc($fetch_img_result);
    $old_image = $fetch_img_row['lunchimg'];

    // Handle image upload
    if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['name'] != "") {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu" . $filename;

        if (move_uploaded_file($tempname, $folder)) {
            $imagename = $filename; // New image uploaded
        } else {
            $imagename = $old_image; // Keep old image if upload fails
        }
    } else {
        $imagename = $old_image; // No new image uploaded, keep old image
    }

    // Update Query
    $uptqry = "UPDATE lunch SET 
               lunchname='$lname',
               lunchprice='$lprice',
               lunchdesc='$ldesc',
               lunchimg='$imagename' 
               WHERE id='$edit_id'";

    $uptres = mysqli_query($conn, $uptqry);

    if ($uptres) {
        echo "<script>alert('Data Updated'); window.location='menus_lunch.php';</script>";
        exit;
    } else {
        echo "Error updating data";
    }
}

// Fetch all data
$getdata = "SELECT * FROM lunch";
$get_res = mysqli_query($conn, $getdata);
?>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php" ?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Lunch</h1>
            </div>

            <form method="post" enctype="multipart/form-data">
                <?php if (isset($mydata)) { ?>
                    <input type="hidden" name="edit_id" value="<?php echo $mydata['id']; ?>">
                <?php } ?>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Food Name</label>
                        <input type="text" class="form-control" value="<?php if (isset($mydata)) echo $mydata['lunchname']; ?>" name="lname">
                    </div>
                    <div class="col">
                        <label for="">Food Price</label>
                        <input type="text" class="form-control" name="lprice" value="<?php if (isset($mydata)) echo $mydata['lunchprice']; ?>">
                    </div>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col">
                        <label for="">Food Description</label>
                        <input type="text" class="form-control" name="ldesc" value="<?php if (isset($mydata)) echo $mydata['lunchdesc']; ?>">
                        <button type="submit" name="<?php echo $btnname; ?>" class="btn btn-dark mt-3"><?php echo ucfirst($btnname); ?></button>
                    </div>
                    <div class="col">
                        <label for="">Food Image</label>
                        <input type="file" class="form-control" name="uploadfile">
                        <?php if (isset($mydata['lunchimg'])) { ?>
                            <img src="../assets/img/menu<?php echo $mydata['lunchimg']; ?>" width="100" class="mt-2">
                        <?php } ?>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-dark mt-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Food Name</th>
                        <th scope="col">Food Price</th>
                        <th scope="col">Food Description</th>
                        <th scope="col">Food Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($get_res as $lunchdata) { ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $lunchdata['lunchname']; ?></td>
                            <td><?php echo $lunchdata['lunchprice']; ?></td>
                            <td><?php echo $lunchdata['lunchdesc']; ?></td>
                            <td><img src="../assets/img/menu<?php echo $lunchdata['lunchimg']; ?>" width="80"></td>
                            <td>
                                <a href='menus_lunch.php?action=del&id=<?php echo $lunchdata["id"]; ?>' class="btn btn-danger">Delete</a>
                                <a href='menus_lunch.php?action=edit&id=<?php echo $lunchdata["id"]; ?>' class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
