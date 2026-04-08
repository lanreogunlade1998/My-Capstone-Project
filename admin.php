<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard | Sprevonix</title>
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
        <span class="eyebrow">Admin Dashboard</span>
        <h1>Submission review console</h1>
        <p class="lead">Dashboard for inquiry and booking records captured from the unified contact form.</p>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="admin-toolbar">
          <button id="seedDataBtn" class="btn btn-outline">Load Sample Records</button>
          <button id="clearDataBtn" class="btn danger">Clear All Records</button>
        </div>
        <div class="table-card">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Service</th>
                <th>Request Type</th>
                <th>Preferred Slot</th>
                <th>Submitted</th>
              </tr>
            </thead>
            <tbody id="submissionTableBody"></tbody>
          </table>
          <p id="emptyState" class="empty-state">No records yet. Submit the form or load sample records.</p>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-grid">
      <div><h3>Sprevonix</h3><p>Cloud, cybersecurity, software, and education consulting.</p></div>
      <div><h4>Pages</h4><a href="about.php">About</a><a href="services.php">Services</a><a href="portfolio.php">Portfolio</a><a href="contact.html">Contact</a></div>
      <div><h4>Contact</h4><p>Calgary, Alberta, Canada</p><p>hello@sprevonix.com</p><p>Mon–Fri | 9:00 AM – 5:00 PM</p></div>
    </div>
  </footer>
  <script src="assets/js/app.js"></script>
</body>
</html>
