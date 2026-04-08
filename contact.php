<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact | Sprevonix</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>
    <header class="site-header">
    <div class="container nav-wrap">
      <a class="logo" href="index.html"><span class="logo-mark">S</span><span>Sprevonix</span></a>
      <button class="nav-toggle" aria-label="Open menu">☰</button>
      <nav class="site-nav">
        <a href="index.php">Home</a>
        <a href="about.php" class="<?= $currentPage === 'about.php' ? 'active' : '' ?>"About</a>
        <a href="services.php">Services</a>
        <a href="portfolio.php">Portfolio</a>
        <a href="contact.php">Contact</a>
        <a href="admin.php" class="btn btn-outline small">Admin</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="page-hero compact">
      <div class="container">
        <span class="eyebrow">Contact Us</span>
        <h1>Inquiry and consultation booking</h1>
        <p class="lead">Use the unified form below to request consulting, training, partnership support, or a discovery session.</p>
      </div>
    </section>

    <section class="section">
      <div class="container split gap-lg align-start">
        <div class="card form-card">
          <h2>Request support</h2>
          <form id="contactForm" action="insert.php" method="post" novalidate>
            <div class="form-grid">
              <label>
                Full Name
                <input type="text" name="fullName" required maxlength="80" />
              </label>
              <label>
                Company / Institution
                <input type="text" name="organization" maxlength="100" />
              </label>
              <label>
                Email Address
                <input type="email" name="email" required maxlength="120" />
              </label>
              <label>
                Phone Number
                <input type="tel" name="phone" maxlength="30" />
              </label>
              <label>
                Service Needed
                <select name="service" required>
                  <option value="">Select a service</option>
                  <option>Cloud Architecture & Migration</option>
                  <option>DevOps & Automation</option>
                  <option>Web & Platform Development</option>
                  <option>Cybersecurity Readiness</option>
                  <option>Technical Training & Curriculum Design</option>
                </select>
              </label>
              <label>
                Request Type
                <select name="requestType" required>
                  <option value="">Select request type</option>
                  <option>General Inquiry</option>
                  <option>Consultation Booking</option>
                  <option>Training Partnership</option>
                  <option>Project Scoping</option>
                </select>
              </label>
              <label>
                Preferred Date
                <input type="date" name="preferredDate" />
              </label>
              <label>
                Preferred Time
                <input type="time" name="preferredTime" />
              </label>
            </div>
            <label>
              Project Details
              <textarea name="message" rows="6" required maxlength="1200" placeholder="Tell us about your project, challenge, timeline, or training need."></textarea>
            </label>
            <div class="form-actions">
              <button type="submit" class="btn">Submit Request</button>
              <button type="reset" class="btn btn-outline">Clear</button>
            </div>
            <p id="formMessage" class="form-message" aria-live="polite"></p>
          </form>
        </div>

        <aside class="card info-card">
          <h2>Why this form matters</h2>
          <p>This unified form supports both inquiry submission and consultation booking, aligning directly with the BRD scope.</p>
          <div class="info-list">
            <div>
              <strong>Submission handling</strong>
              <span>Validated in JavaScript and saved locally for demo/admin review.</span>
            </div>
            <div>
              <strong>Admin visibility</strong>
              <span>Submitted records appear on the Admin page for review and basic management.</span>
            </div>
            <div>
              <strong>Production note</strong>
              <span>For a graded deployment, connect this form to a real backend and database service.</span>
            </div>
          </div>
          <img src="assets/images/contact-support.svg" alt="Contact and booking support illustration" class="sidebar-image" />
        </aside>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-grid">
      <div><h3>Sprevonix</h3><p>Cloud, cybersecurity, software, and education consulting.</p></div>
      <div><h4>Pages</h4><a href="about.html">About</a><a href="services.html">Services</a><a href="portfolio.html">Portfolio</a><a href="contact.html">Contact</a></div>
      <div><h4>Contact</h4><p>Calgary, Alberta, Canada</p><p>hello@sprevonix.com</p><p>Mon–Fri | 9:00 AM – 5:00 PM</p></div>
    </div>
  </footer>
  <script src="assets/js/app.js"></script>
</body>
</html>
