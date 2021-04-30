#include <iostream>

using namespace std;


char getopr(){
char opr{};

cin >> opr;

return opr;
}

int calculate(int x, int y){
char opr{getopr()};
int result{};

switch(static_cast<int>(opr)){
    case 42: //multiply
    result = x * y;
    break;

    case 43: //add
    result = x + y;
    break;

    case 47: //divide
    result = x / y;
    break;

    case 45: //subtract
    result = x - y;
    break;

    case 37: //modulus
    result = x % y;
    break;

    default:
        cout << "Invalid operator! " << "\n";
    break;
}


return result;
}

void get(){
int x{};
int y{};

cout << "Enter two digits: ";
cin >> x >> y;
cout << "Enter the Operator: ";
cout << calculate(x,y);

}


int main()
{
    get();
    return 0;
}
