package demo_array_list;

//Melakukan import class Scanner
import java.util.Scanner;

import rekap_data_siswa_tahap_pertama.Siswa;

//melakukan import class File
import java.io.File;

//melakukan import class untuk menulis file
import java.io.FileWriter;

//melakukan import class IOException
import java.io.IOException;

//melakukan import class ArrayList
import java.util.ArrayList;

public class Main {	
	public static void main(String[] args) {
		try {
			
		// membuat nama file 
		String judul_file = "REKAP NILAI SISWA";
		
		// melakukan instansiasi class object
		Scanner terminalInput = new Scanner(System.in);
		
		// pembuatan array 1 dimensi untuk element mapel
		String mapel[] = {"DKK", "INFORMATIKA"};
		
		// pembuatan arraylist melalui nama class NilaiSiswa
		ArrayList<NilaiSiswa> listNilai = new ArrayList<>();
		
		// memberikan argument untuk input user
		System.out.print("Masukkan jumlah Siswa: ");
		
		// menangkap inputan user dan memasukkan kedalam variable
		int jumlah_siswa = terminalInput.nextInt();
		
		// melakukan looping berdasarkan jumlah siswa
		for(int urutan = 0; urutan < jumlah_siswa; urutan++) {
			
			// melakukan instansiasi class objek dari class NilaiSiswa
			NilaiSiswa siswa = new NilaiSiswa();
			
			// memberikan argument untuk inputan pengisian nama siswa
			System.out.print("Siswa #" + (urutan + 1) + "\nNama \t : ");
			
			// menggunakan nama objek siswa untuk mengambil inputan nama
			siswa.setNama(terminalInput.next());
			
			// memberikan argument untuk inputan pengisian nama kelas
			System.out.print("Kelas \t : ");
			
			// menggunakan nama objek siswa untuk mengambil inputan kelas
			siswa.setKelas(terminalInput.next());
			
			// melakukan looping array mapel
			for(int index_mapel = 0; index_mapel < mapel.length; index_mapel++) {
				
				// memberikan argument untuk inputan pengisian nilai
				System.out.print("Nilai " + mapel[index_mapel] + ": ");
				
				// melakukan pengecekan nama mapel DKK dari element dalam array mapel
				if(mapel[index_mapel].equals("DKK")) {
					
					// menangkap inputan nilai mapel DKK
					siswa.setNilaiDKK(terminalInput.nextInt());
				}
				
				// melakukan pengecekan nama mapel INFORMATIKA dari element dalam array mapel
				if(mapel[index_mapel].equals("INFORMATIKA")) {
					
					// menangkap inputan nilai mapel INFORMATIKA
					siswa.setNilaiInformatika(terminalInput.nextInt());
				}
			}
			// memasukkan semua inputan nilai siswa kedalam array
			listNilai.add(siswa);
			System.out.println("");
		}
		
		// setting width 
		int width = 60;
		String titleLine = "==== " + judul_file.toLowerCase() + " ====";
		int paddding = (width - titleLine.length()) / 2;
		String centerTitle = "" .repeat(Math.max(0, paddding)) + judul_file.toLowerCase();
					
		// membuat objek file
		File file = new File(judul_file.toLowerCase() + ".txt");
		
		if(file.createNewFile()) {
			System.out.println("Created file successfully");
		}else {
			System.out.println("File already exists");
		}
		
		// menulias ke file 
		FileWriter penaFile = new FileWriter(file);
		
		// setting judul file
		penaFile.write(centerTitle.toLowerCase() + "\n\n");
		
		// membuat variable pembantu untuk increment urutan
		int urutanTampilanTerminal = 1;
		int urutan = 1;
		
		// menampilkan argument untuk judul
		System.out.println("==== REKAP NILAI SISWA ==== ");
		
		// melakukan perulangan mengunakan foreach untuk menampilkan kedalam console
		for(NilaiSiswa murid : listNilai) {
			System.out.println("Siswa #" + (urutanTampilanTerminal++));
			System.out.println("Nama \t\t\t: " + murid.getNama());
			System.out.println("Kelas \t\t\t: " + murid.getKelas());
			System.out.println("Nilai Informatika \t: " + murid.getNilaiInformatika());
			System.out.println("Nilai DKK \t\t: " + murid.getNilaiDKK());
			System.out.println("Nilai Rata Rata \t: " + murid.getNilaiRataRata());
			System.out.println("Predikat \t\t: " + murid.getGradeNilai());
			System.out.println();
		}
		
		// melakukan perulangan mengunakan foreach untuk menulis kedalam file
		for(NilaiSiswa murid : listNilai) {
			penaFile.write("Siswa #" + (urutan ++) + "\n");
			penaFile.write("Nama \t\t\t: " + murid.getNama()+ "\n");
			penaFile.write("Kelas \t\t\t: " + murid.getKelas()+ "\n");
			penaFile.write("Nilai Informatika \t: " + murid.getNilaiInformatika()+ "\n");
			penaFile.write("Nilai DKK \t\t: " + murid.getNilaiDKK()+ "\n");
			penaFile.write("Nilai Rata Rata \t: " + murid.getNilaiRataRata()+ "\n");
			penaFile.write("Predikat \t\t: " + murid.getGradeNilai()+ "\n");
			penaFile.write("\n");
		}
		
		penaFile.close();
		
	}catch(IOException error) {
		System.out.println("");
		error.printStackTrace();
	}
		
	}
}
