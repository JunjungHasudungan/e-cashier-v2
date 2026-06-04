package belajar_array;

public class Array_satu_dimensi {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		// MEMBUAT ARRAY 1 DIMENSI
		int data_array[] = {21, 33, 32};
		System.out.println("panjang array" + data_array.length);
		
		// MENAMPILKAN ISI DATA ARRAY MANUAL
		System.out.println("MENAMPILKAN ISI DATA ARRAY MANUAL");
		System.out.println(data_array[0]);
		System.out.println(data_array[1]);
		System.out.println(data_array[2]);
		
		System.out.println("MENAMPILKAN ISI DATA ARRAY MELALUI LOOPING");
		for(int urutan = 0; urutan < data_array.length; urutan++) {
			System.out.println(data_array[urutan]);
		}
	}
}
