#include <iostream>

using namespace std;

//print the ascii char codes by loop



void asciienum(){
    int intcount;
    char ascii{97};

    while(static_cast<int>(ascii) <= 122){
        cout << ascii << " "<< static_cast<int>(ascii) << "\n";
        ascii++;
    }

}

int main()
{
    asciienum();
    return 0;
}
