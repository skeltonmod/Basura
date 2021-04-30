#include <iostream>

using namespace std;

int doSomething(){
int x{};
int y{};
cin >> x;
y = x * (x + 1) / 2;

return y;
}


int main()
{
    int x{doSomething()};

    cout << "Do Something returned with " << x << '\n';
    return 0;
}
