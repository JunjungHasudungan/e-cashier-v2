function stateListProduct() {
    // mengembalikan data objek stateListProduct
    return {
        // registrasi nama array dan tipe data array kosong
        listProduct: [],

        // membuat nama objek dan propertinya
        product: { name: '', quantity: '', price: '', size: '', description: '' },

         // membuat nama objek erors dan propertinya
        errors: { name: '', quantity: '', price: '', size: '', description: '' },

        // membuat nama objek untuk listSize
        listSize: { kecil: 'kecil', sedang: 'sedang', besar: 'besar' },

        // menambahkan properti untuk menampilkan / menutup card setiap component
        isVisable:'card-table',

        // menggunakan fungsi init untuk menginisilasisasi fungsi pertama kali dirender
        init() {
            // menggunakan kembali fungsi getListProduct
            this.getListProduct()
        },

        btnCreateProduct() {
            this.isVisable = 'create-product'
        },

        closeCreateProduct() {
            // mengambil beberapa data yang diinput kedalam field
            let isAnyData = Object.values(this.product).some(value => value !== '')
            // melakukan pengecekan jika ada beberapa data di field
            if(isAnyData) {
                let confirmation = confirm('yakin untuk membatalkan?')

                // jika user benar melakukan konfirmasi -> tutup dan reset
                if(confirmation) {
                    this.resetField()
                    this.isVisable = 'card-table'
                }
                return
            }
            // this.resetField()
            this.isVisable = 'card-table'
        },

        // fungsi untuk reset field product
        resetField() {
            Object.assign(this.product, {
                name: '',
                price: '',
                quantity: '',
                size: '',
                description: '',
            });
          },

        // fungsi untuk mengirim data keback-end
        async sendDataProduct() {
            // mengosongkan seluruh field objek errors
            for(let key in this.errors) {
                this.errors[key] = ''
             }
             console.log(this.product)
             // mengumpulkan data kedalam objek baru
             let newDataProduct = {
                name: this.product.name,
                quantity: this.product.quantity,
                price: this.product.price,
                size: this.product.size,
                description: this.product.description,
              }

             // mengirim data ke BE lewat jalur store-post
            await axios.post('store-product', newDataProduct)
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
        }
    }
}
