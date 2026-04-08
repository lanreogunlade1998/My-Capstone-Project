<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Sprevonix</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>
  <header class="site-header">
    <div class="container nav-wrap">
      <a class="logo" href="index.php"><span class="logo-mark">S</span><span>Sprevonix</span></a>
      <button class="nav-toggle" aria-label="Open menu">☰</button>
      <nav class="site-nav">
        <a href="index.php">Home</a>
        <a href="about.php" class="active">About</a>
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
        <span class="eyebrow">Portfolio / Case Studies</span>
        <h1>Illustrative engagements grounded in cloud, DevOps, cybersecurity, and education.</h1>
        <p class="lead">These sample case studies support the professional brand and align with the project requirement for a portfolio page.</p>
      </div>
    </section>

    <section class="section">
      <div class="container grid grid-2 cards">
        <article class="card portfolio-card">
          <img src="assets/images/case-modernization.svg" alt="Platform modernization illustration" class="portfolio-image" />
          <span class="tag">Consulting Platform</span>
          <h3>Cloud-Enabled Consulting Website</h3>
          <p><strong>Challenge:</strong> A professional services firm needed a modern web presence with inquiry capture, consultation booking, and DevOps-aligned deployment readiness.</p>
          <p><strong>Solution:</strong> Responsive website, containerized deployment, infrastructure planning, and cloud hosting design across AWS and Azure.</p>
          <p><strong>Outcome:</strong> Stronger digital credibility, structured client onboarding, and improved readiness for scalable cloud deployment.</p>
        </article>

        <article class="card portfolio-card">
          <img src="assets/images/case-training.svg" alt="Training platform illustration" class="portfolio-image" />
          <span class="tag">Technical Education</span>
          <h3>Workforce Upskilling Program Design</h3>
          <p><strong>Challenge:</strong> A learning provider required technical training experiences aligned with industry tools, current practice, and measurable learner outcomes.</p>
          <p><strong>Solution:</strong> Designed structured learning pathways, hands-on labs, applied assessments, and technical enablement resources.</p>
          <p><strong>Outcome:</strong> Better learner engagement, stronger employability focus, and clearer delivery consistency across cohorts.</p>
        </article>

        <article class="card portfolio-card">
          <img src="assets/images/case-cyber.svg" alt="Cyber readiness illustration" class="portfolio-image" />
          <span class="tag">Cybersecurity Readiness</span>
          <h3>Leadership Cyber Preparedness Initiative</h3>
          <p><strong>Challenge:</strong> Non-technical leaders needed a practical understanding of cyber incidents, response priorities, and resilience planning.</p>
          <p><strong>Solution:</strong> Scenario-based facilitation model with risk framing, communication planning, and mitigation priorities.</p>
          <p><strong>Outcome:</strong> Greater decision confidence, improved awareness, and more realistic readiness conversations.</p>
        </article>

        <article class="card portfolio-card">
          <img src="assets/images/case-devops.svg" alt="DevOps automation illustration" class="portfolio-image" />
          <span class="tag">DevOps Transformation</span>
          <h3>Automation & Release Pipeline Enablement</h3>
          <p><strong>Challenge:</strong> A delivery team needed faster, more consistent deployments without sacrificing transparency or control.</p>
          <p><strong>Solution:</strong> Standardized Docker builds, repository structure, IaC planning, and CI/CD workflow recommendations.</p>
          <p><strong>Outcome:</strong> Reduced deployment friction, improved delivery visibility, and stronger operational discipline.</p>
        </article>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-grid">
      <div><h3>Sprevonix</h3><p>Cloud, cybersecurity, software, and education consulting.</p></div>
      <div><h4>Pages</h4><a href="about.php">About</a><a href="services.php">Services</a><a href="portfolio.php">Portfolio</a><a href="contact.php">Contact</a></div>
      <div><h4>Contact</h4><p>Calgary, Alberta, Canada</p><p>hello@sprevonix.com</p><p>Mon–Fri | 9:00 AM – 5:00 PM</p></div>
    </div>
  </footer>
  <script src="assets/js/app.js"></script>
</body>
</html>
