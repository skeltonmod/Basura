#include <iostream>
#include <stdio.h>
#include <conio.h>
using namespace std;
/* run this program using the console pauser or add your own getch, system("pause") or input loop */
int menuchoice;
int main() {
	main:
	printf("Bundled Software");
	printf("\n--------------------------------\n");
	printf("[1]GCF thingy\n");
	printf("[2]Table System\n");
	printf("[3]Frac to Dec\n");
	printf("[4]Ipconfig (Quick)\n");
	printf("[5]Patterns'\n");
	printf("[6]Floyd Patter\n");
	printf("[0]EXIT\n");
	scanf("%d",&menuchoice);
	if(menuchoice == 0){
		return 0;
	}
	if (menuchoice == 1){
	goto gcf;
	system("cls");
	}
	if(menuchoice == 2){
		goto tables;
	}
	if(menuchoice == 3){
		goto fracdec;
	}
		if(menuchoice == 4){
		goto ipshow;
	}
	if(menuchoice == 5){
		goto pattern;
	}
	if (menuchoice == 1){
	gcf:
	system("cls");
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
}
if (menuchoice == 2){
	tables:
	system("cls");
	int a = 101, b = 50, c = 30, z = 10;
	int d = 58, e = 10, f = 49, x = 2;
	int g = 45, h = 56, i = 0, y = 5;
	
	cout << '\t' << "WON" << '\t' << "LOST" << '\t' << "OH MY" << '\t'<< "TIED\n\n";
	cout << "BOYBOY" << '\t' << a << '\t' << b << '\t' << z <<'\t' << c << '\n';
	cout << "JAZZ" << '\t' << d << '\t' << e << '\t' << x << '\t' << f << '\n';
	cout << "BERNARD" << '\t' << g << '\t' << h << '\t'<< y << '\t' << i << '\n';
	getch();
	system("cls");
	goto main;

}
if (menuchoice==3)
{
	fracdec:
	system("cls");
	float nom,denom;
	float value;
	
	cout << "Convert Fraction to Decimal\n";
	cout << "Numerator ";
	cin >> nom;
	cout << "Denominator ";
	cin >> denom;
	value = nom/denom;
	cout << "\n" << nom << "/" << denom << "=" << value;
	getch();
	system("cls");
	goto main;
	
}
if (menuchoice == 4){
	ipshow:
		system("cls");
		system("C:\\Windows\\System32\\ipconfig");
	getch();
	system("cls");
	goto main;
}
if (menuchoice == 5){
	pattern:
	system("cls");
  int row, c, n, s;
  printf("Enter the number of rows in pyramid of stars you wish to see\n");
  scanf("%d", &n);
  s = n;
  for (row = 1; row <= n; row++)  
  {
    for (c = 1; c < s; c++)  
      printf(" ");
    s--;
    for (c = 1; c <= 2*row - 1; c++) 
    printf("*");
    printf("\n");
  }
	getch();
	system("cls");
	goto main;		
}

if (menuchoice == 6){
	floyd:
		system("cls");
	  int n, i,  c, a = 1;
  printf("Enter the number of rows of Floyd's triangle to print\n");
  scanf("%d", &n);
 
  for (i = 1; i <= n; i++)
  {
    for (c = 1; c <= i; c++)
    {
      printf("%d ",a);
      a++;
    }
    printf("\n");
  }
 	getch();
	system("cls");
	goto main;	
}
}

