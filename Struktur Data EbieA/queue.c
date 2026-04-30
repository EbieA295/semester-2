#include <stdio.h>
#include <stdlib.h>

#define MAX 100

typedef struct {
    int data[MAX];
    int priority[MAX];
    int size;
} PriorityQueueArray;

void inisialisasiQueueArray(PriorityQueueArray *queue){
    queue -> size = 0;
}

void enqueueArray(PriorityQueueArray *queue, int data, int priority) {
    if (queue -> size == MAX){
        printf ("Queue penuh. tidak dapat menambahkan elemen.\n");
        return;
    }

    int i;
    for (i = queue -> size - 1; i >= 0 && queue -> priority[i] > priority; i--){
        queue -> data [i + 1] = queue -> data[i];
        queue -> priority [i + 1]= queue -> priority[i];
    }

    queue -> data[i+1]=data;
    queue-> priority[i+1]=priority;
    queue->size++;
    printf("elemen %d dengan priorittas %d berhasil ditambahkan .\n", data, priority);
}

void dequeueArray(PriorityQueueArray *queue){
    if (queue->size==0){
        printf("Queue kosong.\n");
        return;
    }

    printf("Elemen %d dengan prioritas %d telah diproses.\n", queue->data[0], queue->priority[0]);
    for (int i = 0; i < queue->size -1;i++)
    {
        queue->data[i]=queue->data[i+1];
        queue->priority[i]= queue->priority[i+1];
    }    
    queue->size--;
    
}

void tampilkanQueueArray(PriorityQueueArray *queue){
    if(queue->size ==0){
        printf("Queue kosong.\n");
        return;
    }

    printf("isi queue:\n");
    for(int i =0; i < queue->size; i++){
        printf("Data: %d, prioritas; %d\n", queue->data[i], queue->priority[i]);
    }
}

int main(){
    PriorityQueueArray queue;
    inisialisasiQueueArray(&queue);

    enqueueArray(&queue, 30, 2);
    enqueueArray(&queue, 20, 1);
    enqueueArray(&queue, 50, 3);
    tampilkanQueueArray(&queue);

    dequeueArray(&queue);
    tampilkanQueueArray(&queue);

    return 0;
}