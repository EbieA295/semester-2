import requests

def scan_directory(url, file_wordlist):
    url = url.rstrip('/')
    hasil_temuan = []

    print(f"[*] Target: {url}")
    print(f"[*] Menggunakan wordlist: {file_wordlist}")
    print("-" * 30)

    try:
        with open(file_wordlist, 'r') as file:
            for baris in file:
                folder = baris.strip()
                if not folder: continue # Lewati baris kosong
                
                link_lengkap = f"{url}/{folder}"
                
                try:
                    # Kita tambah headers agar dikira browser asli
                    headers = {'User-Agent': 'Mozilla/5.0'}
                    respon = requests.get(link_lengkap, headers=headers, timeout=5)
                    
                    # Print semua biar kita tahu skripnya KERJA
                    print(f"[?] Mencoba: /{folder} -> Status: {respon.status_code}")
                    
                    if respon.status_code == 200:
                        print(f"    [+] KETEMU!")
                        hasil_temuan.append(link_lengkap)
                except Exception as e:
                    print(f"[!] Error saat akses {folder}: {e}")

        # PAKSA buat file walaupun kosong buat ngetes
        with open("hasil_scan.txt", "w") as hasil_file:
            if hasil_temuan:
                for link in hasil_temuan:
                    hasil_file.write(link + "\n")
                print(f"\n[*] SELESAI! {len(hasil_temuan)} hasil disimpan.")
            else:
                hasil_file.write("Tidak ada folder 200 yang ditemukan saat scan.")
                print(f"\n[*] SELESAI! Tapi tidak ada folder 200 yang ditemukan.")

    except FileNotFoundError:
        print(f"[!] Error: File {file_wordlist} tidak ada!")

target = "https://juice-shop.herokuapp.com"
scan_directory(target, "kamus.txt")