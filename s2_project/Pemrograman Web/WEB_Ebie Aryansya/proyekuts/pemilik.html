<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KostKita - Panel Manajemen</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --orange:#F47B20;--orange-dark:#D96A10;--orange-light:#FFF3E8;--orange-faint:#FFF8F2;
  --green:#22C55E;--green-dark:#16A34A;--green-bg:#DCFCE7;
  --red:#EF4444;--red-dark:#DC2626;--red-bg:#FEE2E2;
  --amber:#F59E0B;--amber-bg:#FEF3C7;
  --yellow:#EAB308;--yellow-bg:#FEF9C3;
  --blue:#3B82F6;--blue-bg:#DBEAFE;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-600:#4B5563;--gray-700:#374151;--gray-800:#1F2937;--gray-900:#111827;
  --white:#FFFFFF;
  --shadow-xs:0 1px 2px rgba(0,0,0,.06);
  --shadow-sm:0 1px 4px rgba(0,0,0,.08);
  --shadow-md:0 4px 12px rgba(0,0,0,.10);
  --shadow-lg:0 8px 24px rgba(0,0,0,.12);
  --radius:10px;
}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--gray-50);color:var(--gray-800);font-size:13px;min-height:100vh}

/* ===== NAVBAR ===== */
nav{background:var(--white);border-bottom:1.5px solid var(--gray-200);padding:0 28px;display:flex;align-items:center;height:62px;gap:0;position:sticky;top:0;z-index:200;box-shadow:var(--shadow-sm)}
.logo{display:flex;align-items:center;gap:9px;font-weight:800;font-size:19px;color:var(--gray-900);text-decoration:none;margin-right:28px;flex-shrink:0}
.logo-icon{width:36px;height:36px;background:var(--orange);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px}
.nav-links{display:flex;gap:2px;flex:1}
.nav-links a{text-decoration:none;color:var(--gray-600);font-weight:500;font-size:13px;padding:6px 14px;border-radius:7px;transition:all .15s;white-space:nowrap}
.nav-links a:hover{background:var(--gray-100);color:var(--gray-800)}
.nav-links a.active{color:var(--orange);font-weight:700;background:var(--orange-faint)}
.nav-right{display:flex;align-items:center;gap:10px}
.notif-btn{position:relative;width:36px;height:36px;background:var(--gray-100);border-radius:8px;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;transition:background .15s}
.notif-btn:hover{background:var(--gray-200)}
.notif-badge{position:absolute;top:5px;right:5px;width:14px;height:14px;background:var(--red);border-radius:50%;font-size:9px;font-weight:700;color:white;display:flex;align-items:center;justify-content:center;border:2px solid white}
.nav-user{display:flex;align-items:center;gap:9px;cursor:pointer;padding:6px 12px;border-radius:9px;border:1.5px solid var(--gray-200);font-weight:600;color:var(--gray-700);font-size:13px;transition:background .15s;white-space:nowrap}
.nav-user:hover{background:var(--gray-50)}
.avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#F47B20,#e06b15);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;flex-shrink:0}

/* ===== LAYOUT ===== */
.page{display:flex;gap:20px;padding:22px 28px;max-width:1380px;margin:0 auto}
.main-col{flex:1;min-width:0}
.right-col{width:310px;flex-shrink:0}

/* ===== HEADER ===== */
.page-header{display:flex;align-items:center;gap:16px;margin-bottom:18px;flex-wrap:wrap}
.page-header h1{font-size:22px;font-weight:800;color:var(--gray-900);flex:1;line-height:1.2}
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:9px;font-family:inherit;font-size:13px;font-weight:600;cursor:pointer;transition:all .15s;border:none;text-decoration:none}
.btn-primary{background:var(--orange);color:white}
.btn-primary:hover{background:var(--orange-dark);transform:translateY(-1px);box-shadow:0 4px 12px rgba(244,123,32,.35)}
.btn-sm{padding:6px 12px;font-size:12px}
.btn-outline{background:white;color:var(--gray-700);border:1.5px solid var(--gray-200)}
.btn-outline:hover{border-color:var(--orange);color:var(--orange);background:var(--orange-faint)}
.btn-orange-outline{background:white;color:var(--orange);border:1.5px solid var(--orange)}
.btn-orange-outline:hover{background:var(--orange);color:white}
.btn-green{background:var(--green);color:white}
.btn-green:hover{background:var(--green-dark)}

