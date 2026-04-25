<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KostKita - Solusi Manajemen Kost</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --orange: #F47B20;
    --orange-light: #FFF3E8;
    --green: #28A745;
    --red: #DC3545;
    --amber: #FD7E14;
    --gray-50: #F9FAFB;
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-400: #9CA3AF;
    --gray-600: #4B5563;
    --gray-800: #1F2937;
    --white: #FFFFFF;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.10);
    --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
  }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--gray-50);
    color: var(--gray-800);
    font-size: 14px;
  }

  /* NAVBAR */
  nav {
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
    padding: 0 32px;
    display: flex;
    align-items: center;
    height: 60px;
    gap: 32px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: var(--shadow-sm);
  }

  .logo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 800;
    font-size: 20px;
    color: var(--gray-800);
    text-decoration: none;
    margin-right: 12px;
  }

  .logo-icon {
    width: 36px;
    height: 36px;
    background: var(--orange);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
  }

  .nav-links {
    display: flex;
    gap: 4px;
    flex: 1;
  }

  .nav-links a {
    text-decoration: none;
    color: var(--gray-600);
    font-weight: 500;
    font-size: 14px;
    padding: 6px 14px;
    border-radius: 6px;
    transition: all 0.15s;
  }

  .nav-links a:hover { background: var(--gray-100); color: var(--gray-800); }
  .nav-links a.active { color: var(--orange); font-weight: 600; }

  .nav-user {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 6px 12px;
    border-radius: 8px;
    border: 1px solid var(--gray-200);
    font-weight: 500;
    color: var(--gray-700);
    transition: background 0.15s;
  }
  .nav-user:hover { background: var(--gray-50); }

  .avatar {
    width: 32px; height: 32px;
    background: var(--gray-200);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
  }

  /* MAIN LAYOUT */
  .main-wrapper {
    display: flex;
    gap: 24px;
    padding: 28px 32px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .content-area { flex: 1; min-width: 0; }

  /* HERO / SEARCH SECTION */
  .hero-section {
    background: var(--white);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 24px;
    box-shadow: var(--shadow-sm);
  }

  .hero-section h1 {
    font-size: 26px;
    font-weight: 800;
    color: var(--gray-800);
    margin-bottom: 20px;
    line-height: 1.2;
  }

  .search-bar {
    display: flex;
    gap: 12px;
    align-items: flex-end;
    flex-wrap: wrap;
  }

  .search-field {
    display: flex;
    flex-direction: column;
    gap: 5px;
    flex: 1;
    min-width: 130px;
  }

  .search-field label {
    font-size: 11px;
    font-weight: 600;
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .search-field select,
  .search-field input {
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    padding: 9px 12px;
    font-size: 13px;
    font-family: inherit;
    color: var(--gray-800);
    background: var(--white);
    outline: none;
    cursor: pointer;
    transition: border-color 0.15s;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%239CA3AF' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 28px;
  }

  .search-field input { background-image: none; padding-right: 12px; }

  .search-field select:focus,
  .search-field input:focus { border-color: var(--orange); }

  .search-btn {
    background: var(--orange);
    color: white;
    border: none;
    border-radius: 10px;
    width: 44px; height: 44px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    transition: background 0.15s, transform 0.1s;
    flex-shrink: 0;
    align-self: flex-end;
  }
  .search-btn:hover { background: #e06b15; }
  .search-btn:active { transform: scale(0.95); }

  /* REKOMENDASI */
  .section-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 16px;
  }

  .kost-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
  }

  .kost-card {
    background: var(--white);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-100);
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
  }
  .kost-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }

  .card-img {
    width: 100%;
    height: 110px;
    object-fit: cover;
    background: var(--gray-200);
    position: relative;
    overflow: hidden;
  }

  .card-img-placeholder {
    width: 100%;
    height: 110px;
    position: relative;
    overflow: hidden;
  }

  .card-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    padding: 3px 8px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    z-index: 2;
  }

  .badge-tersedia { background: var(--green); color: white; }
  .badge-sisa { background: var(--amber); color: white; }

  .card-body { padding: 12px; }

  .card-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 2px;
  }

  .card-sub {
    font-size: 11px;
    color: var(--gray-400);
    margin-bottom: 4px;
  }

  .card-location {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    color: var(--gray-600);
    margin-bottom: 8px;
  }

  .card-features {
    display: flex;
    gap: 8px;
    margin-bottom: 8px;
    flex-wrap: wrap;
  }

  .feat {
    display: flex;
    align-items: center;
    gap: 3px;
    font-size: 11px;
    color: var(--gray-600);
  }

  .card-price {
    font-size: 13px;
    font-weight: 700;
    color: var(--orange);
    margin-bottom: 10px;
  }

  .card-price span { font-weight: 400; color: var(--gray-400); font-size: 11px; }

  .btn-detail {
    display: block;
    width: 100%;
    text-align: center;
    padding: 8px;
    border: 1.5px solid var(--gray-200);
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    color: var(--gray-700);
    cursor: pointer;
    background: white;
    transition: all 0.15s;
    font-family: inherit;
  }
  .btn-detail:hover { border-color: var(--orange); color: var(--orange); background: var(--orange-light); }

  /* room image SVGs */
  .room-svg {
    width: 100%; height: 110px;
    display: block;
  }

  /* RIGHT SIDEBAR */
  .sidebar { width: 280px; flex-shrink: 0; }

  .sidebar-card {
    background: var(--white);
    border-radius: 12px;
    padding: 16px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-100);
    margin-bottom: 16px;
  }

  .sidebar-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: 12px;
  }

  /* STATUS LEGEND */
  .legend {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
    flex-wrap: wrap;
  }

  .legend-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: var(--gray-600);
  }

  .legend-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
  }

  /* ROOM GRID */
  .room-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 5px;
    max-height: 240px;
    overflow-y: auto;
    padding-right: 2px;
  }

  .room-grid::-webkit-scrollbar { width: 4px; }
  .room-grid::-webkit-scrollbar-track { background: var(--gray-100); border-radius: 4px; }
  .room-grid::-webkit-scrollbar-thumb { background: var(--gray-300); border-radius: 4px; }

  .room-btn {
    padding: 4px 0;
    border: none;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    text-align: center;
    transition: opacity 0.15s;
    font-family: inherit;
  }
  .room-btn:hover { opacity: 0.85; }
  .room-available { background: var(--green); color: white; }
  .room-occupied { background: var(--red); color: white; }
  .room-pending { background: var(--amber); color: white; }

  /* BOOKING HISTORY */
  .booking-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
  }

  .booking-table th {
    text-align: left;
    padding: 4px 6px;
    color: var(--gray-400);
    font-weight: 600;
    border-bottom: 1px solid var(--gray-100);
    font-size: 10px;
    text-transform: uppercase;
  }

  .booking-table td {
    padding: 6px 6px;
    border-bottom: 1px solid var(--gray-100);
    color: var(--gray-700);
  }

  .status-pill {
    display: inline-block;
    padding: 2px 7px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 600;
  }
  .status-confirmed { background: #D1FAE5; color: #065F46; }
  .status-pending { background: #FEF3C7; color: #92400E; }
  .status-cancelled { background: #FEE2E2; color: #991B1B; }

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
    <a href="#" class="active">Cari Kost</a>
    <a href="#">Promo</a>
    <a href="#">Tentang Kami</a>
    <a href="#">Bantuan</a>
  </div>
  <div class="nav-user">
    <div class="avatar">👤</div>
    Halo, EbieA ▾
  </div>
</nav>

<!-- MAIN -->
<div class="main-wrapper">

  <!-- LEFT CONTENT -->
  <div class="content-area">

    <!-- HERO SEARCH -->
    <div class="hero-section">
      <h1>Temukan Kost Impianmu Tanpa Ribet</h1>
      <div class="search-bar">
        <div class="search-field">
          <label>Lokasi</label>
          <select>
            <option>Semua Jenis Kost</option>
            <option>Padang</option>
            <option>Dekat UNP</option>
            <option>Dekat UNAND</option>
            <option>Pessel</option>
            <option>Bukit Tinggi</option>
          </select>
        </div>
        <div class="search-field">
          <label>Range Harga</label>
          <input type="text" value="Rp 1.5jt - 3jt" />
        </div>
        <div class="search-field">
          <label>Fasilitas</label>
          <select>
            <option>AC, Kamar Mandi Dalam</option>
            <option>AC saja</option>
            <option>Kamar Mandi Dalam</option>
            <option>Tanpa AC</option>
          </select>
        </div>
        <div class="search-field">
          <label>Tipe</label>
          <select>
            <option>Putra</option>
            <option>Putri</option>
          </select>
        </div>
        <button class="search-btn">🔍</button>
      </div>
    </div>

    <!-- REKOMENDASI -->
    <div class="section-title">Rekomendasi Kost</div>
    <div class="kost-grid" id="kostGrid"></div>

  </div><!-- end content-area -->

  <!-- RIGHT SIDEBAR -->
  <div class="sidebar">

    <!-- STATUS KETERSEDIAAN -->
    <div class="sidebar-card">
      <div class="sidebar-title">Status Ketersediaan Kamar</div>
      <div class="legend">
        <div class="legend-item"><div class="legend-dot" style="background:var(--green)"></div>Tersedia</div>
        <div class="legend-item"><div class="legend-dot" style="background:var(--red)"></div>Terisi</div>
        <div class="legend-item"><div class="legend-dot" style="background:var(--amber)"></div>Dipesan</div>
      </div>
      <div class="room-grid" id="roomGrid"></div>
    </div>

    <!-- RIWAYAT BOOKING -->
    <div class="sidebar-card">
      <div class="sidebar-title">Riwayat Booking Saya</div>
      <table class="booking-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Check-in</th>
            <th>Durasi</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="bookingBody"></tbody>
      </table>
    </div>

  </div><!-- end sidebar -->
</div>

<script>
  // --- KOST CARDS DATA ---
  const rooms = [
    { id:'A101', type:'Tersedia', name:'A101', loc:'KostKita - Brother', sub:'(Tipe A, AC)', price:'2.100.000', badge:'tersedia' },
    { id:'B201', type:'Sisa 1 Kamar', name:'B201', loc:'KostKita - Brother', sub:'(Tipe A, AC)', price:'2.100.000', badge:'sisa' },
    { id:'C301', type:'Tersedia', name:'C301', loc:'KostKita - Brother', sub:'(Tipe A, AC)', price:'2.100.000', badge:'tersedia' },
    { id:'A101', type:'Tersedia', name:'A101', loc:'KostKita - Brother', sub:'(Tipe A, AC)', price:null, badge:'tersedia' },
    { id:'B201', type:'Sisa 1 Kamar', name:'B201', loc:'KostKita - Brother', sub:'(Tipe A, AC)', price:null, badge:'sisa' },
    { id:'C301', type:'Tersedia', name:'C301', loc:'KostKita - Brother', sub:'(Tipe A, AC)', price:null, badge:'tersedia' },
  ];

  const roomColors = [
    ['#E8F5E9','#2E7D32'], ['#FFF3E0','#E65100'], ['#FAFAFA','#424242'],
    ['#E3F2FD','#0D47A1'], ['#F3E5F5','#4A148C'], ['#E0F2F1','#004D40'],
  ];

  function getRoomSVG(idx) {
    const c = roomColors[idx % roomColors.length];
    return `<svg class="room-svg" viewBox="0 0 200 110" xmlns="http://www.w3.org/2000/svg">
      <rect width="200" height="110" fill="${c[0]}"/>
      <!-- floor -->
      <rect x="0" y="78" width="200" height="32" fill="${c[1]}22"/>
      <!-- window -->
      <rect x="130" y="18" width="50" height="35" rx="3" fill="white" opacity="0.6"/>
      <line x1="155" y1="18" x2="155" y2="53" stroke="${c[1]}44" stroke-width="1.5"/>
      <line x1="130" y1="35" x2="180" y2="35" stroke="${c[1]}44" stroke-width="1.5"/>
      <!-- bed -->
      <rect x="20" y="55" width="80" height="30" rx="4" fill="${c[1]}66"/>
      <rect x="20" y="55" width="80" height="14" rx="4" fill="${c[1]}99"/>
      <rect x="25" y="59" width="30" height="8" rx="2" fill="white" opacity="0.5"/>
      <rect x="60" y="59" width="30" height="8" rx="2" fill="white" opacity="0.5"/>
      <!-- pillow detail -->
      <!-- desk -->
      <rect x="155" y="62" width="30" height="18" rx="3" fill="${c[1]}55"/>
      <rect x="157" y="64" width="26" height="10" rx="2" fill="white" opacity="0.3"/>
      <!-- lamp -->
      <line x1="168" y1="62" x2="168" y2="45" stroke="${c[1]}77" stroke-width="1.5"/>
      <ellipse cx="168" cy="43" rx="8" ry="4" fill="${c[1]}66"/>
    </svg>`;
  }

  // Render kost cards
  const grid = document.getElementById('kostGrid');
  rooms.forEach((r, i) => {
    const badgeClass = r.badge === 'tersedia' ? 'badge-tersedia' : 'badge-sisa';
    const badgeText = r.badge === 'tersedia' ? 'Tersedia' : 'Sisa 1 Kamar';
    const priceBlock = r.price
      ? `<div class="card-price">Rp ${r.price} <span>/bulan</span></div>`
      : '';

    grid.innerHTML += `
      <div class="kost-card">
        <div class="card-img-placeholder" style="position:relative">
          ${getRoomSVG(i)}
          <span class="card-badge ${badgeClass}" style="position:absolute;top:8px;right:8px">${badgeText}</span>
        </div>
        <div class="card-body">
          <div class="card-title">${r.name}</div>
          <div class="card-sub">KostKita - Brother ${r.sub}</div>
          <div class="card-location">📍 KostKita - Brother</div>
          <div class="card-features">
            <div class="feat">❄️ AC</div>
            <div class="feat">📶 WiFi</div>
            <div class="feat">🚿 K.Mandi</div>
          </div>
          ${priceBlock}
          <button class="btn-detail">Cek Detail</button>
        </div>
      </div>`;
  });

  // --- ROOM STATUS GRID ---
  const roomData = [
    {id:'A101',status:'available'},{id:'A102',status:'occupied'},{id:'A102',status:'pending'},
    {id:'A101',status:'available'},{id:'A102',status:'occupied'},{id:'A102',status:'pending'},
    {id:'A101',status:'available'},{id:'B102',status:'occupied'},{id:'A102',status:'occupied'},
    {id:'A101',status:'available'},{id:'B102',status:'occupied'},{id:'B201',status:'occupied'},
    {id:'B201',status:'available'},{id:'B201',status:'available'},{id:'B201',status:'pending'},
    {id:'C201',status:'available'},{id:'C301',status:'occupied'},{id:'C301',status:'pending'},
    {id:'C301',status:'available'},{id:'C301',status:'pending'},{id:'C301',status:'occupied'},
    {id:'C301',status:'available'},{id:'C301',status:'pending'},{id:'C301',status:'pending'},
    {id:'D201',status:'available'},{id:'D301',status:'occupied'},{id:'D302',status:'pending'},
  ];

  const rg = document.getElementById('roomGrid');
  roomData.forEach(r => {
    const cls = r.status === 'available' ? 'room-available' : r.status === 'occupied' ? 'room-occupied' : 'room-pending';
    rg.innerHTML += `<button class="room-btn ${cls}">${r.id}</button>`;
  });

  // --- BOOKING TABLE ---
  const bookings = [
    {id:'A101', checkin:'29/03/2022', dur:'10 min', status:'confirmed'},
    {id:'B201', checkin:'29/03/2022', dur:'20 min', status:'pending'},
    {id:'C301', checkin:'29/03/2022', dur:'30 min', status:'cancelled'},
    {id:'D101', checkin:'01/04/2022', dur:'1 bln', status:'confirmed'},
  ];

  const tb = document.getElementById('bookingBody');
  bookings.forEach(b => {
    const sClass = b.status === 'confirmed' ? 'status-confirmed' : b.status === 'pending' ? 'status-pending' : 'status-cancelled';
    const sLabel = b.status === 'confirmed' ? 'Confirmed' : b.status === 'pending' ? 'Pending' : 'Cancelled';
    tb.innerHTML += `<tr>
      <td><strong>${b.id}</strong></td>
      <td>${b.checkin}</td>
      <td>${b.dur}</td>
      <td><span class="status-pill ${sClass}">${sLabel}</span></td>
    </tr>`;
  });
</script>
</body>
</html>