{{-- menambah directive php untuk mengambil data user:cashier melalui model class User --}}
@php
    $userCashier = \App\Models\User::where('role', 'cashier')->get();
@endphp

<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end z-10">
    @auth
        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Log in</a>
            {{-- menambahkan logika menghitung jumah user cashier lebih kecil dari 2 --}}
            @if (Route::has('register') && count($userCashier) <= 2)
                <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Register</a>
            @endif
    @endauth
</div>
