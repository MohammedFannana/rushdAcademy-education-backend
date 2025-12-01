@php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));

    $currency = auth()->user()->currency ?? Request::cookie('user_currency');
@endphp
<!-- desktop -->
<style>

    .top-bar .right-side .nav .toooltip-content svg{
        color: #c02127 !important;
    }

    .top-bar .right-side .nav .toooltip-content .icon-top-submenu {
        color: #000!important;
        font-size: 15px!important;
        color: #c02127 !important;
    }

    .video-btn img{
        max-width: 218px;
    }

    .active-lang {
        border: 2px solid #FDA706 !important;
        border-radius: 5px !important;
        padding-left: 10px !important;
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        font-weight: bold !important;
    }
</style>
<div class='top-bar'>
    <div class="container-fluid">
        <div class="container">
            <div class="row pt-2">
                <div class="col-9 left-side">
                    <ul class="nav flex-nowrap topbar_system">
                        @if($top_menu)
                            @foreach($top_menu as $key => $topmenu)
                                <div class="toooltip">
                                    <li style="z-index:{{count($top_menu)-$key}};"> @if($topmenu['custom'] == 1) {!!$topmenu['icon'] !!} @else <i class="{{$topmenu['icon']}}" ></i> @endif {{$topmenu['label']}}</li>
                                    <div class="toooltip-content p-3">
                                        <p>{{$topmenu['sub_title']}}</p>
                                    </div>
                                </div>

                            @endforeach
                        @endif
                        <div class="toooltip">

                            <li><i class="fa fa-th"></i> Other Systems</li>
                            <div class="toooltip-content bg-grey">

                                <div class="scrollbar-inner">
                                    <div class="otherSystem">
                                        @if($other_menu)
                                            @foreach($other_menu as $othermenu)
                                                @if($othermenu['child'] == null)
                                                    <div class="box-item font-roboto">

                                                        <a  @if($othermenu['target'] == 'blank') target="_blank" @endif href="{{ $othermenu['link']}}">
                                                            <div class="icons">@if($othermenu['custom'] == 1) {!!$othermenu['icon'] !!} @else <i class="{{$othermenu['icon']}}"></i> @endif </div>
                                                            <div class="name">{{$othermenu['label']}} </div>
                                                        </a>
                                                        <div class="box-dropdown px-3">
                                                            <p>
                                                                {{$othermenu['sub_title']}}
                                                            </p>
                                                            <div class="content-buttons mt-2">
                                                                <button><span><i class="fab fa-android"></i></span>Download MiniApp</button>
                                                                <button><span><i class="fas fa-eye"></i> </span>Homepage</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
                                                @if($othermenu['child'] != null)
                                                    <h3>{{ $othermenu['label']}}</h3>
                                                    @foreach($othermenu['child'] as $sublevel1)
                                                        <div class="box-item top font-roboto">

                                                            <a @if($sublevel1['target'] == 'blank') target="_blank" @endif href="{{ $sublevel1['link']}}">
                                                                <div class="icons">@if($sublevel1['custom'] == 1) {!!$sublevel1['icon'] !!} @else <i class="{{$sublevel1['icon']}}"></i> @endif </div>
                                                                <div class="name">{{$sublevel1['label']}} </div>
                                                            </a>

                                                            <div class="box-dropdown px-3">
                                                                <p>
                                                                    {{$sublevel1['sub_title']}}
                                                                </p>
                                                                <div class="content-buttons mt-2">
                                                                    <button><span><i class="fab fa-android"></i></span>Download MiniApp</button>
                                                                    <button><span><i class="fas fa-eye"></i> </span>Homepage</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif

                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="col-3 right-side">
                    <ul class="nav">

                        <div class="toooltip">
                            <li><i class="kem-top-header-icons-flag"></i></li>
                            <div class="toooltip-content">
                                <ul class="countries">
                                    @if($countries)
                                        @foreach($countries as $country)
                                            <li>{{$country['name']}}</li>
                                            <ul class='states'>
                                                @if($country['country'])
                                                @foreach($country['country'] as $cout)
                                                    <li class="active" data-code="{{$cout['code']}}"><span class="count-flag"><img src="{{asset('country-flags-main/png100px').'/'.$cout['code'].'.png'}}" alt="" /></span><span>{{$cout['name']}}</span></li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="toooltip">
                            <li><i class="kem-top-header-icons-translate"></i></li>
                            <div class="toooltip-content">
                                <ul class="languages">
                                    @for ($i=0;$i< count($lang);$i++)
                                        {{-- <li data-code={{$lang[$i]['code']}} class="active"><span class="lang-flag"><img class="img-fluid" src="{{asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'}}" width="20px" alt=""></span>{{$lang[$i]['name']}}</li> --}}
                                        <li onclick="setLanguage('{{ $lang[$i]['code'] }}')" data-code={{$lang[$i]['code']}} class="{{ $curr_lang == $lang[$i]['code'] ? 'active-lang' : '' }}"><span class="lang-flag"><img class="img-fluid" src="{{asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'}}" width="20px" alt=""></span>{{$lang[$i]['name']}}</li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <div class="toooltip" x-data="{ open: false }">
                            <li><i @click="open = ! open" class="kem-top-header-icons-dollar-symbol"></i></li>
                            <div class="toooltip-click-content" style="z-index: 10000;">
                                <div x-show="open" @click.outside="open = false" class="currenies" style="display:none">
                                    <div class="currency">
                                        <div class="title"><span>Currency</span></div>
                                        <form action="/set-currency" method="POST">
                                            @csrf
                                            <select class="currencies" name="currency" id="currency">
                                                @for ($i=0;$i< count($curr);$i++)
                                                    <option {{ $currency == $curr[$i]['code'] ? 'selected' : '' }} id={{$curr[$i]['id']}} data-code={{$curr[$i]['code']}} value="{{$curr[$i]['code']}}">{{$curr[$i]['name']}}</option>
                                                @endfor
                                            </select>
                                            <button type="submit">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            @for($i = 0; $i < count($user); $i++)
                                <div class='toooltip'>
                                    <li><i class="{{$user[$i]['icon']}}"></i></li>
                                    <div class="toooltip-content">

                                        <div class="grid-menu {{$user[$i]['class']}}">
                                            <p class="label-top">{{$user[$i]['label']}} </p>
                                            @for($j = 0; $j < count($user[$i]['child']); $j++)
                                                <div class="sub-toooltip">
                                                    <div class="items">
                                                        <a href="{{$user[$i]['child'][$j]['link']}}">
                                                            {{-- <span class="{{$user[$i]['child'][$j]['class']}} popup2"></span> --}}
                                                            <i class="{{$user[$i]['child'][$j]['icon']}} icon-top-submenu"></i>
                                                            {{$user[$i]['child'][$j]['label']}}
                                                        </a>
                                                    </div>
                                                    @if(!empty($user[$i]['child'][$j]['child']))
                                                        <div class="sub-toooltip-content">
                                                            <p class="label-top">{{$user[$i]['child'][$j]['label']}}</p>
                                                            <ul>
                                                                @for($v=0;$v < count($user[$i]['child'][$j]['child']);$v++)
                                                                    <li><a href="#"><span class="{{$user[$i]['child'][$j]['child'][$v]['icon']}} me-2 icon-top-submenu"></span>{{$user[$i]['child'][$j]['child'][$v]['label']}}</a></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            @endfor

                            @auth
                                {{-- <div class="toooltip">
                                    <li><div class="avatar"><img src="{{asset('images/avatar.png')}}" alt="profile-image"></div></li>
                                    <div class="toooltip-content">
                                        <div class="user-dropdown">
                                            <ul>
                                                <li><a href="/owner"> <i class="fal fa-home"></i> Dashboard</a></li>
                                                <li><a href="#"><i class="fal fa-sliders-v"></i> Settings</a></li>
                                                <li><a href="{{ route('logout') }}"><i
                                                            class="ri-shut-down-line align-middle me-1"></i> {{ __('Logout') }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- User Menu --}}
                                @include('web.default.includes.top_nav.user_menu')
                            @endauth

                        @guest
                            <li><a href="https://ssoserver.dev2.kemedar.com/sso-login?redirect_uri={{ base64_encode(env('APP_URL')) }}"  class="text-white"><i class="kem-top-header-icons-log-in"></i></a></li>
                            <li><i class="kem-top-header-icons-signup"></i></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- mobile -->
<div class="m-top-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class='top-nav'>
                    <div class="toooltip" x-data="{ open: false }">

                        <li><i @click="open = ! open" class="fal fa-flag"></i></li>
                        <div class="toooltip-content" x-show="open" @click.outside="open = false" style="display: none">
                            <ul class="countries">
                                @if($countries)
                                    @foreach($countries as $con)
                                        <li>{{$con['name']}}</li>
                                        <ul class='states'>
                                            @if($con['country'])
                                                @foreach($con['country'] as $country)
                                                    <li class="active" data-code="{{$country['code']}}" data-currency="{{$country['currency']}}"><span class="count-flag"><img src="{{asset('country-flags-main/png100px').'/'.$country['code'].'.png'}}" alt="" /></span><span>{{$country['name']}}</span></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="toooltip" x-data="{ openl: false }">
                        <li><i @click="openl = ! openl" class="fal fa-language"></i></li>
                        <div class="toooltip-content" x-show="openl" @click.outside="openl = false" style="display: none">
                            <ul class="languages">
                                @if($lang)
                                    @foreach($lang as $lan)
                                        <li onclick="setLanguage('{{ $lan['code'] }}')" data-code={{$lan['code']}} class="{{ $curr_lang == $lan['code'] ? 'active-lang' : '' }}"><span class="lang-flag"><img class="img-fluid" src="{{asset('language-flags/png100px').'/'.$lan['code'].'.png'}}" width="20px" alt=""></span>{{$lan['name']}}</li>
                                    @endforeach

                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="toooltip" x-data="{ openl: false }">
                        <li><i @click="openl = ! openl" class="fal fa-dollar-sign"></i></li>
                        <div class="toooltip-content" x-show="openl" @click.outside="openl = false" style="display: none;transform: translateX(-30%);">
                            <div class="currenies">
                                <div class="currency">
                                    <div class="title"><span>Currency</span> </div>
                                    <form action="#" method="POST">
                                        @csrf
                                        <select class="currencies" name="currency">
                                            @if($curr)
                                                @foreach($curr as $currency)
                                                    <option id={{$currency['id']}} data-code={{$currency['code']}} value="{{$currency['name']}}">{{$currency['name']}} ({{$currency['symbol']}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <button type="submit">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($user)
                        @foreach($user as $us)

                            <div class="toooltip" x-data="{ open: false }">
                                <li><i @click="open = ! open" class="{{$us['icon']}}"></i> </li>
                                <div x-show="open" @click.outside="open = false" style="display: none">

                                    <!-- grid menu content here-->
                                    @if($us['child'])
                                        @if($us['class'] == 'column-3')
                                            <div class="bg-columm-3 toooltip-content">
                                                <div class="grid-menu">
                                                    <p class="label-top">{{ $us['label'] }}</p>

                                                    @foreach($us['child'] as $child)
                                                        <div class="sub-toooltip">
                                                            <div class="items">
                                                                <span class="icon-top-submenu {{$child['icon']}}"></span>
                                                                <span>{{ $child['label']}}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else

                                            <div class="toooltip-content">
                                                <div class="menu">
                                                    <p class="label-top">{{ $us['label'] }}</p>

                                                    @foreach($us['child'] as $child)

                                                        <div class="item">
                                                            <span class="icon-top-submenu {{$child['icon']}}"></span>
                                                            @if (!empty($child['child']))
                                                                <span>{{ $child['label']}}</span>
                                                                <button class="btn btn-toggle align-items-center rounded"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#home-collapse-{{ $child['id'] }}"
                                                                        aria-expanded="false">

                                                                    <i class="fa fa-caret-down"></i>
                                                                </button>
                                                            @else
                                                                <span>{{ $child['label']}}</span>
                                                            @endif

                                                            @if(!empty($child['child']))
                                                                <div class="collapse relative-position ml-3" style="margin-left: 10px" id="home-collapse-{{$child['id']}}">
                                                                    <div class="menu">
                                                                        {{--                                                                            <p class="label-top m-2">{{ $child['label'] }}</p>--}}

                                                                        @foreach($child['child'] as $chChild)

                                                                            <div class="item">
                                                                                <span class="icon-top-submenu {{$chChild['icon']}}"></span>
                                                                                <span>{{ $chChild['label']}}</span>
                                                                            </div>

                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>

                                                    @endforeach
                                                </div>
                                            </div>

                                        @endif
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{-- <li><i class="fal fa-info-circle"></i></li>
                    <li><i class="fal fa-phone-square-alt"></i></li> --}}
                    <div class="toooltip" x-data="{ open: false }">

                        <li><i @click="open = ! open" class="fal fa-video"></i></li>
                        <div class="toooltip-content nav-videos" x-show="open" @click.outside="open = false" style="display: none; left: 0;transform: translateX(-75%);background: #e5e7eb; border-radius: 10px">
                            {{--                    <li><i @click="open = ! open" class="fal fa-video"></i></li>--}}
                            {{--                            <div class="overflow-hidden flex gap-2 m-3" x-show="open" @click.outside="open = false" style="display: none">--}}
                            <div>
                                <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                    <div class="text-center p-2 h-[60px]">
                                        <div>kemedar proptech realstate marketplace Arabic video</div>
                                    </div>
                                    <div class="p-2">
                                        <a class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/qpO5Q_YfiEM" data-bs-target="#myModal">
                                            <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/first-tumbnail.webp" alt="" class="rounded-lg">
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                    <div class="text-center p-2 h-[60px]">
                                        <div>kemedar proptech realstate marketplace English video</div>
                                    </div>
                                    <div class="p-2">
                                        <a class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/qpO5Q_YfiEM" data-bs-target="#myModal">
                                            <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/second-tumbnail.webp" alt="" class="rounded-lg">
                                        </a>

                                    </div>

                                </div>
                            </div>
                            <div>
                                <div class="border-2 grid grid-cols-1 rounded-md w-[300px]">
                                    <div class="text-center p-2 h-[60px]">
                                        <div>kemedar the best is yet to come</div>
                                    </div>
                                    <div class="p-2">
                                        <a class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/QCvCW9hSvXY" data-bs-target="#myModal">
                                            <img src="https://laravel-kemedar.dev2.kemedar.com/kemedar/assets/images/thirdnew_thmbnail.jpg" alt="" class="rounded-lg">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{--                            </div>--}}
                        </div>
                    </div>
                    @auth
                        <li><a href="{{ route('logout') }}" class="text-white"><i class="fal fa-sign-out"></i></a></li>
                    @endauth
                    @guest
                        <li><a href="https://ssoserver.dev2.kemedar.com/sso-login?redirect_uri={{ base64_encode(env('APP_URL')) }}"><i class="fal fa-sign-in"></i></a></li>
                        <li><a href="https://ssoserver.dev2.kemedar.com/sso-register"><i class="fal fa-user-plus"></i></a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    const setLanguage = (lang) => {
        let url = "{{ route('locale', ['FIXED_LANG']) }}";
        url = url.replace('FIXED_LANG', lang);
        window.open(url, "_self");
    }
</script>
