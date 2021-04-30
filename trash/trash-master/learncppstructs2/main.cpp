#include <iostream>

using namespace std;

struct fraction{
    int numerator;
    int denominator;
};

int getuserinput(){
    int x;
    cin >> x;
    return x;
}


fraction getinput(){
    fraction fract;
    cout << "Enter the numerator: ";
    fract.numerator = getuserinput();
    cout << "Enter the denominator: ";
    fract.denominator = getuserinput();
    return fract;
}


void multiply(fraction f1,fraction f2){
    cout << "The result of 2 fractions: ";
    cout << static_cast<double>(f1.numerator * f2.numerator) / (f1.denominator * f2.denominator) << "\n";
}


int main()
{
    fraction f1{getinput()};
    fraction f2{getinput()};
    multiply(f1,f2);
    return 0;
}
