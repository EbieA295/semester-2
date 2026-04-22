#include <stdio.h>
#include <string.h>

#define MAX 5 // Menentukan batas maksimal riwayat (misal 5)

// Struktur Stack menggunakan Array
struct BrowserStack {
    char url[MAX][100]; // Array 2D untuk menyimpan string URL
    int top;            // Indeks posisi teratas
};

// Inisialisasi stack
void init(struct BrowserStack *s) {
    s->top = -1; // -1 berarti stack kosong
}

// 1. Operasi PUSH (Menambah halaman ke tumpukan)
void push(struct BrowserStack *s, char urlBaru[]) {
    if (s->top == MAX - 1) {
        printf("Riwayat Penuh! Tidak bisa menyimpan: %s\n", urlBaru);
    } else {
        s->top++;
        strcpy(s->url[s->top], urlBaru);
        printf("Mengunjungi: %s\n", urlBaru);
    }
}

// 2. Operasi POP (Kembali/Back)
void pop(struct BrowserStack *s) {
    if (s->top == -1) {
        printf("Tidak ada riwayat untuk kembali.\n");
    } else {
        printf("Menekan Back... Keluar dari: %s\n", s->url[s->top]);
        s->top--; // Cukup kurangi indeks top
    }
}

// 3. Tampilkan Riwayat
void tampilkanRiwayat(struct BrowserStack s) {
    printf("\nRiwayat (Top ke Bottom):\n");
    if (s.top == -1) {
        printf("(Kosong)\n");
        return;
    }
    for (int i = s.top; i >= 0; i--) {
        printf("Posisi %d: %s\n", i, s.url[i]);
    }
    printf("\n");
}

int main() {
    struct BrowserStack riwayat;
    init(&riwayat);

    // Sesuai Skenario
    push(&riwayat, "google.com");
    push(&riwayat, "youtube.com");
    push(&riwayat, "github.com");

    tampilkanRiwayat(riwayat);

    pop(&riwayat);
    
    printf("Setelah menekan Back:");
    tampilkanRiwayat(riwayat);

    return 0;
}