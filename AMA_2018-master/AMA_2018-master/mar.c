#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include <conio.h>
  int n, currentPrice, amount, table, cost=0,u,x,k = 1;
  char choice;
  typedef struct {
    char foodname[100], menu[3];
    char pname[50], food[10];
    int price, currentPrice, amount;
  } record;
  record food[3], purchase[400];
  int total=0, cash, change, tbill=0, subtotal; // important vars
  int quantity; // quantity array
  int order; // order array
  int rows; // loop specific
  char loop; // prevent the program from aborting prematurely
int main(){
	start:
 //the main program
 //printf("Created by some AMA student lmao fuck this shit \n\n");
 //printf ("ELIJAH ABGAO PARIN MGA ULOL!\n");
 printf("\tWELCOME\n");
 printf("-------------------------\n");
 printf("\t[1] Buy shit\n \t[2]Pay Shit\n \t[3]Exit this shit\n");
 scanf("%d",&n);
 switch(n){
 	//BUY
 	buymenu:
 case 1:
 {
 system("cls");
 printf("\n\t[0]Return to Menu\t\n\t[1]Main Dishes \t\n\t[2]Dessert\n \t[3]Drinks\n");
 scanf("%d",&n);
 switch(n){
 	//main dish
 	 	case 0:
 	 	system("cls");
 		goto start;
 		break;
 	maindishMenu:
 	case 1:
  {
    strcpy(food[1].foodname, "Crispy Pata");

    strcpy(food[1].menu, "1");

    food[1].price = 250.00;
  }
   {
    strcpy(food[2].foodname, "Calamares");

    strcpy(food[2].menu, "2");

    food[2].price = 150.00;
  }
   {
    strcpy(food[3].foodname, "Chopsuey");

    strcpy(food[3].menu, "3");

    food[3].price = 70.00;
  }
   {
    strcpy(food[4].foodname, "Tinolang Manok");

    strcpy(food[4].menu, "4");

    food[4].price = 120.00;
    
  }
  break;
  //dessert
  dessertMenu:
  case 2:
  	  {
    strcpy(food[1].foodname, "Leche Flan");

    strcpy(food[1].menu, "1");

    food[1].price = 50.00;
  }
   {
    strcpy(food[2].foodname, "Buko Pandan");

    strcpy(food[2].menu, "2");

    food[2].price = 50.00;
  }
   {
    strcpy(food[3].foodname, "Halo Halo");

    strcpy(food[3].menu, "3");

    food[3].price = 70.00;
  }
   {
    strcpy(food[4].foodname, "Chocolate Cake");

    strcpy(food[4].menu, "4");

    food[4].price = 120.00;
  }
  	
  	break;
  	//drinks
  	case 3:
  	drinkMenu:
  	  	  {
    strcpy(food[1].foodname, "Coke/Sprite");

    strcpy(food[1].menu, "1");

    food[1].price = 30.00;
  }
   {
    strcpy(food[2].foodname, "Shake");

    strcpy(food[2].menu, "2");

    food[2].price = 50.00;
  }
   {
    strcpy(food[3].foodname, "SanMig");

    strcpy(food[3].menu, "3");

    food[3].price = 50.00;
  }
   {
    strcpy(food[4].foodname, "Water");

    strcpy(food[4].menu, "4");

    food[4].price = 20.00;
  }
  	break;
}
system("cls");
	//view the menu
printf("\n\nCode\t\t\tItem Name\t\t\t\tPrice");
 for (x = 1; x <= 4; x++){
printf("\n %s", food[x].menu);
printf("\t\t\t %s", food[x].foodname);
printf("\t\t\t\t\t %d", food[x].price);
 }

}

//main menu
 printf("\n[0] Go Back to Main Menu\n");
 printf("\nWhat would you Like to order? (1-4) ");
scanf("%d",&order);
if (order == 0){
	system("cls");
	goto start;
	}
	else
	{
scanf("&d",&order);
printf("You have ordered ");
printf("%s",food[order].foodname);	
printf("\t %d\n",food[order].price);
printf("How many %s? ",food[order].foodname);
scanf("%d", &quantity);
cost = (food[order].price) * quantity;
printf("Cost: %d\n",cost);
//increment the arrays and store them
	strcpy(purchase[k].pname, food[order].foodname);
	purchase[k].price = (food[order].price);
    purchase[k].amount = quantity;
table++;
k++;
//fucking lazy to analyze lmao fuck this shit!!!
printf("Order Complete! ");
getche();
system("cls");
goto buymenu;
	}


break;
case 2:
	system("cls");
	printf("You have Ordered \n");
	printf("============================================================\n");
	printf("\tItem Code\tQuantity\tPrice\n");
	//u = rows (sean's variables)
	for(rows =1; rows <=table;rows++){
	printf("%d\t\t\t\t",rows);
	
	}
break;
default: printf("Please select a Proper Value!");
	getche();
	system("cls");
	goto start;
break;
}
 getche();
return 0;
}
