<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <title>Registration</title>
</head>
<body class="page">
    <header>
    <a href="#hero">Sun Son Solar</a>
    <nav aria-label="Main navigation">
    <ul>
        <li><a href="#services">Services</a></li>
        <li><a href="#benefits">Why Solar</a></li>
        <li><a href="#testimonials">Stories</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    </nav>
    <div>
    <a href="homepage.html">Log in</a>
    <a href="homepage.html">Free quote</a>
    </div>
    </header>
    <main>
    <section id="hero">
    <div>
    <h1>Power Your Future With Solar</h1>
    <p>Solar consultation, installation, and maintenance for homes and businesses, so you pay less and stay powered.</p>
    <a href="#services">See how it works</a>
    </div>
    <div class="container">
    <form action="" method="POST" class="quote-form register-card">
    <div id="card">
       <h1 class="quote-form__title">Create an account</h1>   
       <div class="form-grid">
       <div class="field">
       <label class="field__label">First Name</label>
       <input class="field__input" type="text" id="fname" name="fname" required>
       </div>
       <div class="field">
       <label class="field__label">Last Name</label>
       <input class="field__input" type="text" id="lname" name="lname" required>
       </div>
       <div class="field">
       <label class="field__label">Middle Name</label>
       <input class="field__input" type="text" id="Mname" name="Mname" required>
       </div>
       <div class="field">
       <label class="field__label">Birthdate</label>
       <input class="field__input" type="date" id="Bdate" name="Bdate" required>
       </div>
       <div class="field">
       <label for="Gender" required class="field__label">Select Gender:</label>
       <select class="field__input" name="gender" id="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
       </select>
       </div>
       <div class="field">
       <label class="field__label">Phone Number</label>
       <input class="field__input" type="number" id="pnum" name="pnum" required>
       </div>
       <div class="field field--full">
       <label class="field__label">Email</label>
       <input class="field__input" type="email" id="email" name="email" required>
       </div>
       <div class="field field--full">
       <label class="field__label">Address</label>
       <input class="field__input" type="text" id="address" name="address" required>
       </div>
       <div class="field field--full">
       <label class="field__label">Username</label>
       <input class="field__input" type="text" id="Uname" name="Uname" required>
       </div>
       <div class="field field--full">
       <label class="field__label">Password</label>
       <input class="field__input" type="password" id="pass" name="pass" required>
       </div>
       </div>
       <input type="submit" value="Register" id="regis" class="btn btn--primary btn--block"><br><br>

       <input type="checkbox" id="coding" name="interest" value="coding" required>
       <label>I agree to the terms of service and privacy policy</label>
       <br><br>
       <a message="you success created an account"></a>
    </div>
    </form>  
       <p class="register-note"><a>already have an account?</a><a href="login.php">Login</a></p>
    </div>
    </section>
    </main>

    <footer id="contact">
    <section>
      <h2>Contact Info</h2>
      <address>
        <p>Pasig City, Philippines</p>
        <p>Phone: <a href="tel:+63">+63 920 855 5993</a></p>
        <p>Email: <a href="mailto:hello@example.com">sasisjhonmatthew@gmail.com</a></p>
      </address>
    </section>
    <section>
      <h2>Social Media</h2>
      <ul>
        <li><a href="https://www.facebook.com/"><img src="images/facebook.svg" alt="facebook"></a></li>
        <li><a href="https://www.instagram.com/"><img src="images/instagram.svg" alt="instagram"></a></li>
        <li><a href="https://www.google.com/"><img src="images/google.svg" alt="google"></a></li>
      </ul>
    </section>
    <section>
      <h2>Links</h2>
      <ul>
        <li><a href="#services">Services</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#faq">FAQ</a></li>
        <li><a href="#blog">News</a></li>
      </ul>
    </section>
    <section>
      <h2>Legal</h2>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
      </ul>
      <p>&copy; Sun Son Solar. All rights reserved.</p>
    </section>
  </footer>
</body>
</html>

<?php
$host = "localhost";
$dbname = "sunsonsolardb";
$username = "root";
$password = "";

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
          $conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
          $username,
          $password
          );

          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      
        $sql = "INSERT INTO employees (`First Name`, `Last Name`, `Middle Name`, `Birthdate`, `Gender`, `Email`, `Phone Num.`, `Address`, `Username`, `Password`)
                VALUES (:fname, :lname, :Mname, :Bdate, :gender, :email, :pnum, :address, :Uname, :pass)";

                $stmt = $conn->prepare($sql);

       
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
} 
?>