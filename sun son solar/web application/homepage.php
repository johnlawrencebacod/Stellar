<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);          // it is set by login.php after a successful login
$userName   = $isLoggedIn ? htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') : '';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sun Son Solar</title>
  <link rel="stylesheet" href="Hstyles.css">
</head>
<body>

<!-- 1. HEADER + NAV -->
<header class="site-header">
  <a href="#top" class="logo">Sun Son Solar</a>
  <nav>
    <a href="#services">Services</a>
    <a href="#why">Why Solar</a>
    <a href="#about">About</a>
    <a href="#stories">Stories</a>
    <a href="#faq">FAQ</a>
    <a href="#news">News</a>
    <a href="#contact">Contact</a>
  </nav>
  <?php if ($isLoggedIn): ?>
    <span>Hi, <?= $userName ?></span> <a class="btn" href="logout.php">Log out</a>
  <?php else: ?>
    <a class="btn btn-outline" href="#login">Log in</a>
  <?php endif; ?>
</header> 

<main>

<!-- 2. HERO -->
<section id="top" class="hero">
  <h1>Power Your Future With Solar</h1>
  <p>TODO: one sentence about what you do and who it is for.</p>
  <a class="btn" href="#quote">Get a free quote</a>
  <a class="btn btn-outline" href="#services">See our services</a>
</section>

<!-- 3. ABOUT: clear description of the company -->
<section id="about" class="section">
  <h2>Who we are</h2>
  <p>TODO: 2 to 3 sentences about the company.</p>
</section>

<!-- 4. BENEFITS -->
<section id="why" class="section">
  <h2>Why go solar</h2>
  <div class="grid">
    <div class="card"><h3>Cost Savings</h3><p>TODO</p></div>
    <div class="card"><h3>Sustainability</h3><p>TODO</p></div>
    <div class="card"><h3>Energy Independence</h3><p>TODO</p></div>
  </div>
</section>

<!-- 5. SERVICES -->
<section id="services" class="section">
  <h2>Our services</h2>
  <div class="grid">
    <div class="card"><h3>Consultation</h3><p>TODO</p></div>
    <div class="card"><h3>Installation</h3><p>TODO</p></div>
    <div class="card"><h3>Maintenance</h3><p>TODO</p></div>
  </div>
</section>

<!-- 6. TESTIMONIALS (use real customer stories) -->
<section id="stories" class="section">
  <h2>Customer stories</h2>
  <blockquote class="card">
    &ldquo;TODO: a real customer quote.&rdquo;
    <footer>TODO: name, result (for example: bill dropped by XX%)</footer>
  </blockquote>
</section>

<!-- 7. CALL TO ACTION: quote or schedule -->
<section id="quote" class="section cta">
  <h2>Ready to power your future?</h2>
  <form action="quote_request.php" method="POST">
    <label>Full name <input type="text" name="name" required></label>
    <label>Mobile number <input type="tel" name="phone" required></label>
    <label>Email <input type="email" name="email" required></label>
    <label>I would like to
      <select name="request">
        <option value="quote">Get a free quote</option>
        <option value="consultation">Schedule a consultation</option>
        <option value="installation">Schedule an installation</option>
        <option value="maintenance">Schedule maintenance</option>
      </select>
    </label>
    <button class="btn" type="submit">Send my request</button>
  </form>
</section>

<!-- 8. FAQ -->
<section id="faq" class="section">
  <h2>Questions? We have answers</h2>
  <details><summary>How much does solar cost?</summary><p>TODO</p></details>
  <details><summary>Does it work on cloudy days?</summary><p>TODO</p></details>
  <details><summary>How long does installation take?</summary><p>TODO</p></details>
</section>

<!-- 9. NEWS / BLOG -->
<section id="news" class="section">
  <h2>News &amp; updates</h2>
  <div class="grid">
    <article class="card"><h3>TODO post title</h3><p>TODO summary</p><a href="#">Read more</a></article>
    <article class="card"><h3>TODO post title</h3><p>TODO summary</p><a href="#">Read more</a></article>
  </div>
</section>

<!-- 10. LOGIN (customers and employees). Only customers can sign up. -->
<section id="login" class="section">
  <h2>Log in</h2>
  <?php if ($isLoggedIn): ?>
    <p>You are logged in as <?= $userName ?>.</p>
  <?php else: ?>
    <form action="login.php" method="POST" class="card">
      <label><input type="radio" name="role" value="customer" checked> Customer</label>
      <label><input type="radio" name="role" value="employee"> Employee</label>
      <label>Username <input type="text" name="username" required></label>
      <label>Password <input type="password" name="password" required></label>
      <button class="btn" type="submit">Log in</button>
    </form>
    <p>New customer? <a href="register.php">Create an account</a></p>
    <p><small>Employee accounts are created by HR or an administrator.</small></p>
  <?php endif; ?>
</section>

</main>

<!-- 11. FOOTER -->
<footer id="contact" class="site-footer">
  <div>
    <h3>Contact us</h3>
    <p>TODO address<br>TODO phone<br>TODO email<br>TODO hours</p>
  </div>
  <div>
    <h3>Follow us</h3>
    <a href="#">Facebook</a> <a href="#">Instagram</a> <a href="#">YouTube</a>
  </div>
  <div>
    <h3>Links</h3>
    <a href="#services">Services</a> <a href="#faq">FAQ</a> <a href="#quote">Free quote</a>
  </div>
  <div>
    <h3>Legal</h3>
    <a href="#">Privacy Policy</a> <a href="#">Terms of Service</a> <a href="#">Data Privacy Notice</a>
  </div>
  <p class="copyright">&copy; <?= date('Y') ?> Sun Son Solar. All rights reserved.</p>
</footer>

</body>
</html>