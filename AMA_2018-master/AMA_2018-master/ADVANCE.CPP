#include <iostream.h>
#include <conio.h>
#include <iomanip.h>
#include <stdlib.h>
#include <string.h>
#include <stdio.h>

/*
  ELIJAH ABGAO n FRIENDS!
  THANKS TO SEAN AND MARK

*/
  // Sean's variables

  int n, currentPrice, amount, table, cost=0,u,x,k = 1;
  char choice;
  typedef struct {
    char foodname[50], menu[3];
    char pname[50], food[10];
    int price, currentPrice, amount;
  } record;
  record food[3], purchase[400];
  // My Vars
  int total=0, cash, change, tbill=0, subtotal; // important vars
  int quantity; // quantity array
  int order; // order array
  char upsize;
  int upsizePrice = 0;
  char secret[100]; //secret!
  int rows; // loop specific
  const char *items[100] = {"Cheese Buger", "Foot Long",      "Yum Burger",
			    "Drinks",       "Coke",           "Sprite",
			    "Royal",        "Pineapple Juice"};
  char loop; // prevent the program from aborting prematurely


int main() {
  clrscr();
//current subtotal REMOVED!
//cout << "current total is: " << tbill <<endl;
  //the main program
  {
    strcpy(food[1].foodname, "Cheeseburger");

    strcpy(food[1].menu, "01");

    food[1].price = 20.00;
  }
  {

    strcpy(food[2].foodname, "Footlong");

    strcpy(food[2].menu, "02");

    food[2].price = 20.00;
  }
  {

    strcpy(food[3].foodname, "Yumburger");

    strcpy(food[3].menu, "03");

    food[3].price = 20.00;
  }
  {

    strcpy(food[4].foodname, "Coke");

    strcpy(food[4].menu, "04");

    food[4].price = 20.00;
  }
  {

    strcpy(food[5].foodname, "Sprite");

    strcpy(food[5].menu, "05");

    food[5].price = 20.00;
  }
  {

    strcpy(food[6].foodname, "Royal");

    strcpy(food[6].menu, "06");

    food[6].price = 20.00;
  }
  {

    strcpy(food[7].foodname, "Pineapple juice");

    strcpy(food[7].menu, "07");

    food[7].price = 20.00;


  }
    {

    strcpy(food[8].foodname, "Upsize Large");

    //strcpy(food[8].menu, "Upgrade to");

    food[8].price = 5.00;


  }
    {

    strcpy(food[9].foodname, "Upsize Large");

    //strcpy(food[9].menu, "Upgrade to");

    food[9].price = 10.00;

  }
	//view the menu
 for (x = 1; x <= 9; x++){
cout <<" "<<food[x].menu;
cout <<" "<< food[x].foodname<<" ";
cout <<" "<< food[x].price<< endl;
 }
cout << "Enter your Order (1-7) ";
cin >> order;
		if(order == 69){
			clrscr();
			cout << "CREATED BY: "<<endl;
			cout << "=====================================================================\n";
			cout << setw(15)<<"RAINE"<<setw(10)<< "SEAN" <<setw(15)<< "WINKYSTER"<<setw(15)<< "MARK"<<setw(15) << "ELIJAH\n";
			cout << "=====================================================================\n";
			cout << "Press any Key to Return"<<endl;
			getche();
			main();
		}
 do {
			if (order >= 9 || order < 1){
	      cout<<"Unregistered Code!! "<<endl;
			  cout<<"RESTARTING!!!!!";

			getche();
			clrscr();
		   return main();
			}
		else {

		 //printf("%s", food[a], foodname);
			cout << food[order].foodname;
	      //strcpy(purchase[k].pname, food[order].foodname);

	      cout <<" "<<food[order].price;

			//purchase[k].price = (food[order].price);

			cout<<"\nHow Many "<<food[order].foodname<<"s ";

			cin>> quantity;

      //purchase[k].amount = quantity;

      cost = (food[order].price) * quantity;

      cout << "\n" << "Cost: " <<" "<<cost<<endl;

      purchase[k].currentPrice = cost;
	cout << "Upsize? (M , L or N)" <<endl;
	cin >> upsize;
	switch(upsize){
		 case 'n':
		 cost+=0;
		 upsizePrice+=0;

		 break;

		case 'l':
		cost+=10;
		upsizePrice+=10;

		break;

		case 'm':
		cost += 5;
		upsizePrice+=5;
		break;
		default: cout << "Please select a Proper Value";
	}
	strcpy(purchase[k].pname, food[order].foodname);
	purchase[k].price = (food[order].price);
    purchase[k].amount = quantity;
	  k++;

      table++;
	  total += cost ;
		}

      cout << "You have ordered " <<food[order].foodname<<endl;
	
	cout<<items[order-1]<< " Added to List, Would you like Another Purchase? (Y/N): ";
	cin >> choice;
	if (choice == 'y'){
		getche();
		return main();
	}
  } while (choice == 'Y' || choice == 'y');
clrscr();
cout << "You Have Ordered \n";
cout << "======================================================\n";
cout << setw(15)<<"ITEM #"<<setw(10)<< "ITEM" <<setw(15)<< "QUANTITY"<<setw(15)<< "PRICE\n";
cout << "=====================================================\n";
    for (rows = 1; rows <= table; rows++) {
    cout << "------------------------------------------------------\n";
    cout<<setw(10)<<rows<<setw(20)<<purchase[rows].pname<<setw(6)<<purchase[rows].amount<<setw(15)<<purchase[rows].currentPrice<<"\n";
    cout << "------------------------------------------------------\n";
	
    }
getche();
tbill += total;
 cout << "Your Upsize bill is: "<<upsizePrice<<endl;
  cout << "Thank You, Your total Bill is: " << tbill<<endl;
  cout << "Cash on Hand: " << endl;
  cin >> cash;

	if(cash <tbill){
		do{
		cout << "Insufficient Funds"<<endl;
		cin >> cash;
		} while (cash < tbill);
	} if (cash >= tbill){
		change = cash-tbill;
       //	cout << "Your change is: " << change<<endl;
 // cout << "Thanks for stopping by at Boboy's AMA BRANCH"<<endl;
    }
	clrscr();
	cout << "Your change is: " << change << endl;
	cout << "Thanks for Stopping by at Boboy's AMA BRANCH"<<endl;
	getche();
  return 0;
}

