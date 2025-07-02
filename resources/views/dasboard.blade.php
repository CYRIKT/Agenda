@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">👋 Selamat Datang, {{ Auth::user()->name }}</h2>
        <p class="text-muted">Anda berada di halaman <strong>Dashboard Data Agenda Kegiatan</strong>.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h1 class="mb-2">📅</h1>
                    <h5 class="card-title">Agenda Hari Ini</h5>
                    <p class="text-muted">Cek dan kelola agenda yang berlangsung hari ini.</p>
                    <a href="{{ route('agenda') }}" class="btn btn-primary btn-sm">Lihat Agenda</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h1 class="mb-2">➕</h1>
                    <h5 class="card-title">Tambah Kegiatan</h5>
                    <p class="text-muted">Buat agenda baru untuk kegiatan mendatang.</p>
                    <a href="{{ route('agenda') }}" class="btn btn-success btn-sm">Tambah Agenda</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h1 class="mb-2">📊</h1>
                    <h5 class="card-title">Statistik Agenda</h5>
                    <p class="text-muted">Tinjau jumlah agenda dan aktivitas bulan ini.</p>
                    <a href="#" class="btn btn-outline-info btn-sm disabled">Belum Tersedia</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h1 class="mb-2">🔓</h1>
                    <h5 class="card-title">Logout</h5>
                    <p class="text-muted">Keluar dari sistem secara aman.</p>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection
