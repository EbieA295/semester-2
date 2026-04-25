<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KostKita - Panel Manajemen Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Gabungkan semua CSS dari file admin.blade.php Anda di sini */
        /* ... (Gunakan CSS variabel dan layouting yang sudah Anda buat sebelumnya) ... */
        :root { --orange: #F47B20; --gray-50: #F9FAFB; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--gray-50); margin: 0; }
        nav { background: white; border-bottom: 1.5px solid #E5E7EB; padding: 0 24px; display: flex; align-items: center; height: 62px; box-shadow: 0 2px 8px rgba(0,0,0,.07); }
        .logo { font-weight: 800; text-decoration: none; color: #111827; display: flex; align-items: center; gap: 10px; }
        .page { display: flex; gap: 20px; padding: 22px 24px; max-width: 1400px; margin: 0 auto; }
        .main-col { flex: 1; }
        .unit-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 14px; }
        .unit-card { background: white; border-radius: 12px; border: 1.5px solid #E5E7EB; overflow: hidden; }
        /* Badge Styles */
        .badge { padding: 3px 9px; border-radius: 20px; font-size: 10px; font-weight: 700; color: white; }
        .badge-tersedia { background: #22C55E; }
        .badge-terisi { background: #EF4444; }
        .badge-sisa { background: #F59E0B; }
    </style>
</head>
<body>

<nav>
    <a href="#" class="logo">🏠 KostKita</a>
</nav>

<div class="page">
    <div class="main-col">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>Panel Manajemen Kamar</h1>
            <button style="background: var(--orange); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">+ Tambah Unit</button>
        </div>

        <div class="unit-grid" id="unitGrid">
            </div>
    </div>
</div>

<script>
    // 1. Ambil data dari Laravel
    const units = @json($units ?? []);

    // Tambahkan ini untuk melihat apakah data benar-benar masuk ke browser
    console.log('Data Units dari Laravel:', units);

    // 2. Fungsi Render Kartu Kamar
    function renderUnits() {
        const grid = document.getElementById('unitGrid');
        if (!grid) return; // Keamanan agar tidak error jika ID tidak ketemu
        
        grid.innerHTML = '';

        // Pastikan units ada isinya
        if (!units || units.length === 0) {
            grid.innerHTML = `
                <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #9CA3AF;">
                    <span style="font-size: 48px;">🏠</span>
                    <p style="margin-top: 10px;">Belum ada data kamar di database db_koskita.</p>
                </div>`;
            return;
        }

        units.forEach(unit => {
            // Gunakan .toLowerCase() agar tidak sensitif terhadap huruf besar/kecil dari database
            const statusDb = unit.status ? unit.status.toLowerCase() : '';
            let statusClass = 'badge-tersedia'; // default
            let statusLabel = unit.status;

            if (statusDb === 'terisi') {
                statusClass = 'badge-terisi';
            } else if (statusDb === 'sisa 1 kamar' || statusDb === 'penuh') {
                statusClass = 'badge-sisa';
            }
            
            // Konversi harga ke angka untuk jaga-jaga jika di DB tersimpan sebagai string
            const hargaNominal = parseInt(unit.harga) || 0;

            grid.innerHTML += `
                <div class="unit-card">
                    <div style="height: 120px; background: #f3f4f6; position: relative; display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 40px;">🛏️</span>
                        <span class="badge ${statusClass}" style="position: absolute; top: 10px; right: 10px;">${statusLabel}</span>
                    </div>
                    <div style="padding: 15px;">
                        <div style="font-weight: 800; font-size: 16px;">${unit.id || 'Tanpa ID'}</div>
                        <div style="font-size: 12px; color: #6B7280;">KostKita - ${unit.lokasi || 'Lokasi belum diset'}</div>
                        <div style="margin-top: 10px; color: #F47B20; font-weight: 700;">
                            Rp ${hargaNominal.toLocaleString('id-ID')} <span style="font-size: 10px; color: #9CA3AF;">/bulan</span>
                        </div>
                        <div style="margin-top: 15px; display: flex; gap: 8px;">
                            <button style="flex: 1; padding: 8px; border: 1.5px solid #E5E7EB; background: white; border-radius: 6px; cursor: pointer;">Detail</button>
                            <button style="padding: 8px; border: 1.5px solid #EF4444; color: #EF4444; background: white; border-radius: 6px; cursor: pointer;">🗑️</button>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    document.addEventListener('DOMContentLoaded', renderUnits);
</script>
</body>
</html>