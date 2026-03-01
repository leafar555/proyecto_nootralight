<?php
$pageTitle = 'Calendario';
require 'data/calendario.php';
?>
<?php include 'includes/head.php'; ?>

<div class="app-layout">
<?php include 'includes/sidebar.php'; ?>

<div class="main">
  <!-- Topbar -->
  <div class="topbar">
    <div>
      <button class="mobile-toggle"><i class="fa-solid fa-bars"></i></button>
      <div class="topbar-title">Calendario Académico</div>
      <div class="topbar-sub">Miércoles, 27 de febrero 2026</div>
    </div>
    <div class="topbar-actions">
      <div class="view-toggle">
        <button class="view-btn active" onclick="setView('month', this)"><i class="fa-solid fa-calendar"></i> Mes</button>
        <button class="view-btn" onclick="setView('agenda', this)"><i class="fa-solid fa-list"></i> Agenda</button>
      </div>
      <button class="btn btn-primary btn-sm" onclick="showToast('Evento creado')">
        <i class="fa-solid fa-plus"></i> Nuevo evento
      </button>
    </div>
  </div>

  <div class="page-content">

    <!-- Month view -->
    <div id="view-month">
      <div class="card" style="overflow:hidden;">
        <!-- Calendar header -->
        <div style="padding:16px 20px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--border);">
          <div style="display:flex; align-items:center; gap:10px;">
            <button class="btn btn-ghost btn-icon btn-sm"><i class="fa-solid fa-chevron-left"></i></button>
            <h2 style="font-size:16px; font-weight:700;">Febrero 2026</h2>
            <button class="btn btn-ghost btn-icon btn-sm"><i class="fa-solid fa-chevron-right"></i></button>
          </div>
          <div style="display:flex; gap:14px; font-size:11px; color:var(--text-muted);">
            <?php
            $legend = [['color'=>'#a78bfa','label'=>'Entrega'],['color'=>'#f472b6','label'=>'Examen'],['color'=>'#34d399','label'=>'Exposición'],['color'=>'#fbbf24','label'=>'Tarea']];
            foreach ($legend as $l): ?>
            <span style="display:flex; align-items:center; gap:5px;">
              <span style="width:8px; height:8px; border-radius:50%; background:<?= $l['color'] ?>; display:inline-block;"></span>
              <?= $l['label'] ?>
            </span>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- Day headers -->
        <div class="calendar-grid">
          <?php foreach ($weekDays as $d): ?>
          <div class="cal-header-day"><?= $d ?></div>
          <?php endforeach; ?>
          <?php foreach ($calDays as $d): ?>
          <div class="cal-cell">
            <?php if ($d): ?>
            <div class="cal-day-num <?= $d === $today ? 'today' : '' ?>"><?= $d ?></div>
            <?php
            if (isset($eventsByDay[$d])) {
              $dayEvs = $eventsByDay[$d];
              foreach (array_slice($dayEvs, 0, 2) as $ev): ?>
              <div class="cal-event" style="background:<?= $ev['color'] ?>22; color:<?= $ev['color'] ?>;" title="<?= $ev['title'] ?> · <?= $ev['time'] ?>">
                <?= $ev['title'] ?>
              </div>
              <?php endforeach;
              if (count($dayEvs) > 2): ?>
              <div class="cal-more">+<?= count($dayEvs) - 2 ?> más</div>
              <?php endif;
            }
            ?>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Agenda view -->
    <div id="view-agenda" style="display:none; max-width:700px;">
      <h2 style="font-size:16px; font-weight:700; margin-bottom:20px;">Próximos eventos — Febrero 2026</h2>
      <?php foreach ($events as $ev): ?>
      <div class="agenda-item card" style="border-color:<?= !empty($ev['urgent']) ? $ev['color'].'44' : 'var(--border)' ?>;">
        <div class="agenda-date" style="background:<?= $ev['color'] ?>22;">
          <span class="agenda-month" style="color:<?= $ev['color'] ?>;">FEB</span>
          <span class="agenda-day" style="color:<?= $ev['color'] ?>;"><?= $ev['day'] ?></span>
        </div>
        <div style="flex:1; min-width:0;">
          <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
            <span style="font-size:14px; font-weight:600;"><?= $ev['title'] ?></span>
            <?php if (!empty($ev['urgent'])): ?>
            <span class="badge badge-red">Urgente</span>
            <?php endif; ?>
          </div>
          <span style="font-size:12px; color:var(--text-muted);"><?= $ev['subject'] ?> · <?= $ev['time'] ?></span>
        </div>
        <div style="width:10px; height:10px; border-radius:50%; background:<?= $ev['color'] ?>; flex-shrink:0; margin-top:4px;"></div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</div>
</div>

<script>
function setView(view, btn) {
  document.getElementById('view-month').style.display  = view === 'month' ? '' : 'none';
  document.getElementById('view-agenda').style.display = view === 'agenda' ? '' : 'none';
  document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}
</script>

<?php include 'includes/footer.php'; ?>
