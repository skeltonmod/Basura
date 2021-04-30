#include <iostream.h>
#include <conio.h>
#include <iomanip.h>
#include <stdlib.h>
#include <string.h>
#include <stdio.h>

/*
  ELIJAH ABGAO n FRIENDS!
  Special thanks to Sean, Mark and some bunch of other people
*/
  // Sean's variables
  int n, currentPrice, amount, table, cost=0, m, x, z, t, quality, u, k = 1;
  char choice;
  typedef struct {
    char foodname[50], menu[3];
    char pname[50], food[7];
    int price, currentPrice, amount;
  } record;
  record food[3], purchase[400];
  // My Vars
  int total=0, cash, change, tbill=0, subtotal; // important vars
  int quantity; // quantity array
  int order; // order array
  int rows; // loop specific
  const char *items[100] = {"Cheese Buger", "Foot Long",      "Yum Burger",
                            "Drinks",       "Coke",           "Sprite",
                            "Royal",        "Pineapple Juice"};
  char loop; // prevent the program from aborting prematurely
  
  
int main() {
  clrscr();

  //the main program
  {
    strcpy(food[1].foodname, "Cheeseburger");

    strcpy(food[1].menu, "01");

    food[01].price = 20.00;
  }
  {

    strcpy(food[2].foodname, "Footlong");

    strcpy(food[2].menu, "02");

    food[02].price = 20.00;
  }
  {

    strcpy(food[3].foodname, "Yumburger");

    strcpy(food[3].menu, "03");

    food[03].price = 20.00;
  }
  {

    strcpy(food[4].foodname, "Coke");

    strcpy(food[4].menu, "04");

    food[04].price = 20.00;
  }
  {

    strcpy(food[5].foodname, "Sprite");

    strcpy(food[5].menu, "05");

    food[05].price = 20.00;
  }
  {

    strcpy(food[6].foodname, "Royal");

    strcpy(food[6].menu, "06");
	
    food[06].price = 20.00;
  }
  {

    strcpy(food[7].foodname, "Pineapple juice");

    strcpy(food[7].menu, "07");

    food[07].price = 20.00;
  }
	//view the menu
 for (x = 1; x <= 7; x++){
cout <<" "<<food[x].menu;
cout <<" "<< food[x].foodname<<" ";
cout <<" "<< food[x].price<< endl;
 }
 cout << "Enter your Order (1-7) ";
cin >> order;
 do {
			if (order > 7 || order < 1){
              cout<<"Unregistered Code!! ";

              			do{
			cout<<"RESTART? Y/N";

            cin >> choice;
				
			}while (choice != 'y' && choice != 'n');
			if(choice =='y') {
				
				main();
				
			}
			}

		else {
			
		 //printf("%s", food[a], foodname);
			cout << food[order].foodname;
              strcpy(purchase[k].pname, food[order].foodname);
			
              cout <<" "<<food[order].price;

			purchase[k].price = (food[order].price);

			cout<<"\n\nHow Many "<<items[order - 1]<<"s ";

			cin>> quantity;

      purchase[k].amount = quantity;

      cost = (food[order].price) * quantity;

      cout << "\n" << "Cost:  " <<" "<<cost<<endl;

      purchase[k].currentPrice = cost;

      k++;

      table++;
	  total += cost ;
		}	
		
      cout << "You have ordered " << items[order - 1] <<endl;
	do{
	cout<<items[order-1]<< " Added to List, Would you like Another Purchase? (Y/N): ";
	cin >> choice;
	
	}while(choice != 'y' && choice !='n');
	if (choice == 'y'){
		getche();
		main();
	}

    
    cout << "Would you like to Checkout? Y/N ";
	cin >> loop;
  } while (loop == 'N' || loop == 'n');
	if (loop == 'Y' || loop == 'y') {
cout << "You Have Ordered \n";
cout << "======================================================\n";
cout << setw(15)<<"ITEM #"<<setw(10)<< "ITEM" <<setw(15)<< "QUANTITY"<<setw(15)<< "PRICE\n";
cout << "=====================================================\n";
    for (rows = 1; rows <= table; rows++) {
    cout<<setw(10)<<rows<<setw(20)<<purchase[rows].pname<<setw(6)<<purchase[rows].amount<<setw(15)<<purchase[rows].currentPrice<< endl;
    }
	tbill += total;
  cout << "Thank You, Your total Bill is: " << tbill<<endl;
  cout << "Thanks for stopping by at Boboy's AMA BRANCH"<<endl;
    getche();
  }
  system("PAUSE");
  return 0;
}
	
