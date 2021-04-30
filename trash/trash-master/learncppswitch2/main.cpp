#include <iostream>

using namespace std;

enum ANIMALS{
    A_PIG,
    A_CHICKEN,
    A_GOAT,
    A_CAT,
    A_DOG
};

int getNumberofLegs(ANIMALS animal){
int legs{};
    switch(animal){
    case A_PIG:
    legs = 4;
    break;

    case A_CHICKEN:
    legs = 2;
    break;

    case A_GOAT:
    legs = 4;
    break;

    case A_CAT:
    legs = 4;
    break;

    case A_DOG:
    legs = 4;
    break;

    default:
        cout << "No such Animal" << "\n";
    break;

    }
return legs;
}


string getAnimalName(ANIMALS animal){
string name{};
switch(animal){
    case A_PIG:
    name = "Pig";
    break;

    case A_CHICKEN:
    name = "Chicken";
    break;

    case A_GOAT:
    name = "Goat";
    break;

    case A_CAT:
    name = "Cat";
    break;

    case A_DOG:
    name = "Dog";
    break;

    default:
        cout << "No such Animal" << "\n";
    break;
}


return name;
}



void printNumberOfLegs(ANIMALS animal){
cout << "A " << getAnimalName(animal) << " Has " << getNumberofLegs(animal) << " legs" << "\n";
}

int main()
{
    printNumberOfLegs(A_CAT);
    printNumberOfLegs(A_CHICKEN);
    return 0;
}
