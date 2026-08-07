<div>
    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">LIST ORDER</h2>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-s-base font-medium">
                        Nama Produk
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Jumlah
                    </th>
                    <th scope="col" class="px-6 py-3 rounded-e-base font-medium">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3 rounded-e-base font-medium">

                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-if="listProductOnCart.length > 0">
                    <template x-for="product in listProductOnCart" :key="product.id">
                        <tr class="bg-neutral-primary">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap" x-text="product.name"></th>
                            <td class="px-6 py-4">
                                <div class="relative flex items-center">
                                    <button
                                        type="button"
                                        id="decrement-button-1"
                                        x-on:click="decrementProductQty(product)"
                                        data-input-counter-decrement="counter-input-1"
                                        class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary rounded-full text-sm focus:outline-none h-6 w-6">
                                        <svg class="w-3 h-3 text-heading" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/></svg>
                                    </button>
                                    <input
                                        type="text"
                                        id="counter-input-1"
                                        data-input-counter
                                        x-model="product.qty"
                                        class="shrink-0 text-heading border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center"
                                        placeholder=""
                                        required />
                                    <button
                                        type="button"
                                         x-on:click="incrementProductQty(product)"
                                        id="increment-button-1"
                                        data-input-counter-increment="counter-input-1" class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary rounded-full text-sm focus:outline-none h-6 w-6">
                                        <svg class="w-3 h-3 text-heading" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                    </button>
                                </div>
                            </td>
                            {{-- menampilkan harga sesuai jumlah produk --}}
                            <td class="px-6 py-4" x-text="product.qty * parseInt(product.price)"></td>
                            <td class="px-6 py-4">
                                <svg
                                    x-on:click="removeProductFormCart(product.id)"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="cursor-pointer text-red-400 size-4"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                            </td>
                        </tr>
                    </template>
                </template>

            </tbody>
            {{-- melakukan pengecekan jika ada produk dalam keranjang --}}
                <template x-if="listProductOnCart.length > 0">
                    <tfoot>
                        {{-- menampilkan total produk dan total total harga --}}
                        <tr class="font-semibold text-heading">
                            <th scope="row" class="px-6 py-3 text-base">Total</th>
                            <td class="px-6 py-3"
                                x-text="listProductOnCart.reduce((sum, product)=> sum + product.qty,0)">
                            </td>
                            <td class="px-6 py-3"
                                x-text="listProductOnCart.reduce((sum, product)=> sum + (product.qty * product.price),0)">
                            </td>
                        </tr>
                        {{-- menampilkan jumlah bayar dari customer dan tombol bayar --}}
                        <tr class="font-semibold text-heading">
                            <th scope="row" class="px-6 py-3 text-base">Total Pembayaran</th>
                            <td class="px-6 py-3"
                                x-text="listProductOnCart.reduce((sum, product)=> sum + product.qty,0)">
                            </td>
                            <td class="px-6 py-3"
                                x-text="listProductOnCart.reduce((sum, product)=> sum + (product.qty * product.price),0)">
                            </td>
                        </tr>
                    </tfoot>
                </template>
        </table>
    </div>

</div>
