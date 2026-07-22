function stateCashierDashboard() {
    return {
        // registrasi objek / array
        listProduct: [],

        alertMessage: { list_product: '' },

        // inisial fungsi pertama kali dirender
        init() {
            this.getListProduct()
        },
        // inisial nama fungsi
        async getListProduct() {
            // menggunakan try and catch agar menghandle kondisi error bila data tidak
            try {
                // mengambil data melalui url yang sudah disediakan dari BE
                const result = await axios.get('products')

                // memasukkan data kedalam variable array listProduct
                this.listProduct = result.data.data

                console.log('data dari BE', this.listProduct)

                // melakukan pengecekan data bla list product  ada atau bila tidak ada data
                this.alertMessage.list_product = this.listProduct.length > 0
                    ? this.listProduct
                    : 'data produk belum tersedia'
            } catch (error) {
                // menampilkan pesan error kedalam console
                console.log('error', error)
            }finally {
                // tandai bahwa data sudah selesai dimuat (berhasil atau gagal)
                this.isEmpty = true
            }
        },
    }
}
