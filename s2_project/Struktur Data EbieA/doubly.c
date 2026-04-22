#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Struktur Data Anggota Keluarga
struct Keluarga {
    char nik[20];
    char nama[50];
    char hubungan[20];
    int usia;
    struct Keluarga *prev; // Pointer ke anggota sebelumnya
    struct Keluarga *next; // Pointer ke anggota setelahnya
};

struct Keluarga *head = NULL;
struct Keluarga *tail = NULL;

// Fungsi Helper untuk membuat node baru
struct Keluarga* buatNode(char nik[], char nama[], char hubungan[], int usia) {
    struct Keluarga *newNode = (struct Keluarga*)malloc(sizeof(struct Keluarga));
    strcpy(newNode->nik, nik);
    strcpy(newNode->nama, nama);
    strcpy(newNode->hubungan, hubungan);
    newNode->usia = usia;
    newNode->next = NULL;
    newNode->prev = NULL;
    return newNode;
}

// 1. Tambah Data Ayah di Awal (addFirst)
void addFirst(char nik[], char nama[], char hubungan[], int usia) {
    struct Keluarga *newNode = buatNode(nik, nama, hubungan, usia);
    if (head == NULL) {
        head = tail = newNode;
    } else {
        newNode->next = head;
        head->prev = newNode;
        head = newNode;
    }
}

// 2. Tambah Data Anak di Akhir (addLast)
void addLast(char nik[], char nama[], char hubungan[], int usia) {
    struct Keluarga *newNode = buatNode(nik, nama, hubungan, usia);
    if (head == NULL) {
        head = tail = newNode;
    } else {
        tail->next = newNode;
        newNode->prev = tail;
        tail = newNode;
    }
}

// 3. Hapus Anggota (Misal: Anak yang sudah menikah/keluar dari KK)
void hapusAnggota(char nama[]) {
    if (head == NULL) return;

    struct Keluarga *curr = head;
    while (curr != NULL && strcmp(curr->nama, nama) != 0) {
        curr = curr->next;
    }

    if (curr == NULL) {
        printf("Anggota dengan nama %s tidak ditemukan.\n", nama);
        return;
    }

    if (curr == head) {
        head = head->next;
        if (head != NULL) head->prev = NULL;
    } else if (curr == tail) {
        tail = tail->prev;
        tail->next = NULL;
    } else {
        curr->prev->next = curr->next;
        curr->next->prev = curr->prev;
    }
    free(curr);
    printf("Data %s berhasil dihapus dari KK.\n", nama);
}

// 4. Tampilkan Data dalam Bentuk Tabel
void tampilkanKK() {
    struct Keluarga *curr = head;
    printf("\n==================== DATA KARTU KELUARGA ====================\n");
    printf("%-15s | %-20s | %-12s | %-5s\n", "NIK", "Nama", "Hubungan", "Usia");
    printf("------------------------------------------------------------\n");
    while (curr != NULL) {
        printf("%-15s | %-20s | %-12s | %-3d th\n", curr->nik, curr->nama, curr->hubungan, curr->usia);
        curr = curr->next;
    }
    printf("============================================================\n\n");
}

int main() {
    // Skenario:
    // 1. Masukkan data Ibu sebagai data awal
    addFirst("123456789", "Siti Aminah", "Ibu", 42);

    // 2. Tambahkan data Ayah di awal (addFirst)
    addFirst("123456780", "Bambang", "Ayah", 45);

    // 3. Tambahkan data Anak-anak di akhir (addLast)
    addLast("123456781", "Eko", "Anak Pertama", 20);
    addLast("123456782", "Dwi", "Anak Kedua", 15);

    tampilkanKK();

    // 4. Simulasi hapus anggota (Eko sudah menikah/keluar KK)
    hapusAnggota("Eko");

    tampilkanKK();

    return 0;
}