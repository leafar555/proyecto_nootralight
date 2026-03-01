<?php
$pageTitle = 'Notas';
require 'data/notas.php';
?>
<?php include 'includes/head.php'; ?>

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
        <div class="toolbar-btn" title="Negrita" data-cmd="bold" aria-label="Negrita" role="button"><i class="fa-solid fa-bold"></i></div>
        <div class="toolbar-btn" title="Cursiva" data-cmd="italic" aria-label="Cursiva" role="button"><i class="fa-solid fa-italic"></i></div>
        <div class="toolbar-btn" title="Lista" data-cmd="insertUnorderedList" aria-label="Lista" role="button"><i class="fa-solid fa-list"></i></div>
        <div class="toolbar-btn" title="Encabezado" data-cmd="formatBlock" data-val="h3" aria-label="Encabezado" role="button"><i class="fa-solid fa-heading"></i></div>
        <div class="toolbar-btn" title="Código" aria-label="Código" role="button" id="toolbar-code"><i class="fa-solid fa-code"></i></div>
        <div class="toolbar-sep"></div>
        <div class="toolbar-ai">
          <i class="fa-solid fa-robot"></i> Preguntar a IA
        </div>
      </div>

      <!-- Note content -->
      <div class="editor-body">
        <div class="note-title-display" contenteditable="true" spellcheck="false"><?= $selected['title'] ?></div>
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

        <div class="note-content" contenteditable="true" spellcheck="false" data-placeholder="Escribe aquí...">
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

<script>
/* ─── Toolbar: execCommand ─── */
document.querySelectorAll('.toolbar-btn[data-cmd]').forEach(btn => {
  btn.addEventListener('mousedown', e => {
    e.preventDefault(); // Evitar que el editor pierda el foco
    const val = btn.dataset.val || null;
    document.execCommand(btn.dataset.cmd, false, val);
  });
});

/* ─── Toolbar: código inline ─── */
document.getElementById('toolbar-code')?.addEventListener('mousedown', e => {
  e.preventDefault();
  const sel = window.getSelection();
  if (!sel.rangeCount || sel.isCollapsed) return;
  const range = sel.getRangeAt(0);
  const code = document.createElement('code');
  try { range.surroundContents(code); } catch (_) {}
});
</script>

<?php include 'includes/footer.php'; ?>
