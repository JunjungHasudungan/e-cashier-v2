package basic_pbo;

// melakukan import class Scanner dari library
import java.util.Scanner;

// melakukan import class ArrayList dari library
import java.util.ArrayList;

public class Main {

	public static void main(String[] args) {
		// melakukan instansiasi class objek Scanner
		Scanner terminalInput = new Scanner(System.in);
		
		// melakukan instansiasi class objek ArrayList
		ArrayList<NilaiSiswa> listNilaiSiswa = new ArrayList<>();
		
		// membuat array untuk mapel
		String mapel[] = {"Basis", "Web"};
		
		// membuat argument inputan user
		System.out.print("Jumlah Siswa: ");
		
		// menangkap inputan user untuk jumlah siswa
		int jumlahSiswa = terminalInput.nextInt();
		
		// melakukan perulangan berdasarkan jumlah siswa
		for(int urutan = 0; urutan < jumlahSiswa; urutan++) { 
			
			// melakukan instansiasi class objek NilaiSiswa
			NilaiSiswa siswa = new NilaiSiswa();
			
			// memberikan argument untuk input nama siswa
			System.out.println("Siswa #" + (urutan + 1));
			
			System.out.print("Nama: ");
			// menangap nama user dan memasukkan kedalam setNama
			siswa.setNama(terminalInput.next());
			
			// memberikan argument untuk input nama siswa
			System.out.print("kelas : ");
			
			// menangap nama user dan memasukkan kedalam setNama
			siswa.setKelas(terminalInput.next());
			
			// melakukan looping untuk array mapel
			for( int index = 0; index < mapel.length; index++) { 
				System.out.print("Nilai " + mapel[index] + " : ");
				// melakukan pengecekan untuk nilai elemen mapel
				if(mapel[index].equals("Basis")) { 
					// memasukkan nilai basis
					siswa.setNilaiBasis(terminalInput.nextInt());
				}
				
				if(mapel[index].equals("Web")) { 
					// memasukkan nilai basis
					siswa.setNilaiWeb(terminalInput.nextInt());
				}
			}
			// memasukkan nilai kedalam objek menggunakan add
			listNilaiSiswa.add(siswa);
			System.out.println("");
		}
		
		System.out.println("==== REKAP NILAI SISWA ==== ");
		
		// melakukan perulangan menggunakan foreach
		for(NilaiSiswa siswa : listNilaiSiswa) { 
			System.out.println("Nama \t\t: " + siswa.getNama()); 
		}
	}
}
