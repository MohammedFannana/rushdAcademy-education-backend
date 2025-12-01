{{-- @dd($lang) --}}

<link rel="stylesheet" href="{{ asset('css/layouts.css') }}">

@php
$rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

$curr_lang = app()->getLocale();
if(Session::has('site_language')) {
$curr_lang = Session::get('site_language');
}

$isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));

$currency = auth()->user()->currency ?? Request::cookie('user_currency');
@endphp

<script>
function removeTransformFromTargets() {
  const els = document.querySelectorAll('.bg-columm-3, .toooltip-content');
  els.forEach(el => {
    el.style.setProperty('transform', 'none', 'important');
    el.style.setProperty('-webkit-transform', 'none', 'important');
  });
}

removeTransformFromTargets();

let tries = 0;
const interval = setInterval(() => {
  removeTransformFromTargets();
  if (++tries >= 20) clearInterval(interval);
}, 500);

const observer = new MutationObserver(() => {
  removeTransformFromTargets();
});

observer.observe(document.body, {
  childList: true,
  subtree: true,
  attributes: true,
  attributeFilter: ['style', 'class']
});
</script>




<!-- desktop -->

<div class='top-bar'>
    <div class="container-fluid">
        <div class="container">
            <div class="row pt-2 ">

                <!-- Left side of topbar -->

                <div class="col-9 left-side" id="left">
                    <ul class="nav flex-nowrap topbar_system">
                        @if($top_menu)
                        @foreach($top_menu as $key => $topmenu)
                        <div class="toooltip">
                            <li style="z-index:{{count($top_menu)-$key}};"> @if($topmenu['custom'] == 1) {!!$topmenu['icon'] !!} @else <i class="{{$topmenu['icon']}}"></i> @endif {{$topmenu['label']}}</li>
                            <!-- <li style="z-index:{{count($top_menu)-$key}};">
                                        <a style= "display : flex;justify-content:center;align-items:center"href="{{ linkSSO($topmenu['link']) }}" target="_{{$topmenu['target']}}">@if($topmenu['custom'] == 1) <i  style="margin-top:1px">{!!$topmenu['icon'] !!}</i> @else <i  class="{{$topmenu['icon']}}" ></i> @endif <p style="margin-top:12px">{{$topmenu['label']}}</p> </a>
                                    </li> -->

                            <div class="toooltip-content p-3">
                                <p>{{$topmenu['sub_title']}}</p>
                            </div>
                        </div>

                        @endforeach
                        @endif
                        <div class="toooltip">
                            <li><i class="fa fa-th"></i> {{ __('Other Systems') }}</li>
                            <div class="toooltip-content bg-grey">
                                <div class="scrollbar-inner">
                                    <div class="otherSystem">
                                        @if($other_menu)
                                        @foreach($other_menu as $othermenu)
                                        @if($othermenu['child'] == null)
                                        <div class="box-item font-roboto">

                                            <a @if($othermenu['target']=='blank' ) target="_blank" @endif href="{{ linkSSO($othermenu['link']) }}">
                                                <div class="icons">@if($othermenu['custom'] == 1) {!!$othermenu['icon'] !!} @else <i class="{{$othermenu['icon']}}"></i> @endif </div>
                                                <div class="name">{{$othermenu['label']}} </div>
                                            </a>
                                            <div class="box-dropdown px-3">
                                                <p class="text-xs">
                                                    {{$othermenu['sub_title']}}
                                                </p>
                                                <div class="content-buttons mt-2">
                                                    <button><span><i class="fab fa-android"></i></span>Download MiniApp</button>
                                                    <button><a href="{{ linkSSO($othermenu['link']) }}" target="_{{ $othermenu['target']}}"><span><i class="fas fa-eye"></i> </span>Homepage</button>
                                                </div>
                                            </div>

                                        </div>
                                        @endif
                                        @if($othermenu['child'] != null)
                                        <h3>{{ $othermenu['label']}}</h3>
                                        @foreach($othermenu['child'] as $sublevel1)
                                        <div class="box-item top font-roboto">

                                            <a @if($sublevel1['target']=='blank' ) target="_blank" @endif href="{{ linkSSO($sublevel1['link'])}}">
                                                <div class="icons">@if($sublevel1['custom'] == 1) {!!$sublevel1['icon'] !!} @else <i class="{{$sublevel1['icon']}}"></i> @endif </div>
                                                <div class="name">{{$sublevel1['label']}} </div>
                                            </a>

                                            <div class="box-dropdown px-3">
                                                <p class="text-xs">
                                                    {{$sublevel1['sub_title']}}
                                                </p>
                                                <div class="content-buttons mt-2">
                                                    <button><span><i class="fab fa-android"></i></span>Download MiniApp</button>
                                                    <button><a href="{{ linkSSO($sublevel1['link']) }}" target="_{{ $sublevel1['target']}}"><span><i class="fas fa-eye"></i> </span>Homepage</a></button>
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

                <!-- Right side of topbar -->

                <div class="col-3 right-side">
                    <ul class="nav">

                        <div class="toooltip modal-button-desktop">
                            <li><i class="fas fa-bars"></i></li>
                        </div>

                        <div class="toooltip" >
                            <li><i class="kem-top-header-icons-flag"></i></li>
                            <div class="toooltip-content" id="set1">
                                <ul class="countries">
                                    @if ($countries)
                                        @foreach ($countries as $country)
                                            <li style="color: white !important">{{ $country['name'] }}</li>
                                            <ul class='states'>
                                                @if ($country['country'])
                                                    @foreach ($country['country'] as $cout)
                                                        <li class="active {{ $cout['code'] == session('country_code') ? 'langBorder' : '' }}" data-code="{{$cout['code']}}">
                                                            <a href="{{ route('country.change', $cout['code']) }}">
                                                                <span class="flex gap-2">
                                                                    <span class="count-flag">
                                                                        <img src="{{ asset('country-flags-main/png100px') . '/' . $cout['code'] . '.png' }}" alt="" />
                                                                    </span>
                                                                    <span>{{ $cout['name'] }}</span>
                                                                </span>
                                                            </a>
                                                        </li>
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
                            <div class="toooltip-content" id="set2">
                                <ul class="languages">
                                    @for ($i=0;$i< count($lang);$i++)
                                        {{-- <li data-code={{$lang[$i]['code']}} class="active"><span class="lang-flag"><img class="img-fluid" src="{{asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'}}" width="20px" alt=""></span>{{$lang[$i]['name']}}</li> --}}
                                        <li onclick="setLanguage('{{ $lang[$i]['code'] }}')"  class="{{  $lang[$i]['code'] == $curr_lang ? 'langBorder' :''}}"><span class="lang-flag"><img class="img-fluid" src="{{asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'}}" width="20px" alt=""></span>{{$lang[$i]['name']}}</li>
                                        @endfor
                                </ul>
                            </div>
                        </div>

                        <div class="toooltip"  x-data="{ open: false }">
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

                        @if($bft_AB)
                        @foreach($bft_AB as $bftab)
                        <div class='toooltip' >
                            <li><i class="{{$bftab['icon']}}"></i></li>
                            <div class="toooltip-content" id="set3">

                                <div class="grid-menu {{$bftab['class']}}">
                                    <p class="label-top" style="color: white !important;">{{$bftab['label']}} </p>
                                    @if($bftab['child'])
                                    @foreach($bftab['child'] as $bfsub)

                                    <div class="sub-toooltip">
                                        <div class="items">
                                            <a class="text-black" target="_{{$bfsub['target']}}" href="{{linkSSO($bfsub['link'])}}">
                                                <i class="{{$bfsub['icon']}} icon-top-submenu" style="color: #c02127 !important;"></i>
                                                {{$bfsub['label']}}
                                            </a>
                                        </div>
                                        @if(!empty($bfsub['child']))
                                        <div class="sub-toooltip-content">
                                            <p class="label-top" style="color:white !important">{{$bfsub['label']}}</p>
                                            <ul>
                                                @foreach($bfsub['child'] as $sub)

                                                <li><a class="text-black" target="_{{ $sub['target'] }}" href="{{ linkSSO($sub['link']) }}"><span class="{{$sub['icon']}} me-2 icon-top-submenu"></span>{{$sub['label']}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        @auth
                        {{-- <div class="toooltip">
                                <li><div class="avatar"><img src="{{asset('images/avatar.png')}}" alt="profile-image">
                </div>
                </li>
                <div class="toooltip-content" id="set4">
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
            <li><a href="{{ returnSSOLinkWithLang('login') }}" class="text-white"><i class="kem-top-header-icons-log-in"></i></a></li>
            <li> <a class="text-white" href="{{ returnSSOLinkWithLang('re') }}"><i class="kem-top-header-icons-signup"></i></a> </li>
            @endguest
            </ul>
        </div>
    </div>
</div>
</div>
</div>

<!-- mobile -->
<div class="m-top-bar" style=" background-color : #ffc107;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class='top-nav' style="padding-top: 10px !important;">
                    <div class="toooltip" x-data="{ open: false }">

                        <li><i @click="open = ! open" class="kem-top-header-icons-flag"></i></li>
                        <div class="toooltip-content contriesInMobile" x-show="open" @click.outside="open = false" style="display: none; " >
                        <ul class="countries">
    @if ($countries)
        @foreach ($countries as $country)
            <li style="color: white !important">{{ $country['name'] }}</li>
            <ul class='states'>
                @if ($country['country'])
                    @foreach ($country['country'] as $cout)
                        <li class="active {{ $cout['code'] == session('country_code') ? 'langBorder' : '' }}" data-code="{{$cout['code']}}">
                            <a href="{{ route('country.change', $cout['code']) }}">
                                <span class="flex gap-2">
                                    <span class="count-flag">
                                        <img src="{{ asset('country-flags-main/png100px') . '/' . $cout['code'] . '.png' }}" alt="" />
                                    </span>
                                    <span>{{ $cout['name'] }}</span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        @endforeach
    @endif
</ul>

                        </div>
                    </div>
                    <div class="toooltip" x-data="{ openl: false }">
                        <li><i @click="openl = ! openl" class="kem-top-header-icons-translate"></i></li>
                        <div class="toooltip-content" x-show="openl" @click.outside="openl = false" style="display: none">
                            <ul class="languages">
                                @if($lang)
                                @for ($i=0;$i< count($lang);$i++)
                                        {{-- <li data-code={{$lang[$i]['code']}} class="active"><span class="lang-flag"><img class="img-fluid" src="{{asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'}}" width="20px" alt=""></span>{{$lang[$i]['name']}}</li> --}}
                                        <li onclick="setLanguage('{{ $lang[$i]['code'] }}')"  class="{{  $lang[$i]['code'] == $curr_lang ? 'langBorder' : ''}}"><span class="lang-flag"><img class="img-fluid" src="{{asset('language-flags/png100px').'/'.$lang[$i]['code'].'.png'}}" width="20px" alt=""></span>{{$lang[$i]['name']}}</li>
                                        @endfor

                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="toooltip" x-data="{ open: false }">
                            <li><i @click="open = ! open" class="kem-top-header-icons-dollar-symbol"></i></li>
                            <div class="toooltip-click-content" style="z-index: 10000; position: absolute;">
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

                    @if($bft_AB)
                    @foreach($bft_AB as $us)

                    <div class="toooltip" x-data="{ open: false }">
                        <li><i @click="open = ! open" class="{{$us['icon']}}"></i> </li>
                        <div x-show="open" @click.outside="open = false" style="display: none">

                            <!-- grid menu content here-->
                            @if($us['child'])
                            @if($us['class'] == 'column-3')
                            <div class="bg-columm-3 toooltip-content">
                                <div class="grid-menu">
                                    <p class="label-top" >{{ $us['label'] }}</p>

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

                            <div class="toooltip-content" id="men">
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
                                                {{-- <p class="label-top m-2">{{ $child['label'] }}</p>--}}

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

                        <li><a href="https://kemodoo.com/video-gallery"><i  class="fal fa-video"></i></a></li>
                        <div class="toooltip-content nav-videos" x-show="open" @click.outside="open = false" style="display: none; left: 0;transform: translateX(-75%);background: #e5e7eb; border-radius: 10px">
                            {{-- <li><i @click="open = ! open" class="fal fa-video"></i></li>--}}
                            {{-- <div class="overflow-hidden flex gap-2 m-3" x-show="open" @click.outside="open = false" style="display: none">--}}
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
                            {{-- </div>--}}
                        </div>
                    </div>
                    @auth
                    <li><a href="kemecademy.com/logout" class="text-white"><i class="fal fa-sign-out"></i></a></li>
                    @endauth
                    @guest
                    <li><a href="{{returnSSOLinkWithLang('login')}}"><i class="fal fa-sign-in"></i></a></li>
                    <li><a href="{{ returnSSOLinkWithLang('re') }}"><i class="fal fa-user-plus"></i></a></li>
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
