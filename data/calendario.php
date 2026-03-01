<?php
// ─── Mock data: Calendario ───────────────────────────────────────────────────

$events = [
  ['day'=> 3,'title'=>'Entrega Lab. Física',       'subject'=>'Física',     'color'=>'#a78bfa','time'=>'09:00'],
  ['day'=> 7,'title'=>'Parcial Cálculo II',         'subject'=>'Cálculo II', 'color'=>'#f472b6','time'=>'11:00','urgent'=>true],
  ['day'=>12,'title'=>'Tarea Estadística 3.1-3.5',  'subject'=>'Estadística','color'=>'#fbbf24','time'=>'23:59'],
  ['day'=>15,'title'=>'Exposición Historia',        'subject'=>'Historia',   'color'=>'#34d399','time'=>'10:00'],
  ['day'=>20,'title'=>'Entrega Prog. Web',          'subject'=>'Prog. Web',  'color'=>'#60a5fa','time'=>'18:00'],
  ['day'=>24,'title'=>'Quiz Química Orgánica',      'subject'=>'Química',    'color'=>'#f87171','time'=>'08:30','urgent'=>true],
  ['day'=>27,'title'=>'Revisión de proyectos',      'subject'=>'Prog. Web',  'color'=>'#60a5fa','time'=>'14:00'],
  ['day'=>28,'title'=>'Fin de semestre',            'subject'=>'General',    'color'=>'#7c3aed','time'=>'Todo el día'],
];

// Indexar eventos por día para el grid mensual
$eventsByDay = [];
foreach ($events as $ev) {
  $eventsByDay[$ev['day']][] = $ev;
}

$calDays  = array_merge(array_fill(0, 6, null), range(1, 28));
$today    = 27;
$weekDays = ['L','M','M','J','V','S','D'];
