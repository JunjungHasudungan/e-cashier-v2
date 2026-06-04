package crud_product;

public class Produk {
	// registrasi nama properti produk
	public String nama; // variable global untuk penampung nilai nama produk
	public String kode; // variable global untuk penampung nilai kode
	public int harga; // variable global untuk penampung nilai kode
	
	// membuat constructor class Product
	public Produk(String kode, String nama, int harga) { 
		this.kode = kode;
		this.nama = nama;
		this.harga = harga;
	}
	
	// membuat fungsi setter untuk setNama
	public void setNama(String nama) { 
		this.nama = nama;
	} 
	
	// membuat fungsi getter untuk mengambil nama
	public String getNama() { 
		return this.nama;
	}
	
	// membuat fungsi setter setting kode
	public void setKode(String kode) { 
		this.kode = kode;
	} 
	
	// membuat fungsi getter untuk mengambil kode product
	public String getKode() { 
		return this.kode;
	}
	
	// membuat fungsi setter untuk setting harga
	public void setHarga(int harga) { 
		this.harga = harga;
	} 
	
	// membuat fungsi getter untuk mengambil harga product
	public int getHarga() { 
		return this.harga;
	}
}







