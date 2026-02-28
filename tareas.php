<?php
$pageTitle = 'Tareas';

$tasks = [
  ['id'=>1,'name'=>'Revisar apuntes de Cálculo II',       'subject'=>'Cálculo II',  'subjectColor'=>'#a78bfa','due'=>'Hoy',       'dueColor'=>'#34d399','status'=>'pending', 'priority'=>'high'],
  ['id'=>2,'name'=>'Laboratorio de Física — informe final','subject'=>'Física',      'subjectColor'=>'#60a5fa','due'=>'Entregado',  'dueColor'=>'#34d399','status'=>'done',    'priority'=>'medium'],
  ['id'=>3,'name'=>'Tarea Estadística 3.1–3.5',           'subject'=>'Estadística',  'subjectColor'=>'#34d399','due'=>'Mañana',    'dueColor'=>'#fbbf24','status'=>'pending', 'priority'=>'medium'],
  ['id'=>4,'name'=>'Parcial Química Orgánica — caps. 5-8','subject'=>'Química',      'subjectColor'=>'#f472b6','due'=>'¡Urgente!',  'dueColor'=>'#f87171','status'=>'pending', 'priority'=>'urgent'],
  ['id'=>5,'name'=>'Reporte de Programación Web',         'subject'=>'Prog. Web',    'subjectColor'=>'#f87171','due'=>'3 días',    'dueColor'=>'#fbbf24','status'=>'pending', 'priority'=>'medium'],
  ['id'=>6,'name'=>'Exposición Historia — preparar slides','subject'=>'Historia',    'subjectColor'=>'#fbbf24','due'=>'Vencida',   'dueColor'=>'#f87171','status'=>'overdue', 'priority'=>'urgent'],
  ['id'=>7,'name'=>'Resumen de derivadas parciales',      'subject'=>'Cálculo II',   'subjectColor'=>'#a78bfa','due'=>'Completado','dueColor'=>'#34d399','status'=>'done',    'priority'=>'low'],
  ['id'=>8,'name'=>'Quiz de Física — repasar ondas',      'subject'=>'Física',       'subjectColor'=>'#60a5fa','due'=>'5 días',    'dueColor'=>'#94a3b8','status'=>'pending', 'priority'=>'low'],
];

$stats = [
  ['label'=>'Total',      'value'=> count($tasks),                                  'color'=>'#a78bfa','bg'=>'rgba(124,58,237,0.15)'],
  ['label'=>'Pendientes', 'value'=> count(array_filter($tasks, fn($t) => $t['status']==='pending')),  'color'=>'#fbbf24','bg'=>'rgba(245,158,11,0.15)'],
  ['label'=>'Completadas','value'=> count(array_filter($tasks, fn($t) => $t['status']==='done')),     'color'=>'#34d399','bg'=>'rgba(16,185,129,0.15)'],
  ['label'=>'Vencidas',   'value'=> count(array_filter($tasks, fn($t) => $t['status']==='overdue')),  'color'=>'#f87171','bg'=>'rgba(239,68,68,0.15)'],
];

$bySubject = [
  ['name'=>'Cálculo II',  'count'=>2,'done'=>1,'color'=>'#a78bfa'],
  ['name'=>'Física',      'count'=>2,'done'=>1,'color'=>'#60a5fa'],
  ['name'=>'Química',     'count'=>1,'done'=>0,'color'=>'#f472b6'],
  ['name'=>'Estadística', 'count'=>1,'done'=>0,'color'=>'#34d399'],
  ['name'=>'Historia',    'count'=>1,'done'=>0,'color'=>'#fbbf24'],
  ['name'=>'Prog. Web',   'count'=>1,'done'=>0,'color'=>'#f87171'],
];
?>
<?php include 'includes/head.php'; ?>
<style>
  .tasks-layout { display: grid; grid-template-columns: 1fr 260px; gap: 20px; }

  .task-section-title {
    display: flex; align-items: center; gap: 8px;
    font-size: 11px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1px; margin-bottom: 12px;
  }

  .task-list { background: var(--bg-secondary); border: 1px solid var(--border); border-radius: var(--radius-card); overflow: hidden; margin-bottom: 20px; }

  .task-row {
    display: flex; align-items: center; gap: 12px;
    padding: 13px 18px;
    border-bottom: 1px solid var(--border);
    transition: var(--transition);
  }
  .task-row:last-child { border-bottom: none; }
  .task-row:hover { background: rgba(255,255,255,0.02); }
  .task-row.done .task-name { text-decoration: line-through; color: var(--text-muted); }

  .task-check {
    width: 18px; height: 18px; border-radius: 5px;
    border: 2px solid var(--border);
    background: transparent;
    cursor: pointer; flex-shrink: 0;
    appearance: none; -webkit-appearance: none;
    transition: var(--transition);
    position: relative;
  }
  .task-check:checked { background: var(--success); border-color: var(--success); }
  .task-check:checked::after {
    content: '✓'; position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 11px; font-weight: 700;
  }

  .task-name { font-size: 13px; font-weight: 500; flex: 1; min-width: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .task-subject { font-size: 11px; font-weight: 600; display: block; margin-top: 1px; }
  .task-due { font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 5px; flex-shrink: 0; }

  .right-sidebar { display: flex; flex-direction: column; gap: 20px; }
  .right-section-title { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-muted); margin-bottom: 12px; }

  @media (max-width: 900px) { .tasks-layout { grid-template-columns: 1fr; } }
</style>

