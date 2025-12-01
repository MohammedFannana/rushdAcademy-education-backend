@php
    $user_role_id = 0;
    if( !Auth::guest() ) {
        $user_role_id = auth()->user()->role_id;
    }

    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $curr_lang = app()->getLocale();
    if(Session::has('site_language')) {
        $curr_lang = Session::get('site_language');
    }

    $isRtl = ((in_array(mb_strtoupper($curr_lang), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
@endphp
<style>
    .popup2 {
        position: relative;

    }

    .popup-content2 {
        position: absolute;
        right: 0;
        /* Add any additional styling you need for the popup content */
    }
    .popup-content-new {
        display: none;
        background-color:#e5e7eb;
        padding: 20px;
        border-radius: 1rem;
        box-shadow:0 0 10px 0 rgba(0,0,0,0.1);
        width:200px;
    }
    .items.popup2:hover .popup-content-new {
        display: block;
        z-index: 100;
    }
    .popup-content-new {
        position: absolute;
        left: 0px !important;
        margin-top: 5px;

    }
    .items.popup2 a.parent_anchor{
        position: relative;
    }

    .nav-bar-bottom .popup-content  *{
        color: #000!important;
        font-size: 11px!important;
    }

    .nav-bar-bottom .popup-content .icon-top-submenu {
        font-size: 15px!important;
        color: #c02127 !important;
    }
</style>

<div class="bottom-bar {{ $user_role_id == 4 ? ( $isRtl ? 'panel-footer-width-instructor instructor-right' : 'panel-footer-width-instructor instructor-left') : ( $isRtl ? 'panel-footer-width-user' : 'panel-footer-width-user user-left' ) }}">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <span>
                    All rights reserved to KEMEDAR &copy; CORPORATION 2014
                </span>
            </div>
            <div class="col-auto">
                <div class="nav-bar-bottom">
                    <ul>
                        @if($menuBottom)
                            @foreach($menuBottom as $menubtom)
                                <div class="popup ">
                                    <li><a href="#">{{ $menubtom['label'] }}</a></li>
                                    <div class="popup-content {{$menubtom['class']}}">
                                        <div class="find-button">
                                            <button>{{ $menubtom['label'] }}</button>
                                        </div>
                                        <div class="items-grid {{$menubtom['class']}}">

                                            @if($menubtom['child'])
                                            @foreach($menubtom['child'] as $bottomchild)


                                                <div class="items popup2">
                                                    <a href="{{ linkSSO($bottomchild['link']) }}" target="_{{ $bottomchild['target']}}" class="parent_anchor"><span class="{{$bottomchild['icon']}} icon-top-submenu "></span><span>{{$bottomchild['label']}}</span>

                                                        @if(count($bottomchild['child']) > 0 )

                                                            <div class="popup-content-new">
                                                                <div class="inner-grid">
                                                                    <div class="find-button">
                                                                        <button>{{$bottomchild['label'];}}</button>
                                                                    </div>
                                                                    @foreach($bottomchild['child'] as $subbottomchild)
                                                                        <div class="inner-submenu">
                                                                            <div class="items">
                                                                                <a href="{{ linkSSO($subbottomchild['link']) }}" target="_{{ $subbottomchild['target']}}">
                                                                                    <span class="{{$subbottomchild['icon']}} icon-top-submenu"></span>

                                                                                    <span class="text-dark">{{$subbottomchild['label']}}</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        @endif

                                                    </a>

                                                </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="bottom-image"></div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  mobile fixed bottom bar -->
<div class="mobile-bottom-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class='mobile-nav'>
                    @if($menuBottomMobile)
                        @foreach($menuBottomMobile as $key=> $menubottombile)
                            <div class="toooltip">
                                <li x-data="{open{{$key}}: false}">
                                    <a @click="open{{$key}} = ! open{{$key}}" href="#">

                                        <i class="{{$menubottombile['icon']}}"></i>
                                        <span>{{$menubottombile['label']}}</span></a>
                                    @if(sizeof($menubottombile['child']))
                                        <div class="toooltip-content" x-show="open{{$key}}" @click.outside="open{{$key}} = false" style="display:none">
                                            <div class="button">
                                                <button x-show="open{{$key}}" @click.outside="open{{$key}} = false" style="display:none">{{$menubottombile['label']}}</button>
                                                <span class="close" x-show="open{{$key}}" @click.outside="open{{$key}} = false" style="display:none"><i class="fal fa-times"></i></span>
                                            </div>

                                            <ul>
                                                @foreach($menubottombile['child'] as $bottomobilechild)
                                                    <li>
                                                        <a href="{{ linkSSO($bottomobilechild['link'])}}" target="{{$bottomobilechild['target']}}">
                                                            <span class="footer-icon {{$bottomobilechild['icon']}}"></span>
                                                            <span>{{$bottomobilechild['label']}}</span>
                                                        </a>
                                                        @if(sizeof($bottomobilechild['child']))
                                                            <div class="toooltip-content">
                                                                <div class="button">
                                                                    <button x-show="open{{$key}}" @click.outside="open{{$key}} = false" style="display:none"> {{$bottomobilechild['label']}}</button>
                                                                    <span class="close" x-show="open{{$key}}" @click.outside="open{{$key}} = false" style="display: none"><i class="fal fa-times"></i></span>
                                                                </div>

                                                                <ul>
                                                                    @foreach($bottomobilechild['child'] as $subchildbottomobile)
                                                                        <li>
                                                                            <a href="{{ linkSSO($subchildbottomobile['link'])}}" target="{{$subchildbottomobile['target']}}">
                                                                                <span class="footer-icon {{$subchildbottomobile['icon']}}"></span>
                                                                                <span>{{$subchildbottomobile['label']}}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @endif
                                                            </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </li>
                            </div>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
