#include <iostream>

/* run this program using the console pauser or add your own getch, system("pause") or input loop */
using namespace std;
int main(){
	float nom,denom;
	float value;
	
	cout << "Convert Fraction to Decimal\n";
	cout << "Numerator ";
	cin >> nom;
	cout << "Denominator ";
	cin >> denom;
	value = nom/denom;
	cout << "\n" << nom << "/" << denom << "=" << value;
	
	
	return 0;
}
