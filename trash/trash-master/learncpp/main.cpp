#include <iostream>

using namespace std;

int getuserinput(){
    int x;
    cin >> x;
    return x;
}

void intswap(int x, int y){
    // x is the first integer to be entered while y is the second integer
    bool swappable = (y < x); // for fun
    if(swappable){
        int tempvar{};
        tempvar = x;
        x = y;
        y = tempvar;

    } // tempvar dies here RIP soldier


    cout << "The first integer is now " << x << '\n';
    cout << "The second integer is now " << y << '\n';
}


int main()
{
    cout << "Enter the first integer: ";
    int x{getuserinput()};
    cout << "Enter the second integer: ";
    int y{getuserinput()};

    intswap(x,y);

    return 0;
}
