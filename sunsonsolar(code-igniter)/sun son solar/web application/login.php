<?php
$host     = "localhost";
$dbname   = "sunsonsolardb";
$username = "root";   
$password = "";  

$error = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uname = trim($_POST["Uname"] ?? "");
    $pnum  = trim($_POST["pnum"] ?? "");
    $pass  = trim($_POST["pass"] ?? "");

    if ($uname === "" || $pnum === "" || $pass === "") {
        $error = "Please fill in all fields.";
    } else {
        try {
            $conn = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `admin`
                    WHERE `Username` = :uname AND `Phone Number` = :pnum
                    LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":uname" => $uname,
                ":pnum"  => $pnum
            ]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && $admin["Password"] === $pass) {
                session_regenerate_id(true);
                $_SESSION["admin_id"]   = $admin["ID"];
                $_SESSION["admin_name"] = $admin["First Name"];
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Invalid username, phone number, or password.";
            }
        } catch (PDOException $e) {

        }
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

    <?php if ($error !== ""): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="Uname">Username</label><br>
        <input type="text" id="Uname" name="Uname" required><br><br>

        <label for="pnum">Phone Number</label><br>
        <input type="text" id="pnum" name="pnum" required><br><br>

        <label for="pass">Password</label><br>
        <input type="password" id="pass" name="pass" required><br><br>

        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">I agree to the terms of service and privacy policy</label><br><br>

        <input type="submit" value="Login" id="regis"><br><br>
        <input type="submit" value="Forgot Password" id="fogpass">
    </form>
</body>
</html>