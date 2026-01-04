function demoStateListProduct() {
    // mengembalikan data objek stateListProduct
    return {
        // registrasi nama array dan tipe data array kosong
        listProduct: [],

        // properti untuk menampilkan-menyembunyikan card
        isCurrentCard: 'table-product',

        // properti untuk menampung objek produk
        product: {name: '', description: '', price: '', size:'', quantity: ''},

        // properti untuk menampung objek listUkuran
        listSize: {s: 'kecil', m: 'sedang', xl: 'besar'},

        // menggunakan fungsi init untuk menginisilasisasi fungsi pertama kali dirender
        init() {
            // menggunakan kembali fungsi getListProduct
            this.getListProduct()
        },

        // membuat fungsi mengambil data product dari BE
        async getListProduct() {
            // menggunakan try and catch agar menghandle kondisi error bila data tidak
            try {
                // mengambil data melalui url yang sudah disediakan dari BE
                const result = await axios.get('list-product')

                // memasukkan data kedalam variable array listProduct
                this.listProduct = result.data.data

                console.log('data dari BE', this.listProduct)
            } catch (error) {
                // menampilkan pesan error kedalam console
                console.log('error', error)
            }finally {
                // tandai bahwa data sudah selesai dimuat (berhasil atau gagal)
                this.isEmpty = true
            }
        },

        // fungsi handle tombol card 
        btnAddProduct() {
            this.isCurrentCard = 'create-product'
        },
        btnCancelAddProduct() {
            this.isCurrentCard = 'table-product'
        }, 
        sendDataProduct() {
            console.log('mau mengirim data...', this.product)
        }
    }
}
