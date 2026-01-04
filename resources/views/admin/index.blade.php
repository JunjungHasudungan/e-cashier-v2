<x-app-layout>
    <div class="py-12" x-data="stateListProduct()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- start alert dialog --}}
                    {{-- end alert dialog --}}

                    {{-- start komponent toggle form create product --}}
                    {{-- end komponent toggle form create product --}}

                    {{-- start komponent table --}}
                    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <table class="w-full text-sm text-left rtl:text-right text-body">
                            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Kode Produk
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Ukuran
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Jumlah Stok
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- start melakukan pengecekan jika data listProduct lebih dari 0 --}}
                                <template x-if="listProduct.length > 0">
                                    {{-- start melakukan perulangan--}}
                                    <template x-for="(product, index) in listProduct" :key="index">
                                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                            <th x-text="index + 1" scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">

                                            </th>
                                            <td x-text="product.name" class="px-6 py-4">

                                            </td>
                                            <td x-text="product.code" class="px-6 py-4">

                                            </td>
                                            <td x-text="product.price" class="px-6 py-4">

                                            </td>
                                            <td x-text="product.size" class="px-6 py-4">

                                            </td>
                                            <td class="px-6 py-4">
                                            {{-- start pengecekan jumlah stok produk --}}
                                            <template x-if="product.stocks">
                                                <p>ada stok produk</p>
                                            </template>
                                            {{-- end pengecekan jumlah stok produk --}}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="#" class="font-medium text-fg-brand hover:underline">Edit</a>
                                            </td>
                                        </tr>
                                    </template>
                                    {{-- end melakukan perulangan --}}
                                </template>
                                 {{-- end melakukan pengecekan jika data listProduct lebih dari 0 --}}

                            </tbody>
                        </table>
                    </div>
                    {{-- end komponent table --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
