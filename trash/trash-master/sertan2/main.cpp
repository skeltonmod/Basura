#include <iostream>

using namespace std;

void insertionSort(int arraylist[], int maxval){
    for(int i = 1; i < maxval; ++i){
        int temp{};
        int j{};
        temp = arraylist[i];
        j = i - 1;

        while(j >= 0 && arraylist[j] > temp){
            arraylist[j+1] = arraylist[j];
            j = j - 1;
        }
        arraylist[j+1] = temp;
    }

    for(int i = 1; i < maxval; ++i){
        cout << arraylist[i] << '\n';
    }

}


int main()
{
    int oogabooga[6] = {20,60,1,40,90,70};

    insertionSort(oogabooga,5);

    return 0;
}
