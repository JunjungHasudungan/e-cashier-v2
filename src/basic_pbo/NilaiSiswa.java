package basic_pbo;

public class NilaiSiswa {
	// melakukan registrasi properti global
	public String nama;
	public String kelas;
	public int nilai_rata_rata;
	public int nilai_basis;
	public int nilai_web;
	public String grade;
	
	// membuat fungsi setter untuk nama
	public void setNama(String nama) {
		this.nama = nama;
	}
	
	// membuat fungsi getter untuk nama
	public String getNama() { 
		return this.nama;
	}
	
	public void setKelas(String kelas) {
		this.kelas = kelas;
	}
	
	// membuat fungsi getter untuk nama
	public String getKelas() { 
		return this.kelas;
	}
	
	public int getNilaiRataRata() {
		return ( this.nilai_web + this.nilai_basis ) / 2;
	}
	
	public void setNilaiWeb(int nilai_web) {
		this.nilai_web = nilai_web;
	}
	
	public int getNilaiWeb() {
		return this.nilai_web;
	}
	
	public void setNilaiBasis(int nilai_basis) {
		this.nilai_basis = nilai_basis;
	}
	
	public int getNilaiBasis() {
		return this.nilai_basis;
	}
	
	public String getGrade() {
		// mengambil nilai rata-rata
		int totalNilai = this.getNilaiRataRata();
		
		// melakukan pengecekan grade berdasarkan nilai total
		if(totalNilai > 95) {
			this.grade = "A+";
		}else if(totalNilai > 90) {
			this.grade = "A";
		}else if(totalNilai > 85) {
			this.grade = "B+";
		}else if(totalNilai > 80) {
			this.grade = "B";
		}else if(totalNilai > 75) {
			this.grade = "C+";
		}else if(totalNilai > 70) {
			this.grade = "C";
		} else {
			this.grade = "F";
		}
		return this.grade;
	}
}
