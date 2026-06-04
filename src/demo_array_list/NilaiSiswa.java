package demo_array_list;

public class NilaiSiswa {
	// pembuatan properti global dengan jenis aksesbilitas public
	public String nama_siswa; 
	public int nilai_dkk;
	public int nilai_informatika;
	public String grade_nilai; 
	public String kelas;
	
	// pembuatan fungsi dengan parameter nama
	public void setNama(String nama) {
		this.nama_siswa = nama;
	}
	
	// pembuatan fungsi yang akan mengembalikan nilai berdasarkan nama properti global 
	public String getNama() {
		return this.nama_siswa;
	}
	
	public void setKelas(String kelas) {
		this.kelas = kelas;
	}
	
	public String getKelas() {
		return this.kelas;
	}
	
	public void setNilaiDKK(int nilai_dkk) {
		this.nilai_dkk = nilai_dkk;
	}
	
	public int getNilaiDKK() {
		return this.nilai_dkk;
	}
	
	public void setNilaiInformatika(int nilai_informatika) {
		this.nilai_informatika = nilai_informatika;
	}
	
	public int getNilaiInformatika() {
		return this.nilai_informatika;
	}
	
	public String getGradeNilai() {
		return this.grade_nilai;
	}
	
	public int getNilaiRataRata() {
		return (this.nilai_dkk + this.nilai_informatika) / 2;
	}
	
	public String showGrade() {
		// menampung seluruh total nilai rata-rata
		int totalNilai = this.getNilaiRataRata();
		
		// melakukan validasi pengecekan total nilai berdasarkan nilai pencapaian
		if(totalNilai > 95) {
			this.grade_nilai = "A+";
		} else if(totalNilai > 90) {
			this.grade_nilai = "A";
		} else if(totalNilai > 85) {
			this.grade_nilai = "B+";
		} else if(totalNilai > 80) {
			this.grade_nilai = "B";
		}else if(totalNilai > 75) {
			this.grade_nilai = "C+";
		}else if(totalNilai > 70) {
			this.grade_nilai ="C";
		}else {
			this.grade_nilai = "FAIL";
		}
		
		// mengembalikan grade nilai 
		return this.grade_nilai;
	}
 }
