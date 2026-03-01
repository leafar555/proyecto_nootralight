<?php
$pageTitle = 'Cuadernos';
require 'data/cuadernos.php';
?>
<?php include 'includes/head.php'; ?>

<div class="app-layout">
<?php include 'includes/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div>
      <button class="mobile-toggle"><i class="fa-solid fa-bars"></i></button>
      <div class="topbar-title">Cuadernos</div>
      <div class="topbar-sub"><?= count($notebooks) ?> cuadernos · <?= array_sum(array_column($notebooks,'notes')) ?> notas en total</div>
    </div>
    <div class="topbar-actions">
      <div style="display:flex; align-items:center; gap:8px; padding:7px 12px; background:var(--bg-tertiary); border:1px solid var(--border); border-radius:var(--radius-input);">
        <i class="fa-solid fa-search" style="color:var(--text-muted); font-size:12px;"></i>
        <input type="text" placeholder="Buscar cuadernos..." style="background:none; border:none; outline:none; color:var(--text-primary); font-size:12px; width:160px;" oninput="filterNotebooks(this.value)">
      </div>
      <button class="btn btn-primary btn-sm" onclick="showToast('Nuevo cuaderno creado')">
        <i class="fa-solid fa-plus"></i> Nuevo cuaderno
      </button>
    </div>
  </div>

  <div class="page-content">
    <div class="nb-grid" id="notebooks-grid">
      <?php foreach ($notebooks as $nb): ?>
      <a href="notas.php?nb=<?= $nb['id'] ?>" class="nb-card" style="--card-accent:<?= $nb['color'] ?>44; text-decoration:none; color:inherit;" data-title="<?= strtolower($nb['title']) ?>">
        <div class="nb-accent-bar" style="background:linear-gradient(90deg, <?= $nb['color'] ?>, transparent);"></div>
        <div class="nb-emoji" style="background:<?= $nb['bg'] ?>"><?= $nb['emoji'] ?></div>
        <div class="nb-title"><?= $nb['title'] ?></div>
        <div class="nb-meta"><?= $nb['subs'] ?> secciones · <?= $nb['notes'] ?> notas</div>
        <div class="nb-footer">
          <span style="font-size:11px; color:var(--text-muted);">Editado <?= $nb['updated'] ?></span>
          <i class="fa-solid fa-chevron-right" style="color:<?= $nb['color'] ?>; font-size:12px;"></i>
        </div>
      </a>
      <?php endforeach; ?>

      <!-- Add new -->
      <div class="nb-card nb-add" onclick="showToast('Nuevo cuaderno creado')">
        <div class="nb-add-icon"><i class="fa-solid fa-plus"></i></div>
        <span style="font-size:12px; font-weight:600; color:var(--text-muted);">Nuevo cuaderno</span>
      </div>
    </div>

    <div id="nb-empty" class="empty-state" style="display:none;">
      <i class="fa-solid fa-book-open"></i>
      <p>No se encontraron cuadernos</p>
    </div>
  </div>
</div>
</div>

<script>
function filterNotebooks(q) {
  let visible = 0;
  document.querySelectorAll('#notebooks-grid .nb-card[data-title]').forEach(card => {
    const show = card.dataset.title.includes(q.toLowerCase());
    card.style.display = show ? '' : 'none';
    if (show) visible++;
  });
  const empty = document.getElementById('nb-empty');
  if (empty) empty.style.display = visible === 0 ? '' : 'none';
}
</script>

<?php include 'includes/footer.php'; ?>
