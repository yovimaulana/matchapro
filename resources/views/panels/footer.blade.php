<!-- BEGIN: Footer-->
<footer
    class="footer footer-light {{ $configData['footerType'] === 'footer-hidden' ? 'd-none' : '' }} {{ $configData['footerType'] }}">
    <p class="clearfix mb-0">
        <span class="float-md-start d-block d-md-inline-block mt-25">
            {{-- COPYRIGHT  --}}
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            {{-- <a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a> --}}
            <span class="ms-25 text-primary">SBR Team</span>
            ,
            <span class="d-none d-sm-inline-block">All rights Reserved</span> |
            <span class="d-none d-sm-inline-block">Thank you so Matcha for what you do</span>
        </span>
        <span class="float-md-end d-none d-md-block">
            {{-- Hand-crafted & Made with --}}
            < /> dengan
            <i data-feather="heart"></i>
        </span>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
