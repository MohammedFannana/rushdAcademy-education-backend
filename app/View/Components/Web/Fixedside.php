<?php

namespace App\View\Components\Web;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Fixedside extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $sidenav;
    public $allsystems;
    protected $lang;

    public function __construct($lang = 'en')
    {
        $this->lang = $this->getLang();
        $this->sidenav = $this->sideMenu($this->lang);
        $this->allsystems = $this->barMenu($this->lang);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.fixed-side');
    }

    public function barMenu($lang)
    {
        $dropdownsidebar = Cache::rememberForever('barMenu_mobile'.$lang, function () use ($lang) {
            $url = config('app.api')."/api/get-menus?name=All_systems_nonlogin_mobile&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $dropdownsidebar;
    }

    public function sideMenu($lang)
    {
        $sideMenu1 = Cache::rememberForever('sideMenu'.$lang, function () use ($lang){
            $url = "https://laravel-kemedar.dev2.kemedar.com/api/get-menus?name=side_menu_non_login_desktop-updated&lang=".$lang;
            return  Http::accept('application/json')->get($url)['result']['data'];
        });
        return $sideMenu1;
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
