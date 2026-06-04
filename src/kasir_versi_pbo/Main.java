package kasir_versi_pbo;
import java.util.Scanner;
// melakukan import class seluruh io untuk try and catch file
import java.io.*;

// melakukan import seluruh class dari library util
import java.util.*;

public class Main {
	
	// membuat fungsi menampilkan data produk
	public static void listProduct( Product productModel ) { 
		// membuat objek list melalui class Product
		List<Product>  allProducts = productModel.all();
		
		// membuat header table
		System.out.println("\n======== LIST PRODUK ====================");
		// isi kolom table
		System.out.printf("%-15s %-25s %-10s%n", "Kode", "Nama", "Harga");
		System.out.println("--------------------------------------------");
		// melakukan perulangan untuk membongkar data array
		if(allProducts.isEmpty()) { 
			System.out.println("Tidak ada data produk..");
		}else { 
			// melakukan perulangan untuk menampilkan data produk
			for(Product item : allProducts) { 
				System.out.printf("%-15s %-25s %-10s%n",
						item.getKode(), 
						"Nama", 
						"Harga"
						);
			}
		}
		System.out.println("--------------------------------------------");
	} 

	public static boolean confirmation(String message) { 
		Scanner terminalInput = new Scanner(System.in);
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
	
	public static void main(String[] args) {
		// melakukan instansiasi class Scanner ke object
		Scanner terminalInput = new Scanner(System.in);
		// membuat variable bantu
		boolean isLanjutkan = true;
		// melakukan instansiasi class Product menjadi objek product
		Product productModel = new Product();
		// membuat argument judul aplikasi
		System.out.println("==== Aplikasi Kasir Berbasis Desktop ====");
		// melakukan perulangan menggunakan while
		while(isLanjutkan) { 
			// membuat list menu kasir
			System.out.println("======= MENU UTAMA =======");
			System.out.println("\t 1. lihat data produk");
			System.out.println("\t 2. cari data produk");
			System.out.println("\t 3. Tambah data produk");
			System.out.println("\t 4. Ubah data produk");
			System.out.println("\t 5. Hapus data produk");
			System.out.println("==========================");
			// membuat argument untuk bertanya 
			System.out.print("Pilih Menu: ");
			// menangkap jawaban dari user
			String jawaban = terminalInput.next();
			// membuat switch case
			switch(jawaban) {
			case "1":
				listProduct(productModel);
			//System.out.println("MENAMPILKAN DATA TABLE PRODUCT");
			break;
			default: 
				System.out.println("pilihan tidak valid.");
			}
		}
	}

}
