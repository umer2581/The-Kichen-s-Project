<?php
include "header.php";
$btnname = "submit";
$imagename = "default.jfif";

if (isset($_REQUEST['submit'])) {
    if (!empty($_FILES['uploadfile']['name'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu/" . $filename;
        move_uploaded_file($tempname, $folder);
        $imagename = $filename;
    }
    
    $dname = $_REQUEST['dname'];
    $dprice = $_REQUEST['dprice'];
    $ddesc = $_REQUEST['ddesc'];

    $qry = "INSERT INTO dinner (dinnername, dinnerprice, dinnerdesc, dinnerimg) VALUES ('$dname', '$dprice', '$ddesc', '$imagename')";
    $result = mysqli_query($conn, $qry);

    if ($result) {
        header('location:menus_dinner.php');
        exit;
    } else {
        echo "Data not submitted";
    }
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == 'del') {
        $del_qry = "DELETE FROM dinner WHERE id ='$id'";
        if (mysqli_query($conn, $del_qry)) {
            echo "<script>window.location='menus_dinner.php';</script>";
        } else {
            echo "Error deleting record!";
        }
    } elseif ($_GET['action'] == 'edit') {
        $show_qry = "SELECT * FROM dinner WHERE id='$id'";
        $show_res = mysqli_query($conn, $show_qry);
        $mydata = mysqli_fetch_assoc($show_res);
        $btnname = "update";
    }
}

if (isset($_REQUEST['update'])) {
    $edit_id = $_REQUEST['edit_id'];
    $dname = $_REQUEST['dname'];
    $dprice = $_REQUEST['dprice'];
    $ddesc = $_REQUEST['ddesc'];
    
    if (!empty($_FILES['uploadfile']['name'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/menu/" . $filename;
        move_uploaded_file($tempname, $folder);
        $imagename = $filename;
    } else {
        $imagename = $mydata['dinnerimg'];
    }

    $uptqry = "UPDATE dinner SET dinnername='$dname', dinnerprice='$dprice', dinnerdesc='$ddesc', dinnerimg='$imagename' WHERE id=$edit_id";
    if (mysqli_query($conn, $uptqry)) {
        echo "<script>window.location='menus_dinner.php'</script>";
    } else {
        echo "Error updating record!";
    }
}

$get_res = mysqli_query($conn, "SELECT * FROM dinner");
?>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php"; ?>
        </div>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Dinner</h1>
            </div>
            <form method="post" enctype="multipart/form-data">
                <?php if (isset($mydata)) { ?>
                    <input type="hidden" name="edit_id" value="<?php echo $mydata['id']; ?>">
                <?php } ?>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Food Name</label>
                        <input type="text" class="form-control" name="dname" value="<?php echo isset($mydata) ? $mydata['dinnername'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="">Food Price</label>
                        <input type="text" class="form-control" name="dprice" value="<?php echo isset($mydata) ? $mydata['dinnerprice'] : ''; ?>">
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col">
                        <label for="">Food Description</label>
                        <input type="text" class="form-control" name="ddesc" value="<?php echo isset($mydata) ? $mydata['dinnerdesc'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="">Food Image</label>
                        <input type="file" class="form-control" name="uploadfile">
                        <?php if (isset($mydata) && !empty($mydata['dinnerimg'])) { ?>
                            <img src="../assets/img/menu/<?php echo $mydata['dinnerimg']; ?>" width="100" class="mt-2">
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
                    <?php $i = 1; while ($dinnerdata = mysqli_fetch_assoc($get_res)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $dinnerdata['dinnername']; ?></td>
                            <td><?php echo $dinnerdata['dinnerprice']; ?></td>
                            <td><?php echo $dinnerdata['dinnerdesc']; ?></td>
                            <td><img src="../assets/img/menu/<?php echo $dinnerdata['dinnerimg']; ?>" width="100"></td>
                            <td>
                                <a href='menus_dinner.php?action=del&id=<?php echo $dinnerdata["id"] ?>' class="btn btn-danger">Delete</a>
                                <a href='menus_dinner.php?action=edit&id=<?php echo $dinnerdata["id"] ?>' class="btn btn-primary">Edit</a>
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
