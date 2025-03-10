<?php
include "header.php";
// include "db_connection.php"; // Ensure database connection is included

$btnname = "submit";
$imagename = "default.jfif";

// Handle form submission for adding/updating breakfast items
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bname = $_POST['bname'] ?? '';
    $bprice = $_POST['bprice'] ?? '';
    $bdesc = $_POST['bdesc'] ?? '';

    if (!empty($_FILES['uploadfile']['name'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu" . $filename;

        if (move_uploaded_file($tempname, $folder)) {
            $imagename = $filename;
        }
    }

    if (isset($_POST['update'])) {
        // Updating record
        $edit_id = $_POST['edit_id'];
        $update_qry = "UPDATE breakfast SET 
                        breakfastname='$bname',
                        breakfastprice='$bprice',
                        breakfastdesc='$bdesc',
                        breakfastimg='$imagename' 
                      WHERE id=$edit_id";
        mysqli_query($conn, $update_qry);
        echo "<script>window.location='menus_breakfast.php';</script>";
    } else {
        // Inserting new record
        $qry = "INSERT INTO breakfast (breakfastname, breakfastprice, breakfastdesc, breakfastimg) 
                VALUES ('$bname', '$bprice', '$bdesc', '$imagename')";
        mysqli_query($conn, $qry);
        echo "<script>window.location='menus_breakfast.php';</script>";
    }
}

// Handle delete request
if (isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id'])) {
    $del_id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM breakfast WHERE id ='$del_id'");
    echo "<script>window.location='menus_breakfast.php';</script>";
}

// Handle edit request
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $show_res = mysqli_query($conn, "SELECT * FROM breakfast WHERE id='$edit_id'");
    $mydata = mysqli_fetch_assoc($show_res);
    $btnname = "update";
}

// Fetch data to display in the table
$get_res = mysqli_query($conn, "SELECT * FROM breakfast");
?>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php"; ?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Breakfast</h1>
            </div>

            <form method="post" enctype="multipart/form-data">
                <?php if (isset($mydata)) { ?>
                    <input type="hidden" name="edit_id" value="<?php echo $mydata['id']; ?>">
                <?php } ?>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Food Name</label>
                        <input type="text" class="form-control" name="bname" value="<?php echo $mydata['breakfastname'] ?? ''; ?>" required>
                    </div>
                    <div class="col">
                        <label for="">Food Price</label>
                        <input type="text" class="form-control" name="bprice" value="<?php echo $mydata['breakfastprice'] ?? ''; ?>" required>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col">
                        <label for="">Food Description</label>
                        <input type="text" class="form-control" name="bdesc" value="<?php echo $mydata['breakfastdesc'] ?? ''; ?>" required>
                    </div>
                    <div class="col">
                        <label for="">Food Image</label>
                        <input type="file" class="form-control" name="uploadfile">
                        <?php if (isset($mydata['breakfastimg'])) { ?>
                            <img src="../assets/img/menu<?php echo $mydata['breakfastimg']; ?>" width="100px">
                        <?php } ?>
                    </div>
                </div>
                <button type="submit" name="<?php echo $btnname; ?>" class="btn btn-dark mt-3"><?php echo ucfirst($btnname); ?></button>
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
                    <?php $i = 1; while ($data = mysqli_fetch_assoc($get_res)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['breakfastname']; ?></td>
                            <td><?php echo $data['breakfastprice']; ?></td>
                            <td><?php echo $data['breakfastdesc']; ?></td>
                            <td><img src="../assets/img/menu<?php echo $data['breakfastimg']; ?>" width="100px"></td>
                            <td>
                                <a href="menus_breakfast.php?action=del&id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
                                <a href="menus_breakfast.php?action=edit&id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="dashboard.js"></script>
</body>
</html>