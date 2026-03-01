<?php
// ─── Mock data: Notas ────────────────────────────────────────────────────────

$notes = [
  ['id'=>1,'title'=>'Integración por partes',       'notebook'=>'Cálculo II',     'color'=>'#a78bfa','updated'=>'hace 2h',    'words'=>340,'tags'=>['integración','fórmula']],
  ['id'=>2,'title'=>'Leyes de Newton — resumen',    'notebook'=>'Física',          'color'=>'#60a5fa','updated'=>'ayer',        'words'=>215,'tags'=>['newton','mecánica']],
  ['id'=>3,'title'=>'Alcanos, alquenos, alquinos',  'notebook'=>'Química Org.',    'color'=>'#f472b6','updated'=>'hace 2 días', 'words'=>412,'tags'=>['hidrocarburos']],
  ['id'=>4,'title'=>'Distribución normal y Z-score','notebook'=>'Estadística',     'color'=>'#34d399','updated'=>'hace 3 días', 'words'=>188,'tags'=>['probabilidad']],
  ['id'=>5,'title'=>'Primera y Segunda Guerra Mun.','notebook'=>'Historia',        'color'=>'#fbbf24','updated'=>'hace 5 días', 'words'=>560,'tags'=>['historia']],
  ['id'=>6,'title'=>'Componentes en React.js',      'notebook'=>'Programación Web','color'=>'#f87171','updated'=>'hace 1h',    'words'=>290,'tags'=>['react','frontend']],
];

$selected = $notes[0]; // nota activa por defecto

$related = [
  ['title'=>'Sustitución trigonométrica','color'=>'#a78bfa'],
  ['title'=>'Integrales impropias',      'color'=>'#c084fc'],
  ['title'=>'Series de Taylor',          'color'=>'#7c3aed'],
];
