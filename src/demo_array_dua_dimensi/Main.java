package demo_array_dua_dimensi;

// MELAKUKAN IMPORT CLASS Scanner dari Library
import java.util.Scanner;

public class Main {

	public static void main(String[] args) {
		
		// MEMBUAT ARRAY 1 DIMENSI UNTUK MATA PELAJARAN
		String [] mapel = {"INFROMATIKA", "D.K.K"};
		System.out.println("==== INPUTAN USER KEDALAM ARRAY 2 DIMENSI ====");
		
		// MELAKUKAN INSTANSIASI CLASS OBJEK DARI CLASS Scanner
		Scanner terminalInput = new Scanner(System.in);
		
		// MEMBERIKAN ARGUMENT UNTUK MENANGKAP INPUTAN USER
		System.out.print("Masukkan Jumlah Siswa \t: ");
		int jumlah_siswa = terminalInput.nextInt();
		
		String list_siswa[] = new String[jumlah_siswa];
		
		int nilai_siswa [][] = new int[jumlah_siswa][mapel.length];
		
 
		for(int index = 0; index < list_siswa.length; index++) {
			System.out.print((index + 1) + ". Nama \t: ");
			list_siswa[index] = terminalInput.next();
			
			// looping jumlah mapel
			for(int index_mapel = 0; index_mapel < mapel.length; index_mapel++) {
				System.out.print("\t" + (index_mapel + 1) + "." + mapel[index_mapel]  + "\t: ");
				nilai_siswa[index][index_mapel] = terminalInput.nextInt();
			}
			System.out.println();
		}
		
		System.out.println("=============================================================");
		
		// melakkan pembongkaran nilai siswa dari array 2 dimensi
		for(int index_siswa = 0; index_siswa < list_siswa.length; index_siswa++) {
			System.out.println((index_siswa + 1) + ". " + list_siswa[index_siswa]);
			for(int hasil_nilai = 0; hasil_nilai < mapel.length; hasil_nilai++) {
				
				System.out.println("\t" + mapel[hasil_nilai] +": " + nilai_siswa[index_siswa][hasil_nilai]);
			}
			System.out.println("-------------------------------------------------------");
		}
	}
}
