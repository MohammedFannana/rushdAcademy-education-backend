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

class Bottombar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $menuBottom;
    public $menuBottomMobile;
    protected $lang;
    public function __construct($lang = 'en')
    {
        $this->lang = $this->getLang();
        $this->menuBottom = $this->bottomMenu($this->lang);
        $this->menuBottomMobile = $this->bottomMenuMobile($this->lang);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.bottom-bar');
    }
    public function bottomMenu($lang)
    {
        $bottom_menu = Cache::rememberForever('bottomMenuDeskTop'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=bottom_footer_desktop&lang=".$lang;

            return Http::accept('application/json')->get($url)['result']['data'];
        });

        return $bottom_menu;
    }
    public function bottomMenuMobile($lang)
    {
        $bottom_menu = Cache::rememberForever('bottomMenuMobile'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=bottom_footer_mobile&lang=".$lang;
            return Http::accept('application/json')->get($url)['result']['data'];
        });

        return $bottom_menu;
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
