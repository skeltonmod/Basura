#include <iostream>

using namespace std;

struct Advertising{
    int shownAds;
    int clickedAds;
    int earnings;
};

int getuserinput(){
    int x;
    cin >> x;
    return x;
}

Advertising getstruct(){
    Advertising ads;
    cout << "Enter the number of Shown ads, Clicked ads and Earnings: " << "\n";
    ads.shownAds = getuserinput();
    ads.clickedAds = getuserinput();
    ads.earnings = getuserinput();

    return ads;
}

void parseStruct(Advertising adverts){
    int total{adverts.shownAds  * adverts.clickedAds/100 * adverts.earnings};
    cout << "Total earning for today is " << total << "\n";
}

int main()
{

    Advertising ads = {getstruct()};
    parseStruct(ads);
    return 0;
}
