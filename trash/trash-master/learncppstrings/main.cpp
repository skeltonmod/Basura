#include <iostream>
#include <string>
#include <limits>

using namespace std;

string getName(){
    string name{};
    cout << "Enter Name: ";
    getline(cin,name);
    return name;
}

int countName(){
    int x{getName().length()};

    return x;
}

int getAge(){
    int x{};
    cout << "Enter Age: ";
    cin >> x;
    return x;
}


int main()
{
    int x{countName()};
    //age
    int y{getAge()};
    cout << static_cast<double>(y)/x;

    return 0;
}
