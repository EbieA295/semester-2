import requests
import csv

def ambil_dan_simpan():
    url = "https://jsonplaceholder.typicode.com/users"
    print("[*] sedamh menngambi 10 data user..")

    try:
        respon = requests.get(url)
        data_users = respon.json()

        with open('data_mahasiswa_dumm.csv', 'w', newline='') as f:
            kolom = ['ID', 'Nama', 'Email', 'Perusahaan', 'Kota']
            writer = csv.DictWriter(f, fieldnames=kolom)

            writer.writeheader()

            for user in data_users:
                writer.writerow({
                    'ID': user['id'],
                    'Nama': user['name'],
                    'Email': user['email'],
                    'Perusahaan': user['company']['name'],
                    'Kota': user['address']['city']
                })
        
        print("\n[V] Berhasil!! file 'data_mahasisewa_dummy.csv' telah dibuat.")
        print("[*] silakan cek folder kamu dan buka filenya pakai excel.")
    
    except Exception as e:
        print(f"[!] Terajadi kesalaham: {e}")

ambil_dan_simpan() 