package crud_product;
// melakukan import Class Scanner
import java.util.Scanner;

// melakukan import class ArrayList
import java.util.ArrayList;

// melakukan import class File
import java.io.File;

// melakukan import class FileWriter
import java.io.FileWriter;

// melakukan import class file reader
import java.io.FileReader;

// melakukan import class BufferReader
import java.io.BufferedReader;

// melakukan import class IOException
import java.io.IOException;

public class Main {

	// inisialisasi class objek terminalInput
	public static Scanner terminalInput = new Scanner(System.in);
	
	// membuat fungsi konfirmasi lanjut atau tidak
	public static boolean confirmation(String message) { 
		// membuat argument untuk bertanya
		System.out.print("\n" + message + "(y|n)?");
		String pilihanUser = terminalInput.next();
		while(! pilihanUser.equalsIgnoreCase("y") && ! pilihanUser.equalsIgnoreCase("n")) { 
			System.err.println("Pilihan anda bukan y atau n");
			System.out.print("\n" + message + " y|n");
			pilihanUser = terminalInput.next();
		}
		// mengembalikan nilai y
		return pilihanUser.equalsIgnoreCase("y");
	} 
	
	// membuat fungsi tambah data product
	public static void tambahDataProduct() throws IOException { 
		// membuat array objek dari class Produk
		ArrayList < Produk > listProduk = new ArrayList<>();
		
		// memberikan argument pertanyaan tentang jumlah produk
		System.out.print("Jumlah Produk \t: ");
		
		// menangkap nilai inputan tentang jumlah produk
		int jumlah_produk = terminalInput.nextInt();
		
		// melakukan perulangan untuk mengisi data produk
		for( int index = 0; index < jumlah_produk; index++ ) { 
			
			// memberikan argument pertanyaan tentang nama produk
			System.out.print("Nama Produk \t: ");
			
			// menangkap nilai inputan tentang jumlah produk
			String nama_produk = terminalInput.next();
			
			// memberikan argument pertanyaan tentang nama produk
			System.out.print("Kode Produk \t: ");
			
			// menangkap nilai inputan tentang kode produk
			String kode_produk = terminalInput.next();
			
			// memberikan argument pertanyaan tentang nama produk
			System.out.print("Harga Produk \t: ");
			
			// menangkap nilai inputan tentang jumlah produk
			int harga_produk = terminalInput.nextInt();
			
			System.out.println();
			
			// mengisi data produk kedalam objek produk
			Produk objekProduk = new Produk(kode_produk, nama_produk, harga_produk);
			
			// menambahkan siobjek arrayList kedalam objek produk
			listProduk.add(objekProduk);
			System.out.println();
		} 
		// melakukan try and catch file yang digunakan
		try { 
			// mengambil file untuk dibaca
			File fileInput = new File("database-product.txt");
			FileWriter pena = new FileWriter(fileInput, true);
			
			// menulis data produk mengunakan perulangan foreach 
			for(Produk objekProduk : listProduk) { 
				// menulis kedalam file 
				pena.write("\n" + objekProduk.getKode() + "," + 
				objekProduk.getNama() + "," + objekProduk.getHarga());
			}
			// menutup pena
			pena.close();
			System.out.println("Data Berhasil ditambahkan..");
			
		} catch(Exception error) { 
			System.out.println("DATABASE PRODUCT TIDAK DITEMUKAN");
			return;
		}
	}
	
	// membuat fungsi menampilkan data produk
	public static void tampilkanDataProduct() throws IOException { 
		// melakukan instansiasi objek fileReader
		FileReader fileInput;
		// melakukan instansiasi objek buffer
		BufferedReader bufferInput;
		
		try { 
			// mengambil file untuk dibaca
			fileInput = new FileReader("database-product.txt");
			bufferInput = new BufferedReader(fileInput);
			
		} catch(Exception error) { 
			System.out.println("DATABASE PRODUCT TIDAK DITEMUKAN");
			return;
		}
		
		// variable menampung data perbaris
		String baris;
		
		System.out.println("====================================================================");
		System.out.printf("%-15s %-20s %-10s%n", "Kode Product", "Nama Product", "Harga Product");
		System.out.println("====================================================================");
	
		// melakukan perulangan data berdasar baris
		while((baris = bufferInput.readLine()) != null)  { 
			// masukkan kedalam array 
			String [] data = baris.split(",");
			// mengecek kondisi jumlah rownya
			if(data.length == 3) { 
				System.out.printf("%-15s %-20s %-10s%n", data[0].trim(), data[1].trim(), data[2].trim());
			}
		}
		System.out.println("====================================================================");
	
	}
	
	public static void main(String[] args) throws IOException{
		// pembuatan variable local bertipe boolean
		boolean isLanjutkan = true;
		
		// membuat objek file 
		File fileOutput = new File("database-product.txt");
		
		// pengecekan fileOutput ada atau tidak
		if(fileOutput.createNewFile()) { 
			System.out.println("File created succesefully");
		} else { 
			System.out.println("File already exists");
		}
		// membuat argument nama aplikasi
		System.out.println("==== Aplikasi Kasir berbasis Desktop ====");
		
		// melakukan perulangan menggunakan while
		while(isLanjutkan) { 
			// membuat 5 menu
			System.out.println("\t 1. lihat data produk");
			System.out.println("\t 2. cari data produk");
			System.out.println("\t 3. Tambah data produk");
			System.out.println("\t 4. Ubah data produk");
			System.out.println("\t 5. Hapus data produk");
			
			// memberikan argument pertanyaan kepada user
			System.out.print("Pilih menu berapa? ");
			
			// menangkap nilai dari inputan user 
			String jawaban = terminalInput.next();
			
			// membuat pilihan menggunakan switch-case berdasarkan inputan user
			switch(jawaban) { 
			case "1":
				System.out.println("LIHAT LIST PRODUK");
				// menggunakan fungsi tampilkanDataProduct untuk melihat seluruh product
				tampilkanDataProduct();
			break;
			
			case "2":
				System.out.println("LIHAT LIST PRODUK");
				// fungsi untuk melihat seluruh product
			break;
			
			case "3":
				System.out.println("TAMBAH DATA PRODUK");
				// fungsi untuk menambah product product
				tambahDataProduct();
			break;
			
			case "4":
				System.out.println("LIHAT LIST PRODUK");
				// fungsi untuk melihat seluruh product
			break;
			
			case "5":
				System.out.println("LIHAT LIST PRODUK");
				// fungsi untuk melihat seluruh product
			break;
			
			default:
				System.out.println("Pilihan anda tidak sesuai");
			break;
			}
			
			// fungsi untuk konfirmasi
			isLanjutkan = confirmation("Apakah ingin melanjutkan");
		} 
	}

}








