#include <iostream>

/* run this program using the console pauser or add your own getch, system("pause") or input loop */
using namespace std;
int main(){
	int yournumber; 
	 cout << "Enter a Whole number ";
	cin >> yournumber;
	
	if (yournumber % 2 == 0)
	
	 cout << "\nThe number is even\n";
	
	if (yournumber %2 != 0)
	
	 cout << "The Number is Odd\n";
	 cout << "that's all\n";
	
	return 0;
}
