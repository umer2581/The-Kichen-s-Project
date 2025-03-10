<?php
include "header.php";
include "db_connection.php"; // Ensure database connection is included

// Debug: Check if the connection is working
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

if (isset($_REQUEST['submit'])) {
    // Secure input data
    $aboutus = mysqli_real_escape_string($conn, $_REQUEST['aboutus']);
    $whywe = mysqli_real_escape_string($conn, $_REQUEST['whywe']);
    $block1 = mysqli_real_escape_string($conn, $_REQUEST['block1']);
    $block2 = mysqli_real_escape_string($conn, $_REQUEST['block2']);
    $block3 = mysqli_real_escape_string($conn, $_REQUEST['block3']);
    $id = $_REQUEST['id'];

    if (!empty($id)) {
        // Debugging: Check if ID is being received
        echo "Updating record with ID: " . $id;

        $updateqry = "UPDATE home_about SET 
            aboutus='$aboutus', 
            whywe='$whywe', 
            block1='$block1', 
            block2='$block2', 
            block3='$block3' 
            WHERE id='$id'";

        $res = mysqli_query($conn, $updateqry);

        if (!$res) {
            die("Update Query Failed: " . mysqli_error($conn)); // Debugging
        } else {
            header('location:admin_home.php');
            exit();
        }
    } else {
        // Insert new record
        $addqry = "INSERT INTO home_about (aboutus, whywe, block1, block2, block3) 
                   VALUES ('$aboutus', '$whywe', '$block1', '$block2', '$block3')";

        $res = mysqli_query($conn, $addqry);

        if (!$res) {
            die("Insert Query Failed: " . mysqli_error($conn)); // Debugging
        } else {
            header('location:admin_home.php');
            exit();
        }
    }
}

// Fetch data for update
$uptfin = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo "Fetching record with ID: " . $id; // Debugging

    $uptqry = "SELECT * FROM home_about WHERE id='$id'";
    $qryres = mysqli_query($conn, $uptqry);

    if ($qryres && mysqli_num_rows($qryres) > 0) {
        $uptfin = mysqli_fetch_array($qryres);
    } else {
        // echo "No record found for ID: " . $id; // Debugging
    }
}

// Fetch the first available record for display
$qry = "SELECT * FROM home_about LIMIT 1";
$result = mysqli_query($conn, $qry);
$finres = mysqli_fetch_array($result) ?? [
    'aboutus' => '',
    'whywe' => '',
    'block1' => '',
    'block2' => '',
    'block3' => ''
];

?>

<style>
    tr.bg-danger {
        background-color: red !important;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php"; ?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage About Us</h1>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h2>Add/Edit</h2>

                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo isset($uptfin['id']) ? $uptfin['id'] : ''; ?>">

                        <div class="form-group">
                            <label>About Us</label>
                            <textarea class="form-control" rows="3" name="aboutus"><?php echo isset($uptfin['aboutus']) ? $uptfin['aboutus'] : $finres['aboutus']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Why We</label>
                            <textarea class="form-control" rows="3" name="whywe"><?php echo isset($uptfin['whywe']) ? $uptfin['whywe'] : $finres['whywe']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Block 1</label>
                            <textarea class="form-control" rows="3" name="block1"><?php echo isset($uptfin['block1']) ? $uptfin['block1'] : $finres['block1']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Block 2</label>
                            <textarea class="form-control" rows="3" name="block2"><?php echo isset($uptfin['block2']) ? $uptfin['block2'] : $finres['block2']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Block 3</label>
                            <textarea class="form-control" rows="3" name="block3"><?php echo isset($uptfin['block3']) ? $uptfin['block3'] : $finres['block3']; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-ml mt-3" name="submit">Submit</button>
                    </form>
                </div>

                <!-- Display Existing Data -->
                <div class="col-md-6">
                    <h2>Existing Record</h2>

                    <div class="form-group">
                        <label>ABOUT VIEW</label>
                        <textarea class="form-control" rows="3" readonly><?php echo $finres['aboutus']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Why We</label>
                        <textarea class="form-control" rows="3" readonly><?php echo $finres['whywe']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Block 1</label>
                        <textarea class="form-control" rows="3" readonly><?php echo $finres['block1']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Block 2</label>
                        <textarea class="form-control" rows="3" readonly><?php echo $finres['block2']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Block 3</label>
                        <textarea class="form-control" rows="3" readonly><?php echo $finres['block3']; ?></textarea>
                    </div>

                    <a href="admin_home.php?id=<?php echo $finres['id']; ?>" class="btn btn-primary mt-3">Edit</a>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"></script>
<script src="dashboard.js"></script>

</body>
</html>
