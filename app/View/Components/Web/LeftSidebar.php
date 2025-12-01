<?php

namespace App\View\Components\Web;

// use App;
// use Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LeftSidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dropdownsidebar;

    public $sidebar;
    public $sidebarPart2;

    public $othersidebar;

    //public $side;
    public $site;
    protected $lang;
    public function __construct($lang='en')
    {
       // $this->side = env("MOBILE_VIEW_LEFT_SIDE_BAR");
        //$this->site = env("MOBILE_VIEW_LEFT_SIDE_BAR_SITE");

        $this->lang = $this->getLang();
        $this->dropdownsidebar = $this->barMenu($this->lang);

        if(! \Request::route()->getName() == 'sidebar.page'){
            $this->sidebar = $this->sideBarGet($this->lang);
            $this->sidebarPart2 = $this->sideBarGetPart2($this->lang);
        }
        else{
            $this->sidebar = $this->sideBarGetLogin($this->lang);
            $this->sidebarPart2 = $this->sideBarGetPart2Login($this->lang);
        }


        $this->othersidebar = $this->joinbarMenu($this->lang);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd($this->sidebarKemedar);
        return view('components.web.left-sidebar');
    }

    public function barMenu($lang)
    {
        $dropdownsidebar = Cache::rememberForever('barMenuMobile'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=All_systems_nonlogin_mobile&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $dropdownsidebar;
    }

    public function sideBarGet($lang)
    {
        $sidebar = Cache::rememberForever('kemanageSidebar'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=common_user_cpanel_desktop&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $sidebar;
    }

    public function sideBarGetLogin($lang)
    {
        //$this->side = env("CPANEL_USER_LEFT_SIDE_BAR", "common_user_cpanel_desktop&lang=en");
        $sidebar = Cache::rememberForever('kemanageSidebarLogin'.$lang, function () use ($lang) {
            $url = config('app.api')."/api/get-menus?name=common_user_cpanel_desktop&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $sidebar;
    }

    public function sideBarGetPart2($lang)
    {
        $sidebarPart2 = Cache::rememberForever('sidebarPart2'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=non_Login_mobile_side_menu_basic&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $sidebarPart2;
    }

    public function sideBarGetPart2Login($lang)
    {
        $sidebarPart2 = Cache::rememberForever('sidebarPart2Login'.$lang, function () use($lang) {
            $url = config('app.api')."/api/get-menus?name=com_pro_user_cpanel_new_systems&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $sidebarPart2;
    }



    public function joinbarMenu($lang)
    {
        $othersidebar = Cache::rememberForever('menuBarOther'.$lang, function () use($lang){
            $url = config('app.api')."/api/get-menus?name=non_Login_mobile_side_menu_kemedar&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $othersidebar;
    }

    protected function getLang() {
        if(Session::has('site_language')) {
            return Session::get('site_language', Config::get('app.locale'));
        }
        else {
            return App::getLocale();
        }
    }
}
