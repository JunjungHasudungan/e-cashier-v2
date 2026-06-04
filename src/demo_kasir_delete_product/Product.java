package demo_kasir_delete_product;

public class Product {
	// registrasi properti product
	public String nama;
	public int harga;
	public String kode;
	
	// pembuatan konstruktor class Product
	public Product(String kode_product, String nama, int harga) {
		this.kode = kode_product;
		this.nama = nama;
		this.harga = harga;
	}
	
	// pembuatan fungsi setNamaProduct
	public void setNamaProduct(String inputNama) {
		this.nama = inputNama;
	}
	
	public String getNamaProduct() {
		return this.nama;
	}
	
	public void setHarga(int hargaProduct) {
		this.harga = hargaProduct;
	}
	
	public int getHargaProduct() {
		return this.harga;
	}
	
	public void setKodeProduct(String kode_product) {
		this.kode = kode_product;
	}
	
	public String getKodeProduct() {
		return this.kode;
	}
	
	
}
