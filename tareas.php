<?php
$pageTitle = 'Tareas';
require 'data/tareas.php';
?>
<?php include 'includes/head.php'; ?>

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
