<?php
$host = "localhost";
$dbname = "sunsonsolardb";
$username = "root";
$password = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uname = trim($_POST["Uname"] ?? "");
    $pnum  = trim($_POST["pnum"] ?? "");
    $pass  = trim($_POST["pass"] ?? "");

    if (empty($uname) || empty($pnum) || empty($pass)) {
        die("Please fill in all fields.");
    }
    try {
         $conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
          $username,
          $password
          );
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM `employees` WHERE `Username` = :uname AND `Phone Num.` = :pnum LIMIT 1";
          
   }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login Account</h1>
    <label>Username</label> <br>
    <input type="text" id="Uname" name="Uname" required> <br><br>

    <label>Phone Number</label> <br>
    <input type="text" id="pnum" name="pnum" required> <br><br>

    <label>Password</label> <br>
    <input type="password" id="pass" name="pass" required> <br><br>

    <input type="checkbox" id="coding" name="interest" value="coding" required>
    <label>I agree to the terms of service and privacy policy</label> <br><br>

    <input type="submit" value="Login" id="regis"> <br><br>
    <input type="submit" value="Forgot Password" id="fogpass">
</body>
</html>