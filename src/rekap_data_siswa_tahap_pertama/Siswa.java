package rekap_data_siswa_tahap_pertama;

public class Siswa {
	// PEMBUATAN PROPERTI GLOBAL TENTANG SISWA
	public String nama_siswa;
	public String kelas;
	public int nilai_dkk;
	public int nilai_informatika;
	public int nilai_rata_rata;
	public String grade;
	
	// fungsi setter setNama
	public void setNama(String nama_siswa) { 
		this.nama_siswa = nama_siswa;
	}
	
	// fungsi getter getNama
	public String getNama() {
		return this.nama_siswa;
	}
	
	public void setNilaiDkk(int nilai_input_ddk) {
		this.nilai_dkk = nilai_input_ddk;
	}
	
	public void setKelas(String input_kelas) {
		this.kelas = input_kelas;
	}
	
	public String getKelas() {
		return this.kelas;
	}
	
	
	public int getNilaiDkk() {
		return this.nilai_dkk;
	}
	
	public int getNilaiInformatika() {
		return this.nilai_informatika;
	}
	
	public void setNilaiInformatika(int input_nilai_informatika) {
		this.nilai_informatika = input_nilai_informatika;
	}
	
	// fungsi untuk mencari nilai rata-tata 
	public int getNilaiRataRata() {
		return (this.nilai_dkk + this.nilai_informatika) /2;
	}
	
	// membuat fungsi mengecek grade dari rata-rata
	public String getPredicate() { 
		// mengambil nilai rata rata
		int total_rata_rata = this.getNilaiRataRata();
		
		// melakukan pengecekan melalui validasi 
		if(total_rata_rata > 95) { 
			this.grade = "A+";
		}else if(total_rata_rata > 90) {
			this.grade = "A";
		}else if(total_rata_rata > 85) {
			this.grade = "B+";
		}else if(total_rata_rata > 80) {
			this.grade = "B";
		}else if(total_rata_rata > 75) {
			this.grade = "C+";
		}else if(total_rata_rata > 70) {
			this.grade = "C";
		}else {
			this.grade = "F";
		}
		
		return this.grade;
	}
}







//membuat fungsi getNama

	// membuat fungsi setNilaiDkk
	
	// membuat fungsi setKelas

	// membuat fungsi getKelas
	
	// membuat fungsi getNilaiDkk

	// membuat fungsi getNilaiInformatika

	// membuat fungsi setNilaiInformatika
	
	// fungsi untuk mencari nilai rata-tata 
	
	
	// membuat fungsi mengecek grade dari rata-rata





