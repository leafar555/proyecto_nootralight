<?php
$pageTitle = 'Notas';

$notes = [
  ['id'=>1,'title'=>'Integración por partes',      'notebook'=>'Cálculo II',    'color'=>'#a78bfa','updated'=>'hace 2h',    'words'=>340,'tags'=>['integración','fórmula']],
  ['id'=>2,'title'=>'Leyes de Newton — resumen',   'notebook'=>'Física',         'color'=>'#60a5fa','updated'=>'ayer',        'words'=>215,'tags'=>['newton','mecánica']],
  ['id'=>3,'title'=>'Alcanos, alquenos, alquinos', 'notebook'=>'Química Org.',   'color'=>'#f472b6','updated'=>'hace 2 días', 'words'=>412,'tags'=>['hidrocarburos']],
  ['id'=>4,'title'=>'Distribución normal y Z-score','notebook'=>'Estadística',   'color'=>'#34d399','updated'=>'hace 3 días', 'words'=>188,'tags'=>['probabilidad']],
  ['id'=>5,'title'=>'Primera y Segunda Guerra Mun.','notebook'=>'Historia',       'color'=>'#fbbf24','updated'=>'hace 5 días', 'words'=>560,'tags'=>['historia']],
  ['id'=>6,'title'=>'Componentes en React.js',     'notebook'=>'Programación Web','color'=>'#f87171','updated'=>'hace 1h',   'words'=>290,'tags'=>['react','frontend']],
];

$selected = $notes[0]; // default

$related = [
  ['title'=>'Sustitución trigonométrica','color'=>'#a78bfa'],
  ['title'=>'Integrales impropias',      'color'=>'#c084fc'],
  ['title'=>'Series de Taylor',          'color'=>'#7c3aed'],
];
?>
<?php include 'includes/head.php'; ?>
<style>
  .notes-layout { display: flex; height: calc(100vh - var(--topbar-h)); overflow: hidden; }

  /* Notes list panel */
  .notes-list-panel {
    width: 250px; flex-shrink: 0;
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    overflow: hidden;
  }
  .notes-search {
    padding: 12px;
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
  }
  .notes-search-input {
    width: 100%; display: flex; align-items: center; gap: 8px;
    padding: 7px 10px;
    background: var(--bg-tertiary); border: 1px solid var(--border);
    border-radius: var(--radius-input);
  }
  .notes-search-input input {
    flex: 1; background: none; border: none; outline: none;
    color: var(--text-primary); font-size: 11px; font-family: inherit;
  }
  .notes-list { flex: 1; overflow-y: auto; padding: 8px; }
  .note-list-item {
    padding: 10px 8px;
    border-radius: 8px; border: 2px solid transparent;
    margin-bottom: 2px; cursor: pointer;
    transition: var(--transition); text-decoration: none; color: inherit;
    display: block;
  }
  .note-list-item:hover { background: rgba(255,255,255,0.03); }
  .note-list-item.active { background: rgba(124,58,237,0.1); }
  .note-item-nb { display: flex; align-items: center; gap: 5px; margin-bottom: 3px; }
  .note-item-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
  .note-item-nb-name { font-size: 10px; color: var(--text-muted); font-weight: 500; }
  .note-item-title { font-size: 12px; font-weight: 600; margin-bottom: 4px; }
  .note-item-meta { display: flex; justify-content: space-between; font-size: 10px; color: var(--text-muted); }

  /* Editor panel */
  .editor-panel { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
  .editor-toolbar {
    height: 42px; padding: 0 20px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 2px;
    flex-shrink: 0;
  }
  .toolbar-btn {
    width: 28px; height: 28px; border-radius: 5px;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted); font-size: 12px;
    transition: var(--transition); cursor: pointer;
  }
  .toolbar-btn:hover { background: rgba(255,255,255,0.06); color: var(--text-primary); }
  .toolbar-sep { width: 1px; height: 16px; background: var(--border); margin: 0 6px; }
  .toolbar-ai {
    display: flex; align-items: center; gap: 5px;
    padding: 4px 10px; border-radius: 5px;
    font-size: 11px; font-weight: 600; color: #a78bfa;
    cursor: pointer; transition: var(--transition);
  }
  .toolbar-ai:hover { background: rgba(124,58,237,0.1); }

  .editor-body { flex: 1; overflow-y: auto; padding: 32px 36px; }
  .note-title-display { font-size: 24px; font-weight: 800; margin-bottom: 8px; }
  .note-meta-row { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; font-size: 11px; color: var(--text-muted); }
  .note-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 24px; }

  .note-content { font-size: 14px; line-height: 1.8; color: var(--text-secondary); max-width: 640px; }
  .note-content h3 { font-size: 16px; font-weight: 700; color: var(--text-primary); margin: 24px 0 12px; padding-top: 20px; border-top: 1px solid var(--border); }
  .note-content p { margin-bottom: 14px; }
  .note-content .code-block {
    background: var(--bg-tertiary); border: 1px solid var(--border);
    border-radius: 10px; padding: 16px; font-size: 16px;
    color: #a78bfa; font-family: monospace; margin-bottom: 14px;
  }
  .note-content ul { padding-left: 4px; margin-bottom: 14px; }
  .note-content ul li { display: flex; gap: 8px; margin-bottom: 6px; }
  .note-content ul li::before { content: '→'; color: var(--accent-purple); font-weight: 700; flex-shrink: 0; }
  .note-content strong { color: var(--text-primary); }

  /* Meta sidebar */
  .meta-panel {
    width: 210px; flex-shrink: 0;
    border-left: 1px solid var(--border);
    padding: 20px 16px; overflow-y: auto;
    display: flex; flex-direction: column; gap: 20px;
  }
  .meta-section-title { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-muted); margin-bottom: 10px; }
  .meta-row { display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 8px; }
  .meta-key { color: var(--text-muted); }
  .meta-val { color: var(--text-secondary); font-weight: 500; }

  .btn-ai-full {
    width: 100%; padding: 10px; border-radius: 10px;
    background: linear-gradient(135deg, rgba(124,58,237,0.15), rgba(236,72,153,0.15));
    border: 1px solid rgba(124,58,237,0.25);
    color: #a78bfa; font-size: 12px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    cursor: pointer; transition: var(--transition);
  }
  .btn-ai-full:hover { background: linear-gradient(135deg, rgba(124,58,237,0.25), rgba(236,72,153,0.25)); }
