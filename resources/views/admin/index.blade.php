<x-app-layout>
    <div class="py-12" x-data="stateListProduct()" x-cloak>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                       @include('admin._card_create_product')
                    </div>

                     <div
                        {{-- directive untuk menampilkan card create product --}}
                        x-show="isVisable == 'restock-product'"
                        class="bg-gray-200 fixed inset-0 z-50 flex items-center justify-center w-full bg-black/40">
                        @include('admin._card_restock_product')
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
    @push('scripts')
        <script src="{{ asset('js/stateListProduct.js') }}"></script>
    @endpush
</x-app-layout>
