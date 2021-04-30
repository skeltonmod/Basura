#include <iostream>

using namespace std;

void excercise(){
    int intcount = 0;
    while(intcount <= 50){
        if(intcount <=0){
            cout << " ";
        }else if(intcount < 10){
            cout << "0" <<intcount << " ";
        }
        else{
            cout << intcount << " ";
        }

        if(intcount % 10 == 0){
             cout << "\n";
        }

        ++intcount;

    }
    cout << "loop done! " << endl;
}


void excercise2(){
    int outer = 0;
    while(outer < 5){
        int inner = 1;
        while(inner <= outer){
            cout << ++inner << " ";

        }
        cout << "\n";
        ++outer;
    }
}



int main()
{
    excercise2();
    return 0;
}
