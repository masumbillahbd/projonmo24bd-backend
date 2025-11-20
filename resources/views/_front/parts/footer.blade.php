@php $settings = setting(); @endphp

<footer class="text-inverse pt-5 pb-3" style="background: #f5f5f5 !important;box-shadow: 0px -4px 11px #e3e3e3;">
    <div class="container">
        <div class="footer__top text-center">
            <div class="row">
                <div class="col-lg-4 border__right__2 border__left__2">
                    <div class="body py-3 d-none d-md-block d-lg-block">
                        <div class="title">
                            <p>ঠিকানা</p>
                        </div>
                        <div class="info">
                            <p class="mb-0" style="line-height: 1.3;">{{ strip_tags($settings->address) }}
                            </p>
                            <p class="mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened"
                                     width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825"
                                     fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 9l9 6l9 -6l-9 -6l-9 6"/>
                                    <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10"/>
                                    <path d="M3 19l6 -6"/>
                                    <path d="M15 13l6 6"/>
                                </svg> {{ $settings->site_email }}</p>
                            <p class="mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone"
                                     width="20"
                                     height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path
                                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                                </svg> {{ $settings->site_mobile }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 border__right__2">
                    <div class="title">
                        <h4 class="text-600">সম্পাদক<br>{{ $settings->editor }}</h4>
                    </div>
                </div>
                <div class="col-lg-4 border__right__2" style="border-right: 1px solid #05483482 !important;">
                    <div class="body py-3 d-none d-md-block d-lg-block">
                        <div class="title">
                            <p>ফলো করুন</p>
                        </div>
                        <div class="info">
                            <nav class="nav social social-white text-center justify-content-center">
                                <a href="{{ $settings->facebook }}" class="facebook me-1 px-1" target="_blank"
                                   style="background: #1877f2"><i
                                        class="bx bxl-facebook"></i></a>
                                <a href="{{ $settings->twitter }}" class="twitter me-1 px-1" target="_blank"
                                   style="background: #1d9bf0"><i
                                        class="bx bxl-twitter"></i></a>
                                <a href="{{ $settings->youtube }}" class="youtube me-1 px-1" target="_blank"
                                   style="background: #ff0000"><i class="bx bxl-youtube"></i></a>
                                <a href="{{ $settings->instagram }}" class="instagram me-1 px-1" target="_blank"
                                   style="background: #c038be"><i
                                        class="bx bxl-instagram"></i></a>
                                <a href="{{ $settings->linkedin }}" class="linkedin me-1 px-1"
                                   style="background: #0077b5"
                                   target="_blank"><i
                                        class="bx bxl-linkedin"></i></a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-12 m-auto">
                    <div class="py-3 d-block d-md-none d-lg-none">
                        <div class="title">
                            <p><b>ঠিকানা</b></p>
                        </div>
                        <div class="info">
                            <p class="mb-0" style="line-height: 1.3;">{{ strip_tags($settings->address) }}</p>
                        </div>
                    </div>
                    <div class="py-3 d-block d-md-none d-lg-none">
                        <div class="title">
                            <p>ফলো করুন</p>
                        </div>
                        <div class="info">
                            <nav class="nav social social-white text-center justify-content-center">
                                <a href="{{ $settings->facebook }}" class="facebook me-1 px-1" target="_blank"
                                   style="background: #1877f2"><i
                                        class="bx bxl-facebook"></i></a>
                                <a href="{{ $settings->twitter }}" class="twitter me-1 px-1" target="_blank"
                                   style="background: #1d9bf0"><i
                                        class="bx bxl-twitter"></i></a>
                                <a href="{{ $settings->youtube }}" class="youtube me-1 px-1" target="_blank"
                                   style="background: #ff0000"><i class="bx bxl-youtube"></i></a>
                                <a href="{{ $settings->instagram }}" class="instagram me-1 px-1" target="_blank"
                                   style="background: #c038be"><i
                                        class="bx bxl-instagram"></i></a>
                                <a href="{{ $settings->linkedin }}" class="linkedin me-1 px-1"
                                   style="background: #0077b5"
                                   target="_blank"><i
                                        class="bx bxl-linkedin"></i></a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row -->
        <hr class="my-3"/>
        <div class="widget footer__url mt-3 position-relative text-center">
            <a href="/privacy-policy" class="text-600">গোপনীয়তা নীতি</a>
            <a href="" class="text-600">ব্যবহারের শর্তাবলী</a>
            <a href="" class="text-600">আমাদের সম্পর্কে</a>
            <a href="/contact-us" class="text-600">যোগাযোগ</a>
        </div>
        <hr class="my-3"/>
        <div class="d-md-flex align-items-center justify-content-center copyright">
            <p class="mb-2 mb-lg-0 text-center">এই ওয়েবসাইটের কোনো লেখা বা ছবি অনুমতি ছাড়া নকল করা বা অন্য কোথাও প্রকাশ করা সম্পূর্ণ বেআইনি।<br>© <?php $date = date('Y'); $date = e_to_b_replace($date); echo $date; ?>
                <strong><span> <a href="/" class="text-600">{{ $settings->site }}</a></span></strong> কর্তৃক সর্বস্বত্ব
                স্বত্বাধিকার
                সংরক্ষিত
            </p>
        </div>
        <div class="credits text-center mt-3 d-none">
            কারিগরি সহায়তায় <a href="https://www.dataenvelope.com/" style="color: #ffa500" target="_blank"><img
                    src="https://www.dataenvelope.com/settings/1730355836_logo.png" class="img-fluid"
                    style="height: 40px; width: auto"></a>
        </div>
    </div>
</footer>