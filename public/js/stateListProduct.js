function stateListProduct() {
    // mengembalikan data objek stateListProduct
    return {
        listProduct: [], // registrasi nama array dan tipe data array kosong

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

                // menampilkan data kedalam console
                console.log('data dari BE', this.listProduct)
            } catch (error) {
                // menampilkan pesan error kedalam console
                console.log('error', error)                
            }
        }
    }
}