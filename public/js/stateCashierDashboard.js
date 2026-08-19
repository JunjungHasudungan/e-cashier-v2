function stateCashierDashboard() {
    return {
        // registrasi objek / array
        listProduct: [],

        // membuat array untuk menampung order produk kedalam keranjang
        listProductOnCart: [],

        alertMessage: { list_product: '', success_order: '', warning_order: '' },

        dataOrderProduct: { jumlah_uang: 0, order_product: [], type: 'website'},

        total_pembayaran: 0,


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

        // membuat fungsi addProductToCart
        addProductToCart(product) {
            // mengambil data product dalam keranjang
            let productExist = this.listProductOnCart.find(item => item.id === product.id)

            // melakukan pengecekan data produk ada atau tidak
            if(productExist) {
                productExist.qty += 1
            } else {
                // menambahkan data objek produk kedalam array
                this.listProductOnCart.push({
                    ... product,
                    qty: 1,
                    stock: product.stocks.quantity
                })
            }
            console.log('data produk dalam keranjang', this.listProductOnCart)
        },
        removeProductFormCart(productId) {
            // jika tidak ada product kembali keawal
            if(!productId) return

            // menghapus / menghilangkan product dari keranjang
            this.listProductOnCart = this.listProductOnCart.filter(product=> product.id != productId)

            // console.log('product id', productId)
        },
        // fungsi untuk menambah jumlah produk dalam keranjang
        incrementProductQty(product) {
            if(product.qty < product.stock) {
                product.qty++
            }
        },
        decrementProductQty(product) {
            if(product.qty > 1) {
                product.qty--
            }
        },
        // mengembalikan product yang ada didalam keranjang
        productOnCart(productId) {
            return this.listProductOnCart.some(item => item.id == productId)
        },
        async btnBayar() {
            try {


            this.total_pembayaran = this.listProductOnCart.reduce((sum, objProduct)=> sum +(objProduct.price * objProduct.qty),0)

            if(this.dataOrderProduct.jumlah_uang < this.total_pembayaran ) {
                this.alertMessage.warning_order = 'uang tidak cukup'
                return
            }

            this.dataOrderProduct.order_product = this.listProductOnCart.map((productOrder)=> ({
               product_id: productOrder.id,
               qty: productOrder.qty,
               price: productOrder.price
            }))

             console.log('data yang mau dikirim', this.dataOrderProduct)

            let result = await axios.post('checkout-order', this.dataOrderProduct)
            console.log('data yang mau dikirim', result)

            } catch (error) {
                console.log('error', error)
            }
        }


    }
}
