#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Struktur Data Lagu
struct Lagu {
    char penyanyi[50];
    char album[50];
    int jumlahSingle;
    struct Lagu *next;
};

struct Lagu *head = NULL;
struct Lagu *tail = NULL;

// Fungsi Helper membuat node
struct Lagu* buatNode(char penyanyi[], char album[], int jumlah) {
    struct Lagu *newNode = (struct Lagu*)malloc(sizeof(struct Lagu));
    strcpy(newNode->penyanyi, penyanyi);
    strcpy(newNode->album, album);
    newNode->jumlahSingle = jumlah;
    newNode->next = NULL;
    return newNode;
}

// 1. Tambah di Awal (Add First)
void addFirst(char penyanyi[], char album[], int jumlah) {
    struct Lagu *newNode = buatNode(penyanyi, album, jumlah);
    if (head == NULL) {
        head = tail = newNode;
        tail->next = head; // Melingkar ke head
    } else {
        newNode->next = head;
        head = newNode;
        tail->next = head; // Tail selalu menunjuk ke head baru
    }
}

// 2. Tambah di Akhir (Add Last)
void addLast(char penyanyi[], char album[], int jumlah) {
    struct Lagu *newNode = buatNode(penyanyi, album, jumlah);
    if (head == NULL) {
        head = tail = newNode;
        tail->next = head;
    } else {
        tail->next = newNode;
        tail = newNode;
        tail->next = head; // Melingkar kembali ke head
    }
}

// 3. Hapus Data Pertama
void hapusPertama() {
    if (head == NULL) return;
    if (head == tail) {
        free(head);
        head = tail = NULL;
    } else {
        struct Lagu *temp = head;
        head = head->next;
        tail->next = head; // Update circular connection
        free(temp);
    }
}

// 4. Tampilkan Playlist
void tampilkanPlaylist() {
    if (head == NULL) {
        printf("Playlist Kosong.\n");
        return;
    }
    struct Lagu *curr = head;
    printf("\n--- DAFTAR PLAYLIST LAGU ---\n");
    do {
        printf("Penyanyi: %s | Album: %s | Single: %d\n", curr->penyanyi, curr->album, curr->jumlahSingle);
        curr = curr->next;
    } while (curr != head); // Berhenti jika sudah kembali ke head
    printf("----------------------------\n");
}

int main() {
    // Data Awal: Westlife
    addLast("Westlife", "Coast to Coast", 5);

    // Skenario 1: Tambah Nadin Amizah di awal
    addFirst("Nadin Amizah", "Selamat Ulang Tahun", 10);

    // Skenario 2: Tambah Sal Priadi di akhir
    addLast("Sal Priadi", "Markers and Such", 15);

    // Skenario 3: Tambah Penyanyi Favorit (Contoh: Hindia)
    addLast("Hindia", "Menari Dengan Bayangan", 12);

    printf("Playlist sebelum penghapusan:");
    tampilkanPlaylist();

    // Skenario 4: Hapus data penyanyi pertama yang sebelumnya telah ditambahkan
    // Karena instruksi minta hapus data penyanyi pertama (Westlife), kita sesuaikan urutannya
    // Namun biasanya instruksi ini merujuk pada menghapus node 'head' saat ini.
    hapusPertama(); 

    printf("Playlist setelah penghapusan data pertama:");
    tampilkanPlaylist();

    return 0;
}