
(function(){
  const data = window.SprevonixData;
  const navContainer = document.querySelector('[data-nav]');
  const footerNav = document.querySelector('[data-footer-nav]');
  const current = location.pathname.split('/').pop() || 'index.html';

  function navLink(item){
    const active = item.href === current ? 'active' : '';
    return `<a href="${item.href}" class="${active}">${item.name}</a>`;
  }

  if(navContainer){
    navContainer.innerHTML = data.navigation.map(navLink).join('');
  }
  if(footerNav){
    footerNav.innerHTML = data.navigation.map(item => `<a href="${item.href}">${item.name}</a>`).join('<br>');
  }

  const mobileBtn = document.querySelector('[data-menu-button]');
  if(mobileBtn && navContainer){
    mobileBtn.addEventListener('click', () => navContainer.classList.toggle('open'));
  }

  document.querySelectorAll('[data-brand-name]').forEach(el => el.textContent = data.company.shortName);
  document.querySelectorAll('[data-company-email]').forEach(el => el.textContent = data.company.email);
  document.querySelectorAll('[data-company-phone]').forEach(el => el.textContent = data.company.phone);
  document.querySelectorAll('[data-company-location]').forEach(el => el.textContent = data.company.location);
  document.querySelectorAll('[data-company-tagline]').forEach(el => el.textContent = data.company.tagline);

  const serviceGrid = document.querySelector('[data-service-grid]');
  if(serviceGrid){
    serviceGrid.innerHTML = data.services.map(service => `
      <article class="card service-card">
        <div class="icon-chip" aria-hidden="true"><span style="font-size:1.4rem">${service.icon}</span></div>
        <h3>${service.title}</h3>
        <p class="muted">${service.summary}</p>
        <ul class="checklist">
          ${service.bullets.map(b => `<li>${b}</li>`).join('')}
        </ul>
      </article>
    `).join('');
  }

  const portfolioGrid = document.querySelector('[data-portfolio-grid]');
  if(portfolioGrid){
    portfolioGrid.innerHTML = data.portfolio.map(item => `
      <article class="card portfolio-card">
        <img src="${item.image}" alt="${item.title}">
        <div style="padding-top:16px">
          <span class="badge">${item.category}</span>
          <h3>${item.title}</h3>
          <p class="muted"><strong>Challenge:</strong> ${item.challenge}</p>
          <p class="muted"><strong>Solution:</strong> ${item.solution}</p>
          <p>${item.outcome}</p>
        </div>
      </article>
    `).join('');
  }

  const caseStudyList = document.querySelector('[data-case-study-list]');
  if(caseStudyList){
    caseStudyList.innerHTML = data.caseStudies.map(item => `
      <article class="card info-card">
        <h3>${item.name}</h3>
        <p class="muted">${item.detail}</p>
      </article>
    `).join('');
  }

  const metricsGrid = document.querySelector('[data-metrics-grid]');
  if(metricsGrid){
    metricsGrid.innerHTML = data.metrics.map(item => `
      <article class="card kpi">
        <strong>${item.value}</strong>
        <span>${item.label}</span>
      </article>
    `).join('');
  }

  const timeline = document.querySelector('[data-timeline]');
  if(timeline){
    timeline.innerHTML = data.timeline.map((item, index) => `
      <div class="timeline-item">
        <div class="timeline-num">${index + 1}</div>
        <div>
          <h3 style="margin:0 0 8px">${item.step}</h3>
          <p class="muted" style="margin:0">${item.text}</p>
        </div>
      </div>
    `).join('');
  }

  const yearEl = document.querySelector('[data-year]');
  if(yearEl) yearEl.textContent = new Date().getFullYear();
})();
