<footer class="bg-green md: text-base rounded-tl-[20px] rounded-tr-[20px] rounded-bl-none
rounded-br-none pt-8">
    <div class="pl-4 pr-4">
        <nav class="footer-top space-small-top space-bottom grid grid-cols-2 gap-y-8">
                <div class="footer-section-for-job-seekers col-row-1 col-cols-1 px-3">
                    <h2 class="footer-h2-for-job-seekers text-yellow font-bold leading-relaxed">For Job Seekers</h2>
                    <ul class="footer-ul-for-job-seekers">
                        <li class="footer-il-for-job-seekers">
                            <a class="footer-a-for-job-seekers text-strokethin">Find a Job</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-section-for-employers col-row-1 col-cols-2 px-3 ">
                    <h2 class="footer-h2-for-employers text-yellow font-bold leading-relaxed">For Employers</h2>
                    <ul class="footer-ul-for-employers">
                        <li class="footer-li-for-employers">
                            <a href="{{ route('manager.dashboard') }}" class="footer-a-for-employers text-strokethin" style="display: block;">Manager dashboard</a>
                            <a class="footer-a-for-employers text-strokethin" style="display: block;">Create Job Openings</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-section-about-open-hiring col-row-2 col-cols-1 px-3 ">
                    <h2 class="footer-h2-about-open-hiring text-yellow font-bold leading-relaxed">About Open Hiring</h2>
                    <ul class="footer-ul-about-open-hiring">
                        <li class="footer-li-about-open-hiring">
                            <a class="footer-a-about-open-hiring text-strokethin">About</a>
                        </li>
                        <li class="footer-li-about-open-hiring">
                            <a class="footer-a-about-open-hiring text-strokethin">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-section-follow-us-on col-row-2 col-cols-2 px-3 ">
                    <h2 class="footer-h2-follow-us-on text-yellow font-bold leading-relaxed">Follow us on</h2>
                    <ul class="footer-ul-follow-us-on flex flex-col gap-y-2 p-0">
                        <li class="footer-li-follow-us-on inline-flex gap-1 items-center">
                            <img src="{{ asset('images/Icon fa-brands-linkedin.svg') }}" alt="LinkedIn logo" class="rounded-full md: h-5">
                            <a class="footer-a-follow-us-on text-strokethin">LinkedIn</a>
                        </li>
                        <li class="footer-li-follow-us-on flex inline-flex gap-1 items-center">
                            <img src="{{ asset('images/Icon fa-brands-square-instagram.svg') }}" alt="Instagram logo" class="rounded-full md: h-5">
                            <a class="footer-a-follow-us-on text-strokethin">Instagram</a>
                        </li>
                        <li class="footer-li-follow-us-on flex inline-flex gap-1 items-center">
                            <img src="{{ asset('images/Icon fa-brands-square-facebook.svg') }}" alt="Facebook logo" class="rounded-full md: w-5 h-5">
                            <a class="footer-a-follow-us-on text-strokethin">Facebook</a>
                        </li>
                    </ul>
                </div>
        </nav>
    </div>



    <div class="flex pt-12 pb-12">
        <img src="{{ asset('images/logo with slogan.png') }}" alt="Open hiring logo"
        class="w-24 h-24 mr-8 ml-auto">
    </div>


</footer>
