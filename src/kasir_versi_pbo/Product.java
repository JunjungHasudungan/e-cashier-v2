package kasir_versi_pbo;

public class Product extends BaseModel{
	// registrasi properti tentang produk
	public String kode;
	public String nama;
	public int harga;
	
	public Product() {
		// overriding constructor dari parent
		super("product.txt");
	}
	
	// membuat constructor sendiri
	public Product(String kode, String nama, int harga) {
		super("product.txt");
		this.kode = kode;
		this.harga = harga;
		this.nama = nama;
	}
	
	// membuat fungsi untuk create produk
	
	// membuat fungsi untuk delete produk
	
	// membuat fungsi untuk mencari produk
	
	// membuat fungsi untuk mengambil seluruh produk
	
	// membuat fungsi getter pada 3 properti
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















