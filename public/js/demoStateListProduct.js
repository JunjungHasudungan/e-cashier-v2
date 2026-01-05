function demoStateListProduct() {
    // mengembalikan data objek stateListProduct
    return {
        // registrasi nama array dan tipe data array kosong
        listProduct: [],

        // properti untuk menampilkan-menyembunyikan card
        isCurrentCard: 'table-product',

        // properti untuk menampilkan-pesan alert response
        responseMessage: {status: '', content: ''},

        // variable untuk menampung objek produk
        product: {name: '', description: '', price: '', size:'', quantity: ''},

        // variable untuk menampung objek seluruh error field
        errors: {name: '', description: '', price: '', size:'', quantity: ''},

        // properti untuk menampung objek listUkuran
        listSize: {s: 'kecil', m: 'sedang', xl: 'besar'},

        // variable untuk penampung nilai process loading
        isProcess: false,

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
        btnCloseAddProduct() {
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
        async sendDataProduct() {
            // pembuatan try and catch untuk menangkap error ketika pengiriman data ke BE
            try {
                // memberi nilai true pada variable isProcess
                this.isProcess = true
                // awal memberi nilai string kosong untuk seluruh objek errors
                for (let key in this.errors) {
                    this.errors[key] = ''
                }

                // mengumpulkan seluruh data objek produk kedalam objek agar mudah dikirim
                let sendProduct = {
                    name: this.product.name,
                    quantity: this.product.quantity,
                    price: this.product.price,
                    size: this.product.size,
                    description: this.product.description
                }

                // mengirim data ke BE lewat jalur endpoint
                const result = await axios.post('demo-store-product', sendProduct)

                // membersihkan seluruh field inputan
                this.resetFields()

                //menutup form create product
                this.btnCloseAddProduct()

                // menampilkan pesan dari response BE
                this.responseMessage.status = 'success'
                this.responseMessage.content = result.data.message

                // menampilkan pesan alert success
                setTimeout(() => {
                    this.responseMessage.status = ''
                }, 2000);

                // memanggil fungsi getListDataProduct
                this.getListProduct()

            } catch (error) {
                if (error.response && error.response.status === 422) {
                    let responseError = error.response.data.errors
                    // reset error FE dulu
                    for (let key in this.errors) {
                        this.errors[key] = ''
                    }
                     // mapping error BE → FE
                    for (let field in responseError) {
                        this.errors[field] = responseError[field][0] // ambil pesan pertama
                    }
                }else {
                    console.log(error)
                }
            }finally {
                // mengembalikan nilai proses ke nilai awal menjadi false
                this.isProcess = false
            }
        },
        resetFields() {
            // memberi nilai kosong kepada objek produk
            Object.assign(this.product, {
                name: '',
                quantity: '',
                price: '',
                size: '',
                description: ''
            })
        },
        resetErrors() {
            // memberi nilai kosong kepada objek errors
            Object.assign(this.errors, {
                name: '',
                quantity: '',
                price: '',
                size: '',
                description: ''
            })
        }
    }
}
