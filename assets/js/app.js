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
      if (filter === 'all' || item.dataset.status === filter) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    });
  }

  /* ─── Task checkbox toggle ─── */
  document.querySelectorAll('.task-check').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const row = this.closest('.task-row');
      if (row) row.classList.toggle('done', this.checked);
    });
  });

  /* ─── XP bar animation ─── */
  document.querySelectorAll('.xp-fill[data-xp]').forEach(bar => {
    const pct = bar.dataset.xp;
    setTimeout(() => { bar.style.width = pct + '%'; }, 200);
  });

});
