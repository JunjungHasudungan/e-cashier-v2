package pengkondisian;
// lakukan import class Scanner
import java.util.Scanner;
public class Main {

	public static void main(String[] args) {
		// buat 1 variable int dengan nama angka
		int angka  = 0;
		
		// melakukan instansiasi class objek
		Scanner keyboard = new Scanner(System.in);
		
		 System.out.print("Masukkan angka :");
		 angka = keyboard.nextInt();
		 // melakukan pengkondisian menggukan if
		 if( angka > 0 ) { 
			 System.out.println("angka: \t" + angka);
		 }
		 

	}

}
