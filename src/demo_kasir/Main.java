package demo_kasir;

import java.util.Scanner;
import java.util.ArrayList;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.File;
import java.io.IOException;
import java.io.*;
import java.util.List; // penambahan list untuk data array

import java.util.StringTokenizer;

public class Main {

	static Scanner terminalInput = new Scanner(System.in);
	
	private static List<String> readAll() throws IOException {
	    File file = new File("database.txt");
	    List<String> list = new ArrayList<>();

	    if (!file.exists()) return list;

	    BufferedReader br = new BufferedReader(new FileReader(file));
	    String line;

	    while ((line = br.readLine()) != null) {
	        if (!line.trim().isEmpty())
	            list.add(line.trim());
	    }
	    br.close();
	    return list;
	}
	
	private static void writeAll(List<String> data) throws IOException {
	    BufferedWriter bw = new BufferedWriter(new FileWriter("database.txt"));
	    for (String line : data) {
	        bw.write(line);
	        bw.newLine();
	    }
	    bw.close();
	}
	
	public static void tampilkanData() throws IOException {
	    List<String> dataList = readAll();

	    System.out.println("===============================================");
	    System.out.printf("%-15s %-20s %-10s%n", "Kode Produk", "Nama Produk", "Harga");
	    System.out.println("===============================================");

	    if (dataList.isEmpty()) {
	        System.out.println("Belum ada data produk.");
	        System.out.println("===============================================");
	        return;
	    }

	    for (String baris : dataList) {
	        String[] data = baris.split(",");
	        if (data.length == 3) {
	            System.out.printf("%-15s %-20s %-10s%n",
	                    data[0].trim(), data[1].trim(), data[2].trim());
	        }
	    }
	    System.out.println("===============================================");
	}

	public static boolean confirmation(String message) {
		Scanner terminalInput = new Scanner(System.in);
		System.out.print("\n" + message + "(y|n)? ");
		String pilihanUser = terminalInput.next();
		while(!pilihanUser.equalsIgnoreCase("y") && !pilihanUser.equalsIgnoreCase("n")) {
			System.err.println("Pilihan anda bukan y atau n");
			System.out.print("\n" + message + "y|n");
			pilihanUser = terminalInput.next();
		}
		return pilihanUser.equalsIgnoreCase("y");
	}
	
	public static void tambahDataProduct() throws IOException {
	    List<String> dataList = readAll();

	    System.out.print("Jumlah Product: ");
	    int jumlah = terminalInput.nextInt();

	    for (int i = 0; i < jumlah; i++) {
	        System.out.println("Produk #" + (i + 1));

	        System.out.print("Kode Product: ");
	        String kode = terminalInput.next();

	        System.out.print("Nama Product: ");
	        String nama = terminalInput.next();

	        System.out.print("Harga Produk: ");
	        String harga = terminalInput.next();

	        dataList.add(kode + "," + nama + "," + harga);
	    }

	    writeAll(dataList);
	    System.out.println("Berhasil menambah data produk.");
	}

	
	private static void cariDataProduct() throws IOException {
	    List<String> dataList = readAll();
	    if (dataList.isEmpty()) {
	        System.out.println("Database kosong.");
	        return;
	    }

	    terminalInput.nextLine(); // menghapus newline sebelumnya
	    System.out.print("Masukan Kode Produk: ");
	    String keyword = terminalInput.nextLine().trim();

	    // Buat keyword lowercase sekali saja
	    String keywordLower = keyword.toLowerCase();

	    boolean found = false;

	    System.out.println("===============================================");
	    System.out.printf("%-15s %-20s %-10s%n", "Kode Produk", "Nama Produk", "Harga");
	    System.out.println("===============================================");

	    for (String baris : dataList) {
	        // case-insensitive: bandingkan versi lowercase keduanya
	        if (baris.toLowerCase().contains(keywordLower)) {
	            found = true;
	            String[] d = baris.split(",");

	            if (d.length == 3) {
	                System.out.printf("%-15s %-20s %-10s%n",
	                    d[0].trim(),
	                    d[1].trim(),
	                    d[2].trim()
	                );
	            }
	        }
	    }

	    if (!found) {
	        System.out.println("Data [" + keyword + "] tidak ditemukan.");
	    }

	    System.out.println("===============================================");
	}	
	
	private static void deleteData() throws IOException {
	    List<String> dataList = readAll();
	    if (dataList.isEmpty()) {
	        System.out.println("Database kosong.");
	        return;
	    }

	    tampilkanData();

	    System.out.print("\nMasukan KODE produk yang akan dihapus: ");
	    String kode = terminalInput.next().toLowerCase();

	    List<String> newList = new ArrayList<>();
	    boolean found = false;

	    for (String baris : dataList) {
	        String[] d = baris.split(",");

	        if (d[0].trim().toLowerCase().equals(kode)) {
	            found = true;

	            System.out.println("\nData yang akan dihapus:");
	            System.out.println("Kode  : " + d[0]);
	            System.out.println("Nama  : " + d[1]);
	            System.out.println("Harga : " + d[2]);

	            if (!confirmation("Apakah anda yakin ingin menghapus data ini?")) {
	                newList.add(baris); // batal hapus
	            }
	        } else {
	            newList.add(baris);
	        }
	    }

	    if (!found) {
	        System.out.println("Produk tidak ditemukan.");
	        return;
	    }

	    writeAll(newList);
	    System.out.println("Data berhasil dihapus.");
	}
	
	public static void main(String[] args) throws IOException {
		boolean isLanjutkan  = true;
		
		ArrayList<Product> arrayProduct = new ArrayList<>();
		File fileOutput = new File("database.txt");
		 // mengecek file 
        if(fileOutput.createNewFile()) {
        	System.out.println("File created successfully");
        }else {
        	System.out.println("File already exist");
        }
		
		System.out.println("==== APLIKASI DEMO KASIR BERBASIS JAVA ==== ");
		
		while(isLanjutkan) {

			System.out.println("1.\tLihat list Produk");
			System.out.println("2.\tCari data Produk");
			System.out.println("3.\tTambah list Produk");
			System.out.println("4.\tUbah list Produk");
			System.out.println("5.\tHapus list Produk");
			System.out.print("Pilihan anda: ");
			String jawaban = terminalInput.next();
			
			switch(jawaban) {
				case "1":
					System.out.println("Lihat list Produk");
					tampilkanData();
				break;
				
				case "2":
					System.out.println("Cari Produk");
					cariDataProduct();
				break;
				
				case "3":
					System.out.println("Tambah Produk");
					tambahDataProduct();
				break;
				
				case "4":
					System.out.println("Tambah Produk");
					tambahDataProduct();
				break;
				
				case "5":
					System.out.println("Hapus Produk");
					deleteData();
				break;
				
				default:
					System.out.println("Pilihan anda tidak sesuai: ");
				break;
			}
			isLanjutkan = confirmation("Apakah anda ingin melanjutkan");
		}
		
		
	}

}
