/* ═══════════════════════════════════════════
   NOOTRA LIGHT — app.js
═══════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', () => {

  /* ─── Mobile sidebar toggle ─── */
  const sidebar  = document.querySelector('.sidebar');
  const overlay  = document.querySelector('.sidebar-overlay');
  const toggleBtns = document.querySelectorAll('.mobile-toggle');

  const openSidebar  = () => { sidebar?.classList.add('open'); overlay?.classList.add('open'); };
  const closeSidebar = () => { sidebar?.classList.remove('open'); overlay?.classList.remove('open'); };

  toggleBtns.forEach(btn => btn.addEventListener('click', openSidebar));
  overlay?.addEventListener('click', closeSidebar);

  /* ─── Active nav item ─── */
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.nav-item[href]').forEach(link => {
    if (link.getAttribute('href') === currentPath) link.classList.add('active');
  });

  /* ─── Toast utility ─── */
  window.showToast = function(msg, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `<i class="fa-solid ${type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'}"></i> ${msg}`;
    document.body.appendChild(toast);
    requestAnimationFrame(() => { toast.classList.add('show'); });
    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  };

  /* ─── Filter chips ─── */
  document.querySelectorAll('.filter-chips').forEach(group => {
    group.querySelectorAll('.chip').forEach(chip => {
      chip.addEventListener('click', () => {
        group.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        const filter = chip.dataset.filter;
        if (filter) filterItems(filter);
      });
    });
  });

  function filterItems(filter) {
    document.querySelectorAll('[data-status]').forEach(item => {
      item.style.display = (filter === 'all' || item.dataset.status === filter) ? '' : 'none';
    });
    // Ocultar secciones enteras si no tienen filas visibles
    document.querySelectorAll('.task-section-title').forEach(title => {
      const list = title.nextElementSibling;
      const hasVisible = list && [...list.querySelectorAll('.task-row')].some(r => r.style.display !== 'none');
      title.style.display = hasVisible ? '' : 'none';
      if (list) list.style.display = hasVisible ? '' : 'none';
    });
    // Empty state
    const hasAny = [...document.querySelectorAll('[data-status]')].some(r => r.style.display !== 'none');
    const empty = document.getElementById('tasks-empty');
    if (empty) empty.style.display = hasAny ? 'none' : '';
  }

  /* ─── Task checkbox: restaurar desde localStorage ─── */
  document.querySelectorAll('.task-check').forEach(checkbox => {
    const key = 'task__' + checkbox.dataset.task;
    if (checkbox.dataset.task && localStorage.getItem(key) === '1') {
      checkbox.checked = true;
      checkbox.closest('.task-row')?.classList.add('done');
    }
  });

  /* ─── Task checkbox toggle + persistir ─── */
  document.querySelectorAll('.task-check').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const row = this.closest('.task-row');
      if (row) row.classList.toggle('done', this.checked);
      if (this.dataset.task) {
        if (this.checked) localStorage.setItem('task__' + this.dataset.task, '1');
        else localStorage.removeItem('task__' + this.dataset.task);
      }
    });
  });

  /* ─── Escape: limpiar búsquedas ─── */
  document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;
    const nbInput = document.querySelector('[oninput*="filterNotebooks"]');
    if (nbInput && nbInput === document.activeElement) {
      nbInput.value = '';
      if (typeof filterNotebooks === 'function') filterNotebooks('');
      nbInput.blur();
    }
    const notesInput = document.querySelector('.notes-search-input input');
    if (notesInput && notesInput === document.activeElement) {
      notesInput.value = '';
      notesInput.blur();
    }
  });

  /* ─── XP bar animation (sidebar + dashboard) ─── */
  document.querySelectorAll('[data-xp]').forEach(bar => {
    const pct = bar.dataset.xp;
    setTimeout(() => { bar.style.width = pct + '%'; }, 200);
  });

  /* ─── Ripple en botones ─── */
  document.addEventListener('click', e => {
    const btn = e.target.closest('.btn');
    if (!btn) return;
    const ripple = document.createElement('span');
    ripple.className = 'ripple-el';
    const rect = btn.getBoundingClientRect();
    ripple.style.left = (e.clientX - rect.left) + 'px';
    ripple.style.top  = (e.clientY - rect.top)  + 'px';
    btn.appendChild(ripple);
    ripple.addEventListener('animationend', () => ripple.remove());
  });

  /* ─── Stagger de cards al cargar ─── */
  document.querySelectorAll('.card, .nb-card').forEach((card, i) => {
    card.style.setProperty('--card-delay', Math.min(i * 60, 480) + 'ms');
  });

});
