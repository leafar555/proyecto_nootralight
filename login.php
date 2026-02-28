<?php $pageTitle = 'Iniciar sesión'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión — NOOTRA</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { display: flex; min-height: 100vh; }

    /* ─── Auth form panel ─── */
    .auth-panel {
      width: 460px;
      min-height: 100vh;
      background: var(--bg-secondary);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 48px 44px;
      flex-shrink: 0;
    }
    .auth-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 36px; }
    .auth-logo-icon {
      width: 42px; height: 42px;
      background: var(--accent-grad);
      border-radius: 11px;
      display: flex; align-items: center; justify-content: center;
      font-weight: 900; font-size: 18px; color: #fff;
    }
    .auth-logo-text { font-size: 22px; font-weight: 800; background: var(--accent-grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

    .auth-heading { font-size: 22px; font-weight: 800; margin-bottom: 6px; text-align: center; }
    .auth-sub { font-size: 13px; color: var(--text-muted); text-align: center; margin-bottom: 32px; }

    .btn-google {
      width: 100%;
      display: flex; align-items: center; justify-content: center; gap: 10px;
      padding: 11px;
      background: var(--bg-tertiary);
      border: 1px solid var(--border);
      border-radius: var(--radius-btn);
      color: var(--text-secondary);
      font-size: 13px; font-weight: 600;
      transition: var(--transition);
      margin-bottom: 20px;
    }
    .btn-google:hover { border-color: #3d3d6e; color: var(--text-primary); }
    .btn-google img { width: 18px; }

    .divider-text {
      display: flex; align-items: center; gap: 12px;
      font-size: 11px; color: var(--text-muted);
      margin-bottom: 20px;
    }
    .divider-text::before, .divider-text::after {
      content: ''; flex: 1; height: 1px; background: var(--border);
    }

    .btn-submit {
      width: 100%;
      padding: 12px;
      background: var(--accent-grad);
      color: #fff;
      border-radius: var(--radius-btn);
      font-size: 14px; font-weight: 700;
      letter-spacing: 0.3px;
      box-shadow: 0 0 24px rgba(124,58,237,0.3);
      transition: var(--transition);
      margin-top: 4px;
    }
    .btn-submit:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 6px 24px rgba(124,58,237,0.4); }

    .auth-footer { font-size: 12px; color: var(--text-muted); text-align: center; margin-top: 20px; }
    .auth-footer a { color: #a78bfa; font-weight: 600; }
    .auth-footer a:hover { text-decoration: underline; }

    /* ─── Feature preview panel ─── */
    .feature-panel {
      flex: 1;
      background: var(--bg-primary);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 60px 48px;
      position: relative;
      overflow: hidden;
    }

    /* Background glow */
    .feature-panel::before {
      content: '';
      position: absolute;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(124,58,237,0.12) 0%, transparent 70%);
      top: 50%; left: 50%; transform: translate(-50%, -50%);
      pointer-events: none;
    }

    .feature-headline {
      font-size: 32px; font-weight: 900; line-height: 1.2;
      text-align: center; max-width: 480px;
      margin-bottom: 12px;
      position: relative;
    }
    .feature-headline span {
      background: var(--accent-grad);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .feature-sub {
      font-size: 14px; color: var(--text-muted);
      text-align: center; max-width: 380px;
      margin-bottom: 40px;
      position: relative;
    }

    .features-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 14px; max-width: 480px; width: 100%;
      position: relative;
    }
    .feature-card {
      background: var(--bg-secondary);
      border: 1px solid var(--border);
      border-radius: var(--radius-card);
      padding: 18px;
      display: flex; gap: 12px; align-items: flex-start;
    }
    .feature-icon {
      width: 36px; height: 36px;
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      font-size: 15px; flex-shrink: 0;
    }
    .feature-name { font-size: 12px; font-weight: 700; margin-bottom: 3px; }
    .feature-desc { font-size: 11px; color: var(--text-muted); line-height: 1.4; }

    .stats-row {
      display: flex; gap: 32px; margin-top: 36px;
      position: relative;
    }
    .stat-item { text-align: center; }
    .stat-num { font-size: 24px; font-weight: 800; background: var(--accent-grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .stat-lbl { font-size: 11px; color: var(--text-muted); margin-top: 2px; }

    @media (max-width: 900px) {
      .feature-panel { display: none; }
      .auth-panel { width: 100%; border: none; }
    }
  </style>
</head>
<body>

<!-- Auth panel -->
<div class="auth-panel">
  <div class="auth-logo">
    <div class="auth-logo-icon">N</div>
    <span class="auth-logo-text">NOOTRA</span>
  </div>

  <h1 class="auth-heading">Bienvenido de vuelta</h1>
  <p class="auth-sub">Inicia sesión para continuar tu estudio</p>

  <!-- Google -->
  <button class="btn-google" type="button">
    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
    Continuar con Google
  </button>

  <div class="divider-text">o con tu correo</div>

  <form action="dashboard.php" method="get" style="width:100%">
    <div class="input-group">
      <label class="input-label">Correo electrónico</label>
      <input type="email" class="input" placeholder="usuario@ejemplo.com" name="email">
    </div>
    <div class="input-group">
      <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
        <label class="input-label" style="margin:0">Contraseña</label>
        <a href="#" style="font-size:11px; color:#a78bfa;">¿Olvidaste tu contraseña?</a>
      </div>
      <input type="password" class="input" placeholder="••••••••" name="password">
    </div>
    <button type="submit" class="btn-submit">Iniciar sesión</button>
  </form>

  <div class="auth-footer">
    ¿No tienes cuenta? <a href="register.php">Regístrate gratis</a>
  </div>
</div>

<!-- Feature preview panel -->
<div class="feature-panel">
  <h2 class="feature-headline">Todo lo que necesitas para <span>estudiar mejor</span></h2>
  <p class="feature-sub">Organiza tus apuntes, gestiona tareas y estudia con IA — en un solo lugar.</p>

  <div class="features-grid">
    <div class="feature-card">
      <div class="feature-icon" style="background:rgba(124,58,237,0.15); color:#a78bfa;">
        <i class="fa-solid fa-book"></i>
      </div>
      <div>
        <div class="feature-name">Cuadernos virtuales</div>
        <div class="feature-desc">Jerárquicos, organizados y siempre accesibles.</div>
      </div>
    </div>
    <div class="feature-card">
      <div class="feature-icon" style="background:rgba(236,72,153,0.15); color:#f472b6;">
        <i class="fa-solid fa-robot"></i>
      </div>
      <div>
        <div class="feature-name">Asistente IA</div>
        <div class="feature-desc">Guía tu aprendizaje sin darte respuestas directas.</div>
      </div>
    </div>
    <div class="feature-card">
      <div class="feature-icon" style="background:rgba(16,185,129,0.15); color:#34d399;">
        <i class="fa-solid fa-check-square"></i>
      </div>
      <div>
        <div class="feature-name">Gestor de tareas</div>
        <div class="feature-desc">Prioridades, recordatorios y vista por materia.</div>
      </div>
    </div>
    <div class="feature-card">
      <div class="feature-icon" style="background:rgba(245,158,11,0.15); color:#fbbf24;">
        <i class="fa-solid fa-trophy"></i>
      </div>
      <div>
        <div class="feature-name">Gamificación</div>
        <div class="feature-desc">XP, rachas de estudio, logros y niveles.</div>
      </div>
    </div>
  </div>

  <div class="stats-row">
    <div class="stat-item"><div class="stat-num">10K+</div><div class="stat-lbl">Estudiantes</div></div>
    <div class="stat-item"><div class="stat-num">98%</div><div class="stat-lbl">Satisfacción</div></div>
    <div class="stat-item"><div class="stat-num">4.9<i class="fa-solid fa-star" style="font-size:14px;color:#fbbf24;margin-left:3px;-webkit-text-fill-color:initial;"></i></div><div class="stat-lbl">Valoración</div></div>
  </div>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>
