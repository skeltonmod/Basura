#include <stdio.h>
#include <conio.h>
#include <iostream.h>
int num;
char sign;
//char choice[2];
int main(){
clrscr();
menu:
printf("MAINE MENU\n");
printf("[1]Activity 1\n");
printf("[2]Activity 2\n");
printf("[0]Exit\n");
printf("What activity would you like to view?\n");
scanf("%d",&num);
activity1:
if (num==1){
clrscr();
cout << "ACTIVITY 1"<< endl;
cout <<"Int Size is " <<sizeof(int)<<endl;
cout <<"Float size is " <<sizeof(float)<<endl;
cout <<"Double size is "<<sizeof(double)<<endl;
cout <<"CHar size is " <<sizeof(char)<<endl;
printf("Press any Key to return to menu");
getche();
clrscr();
goto menu;
}
activity2:
if (num==2){
clrscr();
int a,b,c,d,e;
printf("Enter 2 Operands\n");
scanf("\n%f%f",&a,&b);
printf("Enter Operator\n");
cin >> sign;
switch(sign){
	case '+':
	c=a+b;
	break;
	case '-':
	c=a-b;
	break;
	case '*':
	c=a*b;
	break;
	case '/':
	c=a/b;
	break;
       //	case '%':
       //	c= a%b;
       //	break;
default: goto activity2;
}
printf("The Answer is: %2f",c);
getche();
clrscr();
goto menu;
}
if (num == 3){
return 0;
}
getche();
 return 0;
}