</style>

<div class="app-layout">
<?php include 'includes/sidebar.php'; ?>

<div class="main">
  <!-- Topbar (breadcrumb style) -->
  <div class="topbar">
    <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--text-muted);">
      <button class="mobile-toggle"><i class="fa-solid fa-bars"></i></button>
      <i class="fa-solid fa-file-lines" style="color:var(--accent-purple);"></i>
      <a href="cuadernos.php" style="color:var(--text-muted); transition:var(--transition);" onmouseover="this.style.color='#f1f5f9'" onmouseout="this.style.color='var(--text-muted)'">
        <?= $selected['notebook'] ?>
      </a>
      <i class="fa-solid fa-chevron-right" style="font-size:10px;"></i>
      <span style="color:var(--text-primary); font-weight:600;"><?= $selected['title'] ?></span>
    </div>
    <div class="topbar-actions">
      <button class="btn btn-primary btn-sm" onclick="showToast('Nota creada')">
        <i class="fa-solid fa-plus"></i> Nueva nota
      </button>
    </div>
  </div>

  <div class="notes-layout">

    <!-- Notes list -->
    <div class="notes-list-panel">
      <div class="notes-search">
        <div class="notes-search-input">
          <i class="fa-solid fa-search" style="color:var(--text-muted); font-size:11px;"></i>
          <input type="text" placeholder="Buscar notas...">
        </div>
      </div>
      <div class="notes-list">
        <?php foreach ($notes as $i => $note): ?>
        <a href="notas.php?id=<?= $note['id'] ?>" class="note-list-item <?= $i === 0 ? 'active' : '' ?>"
           style="<?= $i===0 ? 'border-left-color:'.$note['color'] : '' ?>">
          <div class="note-item-nb">
            <span class="note-item-dot" style="background:<?= $note['color'] ?>;"></span>
            <span class="note-item-nb-name"><?= $note['notebook'] ?></span>
          </div>
          <div class="note-item-title"><?= $note['title'] ?></div>
          <div class="note-item-meta">
            <span><?= $note['updated'] ?></span>
            <span><?= $note['words'] ?>p</span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Editor -->
    <div class="editor-panel">
      <!-- Toolbar -->
      <div class="editor-toolbar">
        <div class="toolbar-btn" title="Negrita"><i class="fa-solid fa-bold"></i></div>
        <div class="toolbar-btn" title="Cursiva"><i class="fa-solid fa-italic"></i></div>
        <div class="toolbar-btn" title="Lista"><i class="fa-solid fa-list"></i></div>
        <div class="toolbar-btn" title="Encabezado"><i class="fa-solid fa-heading"></i></div>
        <div class="toolbar-btn" title="Código"><i class="fa-solid fa-code"></i></div>
        <div class="toolbar-sep"></div>
        <div class="toolbar-ai">
          <i class="fa-solid fa-robot"></i> Preguntar a IA
        </div>
      </div>

      <!-- Note content -->
      <div class="editor-body">
        <div class="note-title-display"><?= $selected['title'] ?></div>
        <div class="note-meta-row">
          <span><i class="fa-solid fa-clock"></i> <?= $selected['updated'] ?></span>
          <span><?= $selected['words'] ?> palabras</span>
          <span><i class="fa-solid fa-tag"></i> <?= implode(', ', $selected['tags']) ?></span>
        </div>
        <div class="note-tags">
          <?php foreach ($selected['tags'] as $tag): ?>
          <span class="badge badge-purple">#<?= $tag ?></span>
          <?php endforeach; ?>
        </div>

        <div class="note-content">
          <h3>Fórmula principal</h3>
          <div class="code-block">∫ u dv = uv − ∫ v du</div>
          <p>
            La integración por partes es una técnica de integración que se utiliza cuando el integrando es el producto de dos funciones. Deriva directamente de la <strong>regla del producto</strong> para derivadas.
          </p>

          <h3>Regla LIATE para elegir u</h3>
          <ul>
            <li><strong>L</strong> — Logarítmicas (ln x, log x)</li>
            <li><strong>I</strong> — Inversas trigonométricas (arctan, arcsin...)</li>
            <li><strong>A</strong> — Algebraicas (xⁿ, polinomios)</li>
            <li><strong>T</strong> — Trigonométricas (sin, cos, tan)</li>
            <li><strong>E</strong> — Exponenciales (eˣ, aˣ)</li>
          </ul>

          <h3>Ejemplo resuelto</h3>
          <p>Calcular ∫ x·eˣ dx:</p>
          <ul>
            <li>Elegimos u = x → du = dx</li>
            <li>Elegimos dv = eˣ dx → v = eˣ</li>
            <li>Aplicamos: ∫ x·eˣ dx = x·eˣ − ∫ eˣ dx = x·eˣ − eˣ + C = <strong>eˣ(x − 1) + C</strong></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Meta sidebar -->
    <div class="meta-panel">
      <div>
        <div class="meta-section-title">Detalles</div>
        <div class="meta-row"><span class="meta-key">Cuaderno</span><span style="color:<?= $selected['color'] ?>; font-weight:600;"><?= $selected['notebook'] ?></span></div>
        <div class="meta-row"><span class="meta-key">Palabras</span><span class="meta-val"><?= $selected['words'] ?></span></div>
        <div class="meta-row"><span class="meta-key">Editado</span><span class="meta-val"><?= $selected['updated'] ?></span></div>
      </div>

      <div>
        <div class="meta-section-title">Etiquetas</div>
        <div style="display:flex; flex-wrap:wrap; gap:6px;">
          <?php foreach ($selected['tags'] as $tag): ?>
          <span class="badge badge-purple">#<?= $tag ?></span>
          <?php endforeach; ?>
          <span style="font-size:11px; color:var(--text-muted); cursor:pointer;">+ añadir</span>
        </div>
      </div>

      <div>
        <div class="meta-section-title">Notas relacionadas</div>
        <?php foreach ($related as $r): ?>
        <div style="display:flex; align-items:flex-start; gap:7px; margin-bottom:8px; cursor:pointer;">
          <span style="width:5px; height:5px; border-radius:50%; background:<?= $r['color'] ?>; flex-shrink:0; margin-top:5px;"></span>
          <span style="font-size:11px; color:var(--text-secondary);"><?= $r['title'] ?></span>
        </div>
        <?php endforeach; ?>
      </div>

      <button class="btn-ai-full">
        <i class="fa-solid fa-robot"></i> Consultar a IA
      </button>
    </div>

  </div><!-- /notes-layout -->
</div><!-- /main -->
</div><!-- /app-layout -->

<?php include 'includes/footer.php'; ?>
