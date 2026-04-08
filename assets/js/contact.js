
(function(){
  const STORAGE_KEY = 'sprevonix_submissions';
  const form = document.querySelector('[data-contact-form]');
  const successBox = document.querySelector('.success-msg');
  const errorBox = document.querySelector('.error-msg');
  const tableBody = document.querySelector('[data-submission-body]');
  const emptyState = document.querySelector('[data-empty-state]');
  const clearBtn = document.querySelector('[data-clear-submissions]');

  const readItems = () => {
    try{
      return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    }catch(err){
      return [];
    }
  };

  const writeItems = items => localStorage.setItem(STORAGE_KEY, JSON.stringify(items));

  const validate = values => {
    const errors = [];
    if(!values.name.trim()) errors.push('Name is required.');
    if(!values.email.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.email)) errors.push('A valid email is required.');
    if(!values.service.trim()) errors.push('Please select a service.');
    if(!values.requestType.trim()) errors.push('Please select inquiry or booking.');
    if(!values.message.trim() || values.message.trim().length < 20) errors.push('Message must be at least 20 characters.');
    return errors;
  };

  if(form){
    form.addEventListener('submit', e => {
      e.preventDefault();
      successBox.style.display = 'none';
      errorBox.style.display = 'none';

      const formData = new FormData(form);
      const values = Object.fromEntries(formData.entries());
      const errors = validate(values);

      if(errors.length){
        errorBox.innerHTML = errors.join('<br>');
        errorBox.style.display = 'block';
        return;
      }

      const items = readItems();
      items.unshift({
        id: crypto.randomUUID(),
        ...values,
        submittedAt: new Date().toLocaleString()
      });
      writeItems(items);
      form.reset();
      successBox.textContent = 'Submission saved successfully. In this HTML/CSS/JS version, entries are stored in your browser localStorage and viewable on the Admin page.';
      successBox.style.display = 'block';
    });
  }

  function renderTable(){
    if(!tableBody) return;
    const items = readItems();
    tableBody.innerHTML = '';
    if(!items.length){
      if(emptyState) emptyState.style.display = 'block';
      return;
    }
    if(emptyState) emptyState.style.display = 'none';
    tableBody.innerHTML = items.map(item => `
      <tr>
        <td>${item.submittedAt}</td>
        <td>${item.name}</td>
        <td>${item.email}</td>
        <td>${item.requestType}</td>
        <td>${item.service}</td>
        <td>${item.company || '—'}</td>
        <td>${item.preferredDate || '—'}</td>
        <td>${item.message}</td>
      </tr>
    `).join('');
  }

  renderTable();

  if(clearBtn){
    clearBtn.addEventListener('click', () => {
      localStorage.removeItem(STORAGE_KEY);
      renderTable();
    });
  }
})();