/* ===== FILTER BAR ===== */
.filter-bar{background:var(--white);border-radius:var(--radius);padding:16px 18px;margin-bottom:20px;box-shadow:var(--shadow-sm);border:1px solid var(--gray-100);display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap}
.filter-group{display:flex;flex-direction:column;gap:4px;flex:1;min-width:120px}
.filter-group label{font-size:11px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.4px}
.filter-group select,.filter-group input{border:1.5px solid var(--gray-200);border-radius:7px;padding:8px 10px;font-size:12px;font-family:inherit;color:var(--gray-800);background:var(--white);outline:none;cursor:pointer;transition:border-color .15s;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%239CA3AF' d='M5 7L0.5 2h9z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 9px center;padding-right:26px}
.filter-group select:focus,.filter-group input:focus{border-color:var(--orange)}
.filter-btn{background:var(--orange);color:white;border:none;border-radius:9px;width:40px;height:40px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:17px;transition:all .15s;flex-shrink:0}
.filter-btn:hover{background:var(--orange-dark)}

/* ===== SECTION TITLE ===== */
.section-title{font-size:15px;font-weight:700;color:var(--gray-900);margin-bottom:14px}

/* ===== UNIT GRID ===== */
.unit-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}

.unit-card{background:var(--white);border-radius:12px;overflow:hidden;box-shadow:var(--shadow-sm);border:1.5px solid var(--gray-100);transition:all .2s;position:relative}
.unit-card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px);border-color:var(--gray-200)}

