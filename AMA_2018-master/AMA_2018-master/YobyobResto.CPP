#include <iostream.h>
#include <conio.h>
#include <iomanip.h>
#include <stdlib.h>
#include <string.h>
#include <stdio.h>

/*
  ELIJAH ABGAO n FRIENDS!
*/

int main(){
clrscr();
const int cb=20,fl=25,yb=30,drinks=20,coke=20,
sprite=20,royal=20,pj=25,med=5,large=10; //price Variable
int subtotal,cash,change,total,tbill;  //the 3 idiots
int quantity;  //quantity array
int order;   //order array
int rows,coloumns; //loop specific
char upsize;
char loop; //prevent the program from aborting prematurely
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
	break;
	case 1:
	cout << "How many Chesse Burgers do you Like?\n";
	cin >> quantity;
	subtotal = cb * quantity;
	break;

	case 2:
	cout << "How many Foot longs do you like?\n";
	cin >> quantity;
	subtotal = fl * quantity;
	break;

		case 3:
	cout << "How many Yum Burgers do you like?\n";
	cin >> quantity;
	subtotal = yb * quantity;
	break;

		case 4:
	cout << "How many Waters do you like?\n";
	cin >> quantity;
	subtotal = drinks * quantity;
	break;

		case 5:
	cout << "How many Cokes do you like?\n";
	cin >> quantity;
	subtotal = coke * quantity;
	break;

		case 6:
	cout << "How many Royals do you like?\n";
	cin >> quantity;
	subtotal = royal * quantity;
	break;

		case 7:
	cout << "How many Sprites do you like?\n";
	cin >> quantity;
	subtotal = sprite * quantity;
	break;

		case 8:
	cout << "How many Pine Apple Juices do you like?\n";
	cin >> quantity;
	subtotal = pj * quantity;
	break;
	



default: cout << "Please select a Valid Order!";
}
	total = subtotal;
	tbill = total+subtotal;
	cout << "Upsize? (M , L or N)" <<endl;
	cin >> upsize;
	if (upsize == 'm')
	{
		tbill= subtotal + med;
		
	}
	else if (upsize == 'l')
	{
		tbill= subtotal + large;
		
	}
	else if (upsize == 'n')
	{
	tbill = subtotal + 0;
	}
cout << "Would you like to Order Again? Y/N " ;
cin >> loop;
 }while(loop == 'Y' || loop == 'y');
	if (loop=='N'||loop=='n'){
	cout << "Your subtotal would be " << tbill<<endl;
	



       }
system("PAUSE");
return 0;
}

