<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services | Sprevonix</title>
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
        <span class="eyebrow">Services</span>
        <h1>Specialized offerings for modern digital organizations.</h1>
        <p class="lead">Our service portfolio reflects the capstone brief: consulting, delivery, automation, and enablement.</p>
      </div>
    </section>

    <section class="section">
      <div class="container grid grid-2 cards">
        <article class="card service-card">
          <img src="assets/images/service-cloud.svg" alt="Cloud architecture service illustration" class="service-image" />
          <h3>Cloud Architecture & Migration</h3>
          <p>Assessment, target architecture design, workload placement strategy, hosting recommendations, and multi-cloud mapping across AWS and Azure.</p>
          <ul>
            <li>AWS and Azure solution design</li>
            <li>Hosting, networking, storage, and database planning</li>
            <li>Scalability and resilience recommendations</li>
          </ul>
        </article>

        <article class="card service-card">
          <img src="assets/images/service-devops.svg" alt="DevOps service illustration" class="service-image" />
          <h3>DevOps & Automation</h3>
          <p>Containerization, CI/CD setup, infrastructure as code, and deployment workflow optimization to reduce friction and improve reliability.</p>
          <ul>
            <li>Docker-based application packaging</li>
            <li>Terraform-driven infrastructure provisioning</li>
            <li>GitHub Actions and deployment automation</li>
          </ul>
        </article>

        <article class="card service-card">
          <img src="assets/images/service-web.svg" alt="Web engineering service illustration" class="service-image" />
          <h3>Web & Platform Development</h3>
          <p>Professional digital platforms for consulting firms, education brands, and service organizations that need clean UX and credible presentation.</p>
          <ul>
            <li>Responsive websites and landing pages</li>
            <li>Inquiry and booking flows</li>
            <li>Content architecture and UI refinement</li>
          </ul>
        </article>

        <article class="card service-card">
          <img src="assets/images/service-cyber.svg" alt="Cybersecurity service illustration" class="service-image" />
          <h3>Cybersecurity Readiness</h3>
          <p>Security awareness, baseline architecture controls, policy considerations, secure forms, access control recommendations, and monitoring guidance.</p>
          <ul>
            <li>Input validation and secure handling of submissions</li>
            <li>Operational monitoring strategy</li>
            <li>Access control and cloud security posture guidance</li>
          </ul>
        </article>
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
