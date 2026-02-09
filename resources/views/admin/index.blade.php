<x-app-layout>
    <div class="py-12" x-data="stateListProduct()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- start alert dialog --}}
                    {{-- end alert dialog --}}

                    {{-- start komponent toggle form create product --}}
                    <button
                        x-on:click="btnCreateProduct"
                        x-show="isVisable == 'card-table'"
                        class="text-white bg-blue-600 mb-4 rounded-lg box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none"
                        type="button">
                    Tambah Produk
                    </button>

                    <!-- Main modal -->
                    <div  x-show="isVisable == 'create-product'"  class="fixed flex z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-lg max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-gray-400 border border-default rounded-base shadow-sm p-4 md:p-6">

                                <!-- Modal body -->
                                <form @submit.prevent="sendDataProduct">
                                    <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                                        <div class="col-span-2 sm:col-span-1">
                                            <label
                                                for="name"
                                                class="block mb-2.5 text-sm font-medium text-heading">
                                                Nama Produk
                                            </label>
                                            <input
                                                type="text"
                                                x-model="product.name"
                                                id="name"
                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                                placeholder="Type product name"
                                            >
                                            {{-- menampilkan pesan error nama produk --}}
                                            <template x-if="errors.name">
                                                <p x-text="errors.name" class="mt-2.5 text-sm text-red-400"></p>
                                            </template>

                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label
                                                for="price"
                                                class="block mb-2.5 text-sm font-medium text-heading">
                                                Jumlah Produk
                                            </label>
                                        <select x-model="product.quantity" id="product.quantity" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body">
                                                <option selected="">Pilih Jumlah</option>
                                                <template x-for="index in 10" :key="index">
                                                    <option :value="index" x-text="index"></option>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label
                                                for="category"
                                                class="block mb-2.5 text-sm font-medium text-heading">
                                                Harga Produk
                                            </label>
                                        <input
                                                type="number"
                                                x-model="product.price"
                                                id="product.price"
                                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                                placeholder="Rp.10000"
                                            >
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label
                                                for="product.size"
                                                class="block mb-2.5 text-sm font-medium text-heading">
                                                Ukuran Produk
                                            </label>
                                            <select
                                                x-model="product.size"
                                                id="product.size"
                                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body">
                                                <option selected="">Pilih Ukuran</option>
                                                <template x-for="size in listSize" :key="size">
                                                    <option :value="size" x-text="size"></option>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="col-span-2">
                                            <label
                                                for="description"
                                                class="block mb-2.5 text-sm font-medium text-heading">
                                            Keterangan Produk
                                            </label>
                                            <textarea
                                                x-model="product.description"
                                                id="product.description"
                                                rows="4"
                                                class="block bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body" placeholder="Write product description here"></textarea>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 pt-2 md:pt-6">
                                        <button type="submit" class="inline-flex items-center  text-white bg-blue-400 hover:bg-blue-600 rounded-lg box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                            <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                        Simpan
                                        </button>
                                        <button x-on:click="closeCreateProduct" type="button" class="text-body bg-gray-200 box-border border border-default-medium hover:bg-gray-400 rounded-lg hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- end komponent toggle form create product --}}

                    {{-- start komponent card table product --}}
                    <div
                        x-show="isVisable == 'card-table'"
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                       @include('admin._card_table')
                    </div>
                    {{-- end komponent table --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
