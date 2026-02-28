<?php
$pageTitle = 'Calendario';

$events = [
  ['day' => 3,  'title' => 'Entrega Lab. Física',      'subject' => 'Física',     'color' => '#a78bfa', 'time' => '09:00'],
  ['day' => 7,  'title' => 'Parcial Cálculo II',        'subject' => 'Cálculo II', 'color' => '#f472b6', 'time' => '11:00', 'urgent' => true],
  ['day' => 12, 'title' => 'Tarea Estadística 3.1-3.5', 'subject' => 'Estadística','color' => '#fbbf24', 'time' => '23:59'],
  ['day' => 15, 'title' => 'Exposición Historia',       'subject' => 'Historia',   'color' => '#34d399', 'time' => '10:00'],
  ['day' => 20, 'title' => 'Entrega Prog. Web',         'subject' => 'Prog. Web',  'color' => '#60a5fa', 'time' => '18:00'],
  ['day' => 24, 'title' => 'Quiz Química Orgánica',     'subject' => 'Química',    'color' => '#f87171', 'time' => '08:30', 'urgent' => true],
  ['day' => 27, 'title' => 'Revisión de proyectos',     'subject' => 'Prog. Web',  'color' => '#60a5fa', 'time' => '14:00'],
  ['day' => 28, 'title' => 'Fin de semestre',           'subject' => 'General',    'color' => '#7c3aed', 'time' => 'Todo el día'],
];

// Organizar eventos por día
$eventsByDay = [];
foreach ($events as $ev) {
  $eventsByDay[$ev['day']][] = $ev;
}

$calDays = array_merge(array_fill(0, 6, null), range(1, 28));
$today = 27;
$weekDays = ['L','M','M','J','V','S','D'];
?>
<?php include 'includes/head.php'; ?>
<style>
  .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); }
  .cal-header-day {
    padding: 10px; text-align: center;
    font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--text-muted);
    border-bottom: 1px solid var(--border);
  }
  .cal-cell {
    min-height: 100px; padding: 6px;
    border-right: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
  }
  .cal-cell:nth-child(7n) { border-right: none; }
  .cal-day-num {
    width: 26px; height: 26px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 600;
    margin-bottom: 4px; color: var(--text-muted);
  }
  .cal-day-num.today { background: var(--accent-grad); color: #fff; font-weight: 700; }
  .cal-event {
    padding: 2px 6px; border-radius: 4px;
    font-size: 10px; font-weight: 600;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    margin-bottom: 2px;
  }
  .cal-more { font-size: 10px; color: var(--text-muted); padding: 0 4px; }

  .view-toggle { display: flex; border-radius: 8px; overflow: hidden; border: 1px solid var(--border); }
  .view-btn { padding: 6px 14px; font-size: 11px; font-weight: 600; color: var(--text-muted); background: var(--bg-tertiary); transition: var(--transition); }
  .view-btn.active { background: var(--accent-grad); color: #fff; }
  .view-btn:hover:not(.active) { color: var(--text-primary); }

  .agenda-item {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 10px;
  }
  .agenda-date {
    width: 48px; height: 48px;
    border-radius: 12px;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .agenda-month { font-size: 9px; font-weight: 700; text-transform: uppercase; }
  .agenda-day { font-size: 20px; font-weight: 900; line-height: 1; }
</style>

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
