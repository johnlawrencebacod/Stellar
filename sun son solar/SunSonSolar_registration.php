<?php
$host = "localhost";
$dbname = "sunsonsolarDB";
$employee = "root"

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname  = trim($_POST["fname"] ?? "");
    $lname = trim($_POST["lname"] ?? "");
    $Mname = trim($_POST["Mname"] ?? "");
    $Bdate = trim($_POST["Bdate"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $pnum = trim($_POST["pnum"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $Uname = trim($_POST["Uname"] ?? "");
    $pass = trim($_POST["pass"] ?? "");

    if (empty($fname) || empty($lname) || empty($Mname) || 
    empty($Bdate) || empty($gender)
         || empty($email)|| empty($pnum)|| empty($address)|| empty($Uname)|| empty($pass)) {
        die("Name and Email are required.");
    }


    try {
       
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      
        $stmt = $conn->prepare("$sql="INSERT INTO employee (fname, Lname, Mname, Bdate, Gender, Email, PhoneNum, Address, Username, Password));

       
        $stmt->bindParam(":fname", $fname);
        $stmt->bindParam(":lname", $lname);
         $stmt->bindParam(":Mname", $Mname);
        $stmt->bindParam(":Bdate", $Bdate);
         $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pnum", $pnum);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":Uname", $Uname);
        $stmt->bindParam(":pass", $pass);

  
        $stmt->execute();

        echo "Data inserted successfully!";
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form action="SunSonSolar_registration.php" method="POST"></form>
    <div class="container">
       <h1>Create an account</h1>   
       <label>First Name</label> <br>
       <input type="text" id="fname" required> <br><br>

       <label>Last Name</label> <br>
       <input type="text" id="lname" required> <br><br>

       <label>Middle Name</label> <br>
       <input type="text" id="Mname" required> <br><br>
       
       <label>Birthdate</label> <br>
       <input type="date" id="Bdate" required> <br><br>

       <label for="Gender" required>Select Gender:</label> <br>
       <select name="Gender" id="gender"> <br><br>
        <option value="male">Male</option>
        <option value="female">Female</option>
       </select>
       <br><br>
       <label>Email</label> <br>
       <input type="email" id="email" required> <br><br>

       <label>Phone Number</label> <br>
       <input type="number" id="Pnum" required> <br><br>

       <label>Address</label> <br>
       <input type="text" id="address" required> <br><br>

       <label>Username</label> <br>
       <input type="text" id="Uname" required> <br><br>

       <label>Password</label> <br>
       <input type="password" id="pass"required> <br><br>
       <input type="submit" value="Register" id="regis"><br><br>

       <input type="checkbox" id="coding" name="interest" value="coding" required>
       <label>I agree to the terms of service and privacy policy</label>
       <br><br>
       <a message="you success created an account"></a>
      
       <a>already have an account?</a><a href="login.php">Login</a>
    </div>
</body>
</html>