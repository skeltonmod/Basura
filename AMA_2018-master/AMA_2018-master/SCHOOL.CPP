#include <iostream.h>
#include <conio.h>
#include <iomanip.h>
#include <stdlib.h>
#include <string.h>

/*
  ELIJAH ABGAO n FRIENDS!
*/

int main(){

const int cb=20,fl=25,yb=30,drinks=20,coke=20,
sprite=20,royal=20,pj=25,med=5,large=10; //price Variable
const char *items[100]={"Cheese Buger","Foot Long","Yum Burger","Drinks","Coke"
,"Sprite","Royal","Pineapple Juice"}; //item names array
int subtotal=0,cash,change,total=0,tbill;  //the 3 idiots
int quantity;  
int order;   
int price;
char upsize;
char loop; //prevents the program from aborting prematurely
clrscr();
cout << "\t"<<setw(10) << "Item" << "\t" << " Price" <<"\t"<< "\n";
cout << "\t" << "Cheese Burger" << "\t" << setw(5)<<cb << "\n";
cout << "\t" << "Foot Long" << "\t" <<setw(5)<< fl << "\n";
cout << "\t" << "Yum Burger" << "\t" <<setw(5)<< yb << "\n";
cout << "\t" << "Water" << "\t" <<setw(14)<< drinks << "\n";
cout << "\t" << "Coke" << "\t" <<setw(14) <<coke << "\n";
cout << "\t" << "Sprite" << "\t" <<setw(14) <<sprite << "\n";
cout << "\t" << "Royal" << "\t" <<setw(14) <<royal << "\n";
cout << "\t" << "P.J" << "\t"<<setw(14)<< pj << "\n";
cout << "\t" << "Med" << "\t" <<setw(14)<< med << "\n";
cout << "\t" << "Large" << "\t" <<setw(14) <<large << "\n";
cout << "Hi, Sir/Maam welcome to boboys! What would you like?" << "\n" ;
 do
 {
cin >> order;
switch(order)
{
	case 0:
	cout << "You have selected nothing... program aborted!";
	getche();
	return 0;
	break;
	case 1:
	//cout << "Your ordered Cheese Burger";
	price = cb;
	break;

	case 2:
	//cout << "Your ordered footlong";
	price = fl;
	break;

		case 3:
	//cout << "Your ordered Yum Burger";
	price = yb;
	break;

		case 4:
	//cout << "Your ordered Water";
	price = drinks;
	break;

		case 5:
	//cout << "Your ordered Coke";
	price = coke;
	break;

		case 6:
	//cout << "Your ordered Sprite";
	price = sprite;
	break;

		case 7:
	//cout << "Your ordered Royal";
	price = royal;
	break;

		case 8:
	//cout << "Your ordered Pine Apple Juice";
	price = pj;
	break;


default: cout << "Please select a Valid Order! program aborting...";
		getche();
		return 0;
		break;
}

/*////////DEBUG BOX!!!
//change 
*/
cout <<"You have ordered "<<items[order-1]<<","<<" How many "<<items[order-1]<<"s"<<" Would you like?" <<endl;
cin >> quantity;
subtotal += price*quantity;
cout << "Upsize? (M , L or N)" <<endl;
cin >> upsize;
switch(upsize){
	 case 'n':
	 price=0;
	 break;
	case 'l':
	price=large;
	break;
	case 'm':
	price=med;
	break;
	default: cout << "Please select a Proper Value";
}
	subtotal += price;
cout << "Your subtotal would be " << subtotal <<endl;
cout << "Would you like to Order Again? Y/N " ;
cin >> loop;
 }while(loop == 'Y' || loop == 'y');
	if (loop=='N'||loop=='n'){

	tbill = subtotal+total;
	cout << "Your bill is: " << tbill << endl;
	}
	//checkout!!
	cout << "Cash on Hand: "; 
		cin >> cash;
		change = cash - tbill;
	if (cash < tbill){
		cout << "WOW! YOU BROKE AF!";
	}else
	{
		cout << "Your change is: " << change <<endl;
	}
system("PAUSE");
return 0;
}
