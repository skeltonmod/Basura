#include <iostream.h>
#include <conio.h>

int main(){
clrscr();
int a,b;
cout << "enter two comparable values"<< "\n";
cin >> a;
cin >> b;
if (a==b)
{
cout << "A is equal to B"<< "\n";
	}
else
{
cout << "A is not Equal to B" << "\n";
}
if (a!=b)
{
cout << "A is not Equal to B (True)" << "\n";
}
else
{
 cout << "A is Equal to B (False)"<< "\n";
}
if (a>b){
cout << "A is Less Than B" << "\n";
}
else
{
cout << "A is not Less than B" << "\n";
}
if (a<b){
cout << "A is greater than B" << "\n";
}
else{
cout << "A is not greater than B" << "\n";
}
if(a>=b){
cout << "A is Greater than or Equal to B" << "\n";
}
else{
cout << "A is not Greater than or Equal to B" << "\n";
}
if (a<=b){
cout << "A is Less than or Equal to B" << "\n";
}
else
{
cout << "A is not Less than or Equal to B" << "\n";
}

getche();
return 0;
}