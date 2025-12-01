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

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $menuBottom;
    protected $lang;

    public function __construct($lang='en')
    {
        $this->lang = $this->getLang();
        $this->menuBottom = $this->bottomMenu($this->lang);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.footer');
    }



    public function bottomMenu($lang)
    {
        $bottomMenu_desktop = Cache::rememberForever('bottomMenu_desktop'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=menu_footer_desktop&lang=".$lang;

            $bottom_menu = Http::accept('application/json')->get($url)['result'];
            return $bottom_menu;
        });
        return $bottomMenu_desktop;
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
