<?php 
include "header.php";
include "db_connection.php"; // Make sure your DB connection is included
$btnname = "submit";

// **Handle Add New Chef**
if (isset($_REQUEST['submit'])) {
    $imagename = "default.jfif";
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../chef/" . $filename;

    if (!empty($filename)) {
        move_uploaded_file($tempname, $folder);
        $imagename = $filename;
    }

    $chefname = $_REQUEST['chefname'];
    $chefabout = $_REQUEST['chefabout'];
    $chefcat = $_REQUEST['options'];
    $onduty = $_REQUEST['onduty'];

    $addqry = "INSERT INTO chefmaster (cname, title, descr, isactive, img) 
               VALUES ('$chefname', '$chefcat', '$chefabout', '$onduty', '$imagename')";

    $res = mysqli_query($conn, $addqry);

    if ($res) {
        echo '<script>window.location="mangechefs.php";</script>';
    } else {
        echo "Data not submitted!";
    }
}

// **Handle Delete Request**
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'del') {
    $del_id = $_GET['id'];
    $del_qry = "DELETE FROM chefmaster WHERE id ='$del_id'";
    $del_res = mysqli_query($conn, $del_qry);
    if ($del_res) {
        echo "<script>window.location='mangechefs.php';</script>";
    } else {
        echo "Error deleting record!";
    }
}

// **Handle Edit Request**
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $edit_id = $_GET['id'];
    $show_qry = "SELECT * FROM chefmaster WHERE id= '$edit_id'";
    $show_res = mysqli_query($conn, $show_qry);
    $mydata = mysqli_fetch_assoc($show_res);
    $btnname = "update";
}

// **Handle Update Request**
if (isset($_REQUEST['update'])) {
    $edit_id = $_REQUEST['edit_id']; // Hidden input stores ID

    $chefname = $_REQUEST['chefname'];
    $chefabout = $_REQUEST['chefabout'];
    $chefcat = $_REQUEST['options'];
    $onduty = $_REQUEST['onduty'];

    // Handle image upload
    if (!empty($_FILES["uploadfile"]["name"])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../chef/" . $filename;
        move_uploaded_file($tempname, $folder);
        $imagename = $filename;
    } else {
        $imagename = $_REQUEST['photo-name']; // Keep existing image if no new upload
    }

    // Update Query
    $uptqry = "UPDATE chefmaster SET cname='$chefname', descr='$chefabout', title='$chefcat', isactive='$onduty', img='$imagename' WHERE id='$edit_id'";
    
    $uptres = mysqli_query($conn, $uptqry);

    if ($uptres) {
        echo "<script>window.location='mangechefs.php'</script>";
    } else {
        echo "Error updating data!";
    }
}
?>

<style>
    tr.bg-danger { background-color: red !important; }
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
            $getdata = "SELECT * FROM chefmaster";
            $get_res = mysqli_query($conn, $getdata);
            $count = mysqli_num_rows($get_res);
            ?>

            <div class="row">
                <div class="col-md-6">
                    <h2>Add/Edit Chef</h2>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="<?php if (isset($mydata)) echo $mydata['id']; ?>">

                        <div class="form-group">
                            <label>Chef Name</label>
                            <input type="text" class="form-control" placeholder="Enter Chef Name" name="chefname" value="<?php if (isset($mydata)) echo $mydata['cname']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Chef Category</label>
                            <select class="form-control" name="options">
                                <?php 
                                $categories = ["Chef-Owner", "Executive Chef", "Sous Chef", "Senior Chef", "Pantry Chef"];
                                foreach ($categories as $category) {
                                    $selected = (isset($mydata) && $mydata['title'] == $category) ? "selected" : "";
                                    echo "<option value='$category' $selected>$category</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>About Chef</label>
                            <textarea class="form-control" rows="3" name="chefabout"><?php if (isset($mydata)) echo trim($mydata['descr']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Current Photo</label>
                            <input type="text" class="mt-3 mb-3 form-control" name="photo-name" value="<?php if (isset($mydata)) echo $mydata['img']; ?>" readonly>
                            <label>Upload New Photo</label>
                            <input type="file" class="form-control" name="uploadfile">
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" value="1" name="onduty" checked <?php if (isset($mydata) && $mydata['isactive'] == "1") echo "checked"; ?>>
                            <label>Present</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="onduty" <?php if (isset($mydata) && $mydata['isactive'] == "0") echo "checked"; ?>>
                            <label>Resign</label>
                        </div>

                        <button type="submit" name="<?php echo $btnname ?>" class="btn btn-primary mt-3"><?php echo ucfirst($btnname); ?></button>
                    </form>
                </div>

                <div class="col-md-6">
                    <h2>All Chefs (<?= $count ?>)</h2>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>#</th><th>Name</th><th>Category</th><th>Photo</th><th>Status</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($get_res as $row) {
                                $rowclass = ($row['isactive'] == "0") ? "bg-danger" : "";
                            ?>
                                <tr class="<?= $rowclass ?>">
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['cname'] ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><img src="../chef/<?= $row['img'] ?>" width="100px"></td>
                                    <td><?= $row['isactive'] == "1" ? "🟢" : "🔴"; ?></td>
                                    <td>
                                        <a href='mangechefs.php?action=del&id=<?= $row["id"] ?>' class="btn btn-danger">Delete</a>
                                        <a href='mangechefs.php?action=edit&id=<?= $row["id"] ?>' class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
