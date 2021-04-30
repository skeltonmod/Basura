#include <iostream>

using namespace std;


void recursion(int x){

if(x > 0){
    cout << x << endl;
    recursion(x-1);
}else{
    return;
}

}


int main()
{
    recursion(5);
    return 0;
}
