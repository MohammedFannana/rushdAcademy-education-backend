<?php

namespace App\View\Components\Web;

// use App;

use App\Models\Currency;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Topbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $lang;
    public $langs;
    public $countries;
    public $curr;
    //public $user;
    public $bft_AB;
    public $top_menu;
    public $other_menu;

    public function __construct($lang='en')
    {
        $this->lang = $this->languages($lang);
        $this->langs = $this->getLang();
        $this->countries = $this->countries();
        $this->curr = $this->currency($this->langs);
        //$this->user = $this->users($this->langs);
        $this->bft_AB = $this->bftab($lang);
        $this->top_menu = $this->systemsMenu($this->langs);
        $this->other_menu = $this->otherSystemMenu($this->langs);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.fixTopBar');
    }

    public function systemsMenu($lang = '')
    {
        $systemMenu = Cache::rememberForever('topMenu_'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=systems_button_desktop_nonlogin-login&lang=".$lang;
            return Http::accept('application/json')->get($url)['result']['data'];
        });
        return $systemMenu;
    }

    public function otherSystemMenu($lang='')
    {
        $otherSystemMenu = Cache::rememberForever('otherSystemMenu_'.$lang, function () use ($lang){
            $url = config('app.api')."/api/get-menus?name=other_systems_nonlogin_Login_desktop&lang=".$lang;
            return Http::accept('application/json')->get($url)['result']['data'];
        });
        return $otherSystemMenu;
    }

    public function countries()
    {
        $response_cache_countries = Cache::rememberForever('countries', function () {
            $url = config('app.api')."/api/countries-in-continent";
            return  Http::accept('application/json')->get($url)['result'];
        });
        return $response_cache_countries;
    }

    public function languages()
    {

        $response_cache_languages = Cache::rememberForever('languages', function () {
            $url2 = config('app.api')."/api/languages";
            return Http::accept('application/json')->get($url2)['result']['data'];
        });
        return $response_cache_languages;
    }

    public function currency($lang='')
    {
        // Cache::put('currencies', $response_currency);
        $response_cache_currencies = Cache::remember('currency_'.$lang, now()->addWeek(), function () use ($lang) {
            $url3 = config('app.api')."/api/currencies?lang=".$lang;
            $data = Http::accept('application/json')->get($url3)['result']['data'];

            foreach( $data as $currency ) {
                $curr = Currency::where('currency', $currency['code'])->first();

                if( empty($curr) ) {
                    // insert
                    $max_order = Currency::max('order') + 1;

                    $curr = new Currency();
                    $curr->currency = $currency['code'];
                    $curr->currency_position = 'left';
                    $curr->currency_separator = 'dot';
                    $curr->currency_decimal = 2;
                    $curr->exchange_rate = $currency['exchange_rate'];
                    $curr->order = $max_order;
                    $curr->created_at = now()->timestamp;
                    $curr->save();
                } else {
                    // update
                    $curr->exchange_rate = $currency['exchange_rate'];
                    $curr->save();
                }
            }

            return $data;
        });
        return $response_cache_currencies;
    }

    // public function users($lang='')
    // {
    //     // Cache::put('users', $response_users);
    //     $response_cache_users = Cache::rememberForever('users_'.$lang, function () use($lang){
    //         $url4 = config('app.api')."/api/get-menus?name=top_header_desktop&lang=".$lang;
    //         return Http::accept('application/json')->get($url4)['result']['data'];
    //     });
    //     return $response_cache_users;
    // }

    public function bftab($lang)
    {
        $response_cache_users = Cache::rememberForever('bft_AB'.$lang, function () use ($lang) {
            $url4 = config('app.api')."/api/get-menus?name=top_header_desktop&lang=".$lang;
            return Http::accept('application/json')->get($url4)['result']['data'];
        });
        return $response_cache_users;
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
