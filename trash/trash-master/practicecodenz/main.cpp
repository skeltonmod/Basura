#include <iostream>

using namespace std;

void forloops(){
for(int i = 0; i <=10; ++i){
    cout <<i<<":";

    for(int j = i; j <= 5; ++j){
        cout <<" "<<j << '\n';
    }

}



}



int main()
{
    forloops();

    return 0;
}
