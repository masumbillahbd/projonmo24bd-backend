<footer class="bg-light " style="padding:0.75rem;">
    <style>
        .breaking__news .news__ticker .heading .bi.bi-quote {
            font-size: 46px;
            position: relative;
            color: #e98100;
        }
    </style>
    @php
        $settings = \App\Models\Setting::first();
    @endphp
    <div class="container-fluid text-center py-3">
        <div class="d-flex small justify-content-center">
            <div>Powered by <a href="https://www.dataenvelope.com" target="_blank"><strong>Data Envelope</strong></a></div>
        </div>
    </div>
</footer>
