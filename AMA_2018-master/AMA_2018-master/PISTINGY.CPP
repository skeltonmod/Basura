#include <stdio.h>
#include <conio.h>
int main(){
clrscr();
int a,b,z;
printf("Enter Two Numbers \n");
scanf("%d%d",&a,&b);
z=a+b;
printf("The Answer is: %d\n",z);
z=a-b;
printf("The Answer is: %d\n",z);
z=a*b;
printf("The Answer is: %d\n",z);
z=a/b;
printf("The Answer is: %d\n",z);
z=a%b;
printf("The Answer is: %d\n",z);
z=a++;
printf("The Answer is %d\n",z);
z=a--;
printf("The Answer is %d",z);

getche();
return 0;
}