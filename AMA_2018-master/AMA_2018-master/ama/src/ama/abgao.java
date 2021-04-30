/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ama;
import java.util.*;

/**
 *
 * @author CISCO 07
 */
public class abgao {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
    Scanner sc = new Scanner(System.in);
    System.out.println("Enter Value 1");
    int val1 = sc.nextInt();
    System.out.println("Enter Value 2");
    int val2 = sc.nextInt();
        System.out.println(val1+" == "+val2+" = "+(val1 == val2));
        System.out.println(val1+" != "+val2 +" = "+ (val1 != val2));
        System.out.println(val1+" > " +val2 +" = "+(val1 > val2));
        System.out.println(val1+" < " + val2+" = "+(val1 < val2));
        System.out.println(val2+ " <= "+" = "+ (val2 <= val1));
        System.out.println(val2+ " >= "+ val1+" = " + (val2 >= val1));
    }
    
}
