<?php
  session_start();
  $isLoggedIn = isset($_SESSION['user_id']); // assuming user_id is set during login
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home | Subscription Tracker</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="home.css" />
</head>
<body>
  <header>
    <div class="logo">Subscription Tracking</div>
    <nav>
      <a href="home.php">Home</a>
      <a href="#features">Features</a>
      <a href="#about">About</a>
      <?php if ($isLoggedIn): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
      <?php endif; ?>
    </nav>
  </header>

  <section class="hero">
    <div class="container">
      <h1>Track All Your Subscriptions in One Place</h1>
      <p>Stay ahead of your payments, get notified before anything expires.</p>
      <a href="register.php" class="btn">Get Started</a>
    </div>
  </section>

  <section id="features" class="section">
    <div class="container">
      <h2>Features</h2>
      <div class="features-grid">
        <div class="feature-wrapper">
          <div class="feature-card">
            <img src="easysub.png" alt="Easy Subscription Management" />
          </div>
          <p class="feature-label">Easy Subscription Management</p>
        </div>
        <div class="feature-wrapper">
          <div class="feature-card">
            <img src="easyrem.png" alt="Smart Reminders" />
          </div>
          <p class="feature-label">Smart Reminders</p>
        </div>
        <div class="feature-wrapper">
          <div class="feature-card">
            <img src="img/dashboard.png" alt="Personalized Dashboard" />
          </div>
          <p class="feature-label">Personalized Dashboard</p>
        </div>
        <div class="feature-wrapper">
          <div class="feature-card">
            <img src="secure.png" alt="Secure & Simple Login" />
          </div>
          <p class="feature-label">Secure & Simple Login</p>
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="section">
    <div class="container">
      <h2>About</h2>
      <p class="about-text">
        Subscription Tracking is designed to help you manage all your digital subscriptions like Netflix, Spotify, Amazon Prime and more, in one place. Get reminders before renewals and never miss out or overspend again.
      </p>
    </div>
  </section>

  <footer>
    <div class="footer-content">
      <p>&copy; 2025 SubTrack. All rights reserved.</p>
      <p>Email: <a href="mailto:subscriptiontrackertest@gmail.com">subscriptiontrackertest@gmail.com</a></p>
      <p>Phone: <a href="tel:+916303733839">+91 6303733839</a></p>
    </div>
  </footer>
</body>
</html>
