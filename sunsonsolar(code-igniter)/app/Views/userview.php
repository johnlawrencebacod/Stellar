<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
</head>
<body>
    <main>
        <h1>Create an employee account</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <p role="status"><?= esc(session()->getFlashdata('success')) ?></p>
        <?php endif ?>

        <?php $errors = session()->getFlashdata('errors') ?? []; ?>
        <?php if ($errors !== []): ?>
            <div role="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= site_url('register/save') ?>" method="post">
            <?= csrf_field() ?>

            <label for="fname">First Name</label><br>
            <input type="text" id="fname" name="fname" maxlength="50" value="<?= esc(old('fname')) ?>" required><br><br>

            <label for="lname">Last Name</label><br>
            <input type="text" id="lname" name="lname" maxlength="50" value="<?= esc(old('lname')) ?>" required><br><br>

            <label for="Mname">Middle Name</label><br>
            <input type="text" id="Mname" name="Mname" maxlength="50" value="<?= esc(old('Mname')) ?>" required><br><br>

            <label for="Bdate">Birthdate</label><br>
            <input type="date" id="Bdate" name="Bdate" value="<?= esc(old('Bdate')) ?>" required><br><br>

            <label for="gender">Gender</label><br>
            <select id="gender" name="gender" required>
                <option value="">Select gender</option>
                <option value="male" <?= old('gender') === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= old('gender') === 'female' ? 'selected' : '' ?>>Female</option>
            </select><br><br>

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" maxlength="100" value="<?= esc(old('email')) ?>" required><br><br>

            <label for="pnum">Phone Number</label><br>
            <input type="tel" id="pnum" name="pnum" maxlength="20" value="<?= esc(old('pnum')) ?>" required><br><br>

            <label for="address">Address</label><br>
            <input type="text" id="address" name="address" maxlength="100" value="<?= esc(old('address')) ?>" required><br><br>

            <label for="department">Department</label><br>
            <input type="text" id="department" name="department" maxlength="50" value="<?= esc(old('department')) ?>" required><br><br>

            <label for="Uname">Username</label><br>
            <input type="text" id="Uname" name="Uname" minlength="3" maxlength="50" value="<?= esc(old('Uname')) ?>" required><br><br>

            <label for="pass">Password</label><br>
            <input type="password" id="pass" name="pass" minlength="8" maxlength="255" required><br><br>

            <input type="checkbox" id="terms" name="terms" value="1" required>
            <label for="terms">I agree to the terms of service and privacy policy</label><br><br>

            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
