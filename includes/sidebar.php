<?php
// Determine active page
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
function isActive(string $page): string {
    global $currentPage;
    return $currentPage === $page ? 'active' : '';
}
?>
<div class="sidebar-overlay"></div>

<aside class="sidebar">
  <!-- Logo -->
  <div class="sidebar-logo">
    <div class="logo-icon">N</div>
    <span class="logo-text">NOOTRA</span>
  </div>

  <!-- User -->
  <div class="sidebar-user">
    <div class="user-avatar">M</div>
    <div>
      <div class="user-info-name">Mario García</div>
      <div class="user-info-plan">Pro</div>
    </div>
  </div>

  <!-- Nav -->
  <nav class="sidebar-nav">
    <div class="nav-label">Principal</div>
    <a class="nav-item <?= isActive('dashboard') ?>" href="dashboard.php">
      <i class="fa-solid fa-house"></i> Inicio
    </a>
    <a class="nav-item <?= isActive('calendario') ?>" href="calendario.php">
      <i class="fa-solid fa-calendar-days"></i> Calendario
      <span class="nav-badge">3</span>
    </a>

    <div class="nav-label">Estudio</div>
    <a class="nav-item <?= isActive('cuadernos') ?>" href="cuadernos.php">
      <i class="fa-solid fa-book"></i> Cuadernos
    </a>
    <a class="nav-item <?= isActive('notas') ?>" href="notas.php">
      <i class="fa-solid fa-file-lines"></i> Notas
    </a>
    <a class="nav-item <?= isActive('tareas') ?>" href="tareas.php">
      <i class="fa-solid fa-check-square"></i> Tareas
      <span class="nav-badge">5</span>
    </a>

    <div class="nav-label">Herramientas</div>
    <a class="nav-item <?= isActive('chat') ?>" href="chat.php">
      <i class="fa-solid fa-comments"></i> Chat
    </a>
    <a class="nav-item <?= isActive('ia') ?>" href="ia.php">
      <i class="fa-solid fa-robot"></i> Asistente IA
    </a>
  </nav>

  <!-- XP -->
  <div class="sidebar-xp">
    <div class="xp-label">
      <span><i class="fa-solid fa-star" style="color:#fbbf24;"></i> Nivel 7</span>
      <span style="color:#a78bfa; font-weight:600;">1,240 / 2,000 XP</span>
    </div>
    <div class="xp-bar">
      <div class="xp-fill" data-xp="62" style="width:0%"></div>
    </div>
  </div>

  <!-- Bottom -->
  <div class="sidebar-bottom">
    <a class="nav-item" href="perfil.php">
      <i class="fa-solid fa-gear"></i> Configuración
    </a>
    <a class="nav-item" href="logout.php">
      <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
    </a>
  </div>
</aside>
