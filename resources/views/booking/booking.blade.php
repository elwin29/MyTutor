@extends('layouts.master')
@section('content')
    <x-navbar/>
    <main class="flex flex-col w-full max-w-[1280px] mx-auto px-16 gap-9 mt-16">
        <div class="flex flex-col gap-6">
            <div class="flex items-center gap-2">
                <p class="font-semibold text-lg leading-[22px] text-tutor-grey last:text-tutor-black">Home</p>
                <p class="font-semibold leading-5 text-tutor-grey">></p>
                <p class="font-semibold text-lg leading-[22px] text-tutor-grey last:text-tutor-black">
                    {{ $product->name }}
                </p>
                <p class="font-semibold leading-5 text-tutor-grey">></p>
                <p class="font-semibold text-lg leading-[22px] text-tutor-grey last:text-tutor-black">Checkout</p>
            </div>
            <h1 class="font-Grifter font-bold text-[32px] leading-[33px]">Booking Account</h1>
        </div>
        <div class="flex gap-9 mb-20">
            <div id="Product-Info" class="product-card flex flex-col w-[368px] h-fit shrink-0 rounded-[32px] overflow-hidden bg-white">
                <div class="w-full h-[180px] flex shrink-0 bg-[#D9D9D9]">
                    <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnails">
                </div>
                <div class="flex flex-col p-6 gap-6">
                    <div class="flex items-center gap-3">
                        <div class="w-[62px] h-[62px] flex shrink-0 rounded-xl overflow-hidden">
                            <img src="{{ Storage::url($product->photo) }}" class="w-full h-full object-contain object-center" alt="icon">
                        </div>
                        <div>
                            <p class="font-bold text-xl leading-[25px]">{{ $product->name }}</p>
                            <div class="flex items-center gap-[2px] mt-[2px]">
                                <img src="{{ asset('assets/images/icons/Star.svg') }}" class="w-6 flex shrink-0" alt="icon">
                                <p class="font-bold text-lg leading-[22px]">4.9</p>
                                <p class="font-semibold leading-[20px] text-tutor-grey">(2120 Reviews)</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-3xl border border-tutor-border p-4 gap-4">
                        <div class="flex items-center justify-between">
                            <p class="font-extrabold text-2xl leading-[30px]">
                            Rp {{ number_format($product->price_per_person, 0, ',', '.') }}
                            </p>
                            <div class="flex items-center rounded-lg p-2 gap-1 bg-tutor-red/10">
                                <img src="{{ asset('assets/images/icons/clock-red.svg') }}" class="w-6 flex shrink-0" alt="icon">
                                <p class="font-bold leading-5 text-tutor-red">{{ $product->duration }} month</p>
                            </div>
                        </div>
                        <hr class="border-tutor-border">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('assets/images/icons/verify-green.svg') }}" class="w-[18px] flex shrink-0" alt="icon">
                            <p class="font-medium text-lg leading-[22px] text-tutor-grey">Lebih hemat 50%</p>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('front.booking_store', $product->slug) }}" class="flex flex-col w-full rounded-[32px] overflow-hidden">
                @csrf
                <div class="flex h-[119px] px-6 pt-8 pb-16 bg-[#007B9D] -mb-8">
                    <p class="w-full text-center font-bold text-lg leading-[22px] text-white">Please enter data correctly! We will send the order receipts to your email</p>
                </div>
                <div class="flex flex-col rounded-[32px] p-8 gap-8 overflow-hidden bg-white">
                    <div class="flex flex-col gap-5">
                        <h2 class="font-bold text-xl leading-[25px]">Personal Informations</h2>
                        <hr class="border-tutor-border">
                        <label class="flex flex-col gap-4">
                            <p class="font-bold text-xl leading-[25px] text-tutor-grey">Full Name</p>
                            <div class="flex items-center rounded-3xl border border-tutor-border p-6 gap-4 bg-tutor-bg-grey focus-within:border-tutor-orange transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/profile-circle-black.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <div class="flex h-6 border border-tutor-border"></div>
                                <input type="text" name="name" id="" class="appearance-none outline-none bg-tutor-bg-grey w-full font-bold text-xl leading-[25px] placeholder:text-tutor-black" placeholder="Enter your name">
                            </div>
                        </label>
                        <label class="flex flex-col gap-4">
                            <p class="font-bold text-xl leading-[25px] text-tutor-grey">WhatsApp Number</p>
                            <div class="flex items-center rounded-3xl border border-tutor-border p-6 gap-4 bg-tutor-bg-grey focus-within:border-tutor-orange transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/whatsapp-black.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <div class="flex h-6 border border-tutor-border"></div>
                                <input type="tel" name="phone" id="phone-number" class="appearance-none outline-none bg-tutor-bg-grey w-full font-bold text-xl leading-[25px] placeholder:text-tutor-black" placeholder="+62 Enter your whatsapp number">
                            </div>
                        </label>
                        <label class="flex flex-col gap-4">
                            <p class="font-bold text-xl leading-[25px] text-tutor-grey">Email Address</p>
                            <div class="flex items-center rounded-3xl border border-tutor-border p-6 gap-4 bg-tutor-bg-grey focus-within:border-tutor-orange transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/sms-black.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                                <div class="flex h-6 border border-tutor-border"></div>
                                <input type="email" name="email" id="" class="appearance-none outline-none bg-tutor-bg-grey w-full font-bold text-xl leading-[25px] placeholder:text-tutor-black" placeholder="Enter your email address">
                            </div>
                        </label>
                    </div>
                    <div class="flex flex-col gap-5">
                        <h2 class="font-bold text-xl leading-[25px]">Price Details</h2>
                        <div class="flex flex-col rounded-3xl border border-tutor-border p-6 gap-6">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-lg leading-[22px] text-tutor-grey">Original Price</p>
                                <p class="font-bold text-xl leading-[25px]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-lg leading-[22px] text-tutor-grey">Harga Patungan</p>
                                <p class="font-bold text-xl leading-[25px]">
                                Rp {{ number_format($product->price_per_person, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-lg leading-[22px] text-tutor-grey">Durasi</p>
                                <p class="font-bold text-xl leading-[25px]">{{ $product->duration }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-lg leading-[22px] text-tutor-grey">Group Capacity</p>
                                <p class="font-bold text-xl leading-[25px]">{{ $product->capacity }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-lg leading-[22px] text-tutor-grey">PPN 11%</p>
                                <p class="font-bold text-xl leading-[25px]">
                                Rp {{ number_format($totalTaxAmount, 0, ',', '.') }}
                                </p>
                            </div>
                            <hr class="border-tutor-border">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-lg leading-[22px] text-tutor-grey">Total Price</p>
                                <p class="font-bold text-xl leading-[25px text-tutor-red">
                                Rp {{ number_format($grandTotalAmount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <button type="submit" class="flex items-center rounded-full h-[60px] px-9 w-full gap-[6px] bg-tutor-orange justify-center">
                            <span class="font-bold text-lg leading-5 text-white">Pesan Sekarang</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('after-scripts')
<script src="{{ asset('js/whatsapp-number.js') }}"></script>
@endpush