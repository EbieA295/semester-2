import requests #memnaggil library requests untuk melakukan permintaan HTTP

def cek_status():
    url = input("masukkan URL (contoh: https://google.com): ")

    print(f"[*] sedang mengecek {url}..")
          
    try:
        respon = requests.get(url, timeout=5)
            
        if respon.status_code == 200:
            print(f"[+] Website {url} aman dan AKTIF!")
        elif respon.status_code == 404:
            print(f"[-] Website {url} tidak ditemukan (404).")
        else:
            print(f"[-] Website {url} merespon dengan kode: {respon.status_code}")

    except:
            print(f"[!] gagal terhubung: pastikan url pakai 'https://' dan internet mu menyala.")

cek_status()