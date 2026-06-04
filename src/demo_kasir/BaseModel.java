package demo_kasir;
import java.io.*;
import java.util.*;

public abstract class BaseModel {

    protected static String fileName;

    protected static List<String> readAll(String file) throws IOException {
        File f = new File(file);
        if (!f.exists()) return new ArrayList<>();

        BufferedReader br = new BufferedReader(new FileReader(f));
        List<String> result = new ArrayList<>();

        String line;
        while ((line = br.readLine()) != null) {
            result.add(line);
        }
        br.close();
        return result;
    }

    protected static void writeAll(String file, List<String> data) throws IOException {
        BufferedWriter bw = new BufferedWriter(new FileWriter(file));
        for (String line : data) {
            bw.write(line);
            bw.newLine();
        }
        bw.close();
    }
}
