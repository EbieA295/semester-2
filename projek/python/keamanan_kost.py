def cek_akses():
    print("== SISTEM KEAMANAN KOST ==")

    nama = input("Masukkan nama anda: ")
    peran = input("Status (penghuni/tamu): "). lower()

    if nama == "admin":
        print(f"\n[V], mantap admin!! admin jir")

    if peran == 'penghuni':
        print(f"\n[V] Akses DITERIMA, Selamat datang kembali, {nama}!")
        print(f" Pintu kamar otomoatis terbuka.")
    elif peran == 'tami':
        print(f"\n[!] akses TERBATAS. Silakan tuggu di lobi, {nama}")
        print("Penjaga sedang kami hubungi.")
    elif peran == 'admin':
        print(f"\n[V], welkambek minnn!!")
    else:
        print("\n[X] Akses DITOLAK! Status tidak dikenal.")

cek_akses()