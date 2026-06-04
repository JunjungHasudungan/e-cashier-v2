package demo_cashier_versi_oop;
import java.util.List;

// interface untuk logic bisnis
public interface ProductContractService {
	boolean create(Product product);
    Product findBy(String kode);
    boolean update(Product product);
    boolean delete(String kode);
    List<Product> all();
}
