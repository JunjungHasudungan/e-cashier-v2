package demo_kasir_delete_product;

// melakukan 
import java.util.Scanner;
import java.util.ArrayList;

import java.io.*;
import java.util.StringTokenizer;


public class Main {

	static Scanner terminalInput = new Scanner(System.in);
	
	public static void removeRecord(String path, int deleteLine) {
    File oldFile = new File(path);
    File tempFile = new File(oldFile.getParent(), "temp.txt"); // simpan di folder yang sama

    int line = 0;
    String currentLine;

    try (
        BufferedReader br = new BufferedReader(new FileReader(oldFile));
        PrintWriter pw = new PrintWriter(new BufferedWriter(new FileWriter(tempFile, true)));
    ) {
        while ((currentLine = br.readLine()) != null) {
            line++;
            if (deleteLine != line) {
                pw.println(currentLine);
            }
        }
    } catch (Exception e) {
        System.err.println("❌ Terjadi kesalahan: " + e.getMessage());
        return;
    }

    // Pastikan semua stream tertutup dulu sebelum hapus file
    System.gc(); // trik kecil di Windows agar file lock dilepas cepat

    if (oldFile.delete()) {
        if (tempFile.renameTo(oldFile)) {
            System.out.println("✅ Data berhasil dihapus!");
        } else {
            System.err.println("⚠️ Gagal mengganti nama file sementara.");
        }
    } else {
        System.err.println("❌ Gagal menghapus file lama. Pastikan tidak sedang dibuka.");
    }
}

	
	public static void tampilkanData() throws IOException {
		// melakukan registrasi Object FileReader
		FileReader fileInput;
		BufferedReader bufferInput;
		
		try {
			
			fileInput = new FileReader("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\demo-kasir.txt");
            bufferInput = new BufferedReader(fileInput);
            
		}catch(Exception error) {
			System.out.println("Databaase tidak ditemukan..");
			return;
		}
		  String baris;
          System.out.println("===============================================");
          System.out.printf("%-2s %-15s %-20s %-10s%n", "No", "Kode Produk", "Nama Produk", "Harga");
          System.out.println("===============================================");
          
//          bufferInput.readLine();
          int nomorProduct= 0;
          while ((baris = bufferInput.readLine()) != null) {
        	  nomorProduct++;
              String[] data = baris.split(",");

              if (data.length == 3) {
                  System.out.printf("%-2s %-15s %-20s %-10s%n",nomorProduct, data[0].trim(), data[1].trim(), data[2].trim());
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
	
	public static void tambahDataProduct() {
		ArrayList<Product> arrayProduct = new ArrayList<>();
		
		System.out.print("Jumlah Product \t: ");
		int jumlah_product = terminalInput.nextInt();
		
		for(int index = 0; index < jumlah_product; index++) {
			System.out.println("Produk #" + (index + 1));
			// memasukkan kode produk
			System.out.print("Kode Product: ");
			String kodeProduct = terminalInput.next();
			
			
			// memasukakan nama product
			System.out.print("Nama Product: ");
			String namaProduct = terminalInput.next();

			// memasukkan harga product
			System.out.print("Harga Produk: ");
			int hargaProduct = terminalInput.nextInt();
			
			// masukkkan kedalam array List
			
			Product product = new Product(kodeProduct, namaProduct, hargaProduct);
			arrayProduct.add(product);
			System.out.println();
		}
		
		try {

			File fileOutput = new File("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\demo-kasir.txt");
            FileWriter pena = new FileWriter(fileOutput, true);
			
    		// menulis kedalam file database
            for(Product produk : arrayProduct) {
            	pena.write("\n" + produk.getKodeProduct() +"," + produk.getNamaProduct() + "," + produk.getHargaProduct());
            }
            
            pena.close();
            System.out.println("Berhasil menambah data produk");
		}catch(IOException error) {
			System.out.println("");
			error.printStackTrace();
		}
		
	}
	
	
private static void deleteData() throws IOException {
    File database = new File("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\demo-kasir.txt");
    File tempDB = new File("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\tmp-demo-kasir.txt");

    if (!database.exists()) {
        System.err.println("❌ File demo-kasir.txt tidak ditemukan.");
        return;
    }

    System.out.println("List Product:");
    tampilkanData();

    Scanner terminalInput = new Scanner(System.in);
    System.out.print("\nMasukkan nomor produk yang akan dihapus: ");
    int deleteNum = terminalInput.nextInt();
    terminalInput.nextLine();

    boolean isFound = false;
    int entryCount = 0;

    // Gunakan try-with-resources supaya semua stream tertutup otomatis
    try (BufferedReader bufferedInput = new BufferedReader(new FileReader(database));
         BufferedWriter bufferedOutput = new BufferedWriter(new FileWriter(tempDB))) {

        String data;
        while ((data = bufferedInput.readLine()) != null) {
            if (data.trim().isEmpty()) continue;
            entryCount++;

            StringTokenizer st = new StringTokenizer(data, ",");
            String kode = st.nextToken();
            String nama = st.nextToken();
            String harga = st.nextToken();

            if (deleteNum == entryCount) {
                System.out.println("\nData yang ingin dihapus:");
                System.out.println("Kode   : " + kode);
                System.out.println("Nama   : " + nama);
                System.out.println("Harga  : " + harga);

                if (confirmation("Apakah anda yakin ingin menghapus")) {
                    System.out.println("✅ Data berhasil dihapus.");
                    isFound = true;
                    continue; // skip data ini
                }
            }

            bufferedOutput.write(data);
            bufferedOutput.newLine();
        }
    }

    if (!isFound) {
        System.err.println("⚠️ Nomor produk tidak ditemukan.");
    }

    // 💡 Sekarang semua stream sudah tertutup otomatis
    // sehingga file bisa dihapus dengan aman
    boolean deleted = database.delete();
    boolean renamed = tempDB.renameTo(database);

    if (deleted && renamed) {
        System.out.println("✅ Database berhasil diperbarui!");
    } else {
        System.err.println("❌ File lama gagal dihapus atau file baru gagal diganti.");
        System.err.println("Pastikan file tidak dibuka di editor manapun.");
        System.err.println("Deleted: " + deleted + ", Renamed: " + renamed);
    }
}

	public static void hapusDataProduct() throws IOException {
    File databaseOriginal = new File("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\demo-kasir.txt");
    File dbTemp = new File("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\demo-kasir.txt");

    // tampilkan data
    System.out.println("List Produk");
    tampilkanData();

    System.out.print("Masukkan nomor produk yang akan dihapus: ");
    int nomorProduct = terminalInput.nextInt();

    boolean dataIsFound = false;

    try (
        BufferedReader bufferedReader = new BufferedReader(new FileReader(databaseOriginal));
        BufferedWriter bufferWriter = new BufferedWriter(new FileWriter(dbTemp));
    ) {
        String data;
        int urutanData = 0;
        while ((data = bufferedReader.readLine()) != null) {
            urutanData++;
            StringTokenizer st = new StringTokenizer(data, ",");
            boolean isDelete = false;

            if (nomorProduct == urutanData) {
                System.out.println("Kode Product  : " + st.nextToken());
                System.out.println("Nama Product  : " + st.nextToken());
                System.out.println("Harga Product : " + st.nextToken());
                isDelete = confirmation("Yakin menghapus?");
                dataIsFound = true;
            }

//            if(isDelete){
//                //skip pindahkan data dari original ke sementara
//                System.out.println("Data berhasil dihapus");
//            } else {
//                // kita pindahkan data dari original ke sementara
//                bufferedOutput.write(data);
//                bufferedOutput.newLine();
//            }
//            data = bufferedInput.readLine();
        }
    }

    if (!dataIsFound) {
        System.err.println("Produk tidak ditemukan.");
    }

    // Setelah keluar dari try, semua file otomatis tertutup
    if (databaseOriginal.delete()) {
        if (dbTemp.renameTo(databaseOriginal)) {
            System.out.println("Database diperbarui.");
        } else {
            System.err.println("Gagal mengganti file database.");
        }
    } else {
        System.err.println("❌ File lama gagal dihapus. Pastikan tidak dibuka di tempat lain.");
    }
}
	
	
	public static void cariDataProduct() {
		System.out.println("MENCARI DARA PRODUCT");
	}
	
	public static void main(String[] args) throws IOException {
		boolean isLanjutkan  = true;
		
//		ArrayList<Product> arrayProduct = new ArrayList<>();
		File fileOutput = new File("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\demo-kasir.txt");
		 // mengecek file 
        if(fileOutput.createNewFile()) {
        	System.out.println("File created successfully");
        }else {
        	System.out.println("File already exist");
        }
		
		System.out.println("==== APLIKASI DEMO KASIR BERBASIS JAVA DELETE PRODUCT ==== ");
		
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
					System.out.println("Ubah Produk");
					//ubah data produk
				break;
				
				case "5":
					System.out.println("Hapus Produk");
//					hapusDataProduct();
//					deleteData();
					removeRecord("C:\\Users\\User\\eclipse-workspace\\dasar_dasar_java_x_1\\demo-kasir.txt", 1);
				break;
				default:
					System.out.println("Pilihan anda tidak sesuai: ");
				break;
			}
			isLanjutkan = confirmation("Apakah anda ingin melanjutkan");
		}
	}

}
