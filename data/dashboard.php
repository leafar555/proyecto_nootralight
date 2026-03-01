<?php
// ─── Mock data: Dashboard ───────────────────────────────────────────────────

$stats = [
  ['icon' => 'fa-book',        'value' => '6',   'label' => 'Cuadernos',      'change' => '+1 esta semana',  'color' => '#a78bfa', 'bg' => 'rgba(124,58,237,0.15)'],
  ['icon' => 'fa-file-lines',  'value' => '109', 'label' => 'Notas',          'change' => '+8 esta semana',  'color' => '#60a5fa', 'bg' => 'rgba(59,130,246,0.15)'],
  ['icon' => 'fa-check-square','value' => '5/8', 'label' => 'Tareas',         'change' => '3 pendientes',    'color' => '#34d399', 'bg' => 'rgba(16,185,129,0.15)'],
  ['icon' => 'fa-fire',        'value' => '12',  'label' => 'Días de racha',  'change' => 'Récord personal', 'color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.15)'],
];

$recentNotes = [
  ['title' => 'Integración por partes', 'notebook' => 'Cálculo II',   'color' => '#a78bfa', 'updated' => 'hace 2h'],
  ['title' => 'Leyes de Newton',        'notebook' => 'Física',       'color' => '#60a5fa', 'updated' => 'ayer'],
  ['title' => 'Alcanos y alquenos',     'notebook' => 'Química Org.', 'color' => '#f472b6', 'updated' => 'hace 2 días'],
  ['title' => 'Distribución normal',    'notebook' => 'Estadística',  'color' => '#34d399', 'updated' => 'hace 3 días'],
];

$pendingTasks = [
  ['name' => 'Tarea Estadística 3.1–3.5', 'subject' => 'Estadística', 'due' => 'Mañana',    'dueColor' => '#fbbf24', 'priority' => 'media'],
  ['name' => 'Parcial Química Orgánica',  'subject' => 'Química',     'due' => '¡Urgente!', 'dueColor' => '#f87171', 'priority' => 'urgente'],
  ['name' => 'Reporte Prog. Web',         'subject' => 'Prog. Web',   'due' => '3 días',    'dueColor' => '#94a3b8', 'priority' => 'media'],
];

$weekActivity = [40, 70, 55, 85, 65, 30, 20];
$weekDays     = ['L', 'M', 'M', 'J', 'V', 'S', 'D'];

$badges = ['🔥 Racha 12d', '📚 100 notas', '⚡ 5 materias', '🏆 Semana perfecta'];
