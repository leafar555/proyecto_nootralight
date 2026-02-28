<?php
$pageTitle = 'Cuadernos';

$notebooks = [
  ['id' => 1, 'title' => 'Cálculo II',       'emoji' => '📐', 'color' => '#a78bfa', 'bg' => 'rgba(124,58,237,0.15)', 'notes' => 24, 'subs' => 5, 'updated' => 'hace 2h'],
  ['id' => 2, 'title' => 'Física',            'emoji' => '⚡', 'color' => '#60a5fa', 'bg' => 'rgba(59,130,246,0.15)',  'notes' => 18, 'subs' => 4, 'updated' => 'ayer'],
  ['id' => 3, 'title' => 'Química Orgánica',  'emoji' => '🧪', 'color' => '#f472b6', 'bg' => 'rgba(236,72,153,0.15)','notes' => 12, 'subs' => 3, 'updated' => 'hace 2 días'],
  ['id' => 4, 'title' => 'Estadística',       'emoji' => '📊', 'color' => '#34d399', 'bg' => 'rgba(16,185,129,0.15)', 'notes' => 9,  'subs' => 2, 'updated' => 'hace 3 días'],
  ['id' => 5, 'title' => 'Historia Universal','emoji' => '🏛️', 'color' => '#fbbf24', 'bg' => 'rgba(245,158,11,0.15)', 'notes' => 15, 'subs' => 4, 'updated' => 'hace 5 días'],
  ['id' => 6, 'title' => 'Programación Web',  'emoji' => '💻', 'color' => '#f87171', 'bg' => 'rgba(239,68,68,0.15)',  'notes' => 31, 'subs' => 6, 'updated' => 'hace 1h'],
];
?>
<?php include 'includes/head.php'; ?>
<style>
  .nb-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
  .nb-card {
    padding: 20px; border-radius: var(--radius-card);
    background: var(--bg-secondary); border: 1px solid var(--border);
    cursor: pointer; transition: var(--transition);
    position: relative; overflow: hidden;
  }
  .nb-card:hover { border-color: var(--card-accent, #3d3d6e); transform: translateY(-2px); box-shadow: var(--shadow-lg); }
  .nb-accent-bar { height: 3px; border-radius: 3px; margin-bottom: 16px; }
  .nb-emoji {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; margin-bottom: 12px;
  }
  .nb-title { font-size: 14px; font-weight: 700; margin-bottom: 4px; }
  .nb-meta { font-size: 11px; color: var(--text-muted); margin-bottom: 14px; }
  .nb-footer { display: flex; align-items: center; justify-content: space-between; }
  .nb-add {
    border: 2px dashed var(--border); background: transparent;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: 8px; min-height: 170px; transition: var(--transition); cursor: pointer;
  }
  .nb-add:hover { border-color: rgba(124,58,237,0.5); }
  .nb-add-icon {
    width: 40px; height: 40px; border-radius: 50%;
    background: rgba(124,58,237,0.15);
    display: flex; align-items: center; justify-content: center;
    color: var(--accent-purple); font-size: 16px;
  }

  @media (max-width: 900px) { .nb-grid { grid-template-columns: repeat(2,1fr); } }
  @media (max-width: 600px) { .nb-grid { grid-template-columns: 1fr; } }
</style>

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
  </div>
</div>
</div>

<script>
function filterNotebooks(q) {
  document.querySelectorAll('#notebooks-grid .nb-card[data-title]').forEach(card => {
    card.style.display = card.dataset.title.includes(q.toLowerCase()) ? '' : 'none';
  });
}
</script>

<?php include 'includes/footer.php'; ?>
