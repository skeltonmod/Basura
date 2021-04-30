#include <stdio.h>
#include <stdlib.h>

/* 

CREATED BY MAR ALLEN CANIZAR!! 


 */
int order; // order var
int quantity; // quantity var
int num; //choice var
int total = 0; //total variable
int subtotal = 0; //subtotal
int tbill = 0; // you know what this is!!
int price; // price var
char choice; // choice var (char)
float cash; //duhhh!
float change; //DUHH!
int menuchoice; // lol
int main() {

	menu:	
	printf("\t\tMain Menu");
    printf("\n---------------------------------------");
    printf("\n[1] Take Orders");
    printf("\n[2] Pay Bills");
    printf("\n[3] Exit\n");
    printf("What do you want to do? ");
    scanf("%d",&num); // select the above options
    tbill = 0;
    if (num == 1){
    	system("cls");
    	goto takeorders;
	}
	    if (num == 2){
	   	system("cls");
	   	goto paybills;
	
	}
        if (num == 3){
    	return 0;
	}
    takeorders:
    printf("\n[1] Main Dish");
    printf("\n[2] Dessert");
    printf("\n[3] Drinks");
    printf("\n[0] Return to Menu\n");
	scanf("%d",&menuchoice);
		if (menuchoice==0){
		system("cls");
		goto menu;
	}
	if (menuchoice ==1){
		goto maindish;
	}
		if (menuchoice == 2){
		goto dessert;
	}

	maindish:
	if(menuchoice ==1){
	system("cls");
	printf("\nCode\t\tItem Name\t\t\t\tPrice");
	printf("\n[1] \t\tCrispy Pata\t\t\t\t250");
	printf("\n[2] \t\tCalamares\t\t\t\t150");
	printf("\n[3] \t\tChopsuey\t\t\t\t70");
	printf("\n[4] \t\tTinolang Manok\t\t\t\t120");
	printf("\n[5] \t\tBack to Take Orders Menu");
	printf("\n[6] \t\tBack to Main Menu\n");
	printf("What will you order? ");
	scanf("%d",&num);
	tbill = 0;
	if (num ==1){
		printf("You have ordered Crispy Pata\n");
		price = 250;
	}
		if (num ==2){
			printf("You have ordered Calamares\n");
		price = 150;
	}
		if (num ==3){
		printf("You have ordered Chopsuey\n");
		price = 70;
	}
		if (num ==4){
			printf("You have ordered Tinolang Manoks\n");
		price = 120;
	}
	if (num > 6 || num < 0){
		system("cls");
		goto maindish;
		
	}
	if (num == 5){
		system("cls");
		goto takeorders;
		}
	if (num == 6){
		system("cls");
		goto menu;
		}
}
	dessert:
	if(menuchoice ==2){
	system("cls");
	printf("\nCode\t\tItem Name\t\t\t\tPrice");
	printf("\n[1] \t\tLeche Flan\t\t\t\t50");
	printf("\n[2] \t\tBuko Pandan\t\t\t\t150");
	printf("\n[3] \t\tHalo2x\t\t\t\t\t70");
	printf("\n[4] \t\tChocolate Cake\t\t\t\t120");
	printf("\n[5] \t\tBack to Take Orders Menu");
	printf("\n[6] \t\tBack to Main Menu\n");
	printf("What will you order? ");
	scanf("%d",&num);
	tbill = 0;

	
	if (num ==1){
		printf("You have ordered Leche Flan\n");
		price = 50;
	}
		if (num ==2){
			printf("You have ordered Buko Pandan\n");
		price = 50;
	}
		if (num ==3){
		printf("You have ordered Halo Halo\n");
		price = 70;
	}
		if (num ==4){
			printf("You have ordered Chocolate Cake\n");
		price = 120;
	}
	if (num > 6 || num < 0){
		system("cls");
		goto dessert;
		
	}
	if (num == 5){
		system("cls");
		goto takeorders;
		}
	if (num == 6){
		system("cls");
		goto menu;
	}
}
		drinks:
	if(menuchoice ==3){
	system("cls");
	printf("\nCode\t\tItem Name\t\t\t\tPrice");
	printf("\n[1] \t\tCoke/Sprite\t\t\t\t30");
	printf("\n[2] \t\tFruit Shake\t\t\t\t50");
	printf("\n[3] \t\tSan Mig\t\t\t\t\t50");
	printf("\n[4] \t\tWater\t\t\t\t\t20");
	printf("\n[5] \t\tBack to Take Orders Menu");
	printf("\n[6] \t\tBack to Main Menu\n");
	printf("What will you order? ");
	scanf("%d",&num);
	tbill = 0;

	
	if (num ==1){
		printf("You have ordered Coke/Sprite\n");
		price = 30;
	}
		if (num ==2){
			printf("You have ordered Fruit Shake\n");
		price = 50;
	}
		if (num ==3){
		printf("You have ordered San Mig\n");
		price = 50;
	}
		if (num ==4){
			printf("You have ordered Water\n");
		price = 20;
	}
	if (num > 6 || num < 0){
		system("cls");
		goto drinks;
		
	}
	if (num == 5){
		system("cls");
		goto takeorders;
		}
	if (num == 6){
		system("cls");
		goto menu;
	}
}
			
	printf("How many Would you like? ");
	scanf("%d",&quantity);
	subtotal = price * quantity;
	total = total + subtotal;
	printf("Your subtotal is: %d\n",subtotal);
	
	printf("Would you Like to Checkout? Y/N ");
	choice = getch();
	if (choice == 'N' || choice =='n')
	{
		system("cls");
		goto takeorders;
	}
	else if (choice == 'Y' || choice =='y')
	{
		system("cls");
		goto paybills;
	}
	
	paybills:
	system("cls");
	tbill = tbill + total;
		printf("Your Total is: %d\n",tbill);
			if (tbill <=0 ){
		goto nobills;
	}
	payment:
	printf("Cash on Hand: ");
	scanf("%f",&cash);
	change = cash - tbill;
	//reset the variables back to zero
	tbill = 0;
	subtotal = 0;
	total = 0;
	if (cash < tbill){
		printf("Insufficient Funds!\n");
		goto payment;
		system("cls");
		getch();
		
	}
	else if(cash > tbill){
	printf("Thank you! your change is: %.2f",change);
	getch();
	system("cls");
		tbill = 0;
	goto menu;
	}
	else if(cash == tbill){
	printf("Thank you! you have no change :P");
	getche();
	system("cls");
	goto menu;
	}
	
		else{
			goto nobills;
		}
		
		nobills:
		if (num == 2 ) {
		printf("There's Nothing here!");
		getch();
		system("cls");
		goto takeorders;
	}
	getch();
	system("cls");
	goto menu;
	return 0;
}

