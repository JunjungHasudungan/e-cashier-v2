package belajar_jenis_array;
// MELAKUKAN IMPORT CLASS SCANNER
import java.util.Scanner;

public class Array_dua_dimensi {

	public static void main(String[] args) {
		// MELAKUKAN INSTANSIASI CLASS OBJECT SCANNER
		Scanner terminalInput = new Scanner(System.in);
		
		System.out.println("==== BELAJAR ARRAY DUA DIMENSI ==== ");
		
		// ARRAY 2 DIMENSI SEBAGAI DATA ROW / KOLOM
		 String jadwal_pelajaran[][] = {
				 {"PBO"}, // SENIN
				 {"BASIS DATA",  "WEBSITE",}, // SELASA
				 {"PBO",  "WEBSITE", "BASIS DATA"}, // RABU
				 {"WEBSITE", "PKK"}, // KAMIS
				 {"PKK", "PEMODELAN"}, // JUMAT
		 };
		 
		 // ARRAY 1 DIMENSI SEBAGAI BARIS
		 String hari_belajar[] = {"SENIN", "SELASA", "RABU", "KAMIS", "JUMAT"};
		 System.out.println("--------------------------------------------------");
		
		 for(int index_hari = 0; index_hari < hari_belajar.length; index_hari++) {
			 System.out.print("|");
			 System.out.printf("%-8s | ", hari_belajar[index_hari]);
			 
			// cetak semua mapel untuk hari tersebut
	            for (int j = 0; j < jadwal_pelajaran[index_hari].length; j++) {
	                System.out.printf("%-12s", jadwal_pelajaran[index_hari][j]);
	            }
	            System.out.println();
		 }
		 System.out.println("--------------------------------------------------");
		 
		 
		 for(int in = 0; in < hari_belajar.length; in++) {
			 System.out.print("masukkan jumlah mapel yang dimasuukkan: ");
			 int jumlah_mapel = terminalInput.nextInt();
		 }
	}

}
