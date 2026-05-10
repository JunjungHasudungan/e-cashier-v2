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

        // variable penampung nilai untuk kondisi process pengiriman
        isProcessSubmit: false,

        // variable penampung pesan yang akan terjadi
        alertMessage: { list_product: '' },

        // variable penampung original data product dengan relasi stocks
        originalProduct: {name: '', quantity: '', price: '', size: '', description: ''},

        // menampung data product dari BE
        recivedProduct:{},

        // menggunakan fungsi init untuk menginisilasisasi fungsi pertama kali dirender
        init() {
            // menggunakan kembali fungsi getListProduct
            this.getListProduct()
        },

        btnCreateProduct() {
            this.isVisable = 'create-product'
        },

        async btnRestock(productId) {
            try {
                // mengambil data product melalui url yang mengirimkan parameter
                let result = await axios.get(`product/${productId}/edit`)
                
                // memasukkan data product ke recivedProduct
                this.recivedProduct = result.data.response
                console.log('data', this.recivedProduct)

                // menampilkan kedalam form restock
                this.isVisable  = 'restock-product'
            } catch (error) {
                console.log('error', error)
            }
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
                    this.resetFieldErrors()
                    this.isVisable = 'card-table'
                }
                return
            }
            // this.resetField()
            this.isVisable = 'card-table'
            this.resetFieldErrors()
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

        // fungsi untuk reset field error product
         resetFieldErrors() {
            Object.assign(this.errors, {
                name: '',
                price: '',
                quantity: '',
                size: '',
                description: '',
            });
          },

        // fungsi untuk mengirim data keback-end
        async sendDataProduct() {
            try {
                // memberi nilai isProcessSubmit menjadi true
                this.isProcessSubmit = true

                for(let key in this.errors) {
                    this.errors[key] = ''
                }

             // mengumpulkan data kedalam objek baru
             let newDataProduct = {
                name: this.product.name,
                quantity: this.product.quantity,
                price: this.product.price,
                size: this.product.size,
                description: this.product.description,
              }

             // mengirim data ke BE lewat jalur store-post
            const result = await axios.post('product', newDataProduct)

            // melakukan reset seluruh field
            this.resetField()

            // memanggil kembali data baru dari getLisProduct
            await this.getListProduct()

            // menampilkan pesan sucess
            swalSuccess(result.data.message)

            // kembali menampil table product
            this.isVisable = 'card-table'

             } catch(error) {
                if(error.response && error.response.status == 422) {
                   let responseErrorBe = error.response.data.errors

                   // membersikan error di FE terlebih dahulu
                   for(let key in this.errors) {
                        this.errors[key] = ''
                    }

                    // membongkar data responseErrorBe dengan perulangan
                    for(let key in responseErrorBe) {
                        this.errors[key] = responseErrorBe[key][0]
                    }

                this.isProcessSubmit = false

                }else {
                    console.log(error)
                }
              }
            // mengosongkan seluruh field objek errors
         },

        // membuat fungsi mengambil data product dari BE
        async getListProduct() {
            // menggunakan try and catch agar menghandle kondisi error bila data tidak
            try {
                // mengambil data melalui url yang sudah disediakan dari BE
                const result = await axios.get('products')

                // memasukkan data kedalam variable array listProduct
                this.listProduct = result.data.data

                // melakukan pengecekan data bla list product  ada atau bila tidak ada data
                this.alertMessage.list_product =
                    this.listProduct.length > 0
                    ? this.listProduct
                    : 'data produk belum tersedia'
                console.log('data dari BE', this.listProduct)
            } catch (error) {
                // menampilkan pesan error kedalam console
                console.log('error', error)
            }finally {
                // tandai bahwa data sudah selesai dimuat (berhasil atau gagal)
                this.isEmpty = true
            }
        },

        async btnDeleteProduct(productId) {
            try {
                // membuat alert confirmation
                let confirmation = confirm('yakin menghapus?')
                // mengecek jika tidak ada konfirmasi, akan kembali keawal
                if(!confirmation) return

                // mengirim parameter productId kedalam jalur Backend
                let result = await axios.delete(`product/${productId}/delete`)
                // menampilkan pesan yang dikirim dari Backend
                swalSuccess(result.data.message)

                // reload data products yang ada ditable
                this.getListProduct()
            } catch (error) {
                console.log(error)
            }
        }
    }
}
