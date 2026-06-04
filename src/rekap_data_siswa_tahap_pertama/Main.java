package rekap_data_siswa_tahap_pertama;
// Melakukan import class Scanner
import java.util.Scanner;

// melakukan import class ArrayList
import java.util.ArrayList;

// melakukan import file
import java.io.File;

// melakukan import file writer
import java.io.FileWriter;

// melakukan import try exception
import java.io.IOException;

public class Main {

	public static void main(String[] args) {
		try {
			// membuat file
			File fileOutput = new File("rekap-nilai-siswa.txt");
			
			// mengecek filenya sudah ada atau belum
			if(fileOutput.createNewFile()) {
				System.out.println("File created successfully");
			}else {
				System.out.println("File already exist");
			}
			
			// melakukan instansiasi class Objek
			Scanner terminalInput = new Scanner(System.in);
			
			// memberikan argument pertanyaan jumlah siswa
			System.out.print("Jumlah Siswa : ");
			
			// menangkap nilai inputan dari argument pertanyaan user
			int jumlah_siswa = terminalInput.nextInt();
			
			// Membuat array mapel 1 dimensi
			String mapel[] = { "D.K.K", "INFORMATIKA" };
			
			// membuat nama objek arrayList
			ArrayList<Siswa> listNilaiSiswa = new ArrayList<>();
			
			// melakukan perulangan untuk mengambil nama siswa 
			for(int urutan = 0; urutan < jumlah_siswa; urutan++) { 
				
				// melakukan instansiasi class objek dari clas Siswa
				Siswa murid = new Siswa();
				
				System.out.println("\nSiswa #" + (urutan + 1));
				
				// memberikan argument untuk menangkap inputan nama siswa
				System.out.print("Nama: ");
				
				// menangkap inputan nama siswa dan memasukkan kedalam fungsi setNama
				murid.setNama(terminalInput.next());
				

				// memberikan argument untuk menangkap inputan kelas siswa
				System.out.print("Kelas: ");

				// menangkap inputan kelas siswa dan memasukkan kedalam fungsi setKelas
				murid.setKelas(terminalInput.next());
				
				// melakukan perulangan untuk array mapel
				for(int index_mapel = 0; index_mapel < mapel.length; index_mapel++) { 
					
					// menampilkan nama element mapel
					System.out.print("nilai " + mapel[index_mapel] + ": ");
					
					// melakukan if / percabangan / kondisi
					if(mapel[index_mapel].equals("D.K.K")) { 
						
						// menangkap inputan nilai dkk
						murid.setNilaiDkk(terminalInput.nextInt());
					}
					
					// melakukan if / percabangan / kondisi
					if(mapel[index_mapel].equals("INFORMATIKA")) { 
						
						// menangkap inputan nilai informatika
						murid.setNilaiInformatika(terminalInput.nextInt());
					}
				} 
				// menambahkan nilai kedalam objek murid
				listNilaiSiswa.add(murid);
				System.out.println();
			}
			
			// memberikan judul
			System.out.println("==== SISTEM REKAP NILAI SISWA ====");
			int index =  1;
			// MELAKUKAN PERULANGAN UNTUK MENAMPILKAN DATA DARI ARRAYLIST
			for(Siswa objectSiswa : listNilaiSiswa) { 
				// membuat urutan siswa 
				System.out.println("siswa ke #" + (index++ ));
				// menampilkan setiap nama siswa
				System.out.println("Nama \t\t\t: " + objectSiswa.getNama());
				
				// menampilkan setiap kelas
				System.out.println("Kelas \t\t\t: " + objectSiswa.getKelas());
				
				// menampilkan nilai informatika
				System.out.println("Nilai Informatika \t: " + objectSiswa.getNilaiInformatika());
				
				// menampilkan nilai dkk
				System.out.println("Nilai DKK \t\t: " + objectSiswa.getNilaiDkk());
				
				// menampilkan nilai rata-rata
				System.out.println("Nilai Rata-Rata: \t: " + objectSiswa.getNilaiRataRata());
				
				// menampilkan nilai predikat
				System.out.println("Predikat \t\t: " + objectSiswa.getPredicate());
				System.out.println();
			}
			
			// mengisi data kedalam file yang sudah dibuat
			FileWriter penForWrite = new FileWriter(fileOutput);
			int urutanSiswa = 1;
			// melakukan perulangan berdasarkan nama  array
			for(Siswa murid : listNilaiSiswa) { 
				// mencetak isi konten kefile perbaris
				penForWrite.write("Siswa #" + (urutanSiswa++) + "\n");
				penForWrite.write("Nama \t\t\t: " + murid.getNama() + "\n");
				
				//tampilkan nama kelas
				penForWrite.write("Kelas \t\t\t: " + murid.getKelas() + "\n");
				
				// nilai informatika
				penForWrite.write("Nilai Informatika \t :" + murid.getNilaiInformatika() + "\n");
				
				// nilai dkk
				penForWrite.write("Nilai DKK \t\t: " + murid.getNilaiDkk() + "\n");
				
				// nilai rata
				penForWrite.write("Nilai Rata-Rata \t: " + murid.getNilaiRataRata() + "\n");
				
				// nilai grade
				penForWrite.write("Predikat \t\t: " + murid.getPredicate() + "\n");
			}
			penForWrite.close();
			System.out.println("");
			
		}catch(IOException error) {
			System.out.println("");
			error.printStackTrace();
		}
		
	}
}














