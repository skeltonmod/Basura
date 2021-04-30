/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package abgao;
import javax.swing.*;
/**
 *
 * @author CompLab2
 */
public class Abgao {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        double quantity,price,total;
        String itemName,value1;
        
       itemName = JOptionPane.showInputDialog("Enter Item Name");
       price = Double.parseDouble(JOptionPane.showInputDialog("Enter Item Price"));
       quantity = Double.parseDouble(JOptionPane.showInputDialog("Enter Item Quantity"));
       total = quantity * price;
       JOptionPane.showMessageDialog(null,"You have Ordered " + "\n Item Name: "
               + itemName + "\n Price: "+price+"\n Quantity: "+quantity+"\n\n Your total is: "+total);
    }
    
}
