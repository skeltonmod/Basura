#include <iostream>
#include <string>
using namespace std;

enum MonsterType{
    M_OGRE,
    M_DRAGON,
    M_GSPIDER,
    M_SLIME,
    M_ORC
};


struct Monster{
    string type;
    int health;
    string name;
};

Monster createMonster(string type,int health,string name){
    Monster temp{type,health,name};
    return temp;
}


string getMonsterType(MonsterType m){
    switch(m){
        case M_OGRE:
        return "Ogre";
        break;

        case M_DRAGON:
        return "Dragon";
        break;

        case M_GSPIDER:
        return "Giant Spider";
        break;

        case M_SLIME:
        return "Slime";
        break;

        case M_ORC:
        return "Orc";
        break;
    }

}


void printMonster(MonsterType m, int health, string name){
    Monster monster{getMonsterType(m), health, name};
    cout << "This " << monster.type << " is " << monster.name << " and has " << monster.health << " health \n";
}

int main()
{

    return 0;
}
