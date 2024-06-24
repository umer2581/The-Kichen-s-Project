<?php
include "header.php";

if (isset($_REQUEST['submit'])) {
    if (isset($_FILES['uploadfile'])) {
        $imagename = "default.jfif";
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../assets/img/events/". $filename;
        if ($filename == "") {
        } else {
            move_uploaded_file($tempname, $folder);
            $imagename = $filename;
        }
    } else {
        $imagename = "default.jfif";
    }
    $ename=$_REQUEST['ename'];
    $eprice=$_REQUEST['eprice'];
    $edesc=$_REQUEST['edesc'];
    
    $qry="insert into home_events set event_name='$ename',event_price='$eprice',event_desc='$edesc',event_image='$imagename'";
    $result=mysqli_query($conn,$qry);

    if($result){
        header('location:home_events.php');
        exit;
    }else{
        echo "data not submitted";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = "DELETE FROM home_events WHERE id = '$id'";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        header('location:home_events.php');
        exit;
    } else {
        echo "Error deleting record";
    }
}

$selqry="select * from home_events";
$selfin=mysqli_query($conn,$selqry);

?>


<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <?php include "sidebar.php"?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Events</h1>

            </div>
            <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
  <div class="col">
    <label for="">Event name</label>
    <input type="text" class="form-control" placeholder="Event Name" aria-label="Event Name" name="ename">
  </div>
  <div class="col">
  <label for="">Event Price</label>
    <input type="text" class="form-control" placeholder="Event Price" aria-label="Event Price" name="eprice">
    
  </div>
  
</div>
            <div class="row g-3 mt-4">
            <div class="col">
            <label for="">Event Description</label>
    <input type="text" class="form-control" placeholder="Event Description" aria-label="Event image" name="edesc">
    <button type="submit" name="submit" class="btn btn-dark mt-3">Submit</button>
  </div>
  <div class="col">
  <label for="">Event Image</label>
    <input type="file" class="form-control" placeholder="Event Image" aria-label="Event image" name="uploadfile">
    
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
    $i=1;
    while ($getdata = mysqli_fetch_assoc($selfin)) {
    ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td><?php echo $getdata['event_name'];?></td>
      <td><?php echo $getdata['event_price'];?></td>
      <td><?php echo $getdata['event_desc'];?></td>
      <td><?php echo $getdata['event_image'];?></td>
      <td>
        <a href="home_events.php?id=<?php echo $getdata['id'];?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    <?php $i++; }?>
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