#include <stdio.h>
#include <stdlib.h>

struct Node {
    int dest;
    int weight;
    struct Node* next;
};

struct AdjList 
{
    struct Node* head;
};


struct Graph {
    int numVertices;
    struct AdjList* array;
};

struct Node* createNode(int dest, int weight)
{
    struct Node* newNode = (struct Node*)malloc(sizeof(struct Node ));
    newNode -> dest = dest;
    newNode -> weight = weight;
    newNode -> next = NULL;
    return newNode;
};

struct  Graph* createGraph(int vertices){
    struct Graph* graph = (struct Graph*)malloc(sizeof(struct Graph));
    graph -> numVertices = vertices;
    graph -> array = (struct AdjList*)malloc(vertices * sizeof(struct AdjList));

    for (int i = 0; i < vertices; i++){
        graph -> array[i].head = NULL;
    }
    return graph;
}

void addEdge(struct Graph* graph, int src, int dest, int weight) {
    //jalan dari src ke dest beserta jaraknya
    struct Node* newNode = createNode(dest, weight);
    newNode->next = graph -> array[src].head;
    graph -> array[src].head = newNode;

    //karena jalan dua arah, tambah juga dari dest ke src
    newNode = createNode(src, weight);
    newNode -> next = graph -> array[dest].head;
    graph -> array[dest].head = newNode;
};

void printGraph(struct Graph* graph){
    for (int v =0; v < graph -> numVertices; v++) {
        struct Node* temp = graph -> array[v].head;
        printf("dari lokasi %d dapat ke:\n", v);

        while (temp != NULL){
            printf(" -> Lokasi %d (jarak: %d meter)\n", temp->dest, temp->weight);
            temp =  temp -> next;
        }
        printf("\n");
    }
}

int main(){
    //0:gerbang, 1: gedung kuliah, 2 :perpus, 3: kantin
    int totalLokasi = 4;
    struct Graph* mapGraph = createGraph(totalLokasi);

    //hubungkan lokasi beserta jaraknya (weigth)
    addEdge(mapGraph, 0, 1, 50);
    addEdge(mapGraph, 0, 2, 100);
    addEdge(mapGraph, 1, 3, 30);
    addEdge(mapGraph, 2, 3, 40);
    
    printf("--0 Peta Digital Kampus (Graph) __\n\n");
    printGraph(mapGraph);

    return 0;
}