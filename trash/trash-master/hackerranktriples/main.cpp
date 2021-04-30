#include <iostream>
#include <vector>
#include <iterator>
using namespace std;
d
std::vector<int> a{};
std::vector<int> b{};
std::vector<int> c{};
int getinput();
void initvector(int x);




std::vector<int> compareTriplets(vector<int> arr1, vector<int> arr2){
    int sum{0};
    int sum2{0};
    c.resize(2);


    for(int i = 0; i < 3;++i){
        if(arr1[i] > arr2[i]){
            c[0] += 1;
            sum = c[0];
        }else if (arr1[i] < arr2[i]){
            c[1] += 1;
            sum2 = c[1];
        }else if(arr1[i] < arr2[i]){
            c[1] += 0;
            c[0] += 0;
            sum = c[0];
            sum = c[0];
        }
    }

    return c;
}

int getinput(){
    int x{};
    cin >> x;
    return x;
}

void initvector(int x){
    a.resize(x);
    b.resize(x);
    //cout << a.size() << " " << b.size() << endl;
    //cout << "Enter numbers for arr1: " << "\n";
    for(int i =0; i < 3; ++i){
        a[i] = getinput();
    }
    //cout << "Enter numbers for arr2: " << "\n";
    for(int i =0; i < 3; ++i){
        b[i] = getinput();
    }

}



void printvector(vector<int> const &input){
    for(int i =0; i < input.size();++i){
        cout << input.at(i) << " ";

    }

}

int main()
{
    initvector(getinput());
    printvector(compareTriplets(a,b));
    return 0;
}
