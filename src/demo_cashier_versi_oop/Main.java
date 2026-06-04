package demo_cashier_versi_oop;
import java.io.*;
import java.util.*;

public class Main {
	public static boolean confirmation(String message) { 
		// membuat argument untuk bertanya
		Scanner terminalInput = new Scanner(System.in);
		
		// menangkap inputan berdasarkan pesan yang mau ditampilkan
		System.out.print("\n" + message + "(y|n)?");
		String pilihanUser = terminalInput.next();
		
		// pengecekan inputan 
		while(! pilihanUser.equalsIgnoreCase("y") && ! pilihanUser.equalsIgnoreCase("n")) { 
			System.err.println("Pilihan anda bukan y atau n");
			System.out.print("\n" + message + " y|n");
			pilihanUser = terminalInput.next();
		}
		// mengembalikan nilai y
		return pilihanUser.equalsIgnoreCase("y");
	}
	
	public static void listProducts(Product productModel) {

	    List<Product> allProducts = productModel.all();

	    System.out.println("\n====================== LIST PRODUCT ======================");
	    System.out.printf("%-15s %-25s %-10s%n", "Kode Product", "Nama Product", "Harga");
	    System.out.println("-----------------------------------------------------------");

	    if (allProducts.isEmpty()) {
	        System.out.println("Tidak ada data.");
	    } else {
	        for (Product p : allProducts) {
	            System.out.printf("%-15s %-25s %-10s%n",
	                    p.getKode(),
	                    p.getNama(),
	                    p.getHarga()
	            );
	        }
	    }

	    System.out.println("===========================================================\n");
	}
	
	public static void createProduct(Product productModel, Scanner input) {
	    System.out.print("Masukkan kode: ");
	    String kode = input.next();

	    System.out.print("Masukkan nama: ");
	    String nama = input.next();

	    System.out.print("Masukkan harga: ");
	    int harga = Integer.parseInt(input.next());

	    Product p = new Product(kode, nama, harga);

	    productModel.create(p);

	    System.out.println("Produk berhasil ditambahkan.");
	}
	
	public static void updateProduct(Product productModel, Scanner input) {
	    System.out.print("Masukkan kode yang akan diubah: ");
	    String kode = input.next();

	    System.out.print("Nama baru: ");
	    String nama = input.next();

	    System.out.print("Harga baru: ");
	    int harga = Integer.parseInt(input.next());

	    Product p = new Product(kode, nama, harga);

	    productModel.update(p);

	    System.out.println("Produk berhasil diupdate.");
	}
	
	public static void deleteProduct(Product productModel, Scanner input) {
	    System.out.print("Masukkan kode yang akan dihapus: ");
	    String kode = input.next();

	    boolean deleted = productModel.delete(kode);

	    if (deleted)
	        System.out.println("Produk berhasil dihapus.");
	    else
	        System.out.println("Produk tidak ditemukan.");
	}
	
	public static void findProduct(Product productModel, Scanner input) {
	    System.out.println("\n=== CARI PRODUK ===");

	    System.out.print("Masukkan kode produk: ");
	    String kode = input.next();

	    Product product = productModel.findBy(kode);

	    if (product != null) {

	        System.out.println("\n====================== HASIL PENCARIAN ======================");
	        System.out.printf("%-15s %-25s %-10s%n", "Kode Product", "Nama Product", "Harga");
	        System.out.println("-------------------------------------------------------------");

	        System.out.printf("%-15s %-25s %-10s%n",
	        		product.getKode(),
	        		product.getNama(),
	        		product.getHarga()
	        );

	        System.out.println("==============================================================\n");

	    } else {
	        System.out.println("Produk tidak ditemukan.");
	    }
	}

	public static void main(String[] args) {

	    Scanner terminalInput = new Scanner(System.in);
	    boolean isLanjutkan = true;

	    Product productModel = new Product(); 

	    System.out.println("==== Aplikasi Kasir berbasis Desktop ====");

	    while (isLanjutkan) {

	        System.out.println("\n========== MENU UTAMA ==========");
	        System.out.println("1. Lihat data produk");
	        System.out.println("2. Cari data produk");
	        System.out.println("3. Tambah data produk");
	        System.out.println("4. Ubah data produk");
	        System.out.println("5. Hapus data produk");
	        System.out.println("========================================");
	        System.out.print("Pilih menu: ");

	        String jawaban = terminalInput.next();

	        switch (jawaban) {

	        case "1": 
	        	listProducts(productModel);
            break;

	        case "2":
	        	findProduct(productModel, terminalInput);
            break;

	        case "3":
	        	createProduct(productModel, terminalInput);
            break;

	        case "4":
	        	updateProduct(productModel, terminalInput);
            break;

	        case "5":
	        	deleteProduct(productModel,terminalInput);
            break;

	        default:
	            System.out.println("Pilihan tidak valid.");
	        }

	        isLanjutkan = confirmation("Apakah ingin melanjutkan?");
	    }

	    System.out.println("Program selesai.");
	}

}
