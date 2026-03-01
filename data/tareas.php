<?php
// ─── Mock data: Tareas ───────────────────────────────────────────────────────

$tasks = [
  ['id'=>1,'name'=>'Revisar apuntes de Cálculo II',        'subject'=>'Cálculo II', 'subjectColor'=>'#a78bfa','due'=>'Hoy',        'dueColor'=>'#34d399','status'=>'pending', 'priority'=>'high'],
  ['id'=>2,'name'=>'Laboratorio de Física — informe final','subject'=>'Física',     'subjectColor'=>'#60a5fa','due'=>'Entregado',  'dueColor'=>'#34d399','status'=>'done',    'priority'=>'medium'],
  ['id'=>3,'name'=>'Tarea Estadística 3.1–3.5',            'subject'=>'Estadística','subjectColor'=>'#34d399','due'=>'Mañana',     'dueColor'=>'#fbbf24','status'=>'pending', 'priority'=>'medium'],
  ['id'=>4,'name'=>'Parcial Química Orgánica — caps. 5-8', 'subject'=>'Química',   'subjectColor'=>'#f472b6','due'=>'¡Urgente!',  'dueColor'=>'#f87171','status'=>'pending', 'priority'=>'urgent'],
  ['id'=>5,'name'=>'Reporte de Programación Web',          'subject'=>'Prog. Web', 'subjectColor'=>'#f87171','due'=>'3 días',     'dueColor'=>'#fbbf24','status'=>'pending', 'priority'=>'medium'],
  ['id'=>6,'name'=>'Exposición Historia — preparar slides','subject'=>'Historia',  'subjectColor'=>'#fbbf24','due'=>'Vencida',    'dueColor'=>'#f87171','status'=>'overdue', 'priority'=>'urgent'],
  ['id'=>7,'name'=>'Resumen de derivadas parciales',       'subject'=>'Cálculo II','subjectColor'=>'#a78bfa','due'=>'Completado', 'dueColor'=>'#34d399','status'=>'done',    'priority'=>'low'],
  ['id'=>8,'name'=>'Quiz de Física — repasar ondas',       'subject'=>'Física',    'subjectColor'=>'#60a5fa','due'=>'5 días',     'dueColor'=>'#94a3b8','status'=>'pending', 'priority'=>'low'],
];

$stats = [
  ['label'=>'Total',      'value'=> count($tasks),                                                           'color'=>'#a78bfa','bg'=>'rgba(124,58,237,0.15)'],
  ['label'=>'Pendientes', 'value'=> count(array_filter($tasks, fn($t) => $t['status']==='pending')),         'color'=>'#fbbf24','bg'=>'rgba(245,158,11,0.15)'],
  ['label'=>'Completadas','value'=> count(array_filter($tasks, fn($t) => $t['status']==='done')),            'color'=>'#34d399','bg'=>'rgba(16,185,129,0.15)'],
  ['label'=>'Vencidas',   'value'=> count(array_filter($tasks, fn($t) => $t['status']==='overdue')),         'color'=>'#f87171','bg'=>'rgba(239,68,68,0.15)'],
];

$bySubject = [
  ['name'=>'Cálculo II',  'count'=>2,'done'=>1,'color'=>'#a78bfa'],
  ['name'=>'Física',      'count'=>2,'done'=>1,'color'=>'#60a5fa'],
  ['name'=>'Química',     'count'=>1,'done'=>0,'color'=>'#f472b6'],
  ['name'=>'Estadística', 'count'=>1,'done'=>0,'color'=>'#34d399'],
  ['name'=>'Historia',    'count'=>1,'done'=>0,'color'=>'#fbbf24'],
  ['name'=>'Prog. Web',   'count'=>1,'done'=>0,'color'=>'#f87171'],
];
