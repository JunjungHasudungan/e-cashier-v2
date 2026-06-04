package belajar_array;
// melakukan import clas Scanner dari library
import java.util.Scanner;

public class Main {

	public static void main(String[] args) {
	System.out.println("==== BELAJAR INPUTAN USER KEDALAM ARRAY SATU DIMENSI ====");
	
	// MELAKUKAN INSTANSISASI CLASS OBJEK
	Scanner keyboard = new Scanner(System.in);
	
	// MEMBERIKAN ARGUMENT UNTUK MENANGKAP INPUTAN INPUTAN
	System.out.print("MASUKKAN JUMLAH BUAH KEDALAM ARRAY: ");
	
	// MENANGKAP INPUTAN USER DAN MEMASUKKAN KEDALAM VARIABLE
	int jumlah_buah = keyboard.nextInt();
	
	// MEMBUAT VARIABLE ARRAY 1 DIMENSI BERTIPE string
	String fruits[] = new String[jumlah_buah];
	
	// MELAKUKAN PERULANGAN / LOOPING MENGGUNAKAN for
		for(int nilai_awal = 0; nilai_awal < fruits.length; nilai_awal++) {
			// MEMBERIKAN ARGUMENT UNTUK MENANGKAP INPUTAN NAMA BUAH
			System.out.print("Nama Buah[" + (nilai_awal + 1) + "] = ");
		
			// MEMASUKKAN INPUTAN NAMA BUAH KEDALAM ARRAY YANG TELAH DIBUAH
			fruits[nilai_awal] = keyboard.next();
		}
		System.out.println("==============================================");
		System.out.println("NAMA BUAH-BUAHAN DIDALAM ARRAY: ");
		// MELAKUKAN PERULANGAN / LOOPING MENGGUNAKAN for
		for(int index = 0; index < fruits.length; index++) { 

			// MENAMPILKAN KEMBALI NAMA BUAH YANG TELAH DIMASUKKAN OLEH USER
			System.out.println("Nama Buah[" + (index + 1) + "] = " + fruits[index]);
		}
	}
}
