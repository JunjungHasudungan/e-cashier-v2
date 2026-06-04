package belajar_jenis_array;
import java.util.Scanner;
public class Array_satu_dimensi {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		System.out.println("==== BELAJAR ARRAY SATU DIMENSI ==== ");
		Scanner terminalInput = new Scanner(System.in);
		int data_array[] = {12, 10, 11, 21, 12, 10};
	
		System.out.println("-------------------------------");
		for (int i = 0; i < data_array.length; i++) {
		    System.out.printf("| %2d ", i);   // %2d = lebar 2 karakter
		}
		System.out.println("|");
		System.out.println("-------------------------------");

		for (int i = 0; i < data_array.length; i++) {
		    System.out.printf("| %2d ", data_array[i]);
		}
		System.out.println("|");
		System.out.println("-------------------------------");
		
		System.out.print("Angka yang anda Cari: ");
		int mencari_angka = terminalInput.nextInt();
		int jumlah_elemen_dicari = 0;
		
		
		for(int index = 0; index < data_array.length; index++) {
			if(data_array[index] == mencari_angka) {
				System.out.println("angka [" + mencari_angka + "] berada di urutan " + index);
				jumlah_elemen_dicari++;
			}
		}
		
		 String pesan = (jumlah_elemen_dicari > 0) 
				 ? "angka[" +mencari_angka + "] ada sebanyak: " + jumlah_elemen_dicari
						 : "angka [" +mencari_angka + "] tidak ada dalam elemen array";
		
		 System.out.println(pesan);
		 
		
		 
	}
	
}
