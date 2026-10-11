<?php
$host     = "localhost";
$dbname   = "sunsonsolardb";
$username = "root";
$password = "";

// ---------- PHP: handles the AJAX request and replies with JSON ----------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    $fname   = trim($_POST["fname"]   ?? "");
    $lname   = trim($_POST["lname"]   ?? "");
    $Mname   = trim($_POST["Mname"]   ?? "");
    $Bdate   = trim($_POST["Bdate"]   ?? "");
    $gender  = trim($_POST["gender"]  ?? "");
    $email   = trim($_POST["email"]   ?? "");
    $pnum    = trim($_POST["pnum"]    ?? "");
    $address = trim($_POST["address"] ?? "");
    $Uname   = trim($_POST["Uname"]   ?? "");
    $pass    = trim($_POST["pass"]    ?? "");

    if ($fname === "" || $lname === "" || $Mname === "" || $Bdate === "" || $gender === ""
        || $email === "" || $pnum === "" || $address === "" || $Uname === "" || $pass === "") {
        echo json_encode(["success" => false, "message" => "Please fill in all fields."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email address."]);
        exit;
    }

    if (strlen($pass) < 8) {
        echo json_encode(["success" => false, "message" => "Password must be at least 8 characters."]);
        exit;
    }

    try {
        $conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO employees
                (`First Name`, `Last Name`, `Middle Name`, `Birthdate`, `Gender`, `Email`, `Phone Num.`, `Address`, `Username`, `Password`)
                VALUES (:fname, :lname, :Mname, :Bdate, :gender, :email, :pnum, :address, :Uname, :pass)";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":fname",   $fname);
        $stmt->bindValue(":lname",   $lname);
        $stmt->bindValue(":Mname",   $Mname);
        $stmt->bindValue(":Bdate",   $Bdate);
        $stmt->bindValue(":gender",  $gender);
        $stmt->bindValue(":email",   $email);
        $stmt->bindValue(":pnum",    $pnum);
        $stmt->bindValue(":address", $address);
        $stmt->bindValue(":Uname",   $Uname);
        // Never store plain passwords. Use password_verify() in login.php.
        $stmt->bindValue(":pass",    password_hash($pass, PASSWORD_DEFAULT));

        $stmt->execute();

        echo json_encode(["success" => true, "message" => "You successfully created an account!"]);
    } catch (PDOException $e) {
        // 23000 = duplicate entry (only if Email/Username columns are UNIQUE)
        if ($e->getCode() == 23000) {
            echo json_encode(["success" => false, "message" => "That email or username is already taken."]);
        } else {
            echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
        }
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        #message { display: none; padding: 10px 14px; margin: 12px 0; border-radius: 6px; max-width: 360px; }
        #message.success { display: block; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        #message.error   { display: block; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <form id="regForm" action="SunSonSolar_registration.php" method="POST">
            <h1>Create an account</h1>

            <div id="message" role="alert"></div>

            <label for="fname">First Name</label> <br>
            <input type="text" id="fname" name="fname" required> <br><br>

            <label for="lname">Last Name</label> <br>
            <input type="text" id="lname" name="lname" required> <br><br>

            <label for="Mname">Middle Name</label> <br>
            <input type="text" id="Mname" name="Mname" required> <br><br>

            <label for="Bdate">Birthdate</label> <br>
            <input type="date" id="Bdate" name="Bdate" required> <br><br>

            <label for="gender">Select Gender:</label> <br>
            <select name="gender" id="gender" required>
                <option value="">-- Select --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <br><br>

            <label for="email">Email</label> <br>
            <input type="email" id="email" name="email" required> <br><br>

            <label for="pnum">Phone Number</label> <br>
            <input type="tel" id="pnum" name="pnum" pattern="[0-9]{10,13}" title="10 to 13 digits" required> <br><br>

            <label for="address">Address</label> <br>
            <input type="text" id="address" name="address" required> <br><br>

            <label for="Uname">Username</label> <br>
            <input type="text" id="Uname" name="Uname" required> <br><br>

            <label for="pass">Password</label> <br>
            <input type="password" id="pass" name="pass" minlength="8" required> <br><br>

            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">I agree to the terms of service and privacy policy</label>
            <br><br>

            <input type="submit" value="Register" id="regis"><br><br>
        </form>

        <a>Already have an account?</a> <a href="login.php">Login</a>
    </div>

    <script>
        const form = document.getElementById("regForm");
        const message = document.getElementById("message");
        const button = document.getElementById("regis");

        function showMessage(text, ok) {
            message.textContent = text;
            message.className = ok ? "success" : "error";
        }

        form.addEventListener("submit", async function (e) {
            e.preventDefault();                       // stop the page from reloading

            button.disabled = true;
            button.value = "Registering...";

            try {
                const response = await fetch(form.getAttribute("action"), {
                    method: "POST",
                    body: new FormData(form)          // sends all the fields to PHP
                });

                const result = await response.json(); // PHP replies with JSON
                showMessage(result.message, result.success);

                if (result.success) {
                    form.reset();
                    // Optional: go to login after 2 seconds
                    // setTimeout(() => window.location.href = "login.php", 2000);
                }
            } catch (error) {
                showMessage("Something went wrong. Please try again.", false);
            } finally {
                button.disabled = false;
                button.value = "Register";
            }
        });
    </script>
</body>
</html>