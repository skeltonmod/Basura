/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package pizza;
import javax.swing.*;
/**
 *
 * @author CISCO 01
 */
public class Pizza {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        String firstNumber,thirdNumber, inputNumber,//first string entered by user 
         secondNumber; // second string entered by user 

int pizza,  money,   // first number to add 
    softdrink, burger,   //second number to add 
    change;                //sum of number1 and number2 

//read in the first number from user as a string 
inputNumber = 
        JOptionPane.showInputDialog ( "Enter $$$" ); 


//convert numbers from type String to type int 
pizza = 30; 
money = Integer.parseInt ( inputNumber); 
burger = 20; 
softdrink = 10;
//add the numbers 
change = money - burger -softdrink - pizza; 

//display the results 
JOptionPane.showMessageDialog ( 
null, "Your Chnage is " + change, "Pesoses", 
JOptionPane.PLAIN_MESSAGE); 
System.exit ( 0 ); //ends the program 
    }
}
