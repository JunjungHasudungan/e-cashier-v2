<x-app-layout>
    <div class="py-12" x-data="demoStateListProduct()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- start alert dialog --}}
                        <div x-show="responseMessage.status === 'success'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90"
                            class="p-4 mb-4 text-sm text-green-800 rounded-base bg-green-200 rounded-lg" role="alert">
                            <span x-text="responseMessage.content" class="font-medium"></span>
                        </div>
                    {{-- end alert dialog --}}

                    {{-- start komponent toggle form create product --}}


                    <!-- Modal toggle -->
                    <button
                        type="button"
                        x-on:click="btnAddProduct()"
                        x-show="isCurrentCard == 'table-product'"
                        class="inline-flex items-center mb-2 text-white bg-blue-400 rounded-lg hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        <svg class="w-4 h-4 me-1.5 -ms-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                    Produk
                    </button>

                    <!-- Main modal -->
                    <div x-show="isCurrentCard == 'create-product'"
                        class="bg-gray-200 fixed inset-0 z-50 flex items-center justify-center w-full bg-black/40">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-gray-400 border border-default rounded-lg shadow-sm p-6">
                                <!-- Modal body -->
                            <form @submit.prevent="sendDataProduct">
                                    <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nama Produk</label>
                                            <input
                                                type="text"
                                                x-model="product.name"
                                                id="name"
                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                                placeholder="Ketikkan nama produk..."
                                            >
                                            <template x-if="errors.name">
                                                <p class="mt-2.5 text-sm text-red-800" x-text="errors.name"></p>
                                            </template>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="quantity" class="block mb-2.5 text-sm font-medium text-heading">Jumlah Produk</label>
                                            <select x-model="product.quantity" id="quantity" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body">
                                                 <option selected="">Pilih Jumlah</option>
                                                <template x-for="index in 10" :key="index">
                                                    <option :value="index" x-text="index"></option>
                                                </template>
                                            </select>
                                            <template x-if="errors.quantity">
                                                <p class="mt-2.5 text-sm text-red-800" x-text="errors.quantity"></p>
                                            </template>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="price" class="block mb-2.5 text-sm font-medium text-heading">Harga</label>
                                            <input
                                                type="number"
                                                x-model="product.price"
                                                id="price"
                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                                placeholder="Rp.10000"
                                            >
                                            <template x-if="errors.price">
                                                <p class="mt-2.5 text-sm text-red-800" x-text="errors.price"></p>
                                            </template>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="size" class="block mb-2.5 text-sm font-medium text-heading">Ukuran</label>
                                            <select x-model="product.size" id="size" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body">
                                                <option selected="">Pilih Ukuran</option>
                                                <template x-for="size in listSize" :key="size">
                                                    <option :value="size"  x-text="size"></option>
                                                </template>
                                            </select>
                                            <template x-if="errors.size">
                                                <p class="mt-2.5 text-sm text-red-800" x-text="errors.size"></p>
                                            </template>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="description" class="block mb-2.5 text-sm font-medium text-heading">Keterangan Produk</label>
                                            <textarea
                                                x-model="product.description"
                                                id="description"
                                                rows="4"
                                                class="block bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body"
                                                placeholder="Ketikkan keterangan produk disini...">
                                            </textarea>
                                            <template x-if="errors.description">
                                                <p class="mt-2.5 text-sm text-red-800" x-text="errors.description"></p>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 border-default pt-2">
                                        <button type="submit" class="inline-flex items-center rounded-lg text-white bg-blue-400 hover:bg-blue-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                            <svg class="w-4 h-4 me-1.5 -ms-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                        Simpan
                                        </button>
                                        <button
                                            type="button"
                                            x-on:click="btnCloseAddProduct"
                                            class="rounded-lg text-body bg-gray-400 box-border border border-default-medium hover:bg-gray-600 hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- end komponent toggle form create product --}}

                    {{-- start komponent table --}}
                    <div
                        x-show="isCurrentCard == 'table-product'"
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
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
