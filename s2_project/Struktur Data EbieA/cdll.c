#include <stdio.h>
#include <stdlib.h>
#include <string.h>

struct Lagu {
    char judul[50];
    struct Lagu *prev;
    struct Lagu *next;
};

struct Lagu *head = NULL;

// 1. Inisialisasi & Tambah Node (Sintaks Alokasi & Circular Link)
void tambahLagu(char judul[]) {
    struct Lagu *newNode = (struct Lagu*)malloc(sizeof(struct Lagu));
    strcpy(newNode->judul, judul);

    if (head == NULL) {
        head = newNode;
        newNode->next = head;
        newNode->prev = head;
    } else {
        struct Lagu *tail = head->prev; // Node terakhir adalah prev dari head

        newNode->next = head;
        newNode->prev = tail;
        tail->next = newNode;
        head->prev = newNode;
    }
}

// 2. Hapus Node (Sintaks Pemutusan Link Dua Arah)
void hapusLagu(char judul[]) {
    if (head == NULL) return;

    struct Lagu *curr = head;
    do {
        if (strcmp(curr->judul, judul) == 0) {
            // Jika hanya ada 1 node
            if (curr->next == head && curr->prev == head) {
                head = NULL;
            } else {
                curr->prev->next = curr->next;
                curr->next->prev = curr->prev;
                if (curr == head) head = curr->next;
            }
            free(curr);
            printf("Lagu '%s' dihapus.\n", judul);
            return;
        }
        curr = curr->next;
    } while (curr != head);
}

// 3. Traversal (Sintaks Perulangan Melingkar)
void tampilkanPlaylist() {
    if (head == NULL) return;
    struct Lagu *temp = head;
    printf("Playlist (Maju): ");
    do {
        printf("[%s] <-> ", temp->judul);
        temp = temp->next;
    } while (temp != head);
    printf("(Kembali ke Awal)\n");
}

int main() {
    tambahLagu("Lagu A");
    tambahLagu("Lagu B");
    tambahLagu("Lagu C");

    tampilkanPlaylist();

    // Demonstrasi akses prev dari head (Ciri khas Circular Double)
    printf("Lagu sebelum '%s' adalah '%s'\n", head->judul, head->prev->judul);

    hapusLagu("Lagu B");
    tampilkanPlaylist();

    return 0;
}