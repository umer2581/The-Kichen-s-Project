<?php

$conn=mysqli_connect('localhost','root','','quiry');

if(isset($_GET["action"]) && $_GET["action"]=="del")
{
  
  $delqry ="delete from chefs123 where id =  " . $_GET["id"];

  mysqli_query($conn,$delqry);
  $msg="<div class='alert alert-danger'>Deleted successfully.</div>";
}

if(isset($_POST['submit'])){

$name= $_POST['name'];
$email= $_POST['cateogry'];
$message= $_POST['message'];

$qry="insert into  chefs123 (name,cateogry,descc) values('$name','$cateogry','$message')";
$res=mysqli_query($conn,$qry);


if($res){
    header("location: chefs123.php");
}else{
    echo "Data not submitted";
}
}


//select query

$getdata="select name,cateogry,descc from chefs123";
$get_res=mysqli_query($conn,$getdata);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">

<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" placeholder="Name" required>
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">cateogry</label>
    <input type="text" class="form-control" placeholder="cateogry" name="cateogry" required>
    
  </div>



  <div class="form-group">
    <label for="exampleInputEmail1">Message</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Description" name="message" required>
    
  </div>
  <button type="submit" class="btn btn-primary mt-5" name="submit">Submit</button>
</form>
</div>

<div class="container-fluid">

<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">cateogry</th>
      <th scope="col">Message</th>
      
    </tr>
  </thead>
  <tbody>
    <?php 
    $i=1;
    foreach($get_res as $mydata)
    { 

    ?>
    <tr>
      <th scope="row"><?php echo $i;?></th>
      <td> <?php echo $mydata['name']  ?></td>
      <td><?php echo $mydata['cateogry']  ?></td>
      <td><?php echo $mydata['descc']  ?></td>
      <td><a href='chefs123.php?action=del&id=<?php echo $mydata["id"]?>' class="btn btn-danger">delete</a></td>
     <td> <button type="button" class="btn btn-warning">edit</button></td>
     

    </tr>
    <?php $i++;}?>
  </tbody>
</table>
</div>


    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>