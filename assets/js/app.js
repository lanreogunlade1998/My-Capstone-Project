const STORAGE_KEY = 'sprevonix_submissions';
const navToggle = document.querySelector('.nav-toggle');
const nav = document.querySelector('.site-nav');
if (navToggle && nav) {
  navToggle.addEventListener('click', () => nav.classList.toggle('open'));
}

const sanitize = (value) => String(value || '')
  .replace(/[<>]/g, '')
  .trim();

const getSubmissions = () => {
  try {
    return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
  } catch {
    return [];
  }
};

const saveSubmissions = (items) => localStorage.setItem(STORAGE_KEY, JSON.stringify(items));

const seedRecords = [
  {
    fullName: 'Amina Yusuf',
    organization: 'Praxis Digital Advisory',
    email: 'amina@praxisdigital.ca',
    phone: '+1 403 555 0134',
    service: 'Cloud Architecture & Migration',
    requestType: 'Project Scoping',
    preferredDate: '2026-04-15',
    preferredTime: '10:00',
    message: 'We need a secure cloud hosting strategy for a new consulting platform and would like an architecture review.',
    submittedAt: '2026-03-28T15:22:00'
  },
  {
    fullName: 'Daniel Ofori',
    organization: 'NorthPeak Learning',
    email: 'daniel@northpeaklearning.org',
    phone: '+1 587 555 0178',
    service: 'Technical Training & Curriculum Design',
    requestType: 'Training Partnership',
    preferredDate: '2026-04-18',
    preferredTime: '13:30',
    message: 'We are exploring a cohort-based technical upskilling program for cloud and DevOps fundamentals.',
    submittedAt: '2026-03-29T09:05:00'
  }
];

const form = document.getElementById('contactForm');
if (form) {
  const formMessage = document.getElementById('formMessage');

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const formData = new FormData(form);

    const payload = {
      fullName: sanitize(formData.get('fullName')),
      organization: sanitize(formData.get('organization')),
      email: sanitize(formData.get('email')),
      phone: sanitize(formData.get('phone')),
      service: sanitize(formData.get('service')),
      requestType: sanitize(formData.get('requestType')),
      preferredDate: sanitize(formData.get('preferredDate')),
      preferredTime: sanitize(formData.get('preferredTime')),
      message: sanitize(formData.get('message')),
      submittedAt: new Date().toISOString()
    };

    if (!payload.fullName || !payload.email || !payload.service || !payload.requestType || !payload.message) {
      formMessage.textContent = 'Please complete all required fields.';
      formMessage.style.color = '#c62828';
      return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(payload.email)) {
      formMessage.textContent = 'Please provide a valid email address.';
      formMessage.style.color = '#c62828';
      return;
    }

    const submissions = getSubmissions();
    submissions.unshift(payload);
    saveSubmissions(submissions);

    form.reset();
    formMessage.textContent = 'Your request has been submitted successfully.';
    formMessage.style.color = '#0f9d58';
  });
}

const tableBody = document.getElementById('submissionTableBody');
const emptyState = document.getElementById('emptyState');

const renderTable = () => {
  if (!tableBody) return;

  const submissions = getSubmissions();
  tableBody.innerHTML = '';

  if (!submissions.length) {
    emptyState?.classList.remove('hidden');
    return;
  }

  emptyState?.classList.add('hidden');

  submissions.forEach((item) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td><strong>${item.fullName}</strong><br><span>${item.organization || '—'}</span></td>
      <td>${item.email}<br><span>${item.phone || '—'}</span></td>
      <td>${item.service}</td>
      <td>${item.requestType}</td>
      <td>${item.preferredDate || '—'} ${item.preferredTime || ''}</td>
      <td>${new Date(item.submittedAt).toLocaleString()}</td>
    `;
    tableBody.appendChild(row);
  });
};

renderTable();

const seedBtn = document.getElementById('seedDataBtn');
if (seedBtn) {
  seedBtn.addEventListener('click', () => {
    saveSubmissions(seedRecords);
    renderTable();
  });
}

const clearBtn = document.getElementById('clearDataBtn');
if (clearBtn) {
  clearBtn.addEventListener('click', () => {
    localStorage.removeItem(STORAGE_KEY);
    renderTable();
  });
}
