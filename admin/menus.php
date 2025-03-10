<?php 
include "header.php"; 
include "config.php"; // Ensure database connection is included

$btnname = "submit";

// Handle Insert Operation
if (isset($_REQUEST['submit'])) {
    $imagename = "default.jfif"; // Default image
    
    if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['name'] != "") {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu" . $filename;
        
        if (move_uploaded_file($tempname, $folder)) {
            $imagename = $filename; // Use new uploaded image
        }
    }

    $fname = $_REQUEST['fname'];
    $fprice = $_REQUEST['fprice'];
    $fdesc = $_REQUEST['fdesc'];

    $qry = "INSERT INTO home_menus (foodname, foodprice, fooddesc, foodimg) 
            VALUES ('$fname', '$fprice', '$fdesc', '$imagename')";
    $result = mysqli_query($conn, $qry);

    if ($result) {
        header('location:menus.php');
        exit;
    } else {
        echo "Data not submitted";
    }
}

// Handle Delete Operation
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'del') {
    $del_id = $_GET['id'];
    $del_qry = "DELETE FROM home_menus WHERE id ='$del_id'";
    $del_res = mysqli_query($conn, $del_qry);
    
    if ($del_res) {
        echo "<script>window.location='menus.php';</script>";
    } else {
        echo "Error deleting data!";
    }
}

// Handle Edit Fetch
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $edit_id = $_GET['id'];
    $show_qry = "SELECT * FROM home_menus WHERE id= '$edit_id'";
    $show_res = mysqli_query($conn, $show_qry);
    $mydata = mysqli_fetch_assoc($show_res);

    $btnname = "update";
}

// Handle Update Operation
if (isset($_REQUEST['update'])) {
    $edit_id = $_REQUEST['edit_id'];
    $foodname = $_REQUEST['fname'];
    $foodprice = $_REQUEST['fprice'];
    $fooddesc = $_REQUEST['fdesc'];

    // Fetch old image name
    $fetch_img_query = "SELECT foodimg FROM home_menus WHERE id = '$edit_id'";
    $fetch_img_result = mysqli_query($conn, $fetch_img_query);
    $fetch_img_row = mysqli_fetch_assoc($fetch_img_result);
    $old_image = $fetch_img_row['foodimg'];

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
    $uptqry = "UPDATE home_menus SET 
               foodname='$foodname',
               foodprice='$foodprice',
               fooddesc='$fooddesc',
               foodimg='$imagename' 
               WHERE id='$edit_id'";

    $uptres = mysqli_query($conn, $uptqry);

    if ($uptres) {
        echo "<script>alert('Data Updated'); window.location='menus.php';</script>";
        exit;
    } else {
        echo "Error updating data";
    }
}

// Fetch all data
$getdata = "SELECT * FROM home_menus";
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
                <?php if (isset($mydata)) { ?>
                    <input type="hidden" name="edit_id" value="<?php echo $mydata['id']; ?>">
                <?php } ?>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Food Name</label>
                        <input type="text" class="form-control" name="fname" 
                               value="<?php if (isset($mydata)) echo $mydata['foodname']; ?>">
                    </div>
                    <div class="col">
                        <label for="">Food Price</label>
                        <input type="text" class="form-control" name="fprice" 
                               value="<?php if (isset($mydata)) echo $mydata['foodprice']; ?>">
                    </div>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col">
                        <label for="">Food Description</label>
                        <input type="text" class="form-control" name="fdesc" 
                               value="<?php if (isset($mydata)) echo $mydata['fooddesc']; ?>">
                        <button type="submit" name="<?php echo $btnname; ?>" class="btn btn-dark mt-3">
                            <?php echo ucfirst($btnname); ?>
                        </button>
                    </div>
                    <div class="col">
                        <label for="">Food Image</label>
                        <input type="file" class="form-control" name="uploadfile">
                        <?php if (isset($mydata['foodimg'])) { ?>
                            <img src="../assets/img/menu<?php echo $mydata['foodimg']; ?>" width="100" class="mt-2">
                        <?php } ?>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-dark mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Food Name</th>
                        <th>Food Price</th>
                        <th>Food Description</th>
                        <th>Food Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($get_res as $food) { ?>
                        <tr>
                            <th><?php echo $i; ?></th>
                            <td><?php echo $food['foodname']; ?></td>
                            <td><?php echo $food['foodprice']; ?></td>
                            <td><?php echo $food['fooddesc']; ?></td>
                            <td><img src="../assets/img/menu<?php echo $food['foodimg']; ?>" width="80"></td>
                            <td>
                                <a href='menus.php?action=del&id=<?php echo $food["id"]; ?>' class="btn btn-danger">Delete</a>
                                <a href='menus.php?action=edit&id=<?php echo $food["id"]; ?>' class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
