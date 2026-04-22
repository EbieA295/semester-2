#include <stdio.h>
#include <stdlib.h>
#include <string.h>

// Struktur Node untuk Stack
struct History {
    char url[100];
    struct History *next;
};

// Pointer 'top' untuk menandai puncak tumpukan
struct History *top = NULL;

// 1. Operasi PUSH (Mengunjungi Halaman Baru)
void push(char url[]) {
    struct History *newNode = (struct History*)malloc(sizeof(struct History));
    if (newNode == NULL) {
        printf("Memori penuh!\n");
        return;
    }
    strcpy(newNode->url, url);
    
    // Node baru menunjuk ke node yang sebelumnya ada di top
    newNode->next = top;
    // Top pindah ke node baru
    top = newNode;
    
    printf("Mengunjungi: %s\n", url);
}

// 2. Operasi POP (Menekan tombol 'Back')
void pop() {
    if (top == NULL) {
        printf("Tidak ada riwayat untuk kembali.\n");
        return;
    }
    
    struct History *temp = top;
    printf("Menekan Back... Kembali dari: %s\n", temp->url);
    
    // Pindahkan top ke node di bawahnya
    top = top->next;
    
    // Hapus node lama dari memori
    free(temp);
}

// 3. Operasi PEEK / TOP (Melihat halaman saat ini)
void peek() {
    if (top != NULL) {
        printf("Halaman saat ini: %s\n", top->url);
    } else {
        printf("Browser kosong.\n");
    }
}

// Tampilkan Seluruh Riwayat
void tampilkanRiwayat() {
    struct History *curr = top;
    printf("\nRiwayat (Top ke Bottom):\n");
    if (curr == NULL) printf("(Kosong)\n");
    
    while (curr != NULL) {
        printf("Top -> %s\n", curr->url);
        curr = curr->next;
    }
    printf("\n");
}

int main() {
    // Sesuai Skenario di Gambar:
    push("google.com");
    push("youtube.com");
    push("github.com");
    
    tampilkanRiwayat(); // Output: github -> youtube -> google
    
    peek(); // Melihat posisi paling atas
    
    pop(); // Simulasi tombol Back
    tampilkanRiwayat(); // Sekarang youtube menjadi yang teratas
    
    return 0;
}