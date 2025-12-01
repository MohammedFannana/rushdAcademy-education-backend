<?php

namespace App\View\Components\Web;

// use App;
// use Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $other_menu;
    public $system_menu;
    public $lang;
    public $langs;


    public function __construct($lang = 'en')
    {
        // لغة الموقع الحالية (string)
        $this->lang = $this->getLang();

        // جميع اللغات (array)
        $this->langs = $this->languages();

        // القوائم
        $this->other_menu = $this->otherSystemMenu($this->lang);
        $this->system_menu = $this->thisSystemMenu($this->lang);
    }


    public function thisSystemMenu($lang = '')
    {
        $otherSystemMenu = Cache::rememberForever('thisSysMenu'.$lang, function () use($lang){
            $url = config('app.api')."/api/get-menus?name=main_menu_header_NL-Kemanage_desktop_mobile&lang=".$lang;
            return Http::accept('application/json')->get($url)['result']['data'];
        });
        return $otherSystemMenu;
    }

    public function otherSystemMenu($lang)
    {
        $otherSystemMenu = Cache::rememberForever('otherSysMenu'.$lang, function () use ($lang) {
            $url = config('app.api')."/api/get-menus?name=All_systems_login_nonlogin_mobile&lang=".$lang;
            return Http::accept('application/json')->get($url)['result']['data'];
        });
        return $otherSystemMenu;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.nav-bar');
    }

    public function languages()
    {

        $response_cache_languages = Cache::rememberForever('languages', function () {
            $url2 = config('app.api')."/api/languages";
            return Http::accept('application/json')->get($url2)['result']['data'];
        });
        return $response_cache_languages;
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


