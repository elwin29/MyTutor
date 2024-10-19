<nav class="relative w-full max-w-[1280px] mx-auto h-[140px]">
        <div class="fixed top-10 w-full max-w-[1280px] px-16 z-20">
            <div class="flex items-center w-full max-w-[1280px] h-[100px] mx-auto rounded-full p-5 pl-9 justify-between bg-white shadow-[0px_23px_35px_0px_#0C0F2405]">
                <a href="{{ route('front.index') }}">
                    <img src="{{ asset('assets/images/logos/logo.svg') }}" class="h-10 flex shrink-0" alt="logo">
                </a>
                <ul class="flex items-center gap-8">
                    <li>
                        <a href="#" class="font-semibold text-lg leading-[22.68px] text-tutor-grey">Layanan</a>
                    </li>
                    <div class="h-[18px] border-[1.5px] border-tutor-border"></div>
                    <li>
                        <a href="#" class="font-semibold text-lg leading-[22.68px] text-tutor-grey">Cara Pesan</a>
                    </li>
                    <div class="h-[18px] border-[1.5px] border-tutor-border"></div>
                    <li>
                        <a href="#" class="font-semibold text-lg leading-[22.68px] text-tutor-grey">Testimoni</a>
                    </li>
                    <div class="h-[18px] border-[1.5px] border-tutor-border"></div>
                    <li>
                        <a href="#" class="font-semibold text-lg leading-[22.68px] text-tutor-grey">FAQ</a>
                    </li>
                </ul>
                <a href="{{ route('front.check_booking') }}" class="flex items-center rounded-full border border-tutor-orange/10 bg-tutor-orange/10 h-[60px] px-9 gap-[6px]">
                    <img src="{{ asset('assets/images/icons/receipt-text-orange.svg') }}" class="w-6 flex shrink-0" alt="icon">
                    <span class="font-bold leading-5 text-tutor-orange">Pesanan Saya</span>
                </a>
            </div>
        </div>
    </nav>