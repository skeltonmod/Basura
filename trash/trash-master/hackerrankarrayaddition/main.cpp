#include <iostream>
#include <vector>
#include <numeric>
using namespace std;

std::vector<int> arr{};

int getinput(){
    int x{};
    cin >> x;

    return x;
}


void fillarray(){
    arr.resize(getinput());
    //cout <<  arr.size();

    //insert the values here!
    for(int i = 0; i < arr.size();++i){
        arr[i] = getinput();

    }
}


int simpleArraySum(vector<int> arr){
    int sum{0};
    //cout << arr.size() << "\n";
    for(int i=0;i<arr.size();++i){
        //cout << arr[i] << " ";
        sum += arr[i];

    }
    return sum;
}

int main()
{
    fillarray();
    cout <<simpleArraySum(arr);
    return 0;
}
