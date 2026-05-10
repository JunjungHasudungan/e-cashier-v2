<x-app-layout>
    <div class="py-12" x-data="demoStateListProduct()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     <template x-if="listProduct.length == 0">
                        <div class="p-4 mb-4 text-sm text-fg bg-blue-600 rounded-sm" role="alert">
                            <span class="font-medium">Data produk belum tersedia..</span> 
                        </div>
                    </template>
                    {{-- start komponent toggle form create product --}}
                    <!-- Modal toggle -->
                    <button
                        type="button"
                        {{-- pembuatan event click tambah produk --}}
                        x-on:click="btnAddProduct()"
                        x-show="isCurrentCard == 'table-product' "
                        class="inline-flex items-center mb-2 text-white bg-blue-400 rounded-lg hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        <svg class="w-4 h-4 me-1.5 -ms-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                    Produk
                    </button>

                    <!-- Main modal -->
                    <div
                        {{-- directive untuk menampilkan card create product --}}
                        x-show="isCurrentCard == 'create-product'"
                        class="bg-gray-200 fixed inset-0 z-50 flex items-center justify-center w-full bg-black/40">
                        @include('admin._demo_card_create')
                    </div>
                    {{-- end komponent toggle form create product --}}

                    <div
                        {{-- directive untuk menampilkan card create product --}}
                        x-show="isCurrentCard == 'restock-product'"
                        class="bg-gray-200 fixed inset-0 z-50 flex items-center justify-center w-full bg-black/40">
                        @include('admin._card_restock_product')
                    </div>
                    
                    {{-- end komponent toggle form create product --}}

                    {{-- start komponent table --}}
                    <div
                    {{-- directive untuk menampilkan card table product --}}
                        x-show="isCurrentCard == 'table-product'"
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        @include('admin._demo_card_table')
                    </div>
                    {{-- end komponent table --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
