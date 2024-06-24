<?php
include "connections.php";

if(isset($_POST['submit'])) {
    $uname = $_POST['email'];
    $upass = $_POST['pass'];
     $sel ="select * from users where user_email='$uname' and user_pass='$upass'";
     $res = mysqli_query($conn,$sel);
     $count_rows = mysqli_num_rows($res);

     if($count_rows==1) {
            $fetch_res = mysqli_fetch_assoc($res);
            $_SESSION['admin_data'] = $fetch_res['user_email'];

            echo "<script>window.location='index.php'</script>";
     }
     else {
        echo "Username & Password are wrong....!";
     }

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="assets/img/title-logo.jpg" rel="icon">


      <style>
        body {
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
    line-height: 1.5;
    min-height: 100vh;
    background: #f3f3f3;
    flex-direction: column;
    margin: 0;
}

.main {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    padding: 10px 20px;
    transition: transform 0.2s;
    width: 500px;
    text-align: center;
}

h1 {
    color: #4CAF50;
}

label {
    display: block;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 5px;
    text-align: left;
    color: #555;
    font-weight: bold;
}


input {
    display: block;
    width: 100%;
    margin-bottom: 15px;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    padding: 15px;
    border-radius: 10px;
    margin-top: 15px;
    margin-bottom: 15px;
    border: none;
    color: white;
    cursor: pointer;
    background-color: #4CAF50;
    width: 100%;
    font-size: 16px;
}

.wrap {
    display: flex;
    justify-content: center;
    align-items: center;
}
      </style>
      
</head>

<body>
      <div class="main">
            <img src="../assets/img/title-logo.jpg" alt="" width="30%" height="20%">
            <h3>Enter Your Details</h3>
            <form method="post">
                  <label for="first">
                        Email:
                  </label>
                  <input type="text" 
                         id="first" 
                         name="email" 
                         placeholder="Enter your Email" required>

                  <label for="password">
                        Password:
                  </label>
                  <input type="password"
                         id="password" 
                         name="pass"
                         placeholder="Enter your Password" required>

                  <div class="wrap">
                        <button type="submit" name="submit">
                              Submit
                        </button>
                  </div>
            </form>
            
      </div>
</body>

</html>