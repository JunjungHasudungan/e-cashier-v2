package demo_cashier_versi_oop;

import java.io.*;
import java.util.*;

public abstract class Model implements ProductContractService {

	// setiap model class memiliki nama file db sendiri
    protected String fileName; 

    public Model(String fileName) {
        this.fileName = fileName;
    }

    // membuat fungsi untuk membaca seluruh baris file txt
    protected List<String> readAll() {
        List<String> list = new ArrayList<>();

        try {
            File file = new File(fileName);
            if (!file.exists()) return list;

            BufferedReader reader = new BufferedReader(new FileReader(file));
            String line;

            while ((line = reader.readLine()) != null) {
                list.add(line);
            }
            reader.close();

        } catch (Exception e) {
            e.printStackTrace();
        }
        return list;
    }

    // membuat fungsi untuk menulis ulang seluruh isi file
    protected void writeAll(List<String> dataList) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(fileName))) {
            for (String row : dataList) {
                writer.write(row);
                writer.newLine();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

//  menggunakan kembali fungsi create dari ProductContractService
    @Override 
    public boolean create(Product product) {
    	List<String> dataList = readAll();

        // Cek duplikasi kode
        for (String row : dataList) {
            if (row.startsWith(product.getKode() + ",")) {
                System.out.println("Kode sudah ada!");
                return false;
            }
        }

        String newRow = product.getKode() + "," + product.getNama() + "," + product.getHarga();
        dataList.add(newRow);
        writeAll(dataList);
        return true;	
    }
    
 // menggunakan kembali fungsi findBy dari ProductContractService
    @Override 
    public Product findBy(String kode) {
    	List<String> dataList = readAll();
    	 
    	for (String row : dataList) {
             String[] dt = row.split(",");
             if (dt[0].equals(kode)) {
                 return new Product(dt[0], dt[1], Integer.parseInt(dt[2]));
             }
         }
    	 return null;
    }
    
//  menggunakan kembali fungsi update dari ProductContractService
    @Override
    public boolean update(Product product) {
    	 List<String> dataList = readAll();
         boolean found = false;

         for (int i = 0; i < dataList.size(); i++) {
             String[] dt = dataList.get(i).split(",");

             if (dt[0].equals(product.getKode())) {
                 dataList.set(i, product.getKode() + "," + product.getNama() + "," + product.getHarga());
                 found = true;
                 break;
             }
         }

         if (found) writeAll(dataList);
         return found;
    }
    
//  menggunakan kembali fungsi delete dari ProductContractService
    @Override
    public boolean delete(String kode) {
    	 List<String> dataList = readAll();
         boolean found = false;

         Iterator<String> it = dataList.iterator();
         while (it.hasNext()) {
             String row = it.next();
             if (row.startsWith(kode + ",")) {
                 it.remove();
                 found = true;
             }
         }

         if (found) {
             writeAll(dataList);
         }
         return found;
    }
    
//  menggunakan kembali fungsi all dari ProductContractService
    @Override
    public List<Product> all() {
    	 List<String> rows = readAll();
         List<Product> products = new ArrayList<>();

         for (String row : rows) {
             String[] parts = row.split(",");
             if (parts.length == 3) {
                 String k = parts[0];
                 String n = parts[1];
                 int h = Integer.parseInt(parts[2]);
                 products.add(new Product(k, n, h));
             }
         }
         return products;
    }
}