<div class="app-layout">
<?php include 'includes/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div>
      <button class="mobile-toggle"><i class="fa-solid fa-bars"></i></button>
      <div class="topbar-title">Tareas</div>
    </div>
    <div class="topbar-actions">
      <button class="btn btn-ghost btn-sm"><i class="fa-solid fa-filter"></i> Filtrar</button>
      <button class="btn btn-primary btn-sm" onclick="showToast('Tarea creada')">
        <i class="fa-solid fa-plus"></i> Nueva tarea
      </button>
    </div>
  </div>

  <div class="page-content">

    <!-- Stats -->
    <div class="grid-4" style="margin-bottom:20px;">
      <?php foreach ($stats as $s): ?>
      <div class="card" style="padding:16px; display:flex; align-items:center; gap:12px;">
        <div style="width:40px; height:40px; border-radius:10px; background:<?= $s['bg'] ?>; color:<?= $s['color'] ?>; display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:800; flex-shrink:0;">
          <?= $s['value'] ?>
        </div>
        <span style="font-size:12px; font-weight:500; color:var(--text-secondary);"><?= $s['label'] ?></span>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Filter chips -->
    <div class="filter-chips">
      <button class="chip active" data-filter="all">Todas</button>
      <button class="chip" data-filter="pending">Pendientes</button>
      <button class="chip" data-filter="done">Completadas</button>
      <button class="chip" data-filter="overdue">Vencidas</button>
    </div>

    <div class="tasks-layout">
      <!-- Task lists -->
      <div>
        <?php
        $sections = [
          'overdue' => ['icon'=>'fa-circle-exclamation','color'=>'#f87171','label'=>'Vencidas'],
          'pending' => ['icon'=>'fa-clock','color'=>'#fbbf24','label'=>'Pendientes'],
          'done'    => ['icon'=>'fa-circle-check','color'=>'#34d399','label'=>'Completadas'],
        ];
        foreach ($sections as $status => $section):
          $sectionTasks = array_filter($tasks, fn($t) => $t['status'] === $status);
          if (empty($sectionTasks)) continue;
        ?>
        <div class="task-section-title">
          <i class="fa-solid <?= $section['icon'] ?>" style="color:<?= $section['color'] ?>;"></i>
          <span style="color:<?= $section['color'] ?>;"><?= $section['label'] ?></span>
          <span style="color:var(--text-muted); font-weight:400;">(<?= count($sectionTasks) ?>)</span>
        </div>
        <div class="task-list">
          <?php foreach ($sectionTasks as $t): ?>
          <div class="task-row <?= $t['status'] === 'done' ? 'done' : '' ?>" data-status="<?= $t['status'] ?>">
            <input type="checkbox" class="task-check" <?= $t['status'] === 'done' ? 'checked' : '' ?>>
            <div style="flex:1; min-width:0;">
              <div class="task-name"><?= $t['name'] ?></div>
              <span class="task-subject" style="color:<?= $t['subjectColor'] ?>;"><?= $t['subject'] ?></span>
            </div>
            <?php if ($t['priority'] === 'urgent' && $t['status'] !== 'done'): ?>
            <span class="badge badge-red">Urgente</span>
            <?php endif; ?>
            <span class="task-due" style="color:<?= $t['dueColor'] ?>; background:<?= $t['dueColor'] ?>18;">
              <?= $t['due'] ?>
            </span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Right sidebar -->
      <div class="right-sidebar">
        <!-- By subject -->
        <div class="card card-pad">
          <div class="right-section-title">Por materia</div>
          <?php foreach ($bySubject as $s): ?>
          <div style="margin-bottom:14px;">
            <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
              <div style="display:flex; align-items:center; gap:6px;">
                <span style="width:7px; height:7px; border-radius:50%; background:<?= $s['color'] ?>; display:inline-block;"></span>
                <span style="font-size:12px; color:var(--text-secondary);"><?= $s['name'] ?></span>
              </div>
              <span style="font-size:11px; color:var(--text-muted);"><?= $s['done'] ?>/<?= $s['count'] ?></span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill" style="width:<?= $s['count'] > 0 ? ($s['done']/$s['count']*100) : 0 ?>%; background:<?= $s['color'] ?>;"></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Weekly chart -->
        <div class="card card-pad">
          <div class="right-section-title">Progreso semanal</div>
          <?php $bars = [40,70,55,85,65,30,20]; $days=['L','M','M','J','V','S','D']; ?>
          <div style="display:flex; align-items:flex-end; gap:6px; height:80px;">
            <?php foreach ($bars as $i => $h): ?>
            <div style="flex:1; height:100%; display:flex; flex-direction:column; align-items:center; justify-content:flex-end; gap:4px;">
              <div style="width:100%; height:<?= $h ?>%; background:<?= $i===4 ? 'var(--accent-grad)' : 'rgba(124,58,237,0.2)' ?>; border-radius:4px 4px 0 0;"></div>
              <span style="font-size:9px; color:var(--text-muted);"><?= $days[$i] ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Upcoming -->
        <div class="card card-pad">
          <div class="right-section-title">Próximas entregas</div>
          <?php
          $upcoming = array_filter($tasks, fn($t) => $t['status']==='pending');
          foreach (array_slice($upcoming, 0, 3) as $t): ?>
          <div style="display:flex; align-items:flex-start; gap:8px; margin-bottom:10px;">
            <span style="width:6px; height:6px; border-radius:50%; background:<?= $t['subjectColor'] ?>; flex-shrink:0; margin-top:4px;"></span>
            <div>
              <div style="font-size:11px; font-weight:600; color:var(--text-primary);"><?= $t['name'] ?></div>
              <div style="font-size:10px; color:var(--text-muted);"><?= $t['due'] ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<?php include 'includes/footer.php'; ?>
