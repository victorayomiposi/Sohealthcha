<header class="header rs-nav header-transparent">
    <div class="sticky-header navbar-expand-lg">
        <div class="menu-bar clearfix">
            <div class="container clearfix">
                <div class="menu-logo">
                    <a href="{{ url('/') }}"><img style="width: 7em; height:4em;"
                            src="{{ asset('assets/images/logo-white.png') }}" alt=""></a>
                </div>
                <!-- Mobile Nav Button ==== -->
                <button class="navbar-toggler collapsed menuicon justify-content-end" type="button"
                    data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="nav-search-bar">
                    <form action="#">
                        <input name="search" value="" type="text" class="form-control"
                            placeholder="Type to search">
                        <span><i class="ti-search"></i></span>
                    </form>
                    <span id="search-remove"><i class="ti-close"></i></span>
                </div>
                <!-- Navigation Menu ==== -->
                <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
                    <div class="menu-logo">
                        <a href="#"><img src="{{ asset('assets/images/logo-white.png') }}" alt=""></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ url('/') }}">Home <i class="fa fa-home"></i></a>

                        </li>
                        <li><a href="javascript:;">APPLICANTS<i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('online.candidate.index') }}">Fill Application Form</i></a></li>
                                <li><a href="{{ route('reprint_photocard') }}">Reprint Photocard</i></a></li>
                                <li><a href="{{ route('changecourse') }}">Change Of Course Request</i></a></li>
                                <li><a href="{{ route('exam.date') }}">Check Exam Date</i></a></li>
                                <li><a href="{{ route('candidate_result') }}">Check Exam Result</i></a></li>
                                <li><a href="{{ route('candidate_acceptance') }}">Check Acceptance Letter</i></a></li>
                                <li><a href="{{ route('candidate_admission') }}">Check Admission</i></a></li>
                            </ul>
                        </li>
                        <li class="nav-dashboard"><a href="{{ route('payment.index') }}">Online Payment</i></a></li>
                        <li class="add-mega-menu"><a href="javascript:;">SCHOOL/ACAD. UNITS <i
                                    class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu add-menu">
                                <li class="add-menu-left">
                                    <h5 class="menu-adv-title">SCHOOL/ACAD. UNITS</h5>
                                    <ul>
                                        @foreach ($post as $post)
                                            <li><a target="_blank"
                                                    href="{{ url('/department/view/' . $post->id) }}">{{ $post->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                {{-- <li class="add-menu-right">
                               <img src="{{ asset('assets/images/logo-white.png') }}" alt=""/>
                           </li> --}}
                            </ul>
                        </li>

                        {{-- <li class="nav-dashboard"><a href="javascript:;">Students <i
                                    class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('user_authorization') }}">Login</a></li>
                            </ul>
                        </li> --}}
                    </ul>

                </div>
            </div>
        </div>
    </div>
</header>
