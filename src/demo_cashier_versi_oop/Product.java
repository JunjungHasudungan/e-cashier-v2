package demo_cashier_versi_oop;

public class Product extends Model {

    private String kode;
    private String nama;
    private int harga;

    public Product() {
        super("products.txt"); // menggunakan constructor parent
    }

    public Product(String kode, String nama, int harga) {
        super("products.txt"); // menggunakan constructor parent
        this.kode = kode; // memberi nilai melalui variable paramter
        this.nama = nama;
        this.harga = harga;
    }

    // getter
    public String getKode() { 
    	return this.kode; 
	}

    public String getNama() { 
    	return this.nama; 
	}
    
    public int getHarga() { 
    	return this.harga; 
	}
}