.card-img{width:100%;height:120px;position:relative;overflow:hidden;flex-shrink:0}
.card-img svg{width:100%;height:100%}
.card-badge{position:absolute;top:8px;right:8px;padding:3px 9px;border-radius:20px;font-size:10px;font-weight:700;z-index:2}
.badge-tersedia{background:var(--green);color:white}
.badge-sisa{background:var(--amber);color:white}
.badge-terisi{background:var(--red);color:white}
.badge-perlu{background:#EF4444;color:white}

.card-body{padding:12px}
.card-title{font-size:14px;font-weight:700;margin-bottom:1px;display:flex;align-items:center;justify-content:space-between;gap:6px}
.card-sub{font-size:11px;color:var(--gray-500);margin-bottom:3px}
.card-loc{display:flex;align-items:center;gap:4px;font-size:11px;color:var(--gray-500);margin-bottom:7px}
.card-feats{display:flex;gap:8px;margin-bottom:7px;flex-wrap:wrap}
.feat{display:flex;align-items:center;gap:3px;font-size:11px;color:var(--gray-600)}
.card-tarif label{font-size:11px;color:var(--gray-500)}
.card-tarif{margin-bottom:10px;display:flex;align-items:center;justify-content:space-between}
.card-price{font-size:13px;font-weight:700;color:var(--orange)}
.card-price span{font-weight:400;color:var(--gray-400);font-size:11px}
.edit-icon{background:none;border:none;cursor:pointer;color:var(--orange);font-size:14px;padding:3px;border-radius:5px;transition:background .15s}
.edit-icon:hover{background:var(--orange-faint)}
.card-actions{display:flex;gap:7px}
.card-actions .btn{flex:1;justify-content:center;font-size:11px;padding:7px}

/* ===== RIGHT SIDEBAR ===== */
.sidebar-card{background:var(--white);border-radius:12px;padding:16px;box-shadow:var(--shadow-sm);border:1px solid var(--gray-100);margin-bottom:16px}
.sidebar-title{font-size:13px;font-weight:700;color:var(--gray-900);margin-bottom:4px}
.occupancy-stats{font-size:11px;color:var(--gray-600);margin-bottom:12px}
.occupancy-stats strong{color:var(--gray-800)}

/* Room Grid */
.room-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:5px;margin-bottom:12px}
.room-chip{padding:4px 2px;border:none;border-radius:5px;font-size:10px;font-weight:700;cursor:pointer;text-align:center;font-family:inherit;transition:all .15s;position:relative}
.room-chip:hover{transform:scale(1.08);z-index:2}
.rc-available{background:var(--green);color:white}
.rc-occupied{background:var(--red);color:white}
.rc-pending{background:var(--amber);color:white}
.rc-attention{background:#EF4444;color:white}

.legend{display:flex;flex-wrap:wrap;gap:8px}
.legend-item{display:flex;align-items:center;gap:4px;font-size:10px;color:var(--gray-600)}
.leg-dot{width:9px;height:9px;border-radius:50%}

/* ===== TRANSACTION TABLE ===== */
.tx-table-wrap{overflow-x:auto}
.tx-table{width:100%;border-collapse:collapse;font-size:10px}
.tx-table th{text-align:left;padding:5px 6px;color:var(--gray-400);font-weight:600;border-bottom:1.5px solid var(--gray-100);white-space:nowrap;font-size:9px;text-transform:uppercase}
.tx-table td{padding:5px 6px;border-bottom:1px solid var(--gray-100);color:var(--gray-700);white-space:nowrap;vertical-align:middle}
.tx-table tr:last-child td{border-bottom:none}
.tx-table tr:hover td{background:var(--gray-50)}
.pill{display:inline-flex;align-items:center;padding:2px 7px;border-radius:10px;font-size:9px;font-weight:700;white-space:nowrap}
.pill-lunas{background:var(--green-bg);color:var(--green-dark)}
.pill-pending{background:var(--amber-bg);color:#92400E}
.pill-confirmed{background:var(--blue-bg);color:#1E40AF}
.pill-cancelled{background:var(--red-bg);color:var(--red-dark)}
.pill-action{cursor:pointer;transition:opacity .15s}
.pill-action:hover{opacity:.8}
.pill-verif{background:#FEF3C7;color:#92400E}
.pill-cetak{background:var(--blue-bg);color:#1E40AF}

/* ===== MODAL ===== */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:1000;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal{background:var(--white);border-radius:14px;padding:24px;width:480px;max-width:90vw;max-height:90vh;overflow-y:auto;box-shadow:var(--shadow-lg);transform:scale(.95);transition:transform .2s}
.modal-overlay.open .modal{transform:scale(1)}
.modal-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px}
.modal-header h3{font-size:16px;font-weight:700}
.modal-close{background:none;border:none;cursor:pointer;font-size:20px;color:var(--gray-500);padding:4px;border-radius:5px;line-height:1;transition:background .15s}
.modal-close:hover{background:var(--gray-100)}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.form-group{display:flex;flex-direction:column;gap:5px}
.form-group.full{grid-column:1/-1}
.form-group label{font-size:11px;font-weight:600;color:var(--gray-600)}
.form-group input,.form-group select,.form-group textarea{border:1.5px solid var(--gray-200);border-radius:7px;padding:9px 11px;font-size:13px;font-family:inherit;color:var(--gray-800);outline:none;transition:border-color .15s;background:white}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--orange)}
.form-group textarea{resize:vertical;min-height:70px}
.modal-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:20px}

/* ===== TOAST ===== */
.toast-container{position:fixed;top:70px;right:20px;z-index:2000;display:flex;flex-direction:column;gap:8px}
.toast{background:var(--gray-900);color:white;padding:10px 16px;border-radius:9px;font-size:12px;font-weight:600;box-shadow:var(--shadow-lg);animation:slideIn .25s ease;display:flex;align-items:center;gap:8px}
.toast.success{background:var(--green-dark)}
.toast.error{background:var(--red-dark)}
@keyframes slideIn{from{opacity:0;transform:translateX(60px)}to{opacity:1;transform:translateX(0)}}

/* ===== ROOM DETAIL TOOLTIP ===== */
.room-tooltip{position:absolute;bottom:110%;left:50%;transform:translateX(-50%);background:var(--gray-900);color:white;padding:6px 10px;border-radius:7px;font-size:10px;white-space:nowrap;pointer-events:none;opacity:0;transition:opacity .15s;z-index:10}
.room-chip:hover .room-tooltip{opacity:1}

/* Animations */
@keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.unit-card{animation:fadeIn .3s ease both}
.unit-card:nth-child(1){animation-delay:.05s}
.unit-card:nth-child(2){animation-delay:.1s}
.unit-card:nth-child(3){animation-delay:.15s}
.unit-card:nth-child(4){animation-delay:.2s}
.unit-card:nth-child(5){animation-delay:.25s}
.unit-card:nth-child(6){animation-delay:.3s}

/* Scrollbar */
::-webkit-scrollbar{width:5px;height:5px}
::-webkit-scrollbar-track{background:var(--gray-100)}
::-webkit-scrollbar-thumb{background:var(--gray-300);border-radius:3px}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav>
  <a href="#" class="logo">
    <div class="logo-icon">🏠</div>
    KostKita
  </a>
  <div class="nav-links">
    <a href="#" class="active">Unit Saya</a>
    <a href="#" onclick="showTab('pemesanan',this);return false">Pemesanan</a>
    <a href="#" onclick="showTab('penghuni',this);return false">Data Penghuni Saya</a>
    <a href="#" onclick="showTab('keuangan',this);return false">Keuangan Saya</a>
    <a href="#" onclick="showTab('pengaturan',this);return false">Pengaturan</a>
  </div>
  <div class="nav-right">
    <button class="notif-btn" onclick="toggleNotif()">🔔<span class="notif-badge">3</span></button>
    <div class="nav-user">
      <div class="avatar">SH</div>
      Halo, Bpk EbieA (Pemilik) ▾
    </div>
  </div>
</nav>

<!-- TOAST CONTAINER -->
<div class="toast-container" id="toastContainer"></div>

<!-- PAGE -->
<div class="page">

  <!-- MAIN CONTENT -->
  <div class="main-col">
    <div class="page-header">
      <h1>Panel Manajemen Unit KostKita - Kost Brother</h1>
      <button class="btn btn-primary" onclick="openAddUnit()">➕ Tambah Unit Baru</button>
    </div>

    <!-- FILTER -->
    <div class="filter-bar">
      <div class="filter-group">
        <label>Filter Unit Kost Brother</label>
        <select id="filterLokasi" onchange="applyFilters()">
          <option value="">Semua Jenis Kost</option>
          <option value="Ampera">KostKita - Brother</option>
          <option value="Fatmawati">KostKita - Saudara</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Tipe Kamar</label>
        <select id="filterTipe" onchange="applyFilters()">
          <option value="">Semua Tipe</option>
          <option value="A">Tipe A</option>
          <option value="B">Tipe B</option>
          <option value="C">Tipe C</option>
          <option value="D">Tipe D</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Status Okupansi</label>
        <select id="filterStatus" onchange="applyFilters()">
          <option value="">Semua Status</option>
          <option value="Tersedia">Tersedia</option>
          <option value="Sisa 1 Kamar">Sisa 1 Kamar</option>
          <option value="Terisi">Terisi</option>
          <option value="Perlu Perhatian">Perlu Perhatian</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Tipe Pembayaran</label>
        <select id="filterBayar" onchange="applyFilters()">
          <option value="">Semua</option>
          <option value="Bulanan">Bulanan</option>
          <option value="Tahunan">Tahunan</option>
        </select>
      </div>
      <button class="filter-btn" onclick="applyFilters()">🔍</button>
    </div>

    <div class="section-title">Daftar Unit Kamar &amp; Detail Penghuni</div>
    <div class="unit-grid" id="unitGrid"></div>
  </div>

  <!-- RIGHT SIDEBAR -->
  <div class="right-col">
    <!-- Occupancy Status -->
    <div class="sidebar-card">
      <div class="sidebar-title">Status Okupansi Kost Saya (Kost Brother)</div>
      <div class="occupancy-stats" id="occupancyStats">Tersedia: 2 | Terisi: 15 | Dipesan: 3 | Total: 20</div>
      <div class="room-grid" id="roomGridSide"></div>
      <div class="legend">
        <div class="legend-item"><div class="leg-dot" style="background:var(--green)"></div>Tersedia</div>
        <div class="legend-item"><div class="leg-dot" style="background:var(--red)"></div>Terisi</div>
        <div class="legend-item"><div class="leg-dot" style="background:var(--amber)"></div>Dipesan</div>
        <div class="legend-item"><div class="leg-dot" style="background:var(--yellow)"></div>Total</div>
        <div class="legend-item"><div class="leg-dot" style="background:#EF4444"></div>Perlu Perhatian</div>
      </div>
    </div>

    <!-- Transactions -->
    <div class="sidebar-card">
      <div class="sidebar-title" style="margin-bottom:12px">Daftar Transaksi Unit Saya</div>
      <div class="tx-table-wrap">
        <table class="tx-table">
          <thead>
            <tr>
              <th>ID Transk.</th>
              <th>Nama Penghuni</th>
              <th>Kamar</th>
              <th>Check-in</th>
              <th>Durasi</th>
              <th>Total Bayar</th>
              <th>Status Bayar</th>
              <th>Status Pemesanan</th>
              <th>Status Oikonfirmasi</th>
            </tr>
          </thead>
          <tbody id="txBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- ADD/EDIT UNIT MODAL -->
<div class="modal-overlay" id="unitModal">
  <div class="modal">
    <div class="modal-header">
      <h3 id="modalTitle">Tambah Unit Baru</h3>
      <button class="modal-close" onclick="closeModal('unitModal')">✕</button>
    </div>
    <div class="form-grid">
      <div class="form-group">
        <label>Nomor Kamar</label>
        <input type="text" id="fRoomId" placeholder="cth. A101">
      </div>
      <div class="form-group">
        <label>Tipe Kamar</label>
        <select id="fTipe">
          <option>Tipe A</option><option>Tipe B</option><option>Tipe C</option><option>Tipe D</option>
        </select>
      </div>
      <div class="form-group">
        <label>Lokasi</label>
        <select id="fLokasi">
          <option>KostKita - Ampera</option>
          <option>KostKita - Fatmawati</option>
        </select>
      </div>
      <div class="form-group">
        <label>Fasilitas</label>
        <select id="fFasilitas">
          <option>AC, Kamar Mandi Dalam</option>
          <option>AC, Kamar Mandi Luar</option>
          <option>Tanpa AC, KM Dalam</option>
        </select>
      </div>
      <div class="form-group">
        <label>Harga/Bulan (Rp)</label>
        <input type="number" id="fHarga" placeholder="2100000">
      </div>
      <div class="form-group">
        <label>Tipe Pembayaran</label>
        <select id="fBayar">
          <option>Bulanan</option><option>Tahunan</option>
        </select>
      </div>
      <div class="form-group">
        <label>Status</label>
        <select id="fStatus">
          <option>Tersedia</option>
          <option>Terisi</option>
          <option>Sisa 1 Kamar</option>
          <option>Perlu Perhatian</option>
        </select>
      </div>
      <div class="form-group">
        <label>Nama Penghuni (jika ada)</label>
        <input type="text" id="fPenghuni" placeholder="Nama penghuni">
      </div>
      <div class="form-group full">
        <label>Catatan</label>
        <textarea id="fCatatan" placeholder="Catatan tambahan..."></textarea>
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn btn-outline" onclick="closeModal('unitModal')">Batal</button>
      <button class="btn btn-primary" onclick="saveUnit()">💾 Simpan</button>
    </div>
  </div>
</div>

<!-- LAPORAN PERBAIKAN MODAL -->
<div class="modal-overlay" id="laporanModal">
  <div class="modal">
    <div class="modal-header">
      <h3>Laporan Perbaikan</h3>
      <button class="modal-close" onclick="closeModal('laporanModal')">✕</button>
    </div>
    <div class="form-grid">
      <div class="form-group">
        <label>Kamar</label>
        <input type="text" id="lRoomId" readonly style="background:var(--gray-50)">
      </div>
      <div class="form-group">
        <label>Tanggal Lapor</label>
        <input type="date" id="lTanggal">
      </div>
      <div class="form-group">
        <label>Jenis Kerusakan</label>
        <select id="lJenis">
          <option>Listrik</option><option>Plumbing / Air</option><option>Atap / Dinding</option>
          <option>AC / Kipas</option><option>Pintu / Jendela</option><option>Lainnya</option>
        </select>
      </div>
      <div class="form-group">
        <label>Tingkat Prioritas</label>
        <select id="lPrioritas">
          <option>Rendah</option><option>Sedang</option><option>Tinggi</option><option>Darurat</option>
        </select>
      </div>
      <div class="form-group full">
        <label>Deskripsi Kerusakan</label>
        <textarea id="lDeskripsi" placeholder="Jelaskan kerusakan secara detail..."></textarea>
      </div>
      <div class="form-group full">
        <label>Estimasi Biaya Perbaikan (Rp)</label>
        <input type="number" id="lBiaya" placeholder="500000">
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn btn-outline" onclick="closeModal('laporanModal')">Batal</button>
      <button class="btn btn-primary" onclick="saveLaporan()">📋 Kirim Laporan</button>
    </div>
  </div>
</div>

<!-- EDIT STATUS MODAL -->
<div class="modal-overlay" id="statusModal">
  <div class="modal" style="width:340px">
    <div class="modal-header">
      <h3>Edit Status Kamar <span id="sRoomLabel"></span></h3>
      <button class="modal-close" onclick="closeModal('statusModal')">✕</button>
    </div>
    <div class="form-grid" style="grid-template-columns:1fr">
      <div class="form-group">
        <label>Status Baru</label>
        <select id="sStatus">
          <option>Tersedia</option><option>Terisi</option><option>Sisa 1 Kamar</option><option>Perlu Perhatian</option>
        </select>
      </div>
      <div class="form-group">
        <label>Nama Penghuni (opsional)</label>
        <input type="text" id="sPenghuni" placeholder="Nama penghuni">
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn btn-outline" onclick="closeModal('statusModal')">Batal</button>
      <button class="btn btn-primary" onclick="saveStatus()">✔ Simpan Status</button>
    </div>
  </div>
</div>

<script>
// ===== DATA =====
let units = [
  {id:'A101',tipe:'A',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Tersedia',penghuni:'',catatan:''},
  {id:'B201',tipe:'B',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Sisa 1 Kamar',penghuni:'Rina S.',catatan:''},
  {id:'C301',tipe:'C',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Tersedia',penghuni:'',catatan:''},
  {id:'A102',tipe:'A',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Terisi',penghuni:'Budi W.',catatan:''},
  {id:'B202',tipe:'B',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Perlu Perhatian',penghuni:'Dewi K.',catatan:'AC rusak'},
  {id:'C302',tipe:'C',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Tersedia',penghuni:'',catatan:''},
  {id:'A103',tipe:'A',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Terisi',penghuni:'Siti N.',catatan:''},
  {id:'B203',tipe:'B',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Sisa 1 Kamar',penghuni:'',catatan:''},
  {id:'C303',tipe:'C',lokasi:'Brother',fasilitas:'AC, Kamar Mandi Dalam',harga:2100000,bayar:'Bulanan',status:'Terisi',penghuni:'Ahmad F.',catatan:''},
];

let transactions = [
  {id:'20260329-01',penghuni:'Majid',kamar:'A101',checkin:'29/03/2026',durasi:'1 month',total:'Rp 5.100.000',bayar:'Lunas',pemesanan:'Confirmed',aksi:'Verifikasi Pembayaran'},
  {id:'20260339-02',penghuni:'Majid',kamar:'B201',checkin:'29/03/2026',durasi:'1 month',total:'Rp 5.100.000',bayar:'Lunas',pemesanan:'Confirmed',aksi:'Cetak Invois'},
  {id:'20260339-03',penghuni:'Majid',kamar:'B201',checkin:'29/03/2026',durasi:'1 month',total:'Rp 5.100.000',bayar:'Lunas',pemesanan:'Confirmed',aksi:'Cetak Invois'},
  {id:'20260339-04',penghuni:'Majid',kamar:'A101',checkin:'29/03/2026',durasi:'1 month',total:'Rp 5.100.000',bayar:'Lunas',pemesanan:'Confirmed',aksi:'Cetak Invois'},
  {id:'20260339-05',penghuni:'Majid',kamar:'A103',checkin:'01/04/2026',durasi:'1 month',total:'Rp 2.100.000',bayar:'Pending',pemesanan:'Pending',aksi:'Verifikasi Pembayaran'},
  {id:'20260339-06',penghuni:'Majid',kamar:'A102',checkin:'15/04/2026',durasi:'1 month',total:'Rp 2.100.000',bayar:'Lunas',pemesanan:'Confirmed',aksi:'Cetak Invois'},
];

let editIndex = null;
let editStatusIndex = null;

// ===== ROOM SVG GENERATOR =====
const palettes = [
  ['#E8F5E9','#2E7D32'],['#FFF3E0','#BF360C'],['#E3F2FD','#0D47A1'],
  ['#F3E5F5','#4A148C'],['#E0F2F1','#004D40'],['#FBE9E7','#BF360C'],
  ['#E8EAF6','#1A237E'],['#F1F8E9','#33691E'],['#FCE4EC','#880E4F'],
];

function getRoomSVG(idx, status) {
  const p = palettes[idx % palettes.length];
  const bg = status === 'Terisi' ? '#FFF5F5' : status === 'Perlu Perhatian' ? '#FFF3CD' : p[0];
  const ac = status === 'Terisi' ? '#DC2626' : status === 'Perlu Perhatian' ? '#D97706' : p[1];
  return `<svg viewBox="0 0 200 120" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:120px;display:block">
    <rect width="200" height="120" fill="${bg}"/>
    <rect x="0" y="88" width="200" height="32" fill="${ac}18"/>
    <rect x="125" y="15" width="55" height="42" rx="4" fill="white" opacity=".55"/>
    <line x1="152" y1="15" x2="152" y2="57" stroke="${ac}44" stroke-width="1.5"/>
    <line x1="125" y1="36" x2="180" y2="36" stroke="${ac}44" stroke-width="1.5"/>
    <rect x="15" y="62" width="88" height="34" rx="5" fill="${ac}55"/>
    <rect x="15" y="62" width="88" height="16" rx="5" fill="${ac}88"/>
    <rect x="20" y="65" width="35" height="9" rx="3" fill="white" opacity=".5"/>
    <rect x="60" y="65" width="35" height="9" rx="3" fill="white" opacity=".5"/>
    <rect x="155" y="72" width="30" height="20" rx="3" fill="${ac}44"/>
    <rect x="157" y="74" width="26" height="12" rx="2" fill="white" opacity=".3"/>
    <line x1="170" y1="72" x2="170" y2="56" stroke="${ac}77" stroke-width="1.5"/>
    <ellipse cx="170" cy="54" rx="9" ry="5" fill="${ac}66"/>
    ${status==='Perlu Perhatian'?'<text x="100" y="22" font-size="18" text-anchor="middle">⚠️</text>':''}
  </svg>`;
}

// ===== RENDER UNITS =====
function renderUnits(filtered) {
  const data = filtered || units;
  const grid = document.getElementById('unitGrid');
  grid.innerHTML = '';
  if(data.length === 0) {
    grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--gray-400)">Tidak ada unit ditemukan</div>';
    return;
  }
  data.forEach((u, i) => {
    const realIdx = units.indexOf(u);
    const badgeMap = {
      'Tersedia':'badge-tersedia','Sisa 1 Kamar':'badge-sisa',
      'Terisi':'badge-terisi','Perlu Perhatian':'badge-perlu'
    };
    const badgeClass = badgeMap[u.status] || 'badge-tersedia';
    const showPrice = i < 2;
    const isEditStatus = u.status === 'Terisi';
    const isBroken = u.status === 'Perlu Perhatian';
    const formattedPrice = Number(u.harga).toLocaleString('id-ID');

    grid.innerHTML += `
    <div class="unit-card">
      <div class="card-img">
        ${getRoomSVG(realIdx, u.status)}
        <span class="card-badge ${badgeClass}" style="position:absolute;top:8px;right:8px">${u.status}</span>
      </div>
      <div class="card-body">
        <div class="card-title">
          <span>${u.id}</span>
        </div>
        <div class="card-sub">KostKita - ${u.lokasi} (Tipe ${u.tipe}, AC)</div>
        <div class="card-loc">📍 KostKita - ${u.lokasi}</div>
        <div class="card-feats">
          <div class="feat">❄️ AC</div>
          <div class="feat">📶 WiFi</div>
          <div class="feat">🚿 K.Mandi</div>
        </div>
        <div class="card-tarif">
          <div>
            <div style="font-size:10px;color:var(--gray-500)">Tarif Saat Ini:</div>
            <div class="card-price">Rp ${formattedPrice} <span>/bulan</span></div>
          </div>
          <button class="edit-icon" onclick="openEditUnit(${realIdx})" title="Edit unit">✏️</button>
        </div>
        <div class="card-actions">
          ${isEditStatus
            ? `<button class="btn btn-outline btn-sm" onclick="openEditStatus(${realIdx})">Edit Status ▾</button>`
            : isBroken
              ? `<button class="btn btn-sm" style="flex:1;justify-content:center;background:#FEF3C7;color:#92400E;border:1.5px solid #F59E0B" onclick="openLaporan('${u.id}')">🔧 Laporan Perbaikan</button>`
              : `<button class="btn btn-outline btn-sm" onclick="openEditUnit(${realIdx})">✏️ Edit Unit</button>`
          }
          <button class="btn btn-outline btn-sm" onclick="deleteUnit(${realIdx})">🗑</button>
        </div>
      </div>
    </div>`;
  });
}

// ===== RENDER ROOM GRID SIDEBAR =====
function renderRoomGrid() {
  const rg = document.getElementById('roomGridSide');
  rg.innerHTML = '';
  const statusMap = {
    'Tersedia':'rc-available','Sisa 1 Kamar':'rc-pending',
    'Terisi':'rc-occupied','Perlu Perhatian':'rc-attention'
  };
  units.forEach(u => {
    const cls = statusMap[u.status] || 'rc-available';
    rg.innerHTML += `<div class="room-chip ${cls}" style="position:relative" title="${u.id}: ${u.status}${u.penghuni?' - '+u.penghuni:''}">${u.id}<span class="room-tooltip">${u.status}${u.penghuni?' | '+u.penghuni:''}</span></div>`;
  });
  // Update stats
  const available = units.filter(u=>u.status==='Tersedia').length;
  const occupied = units.filter(u=>u.status==='Terisi').length;
  const pending = units.filter(u=>u.status==='Sisa 1 Kamar').length;
  document.getElementById('occupancyStats').textContent = `Tersedia: ${available} | Terisi: ${occupied} | Dipesan: ${pending} | Total: ${units.length}`;
}

// ===== RENDER TRANSACTIONS =====
function renderTransactions() {
  const tb = document.getElementById('txBody');
  tb.innerHTML = '';
  transactions.forEach(t => {
    const bayarClass = t.bayar === 'Lunas' ? 'pill-lunas' : 'pill-pending';
    const pemClass = t.pemesanan === 'Confirmed' ? 'pill-confirmed' : 'pill-pending';
    const aksiClass = t.aksi.includes('Verifikasi') ? 'pill-verif' : 'pill-cetak';
    tb.innerHTML += `<tr>
      <td><strong>${t.id}</strong></td>
      <td>${t.penghuni}</td>
      <td>${t.kamar}</td>
      <td>${t.checkin}</td>
      <td>${t.durasi}</td>
      <td>${t.total}</td>
      <td><span class="pill ${bayarClass}">${t.bayar}</span></td>
      <td><span class="pill ${pemClass}">${t.pemesanan}</span></td>
      <td><span class="pill ${aksiClass} pill-action" onclick="handleTxAction('${t.id}','${t.aksi}')">${t.aksi}</span></td>
    </tr>`;
  });
}

// ===== FILTERS =====
function applyFilters() {
  const lok = document.getElementById('filterLokasi').value;
  const tipe = document.getElementById('filterTipe').value;
  const status = document.getElementById('filterStatus').value;
  const bayar = document.getElementById('filterBayar').value;
  const filtered = units.filter(u => {
    if(lok && !u.lokasi.includes(lok)) return false;
    if(tipe && u.tipe !== tipe) return false;
    if(status && u.status !== status) return false;
    if(bayar && u.bayar !== bayar) return false;
    return true;
  });
  renderUnits(filtered);
}

// ===== MODAL HELPERS =====
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(o => {
  o.addEventListener('click', e => { if(e.target === o) o.classList.remove('open'); });
});

// ===== ADD/EDIT UNIT =====
function openAddUnit() {
  editIndex = null;
  document.getElementById('modalTitle').textContent = 'Tambah Unit Baru';
  document.getElementById('fRoomId').value = '';
  document.getElementById('fTipe').value = 'Tipe A';
  document.getElementById('fLokasi').value = 'KostKita - Ampera';
  document.getElementById('fFasilitas').value = 'AC, Kamar Mandi Dalam';
  document.getElementById('fHarga').value = '';
  document.getElementById('fBayar').value = 'Bulanan';
  document.getElementById('fStatus').value = 'Tersedia';
  document.getElementById('fPenghuni').value = '';
  document.getElementById('fCatatan').value = '';
  openModal('unitModal');
}

function openEditUnit(idx) {
  editIndex = idx;
  const u = units[idx];
  document.getElementById('modalTitle').textContent = `Edit Unit ${u.id}`;
  document.getElementById('fRoomId').value = u.id;
  document.getElementById('fTipe').value = `Tipe ${u.tipe}`;
  document.getElementById('fFasilitas').value = u.fasilitas;
  document.getElementById('fHarga').value = u.harga;
  document.getElementById('fBayar').value = u.bayar;
  document.getElementById('fStatus').value = u.status;
  document.getElementById('fPenghuni').value = u.penghuni;
  document.getElementById('fCatatan').value = u.catatan;
  openModal('unitModal');
}

function saveUnit() {
  const id = document.getElementById('fRoomId').value.trim();
  const tipe = document.getElementById('fTipe').value.replace('Tipe ','');
  const lokasi = document.getElementById('fLokasi').value.replace('KostKita - ','');
  const fasilitas = document.getElementById('fFasilitas').value;
  const harga = parseInt(document.getElementById('fHarga').value) || 2100000;
  const bayar = document.getElementById('fBayar').value;
  const status = document.getElementById('fStatus').value;
  const penghuni = document.getElementById('fPenghuni').value.trim();
  const catatan = document.getElementById('fCatatan').value.trim();
  if(!id) { showToast('Nomor kamar wajib diisi!','error'); return; }
  const unit = {id,tipe,lokasi,fasilitas,harga,bayar,status,penghuni,catatan};
  if(editIndex !== null) {
    units[editIndex] = unit;
    showToast(`✅ Unit ${id} berhasil diperbarui`,'success');
  } else {
    units.push(unit);
    showToast(`✅ Unit ${id} berhasil ditambahkan`,'success');
  }
  closeModal('unitModal');
  renderUnits();
  renderRoomGrid();
}

// ===== EDIT STATUS =====
function openEditStatus(idx) {
  editStatusIndex = idx;
  const u = units[idx];
  document.getElementById('sRoomLabel').textContent = u.id;
  document.getElementById('sStatus').value = u.status;
  document.getElementById('sPenghuni').value = u.penghuni;
  openModal('statusModal');
}

function saveStatus() {
  const u = units[editStatusIndex];
  u.status = document.getElementById('sStatus').value;
  u.penghuni = document.getElementById('sPenghuni').value;
  showToast(`✅ Status ${u.id} diperbarui ke "${u.status}"`, 'success');
  closeModal('statusModal');
  renderUnits();
  renderRoomGrid();
}

// ===== LAPORAN PERBAIKAN =====
function openLaporan(roomId) {
  document.getElementById('lRoomId').value = roomId;
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('lTanggal').value = today;
  openModal('laporanModal');
}

function saveLaporan() {
  const room = document.getElementById('lRoomId').value;
  const jenis = document.getElementById('lJenis').value;
  const prio = document.getElementById('lPrioritas').value;
  showToast(`📋 Laporan perbaikan ${room} (${jenis}, ${prio}) berhasil dikirim`, 'success');
  closeModal('laporanModal');
}

// ===== DELETE UNIT =====
function deleteUnit(idx) {
  const u = units[idx];
  if(confirm(`Hapus unit ${u.id}?`)) {
    units.splice(idx, 1);
    showToast(`🗑 Unit ${u.id} dihapus`, 'error');
    renderUnits();
    renderRoomGrid();
  }
}

// ===== TX ACTION =====
function handleTxAction(id, aksi) {
  if(aksi.includes('Verifikasi')) {
    showToast(`✅ Pembayaran transaksi ${id} berhasil diverifikasi`, 'success');
  } else {
    showToast(`🖨 Mencetak invoice transaksi ${id}...`, 'success');
    setTimeout(()=>{ window.print && window.print(); }, 500);
  }
}

// ===== TOAST =====
function showToast(msg, type='success') {
  const c = document.getElementById('toastContainer');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.textContent = msg;
  c.appendChild(t);
  setTimeout(() => t.remove(), 3500);
}

// ===== NAV TABS =====
function showTab(tab, el) {
  document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
  el.classList.add('active');
  showToast(`📂 Halaman "${el.textContent}" akan segera hadir`, 'success');
}

// ===== NOTIF =====
function toggleNotif() {
  showToast('🔔 3 notifikasi baru: pembayaran pending & laporan perbaikan', 'success');
}

// ===== INIT =====
renderUnits();
renderRoomGrid();
renderTransactions();
</script>
</body>
</html>