package inputan_user_dua_dimensi;

public class InputanNilai {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int myNumbers[][] = new int[][] {
			{1, 4, 2},
			{3, 6, 8}
		};
		
		// melakukan perulangan
		for(int kolom = 0; kolom < myNumbers.length; kolom++) { 
			for(int baris = 0; baris < myNumbers[kolom].length; baris++) { 
				System.out.print(myNumbers[kolom][baris] + "  ");
			}
			System.out.println();
		}
	}

}
