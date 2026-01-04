function demoStateListProduct() {
    // mengembalikan data objek stateListProduct
    return {
        // registrasi nama array dan tipe data array kosong
        listProduct: [],

        // properti untuk menampilkan-menyembunyikan card
        isCurrentCard: 'table-product',

        // variable untuk menampung objek produk
        product: {name: '', description: '', price: '', size:'', quantity: ''},

        // variable untuk menampung objek seluruh error field
        errors: {name: '', description: '', price: '', size:'', quantity: ''},

        // properti untuk menampung objek listUkuran
        listSize: {s: 'kecil', m: 'sedang', xl: 'besar'},

        // properti untuk seluruh label
        fieldName: {name: 'Nama', price: 'Harga', description: 'Keterangan', category: 'Kategori', quantity: 'Jumlah'},

        // variable untuk penampung kebeneran valid data
        isValid: false,

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
            // mengambil data beberapa data yang ada didalam field inputan
            let isAnyFilled = Object.values(this.product).some(value => value !== '')

            // pengecekan jika ada beberapa inputan field yang ada data
            if (isAnyFilled) {

                // membuat alert
                let confirmCancel = confirm('yakin untuk membatalkan?')

                // mengecek jika benar konfirmasi cancel
               if(confirmCancel) {
                this.isCurrentCard = 'table-product'

                // reset seluruh field
                this.resetFields()

                // reset seluruh error
                this.resetErrors()
               }
            }
            // menampilkan card table
            this.isCurrentCard = 'table-product'
             this.resetErrors()
        },
        sendDataProduct() {
            // pembuatan try and catch untuk menangkap error ketika pengiriman data ke BE
            try {

                // melakukan looping objek produk agar membongkar data inputan setiap properti
                for (let key in this.product) {

                    // pengecekan jika objek berdasarkan key dari objek tidak ada data inputan
                    if(!this.product[key].toString().trim()) {

                        // memasukkan key kedalan fields
                        let label = this.fieldName[key] || key

                        // memberikan pesan error ke setiap label berdsarkan nama properti produk
                        this.errors[key] = `${label} tidak boleh kosong`

                        // memberhentikan eksekusi dengan memberi nilai isValid is false
                        this.isValid = false
                    }else {
                        // memberikan pesan error kosong karna pengisian data setiap field terisi dengan benar
                         this.errors[key] = ''
                    }

                     if (!this.isValid) return

                    // mengumpulkan seluruh data objek produk kedalam objek agar mudah dikirim
                    let sendProduct = {
                        name: this.product.name,
                        quantity: this.product.quantity,
                        price: this.product.price,
                        category: this.product.category,
                        description: this.product.description
                    }

                    // mengirim data ke BE lewat jalur endpoint
                }
            } catch (error) {

            }

            console.log('mau mengirim data...', this.product)
        },
        resetFields() {
            Object.assign(this.product, {
                name: '',
                quantity: '',
                price: '',
                category: '',
                description: ''
            })
        },
        resetErrors() {
            Object.assign(this.errors, {
                name: '',
                quantity: '',
                price: '',
                category: '',
                description: ''
            })
        }
    }
}
