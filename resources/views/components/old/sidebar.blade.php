@php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
@endphp
<div class="sidebar-main">
    <div class="company-logo">
        <div class="logo-image">
            <a href="#">
                <img src="{{asset('images/kemedar.png')}}" alt="company-logo"  class="img-fluid"/>
            </a>
        </div>
        <div class="title">
            Kemedar
        </div>
    </div>
    <div class="bar scroll-wrapper">
        @for($i = 0; $i < count($sidebar);$i++)
            <div class="list">
                <div class="list-button">
                    <span class="icon">
                        <a href="#">@if($sidebar[$i]['custom'] ==1) {!!$sidebar[$i]['icon']!!} @else <i class="{{$sidebar[$i]['icon']}}"></i> @endif</a>
                    </span>
                    <span class="nav-label" style="{{ $isRtl ? 'font-size: 16px' : 'font-size: 10px' }}">
                        {{$sidebar[$i]['label']}}
                    </span>
                </div>
                @if(!empty($sidebar[$i]['child']))
                <div class="nav-dropdown level-1">
                    <div class="nav-close">
                        <i class="fal fa-times"></i>
                    </div>
                    <ul class="subnav">
                        @for($j = 0 ; $j < count($sidebar[$i]['child']); $j++)
                        <li class="nav-item">
                            <a href="#" class="sub-button"><span class="{{$sidebar[$i]['child'][$j]['icon']}} icons"></span><span>{{$sidebar[$i]['child'][$j]['label']}}</span> @if(!empty($sidebar[$i]['child'][$j]['child']))<span class="right-arrow {{ $isRtl ? 'ml-auto' : '' }}"><i class="far {{ $isRtl ? 'fa-chevron-left' : 'fa-chevron-right' }}"></i></span>@endif</a>
                            @if(!empty($sidebar[$i]['child'][$j]['child']))
                            <div class="sub-nav-dropdown">
                                {{--<div class="sub-nav-close">
                                    <i class="fal fa-times-octagon"></i>
                                </div>--}}
                                <ul class="subnav">
                                    @for($k = 0; $k < count($sidebar[$i]['child'][$j]['child']);$k++)
                                        <li class="nav-item"><a href="#"><span class="{{$sidebar[$i]['child'][$j]['child'][$k]['icon']}} icons"></span><span>{{$sidebar[$i]['child'][$j]['child'][$k]['label']}}</span></a></li>
                                    @endfor
                                </ul>
                            </div>
                            @endif
                        </li>
                        @endfor
                    </ul>
                </div>
                @endif
            </div>
        @endfor

        @if($othersidebar)
            @foreach($othersidebar as $sb)
            <div class="list">
                <div class="list-button">
                    <span class="icon">
                        <a href="#">@if($sb['custom'] ==1) {!!$sb['icon']!!} @else <i class="{{$sb['icon']}}"></i> @endif</a>
                    </span>
                    <span class="nav-label" style="{{ $isRtl ? 'font-size: 16px' : 'font-size: 10px' }}">
                        {{$sb['label']}}
                    </span>
                </div>
                @if(!empty($sb['child']))
                <div class="nav-dropdown level-1">
                    <div class="nav-close">
                        <i class="fal fa-times"></i>
                    </div>
                    <ul class="subnav">
                        @foreach($sb['child'] as $level1)
                        <li class="nav-item">
                            <a href="#" class="sub-button"><span class="{{$level1['icon']}} icons"></span><span>{{$level1['label']}}</span> @if(!empty($level1['child']))<span class="right-arrow"><i class="far {{ $isRtl ? 'fa-chevron-left' : 'fa-chevron-right' }}"></i></span>@endif</a>
                            @if(!empty($level1['child']))
                            <div class="sub-nav-dropdown">
                                <ul class="subnav">
                                    @foreach($level1['child'] as $level2)
                                        <li class="nav-item"><a @if($level2['target'] == 'blank') target="_blank" @endif href="{{ $level2['link']}}"><span class="{{$level2['icon']}} icons"></span><span>{{$level2['label']}}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            @endforeach
        @endif
    </div>
</div>
<!-- End Sidebar -->
