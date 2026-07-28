<div>
    <h2 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">LIST PRODUK</h2>
    <div class="grid grid-cols-2 gap-2 w-full">
        <template x-if="listProduct">
            <template x-for="product in listProduct" :key="product.id">
               <div class="p-2 max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
                    <a href="#">
                        <img class="rounded-xl p-2" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="product image" />
                    </a>
                    <div>
                        <div class="flex items-center space-x-3 mb-6">

                            <span x-text="product?.stocks?.quantity || 0" class="bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">

                            </span>
                        </div>
                        <a href="#">
                            <h5 class="text-xl text-heading font-semibold tracking-tight" x-text="product.name"></h5>
                        </a>
                        <div class="flex items-center justify-between mt-6">
                            <span class="text-3xl font-extrabold text-heading">$599</span>
                            <button type="button" class="inline-flex items-center  text-white bg-blue-400 hover:bg-blue-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-lg text-sm px-3 py-2 focus:outline-none">
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        {{-- menampilkan pesan bila list produk tidak ada --}}
        <template x-if="listProduct == 0">
            <div class="p-2 mb-2 rounded-lg">
                <p class="text-yellow-500 jutify-item-center">tidak ada produk</p>
            </div>
        </template>


        {{-- <div></div>
        <div>
            <img class="h-auto max-w-full rounded-base" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-base" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-base" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-base" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="">
        </div> --}}
    </div>
</div>
