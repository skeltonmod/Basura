#include <iostream>

/* run this program using the console pauser or add your own getch, system("pause") or input loop */
using namespace std;
int main() {
	float result;
	float num1;
	float num2;
	float num3;
	float num4;
	cout << "input the first number ";
	cin >> num1;
	cout << "input second number ";
	cin >> num2;
	cout << "input third number ";
	cin >> num3;
	cout << "input fourth number ";
	cin >> num4;
	
	
	result = num1 + num2 * num3/num4;
	cout << '\n' << result;
	result = num1 / num2 + num3;
	cout << '\n' << result;
	result = (num1 + num2)/num3;
	cout << '\n' << result;
	result = (num1 + num2 / num3) + num4;
	cout << '\n' << result;
	
	return 0;
}
