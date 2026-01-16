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
                    <td class="px-4 py-4">
                    {{-- start pengecekan jumlah stok produk --}}
                    <template x-if="product.stocks">
                        <template x-for="stock in product.stocks" :key="stock.id">
                            <span x-text="stock.quantity"></span>
                        </template>
                    </template>
                    {{-- end pengecekan jumlah stok produk --}}
                    </td>
                    <td class="px-6 py-4 gap-2 text-right inline-flex">
                        <button
                            x-on:click="btnConfirmDelete(product.id)"
                            type="button"
                            class="text-white bg-transparent hover:bg-red-200 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-sm focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>

                        </button>
                        <a href="#" class="font-medium text-fg-brand hover:underline">Edit</a>
                    </td>
                </tr>
            </template>
            {{-- end melakukan perulangan --}}
        </template>
        {{-- end melakukan pengecekan jika data listProduct lebih dari 0 --}}
    </tbody>
</table>
