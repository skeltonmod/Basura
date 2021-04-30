/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package abgaoagain;
import javax.swing.*;
/**
 *
 * @author CompLab2
 */
public class Abgaoagain {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
     String s1,s2,s3,iName,school;
     double g=0,g1,g2,g3,average;
    s1 = JOptionPane.showInputDialog("Enter Subject name");
    g1 = Double.parseDouble(JOptionPane.showInputDialog("Enter Grade"));
    s2 = JOptionPane.showInputDialog("Enter Subject name");
    g2 = Double.parseDouble(JOptionPane.showInputDialog("Enter Grade"));
   s3 = JOptionPane.showInputDialog("Enter Subject name");
    g3 = Double.parseDouble(JOptionPane.showInputDialog("Enter Grade"));
    school = JOptionPane.showInputDialog("Enter School");
    iName = JOptionPane.showInputDialog("Enter Instructor Name");
    Math.round((average = (g1+g2+g3)/3));
    JOptionPane.showMessageDialog(null,school+"\n"+iName+
           
            "\n"+s1+" "+g1+
            "\n"+s2+" "+g2+
            "\n"+s3+" "+g3+
            "\nAverage: "+average);
    }
    
}
