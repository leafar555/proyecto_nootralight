<?php
$pageTitle = 'Dashboard';
require 'data/dashboard.php';
?>
<?php include 'includes/head.php'; ?>
<div class="app-layout">
<?php include 'includes/sidebar.php'; ?>

<div class="main">
  <!-- Topbar -->
  <div class="topbar">
    <div>
      <button class="mobile-toggle"><i class="fa-solid fa-bars"></i></button>
      <div class="topbar-title">Buenos días, Mario <span style="font-size:16px;">👋</span></div>
      <div class="topbar-sub">Viernes, 27 de febrero 2026 · Racha de 12 días <span style="color:#f59e0b;">🔥</span></div>
    </div>
    <div class="topbar-actions">
      <a href="notas.php" class="btn btn-ghost btn-sm"><i class="fa-solid fa-plus"></i> Nueva nota</a>
      <button class="btn btn-primary btn-sm"><i class="fa-solid fa-robot"></i> Preguntar a IA</button>
    </div>
  </div>

  <div class="page-content">

    <!-- Stats -->
    <div class="grid-4" style="margin-bottom:24px;">
      <?php foreach ($stats as $s): ?>
      <div class="card stat-card">
        <div class="stat-icon" style="background:<?= $s['bg'] ?>; color:<?= $s['color'] ?>;">
          <i class="fa-solid <?= $s['icon'] ?>"></i>
        </div>
        <div class="stat-value"><?= $s['value'] ?></div>
        <div class="stat-label"><?= $s['label'] ?></div>
        <div class="stat-change" style="color:<?= $s['color'] ?>;"><?= $s['change'] ?></div>
      </div>
      <?php endforeach; ?>
    </div>

    <div style="display:grid; grid-template-columns:1fr 340px; gap:20px;">

      <div style="display:flex; flex-direction:column; gap:20px;">

        <!-- Activity chart -->
        <div class="card card-pad">
          <div class="section-header">
            <div class="section-title"><i class="fa-solid fa-chart-bar" style="color:#a78bfa; margin-right:6px;"></i> Actividad semanal</div>
            <span class="section-link">Esta semana</span>
          </div>
          <div style="display:flex; align-items:flex-end; gap:8px; height:120px; padding-top:12px;">
            <?php foreach ($weekActivity as $i => $h): ?>
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; gap:6px; height:100%;">
              <div style="flex:1; width:100%; display:flex; align-items:flex-end;">
                <div style="width:100%; height:<?= $h ?>%; background:<?= $i === 4 ? 'var(--accent-grad)' : 'rgba(124,58,237,0.2)' ?>; border-radius:5px 5px 0 0; transition:var(--transition);" title="<?= $h ?> min"></div>
              </div>
              <span style="font-size:10px; color:var(--text-muted);"><?= $weekDays[$i] ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Recent notes -->
        <div class="card card-pad">
          <div class="section-header">
            <div class="section-title"><i class="fa-solid fa-file-lines" style="color:#60a5fa; margin-right:6px;"></i> Notas recientes</div>
            <a href="notas.php" class="section-link">Ver todas</a>
          </div>
          <div style="display:flex; flex-direction:column; gap:0;">
            <?php foreach ($recentNotes as $i => $note): ?>
            <a href="notas.php" style="display:flex; align-items:center; gap:12px; padding:12px 0; <?= $i < count($recentNotes)-1 ? 'border-bottom:1px solid var(--border);' : '' ?>">
              <div style="width:6px; height:36px; border-radius:3px; background:<?= $note['color'] ?>; flex-shrink:0;"></div>
              <div style="flex:1; min-width:0;">
                <div style="font-size:13px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?= $note['title'] ?></div>
                <div style="font-size:11px; color:var(--text-muted); margin-top:2px;"><?= $note['notebook'] ?></div>
              </div>
              <span style="font-size:11px; color:var(--text-muted); flex-shrink:0;"><?= $note['updated'] ?></span>
            </a>
            <?php endforeach; ?>
          </div>
        </div>

      </div>

      <!-- Right col -->
      <div style="display:flex; flex-direction:column; gap:20px;">

        <!-- Gamification -->
        <div class="card card-pad" style="background:linear-gradient(135deg, rgba(124,58,237,0.08), rgba(236,72,153,0.08)); border-color:rgba(124,58,237,0.2);">
          <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
            <div style="width:48px; height:48px; background:var(--accent-grad); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:22px; font-weight:900; color:#fff;">7</div>
            <div>
              <div style="font-size:13px; font-weight:700;">Nivel 7 — Estudioso</div>
              <div style="font-size:11px; color:var(--text-muted);">1,240 / 2,000 XP</div>
            </div>
          </div>
          <div class="progress-bar" style="margin-bottom:16px;">
            <div class="progress-fill" data-xp="62" style="width:0%;"></div>
          </div>
          <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <?php
            $badges = ['🔥 Racha 12d', '📚 100 notas', '⚡ 5 materias', '🏆 Semana perfecta'];
            foreach ($badges as $b): ?>
            <span class="badge badge-purple"><?= $b ?></span>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Pending tasks -->
        <div class="card card-pad">
          <div class="section-header">
            <div class="section-title"><i class="fa-solid fa-clock" style="color:#fbbf24; margin-right:6px;"></i> Tareas urgentes</div>
            <a href="tareas.php" class="section-link">Ver todas</a>
          </div>
          <div style="display:flex; flex-direction:column; gap:10px;">
            <?php foreach ($pendingTasks as $t): ?>
            <div style="display:flex; align-items:center; gap:10px; padding:10px; background:var(--bg-tertiary); border-radius:8px;">
              <div style="width:8px; height:8px; border-radius:50%; background:<?= $t['dueColor'] ?>; flex-shrink:0;"></div>
              <div style="flex:1; min-width:0;">
                <div style="font-size:12px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?= $t['name'] ?></div>
                <div style="font-size:10px; color:var(--text-muted);"><?= $t['subject'] ?></div>
              </div>
              <span style="font-size:10px; font-weight:700; color:<?= $t['dueColor'] ?>; flex-shrink:0;"><?= $t['due'] ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Mini calendar -->
        <div class="card card-pad">
          <div class="section-header">
            <div class="section-title"><i class="fa-solid fa-calendar" style="color:#34d399; margin-right:6px;"></i> Febrero 2026</div>
            <a href="calendario.php" class="section-link">Ver más</a>
          </div>
          <?php
          $days = ['L','M','M','J','V','S','D'];
          $calDays = array_merge(array_fill(0, 6, null), range(1, 28));
          $today = 27;
          $eventDays = [3, 7, 12, 15, 20, 24, 27, 28];
          ?>
          <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:3px;">
            <?php foreach ($days as $d): ?>
            <div style="text-align:center; font-size:9px; font-weight:700; color:var(--text-muted); padding:4px 0; text-transform:uppercase;"><?= $d ?></div>
            <?php endforeach; ?>
            <?php foreach ($calDays as $d): ?>
            <div style="text-align:center; padding:4px; border-radius:5px;
              <?php if ($d === $today): ?>background:var(--accent-grad); font-weight:700; color:#fff;
              <?php elseif (in_array($d, $eventDays) && $d): ?>color:#a78bfa; font-weight:600;
              <?php else: ?>color:var(--text-muted);<?php endif; ?>
              font-size:11px;">
              <?= $d ?? '' ?>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>

  </div><!-- /page-content -->
</div><!-- /main -->
</div><!-- /app-layout -->

<?php include 'includes/footer.php'; ?>
