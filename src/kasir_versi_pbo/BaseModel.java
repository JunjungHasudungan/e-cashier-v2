package kasir_versi_pbo;
// melakukan import class library
import java.util.*;
import java.io.*;

public abstract class BaseModel implements ProductContractService {
	// registrasi nama file
	protected String fileName;
	
	// constructor BaseModel
	public BaseModel(String fileName) {
		this.fileName = fileName;
	}
	
	// membuat fungsi untuk membaca seluruh data
	protected List<String> readAll() {
		List<String> list = new ArrayList<>();
		try {
			// membuat objek file
			File file = new File(fileName);
			if(!file.exists()) { 
				return list; 
			}
			
			// membuat objek untuk membaca file
			BufferedReader reader = new BufferedReader(new FileReader(file));
		
			// membuat variable penampung data file
			String dataContentFile;
			
			// melakukan perulangan dari variable dataContentFile
			while((dataContentFile = reader.readLine()) != null) {  
				list.add(dataContentFile);
			} 
			// update
			reader.close();
		} catch(IOException error) {
			error.printStackTrace();
		}
		
		return list;
	}
	// membuat fungsi untuk menulis seluruh inputan
	
	// membuat fungsi untuk menghapus
	
	// menggunakan fungsi dari ProductContractService
	@Override
	public List<Product> all() {
		// menggunakan fungsi dari readdALL
		List<String> rows = readAll();
		
		// membuat objek arrayList
		ArrayList<Product> listProduct = new ArrayList<>();
		
		// melakukan perulangan untuk membongkar data dari rows
		for(String row : rows) {
			
			// membuat array 1 dimensi 
			String [] parts = row.split(",");
			
			// melakukan pengecekan jika part jumlahnya sama dengan 3
			if(parts.length == 3) {
				String kode = parts[0];
				String nama = parts[1];
				int harga =  Integer.parseInt(parts[2]);
				
				// memasukkan nilai setiap part kedalam class Product
				// melalui listProduct
				listProduct.add(new Product(kode, nama, harga));
				
			}
		}
		
		// mengembalikan objek arraylist
		return listProduct;
	}
}
















