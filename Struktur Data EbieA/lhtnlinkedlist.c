#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Struktur untuk Node Pasien
struct Pasien {
    char nama[50];
    int usia;
    struct Pasien *next;
};

// Pointer global untuk mengelola list
struct Pasien *head = NULL;
struct Pasien *tail = NULL;

// Fungsi membuat node baru (Helper)
struct Pasien* buatNode(char nama[], int usia) {
    struct Pasien *newNode = (struct Pasien*)malloc(sizeof(struct Pasien));
    strcpy(newNode->nama, nama);
    newNode->usia = usia;
    newNode->next = NULL;
    return newNode;
}

// 1. Pasien Baru / Biasa (Insert Last)
void tambahBiasa(char nama[], int usia) {
    struct Pasien *newNode = buatNode(nama, usia);
    if (head == NULL) {
        head = tail = newNode;
    } else {
        tail->next = newNode;
        tail = newNode;
    }
}

// 2. Pasien Darurat (Insert First)
void tambahDarurat(char nama[], int usia) {
    struct Pasien *newNode = buatNode(nama, usia);
    if (head == NULL) {
        head = tail = newNode;
    } else {
        newNode->next = head;
        head = newNode;
    }
}

// 3. Pasien Selesai Diperiksa (Delete First)
void hapusDepan() {
    if (head == NULL) {
        printf("Antrean kosong!\n");
        return;
    }
    struct Pasien *temp = head;
    head = head->next;
    if (head == NULL) tail = NULL;
    free(temp); // Menghapus memori
}

// 4. Batal (Delete Last)
void hapusBelakang() {
    if (head == NULL) return;
    if (head == tail) {
        free(head);
        head = tail = NULL;
    } else {
        struct Pasien *curr = head;
        while (curr->next != tail) {
            curr = curr->next;
        }
        free(tail);
        tail = curr;
        tail->next = NULL;
    }
}

// 5. Perbaikan Data (Update First Node)
void updatePasienPertama(char namaBaru[], int usiaBaru) {
    if (head != NULL) {
        strcpy(head->nama, namaBaru);
        head->usia = usiaBaru;
    }
}

// Fungsi menampilkan antrean
void tampilkanAntrean() {
    struct Pasien *curr = head;
    printf("\n=== DAFTAR ANTREAN KLINIK ===\n");
    if (curr == NULL) printf("(Antrean Kosong)\n");
    while (curr != NULL) {
        printf("[%s | %d th] -> ", curr->nama, curr->usia);
        curr = curr->next;
    }
    printf("NULL\n\n");
}

int main() {
    // Simulasi sesuai Skenario di Gambar:
    
    // 1. Pasien pertama: Budi, 45 tahun
    tambahBiasa("Budi", 45);
    
    // 2. Pasien darurat: Sinta, 30 tahun (Masuk ke paling depan)
    tambahDarurat("Sinta", 30);
    
    // 3. Pasien biasa: Rina, 27 tahun (Masuk ke belakang)
    tambahBiasa("Rina", 27);
    
    tampilkanAntrean(); // Output: Sinta -> Budi -> Rina
    
    // 4. Pasien pertama selesai diperiksa
    printf("--- Pasien pertama selesai diperiksa ---\n");
    hapusDepan();
    
    tampilkanAntrean(); // Output: Budi -> Rina

    return 0;
}