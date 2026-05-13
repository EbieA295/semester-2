import requests

url = "https://jsonplaceholder.typicode.com/posts/1"

try:
    respon = requests.get(url)

    data_user = respon.json()

    nama = data_user['name']
    email = data_user['email']
    kota = data_user['address']['city']

    print("-" * 30)
    print(f"Nama: {nama}")
    print(f"Email: {email}")
    print(f"Kota: {kota}")
    print("-" * 30)

except Exception as e:
    print(f"Error: {e}")