package type_data;
import java.util.Scanner;
public class Main {

	public static void main(String[] args) {
		// instansiasi class object Scanner
		Scanner scanner = new Scanner(System.in);
		int numbers[] = {10, 23, 51, 24, 22};
		
		System.out.print("masukkan angka yang dicari: ");
		int angka = scanner.nextInt();
		
		int genap = 0;
		int ganjil = 0;
		int posisi = 0;
		boolean ditemukan = false;
		
		for(int index = 0; index < numbers.length; index++) {
			// menghitung jumlah ganjil genap
			if(numbers[index] % 2 == 0) {
				genap++;
			}else {
				ganjil++;
			}
			
			// mencari letak angka inputan
			if(numbers[index] == angka) {
				ditemukan = true;
		        posisi = index;
			}
		}
		
		if(ditemukan) {
			 System.out.println("Posisi angka di urutan " + (posisi + 1));
		}else {
			System.out.println("angka tidak ditemukan");
		}
		System.out.println("Genap: " + genap);
		System.out.println("Ganjil: " + ganjil);

	}

}
