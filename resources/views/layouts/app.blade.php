<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistem Data Agenda Kegiatan</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/DataTables-1.13.3/css/dataTables.bootstrap5.css') }}">
  <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar {
        background: linear-gradient(to bottom right, #fbc2eb, #a6c1ee); /* Pastel Gradient */
        color: white;
        min-height: 100vh;
        width: 230px;
        transition: all 0.3s ease-in-out;
    }

    .sidebar a {
        font-weight: 500;
        transition: background 0.3s;
    }

    .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 6px;
    }

    .navbar {
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        transition: background-color 0.3s ease;
    }

    .navbar-brand {
        font-weight: 600;
        color: #343a40;
    }

    .navbar-text {
        font-weight: 500;
    }

    .content-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        padding: 25px;
        transition: all 0.3s ease-in-out;
    }

    img.logo {
        filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));
    }

    .sidebar-collapsed {
        width: 60px !important;
    }

    .sidebar-collapsed .nav-link {
        text-align: center;
        font-size: 0;
    }

    .sidebar-collapsed .nav-link::before {
        font-size: 1.2rem;
        content: attr(data-icon);
        display: block;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: absolute;
            z-index: 1000;
            left: -230px;
        }

        .sidebar.show {
            left: 0;
        }
    }

    /* Dark Mode Style */
    .dark-mode {
        background-color: #121212;
        color: #fff;
    }

    .dark-mode .navbar,
    .dark-mode .sidebar {
        background-color: #222 !important;
        color: #fff;
    }

    .dark-mode a.nav-link {
        color: #fff;
    }

    .dark-mode .navbar-brand,
    .dark-mode .navbar-text {
        color: #fff;
    }

    .dark-mode .content-container {
        background-color: #1e1e1e;
    }

    .dark-mode *,
    .dark-mode .nav-link,
    .dark-mode .form-label,
    .dark-mode .form-control,
    .dark-mode .table,
    .dark-mode input,
    .dark-mode select,
    .dark-mode textarea {
        color: #fff !important;
        background-color: transparent !important;
        border-color: #666 !important;
    }

    .dark-mode .table thead th {
        border-bottom: 1px solid #aaa;
    }

    .dark-mode .form-control::placeholder {
        color: #aaa;
    }

    /* 🔧 Kecualikan tombol agar tetap punya warna aslinya di dark mode */
    .dark-mode .btn,
    .dark-mode button,
    .dark-mode .btn-outline-dark,
    .dark-mode .btn-primary,
    .dark-mode .btn-outline-secondary {
        background-color: unset !important;
        color: inherit !important;
        border-color: #fff !important;
    }

    .dark-mode .btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
    }

    .dark-mode .btn-outline-dark {
        color: #fff !important;
        border-color: #aaa !important;
    }

    .dark-mode .btn:hover {
        opacity: 0.9;
        background-color: rgba(255,255,255,0.05) !important;
    }

        .dark-mode .btn:hover {
        opacity: 0.9;
        background-color: rgba(255,255,255,0.05) !important;
    }

    /* Tombol aksi agar tetap terang di dark mode */
    .dark-mode .btn-warning {
        background-color: #f0ad4e !important;
        border-color: #f0ad4e !important;
        color: #000 !important;
    }

    .dark-mode .btn-danger {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        color: #fff !important;
    }

    .dark-mode .btn-warning:hover {
        background-color: #ec971f !important;
        border-color: #ec971f !important;
        color: #000 !important;
    }

    .dark-mode .btn-danger:hover {
        background-color: #c9302c !important;
        border-color: #c9302c !important;
        color: #fff !important;
    }

        /* Form Modal tidak terpengaruh dark mode */
.dark-mode .no-dark {
  background-color: #fff !important;
  color: #000 !important;
  border-color: #ccc !important;
}

.dark-mode .no-dark input,
.dark-mode .no-dark textarea,
.dark-mode .no-dark select {
  background-color: #fff !important;
  color: #000 !important;
  border-color: #ced4da !important;
}

.dark-mode .no-dark .form-label {
  color: #000 !important;
}

  </style>
</head>
<body>
  <div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar p-3">
      <div class="text-center mb-4">
        <img src="{{ asset('assets/image/logo.png') }}" class="img-fluid logo" style="max-width: 150px;" alt="Logo">
      </div>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a href="/" class="nav-link text-white" data-icon="🏠"> Dashboard</a>
        </li>
        <li class="nav-item mb-2">
          <a href="{{ route('agenda') }}" class="nav-link text-white" data-icon="📅"> Data Agenda</a>
        </li>
        <li class="nav-item mb-2">
          <a href="{{ route('agenda.export.pdf') }}" class="nav-link text-white" data-icon="🧾"> Export PDF</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link text-white" data-icon="🔓"> Logout</a>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-fill">
      <nav class="navbar navbar-expand-lg navbar-light bg-white px-4">
        <button class="btn btn-outline-secondary d-lg-none me-2" onclick="toggleSidebar()">☰</button>
        <span class="navbar-brand">📘 Sistem Kegiatan</span>
        <div class="ms-auto">
          <span class="navbar-text">👤 Selamat Datang, {{ Auth::user()->name }}</span>
          <button class="btn btn-sm btn-outline-dark ms-3" onclick="toggleDarkMode()">🌓</button>
        </div>
      </nav>

      <div class="p-4">
        <div class="content-container" id="main-content">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('assets/jquery-3.6.1.js') }}"></script>
  <script src="{{ asset('assets/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/DataTables-1.13.3/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/DataTables-1.13.3/js/dataTables.bootstrap5.min.js') }}"></script>

  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('show');
    }

    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
      const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
      document.documentElement.setAttribute('data-bs-theme', theme);
      localStorage.setItem('theme', theme);
    }

    window.onload = function () {
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
        document.documentElement.setAttribute('data-bs-theme', 'dark');
      }
    }
  </script>

  @yield('scripts')
</body>
</html>
