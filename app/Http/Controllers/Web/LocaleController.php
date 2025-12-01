<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale(Request $request)
    {
        $this->validate($request, [
            'locale' => 'required'
        ]);

        $locale = $request->get('locale');
        $locale = localeToCountryCode(mb_strtoupper($locale), true);

        $generalSettings = getGeneralSettings();
        $userLanguages = $generalSettings['user_languages'] ?? [];

        if (in_array($locale, $userLanguages)) {
            if (auth()->check()) {
                $user = auth()->user();
                $user->update([
                    'language' => $locale
                ]);
            } else {
                Cookie::queue('user_locale', $locale, 30 * 24 * 60);
            }
        }

        $previousUrl = $request->get('previous_url');

        if (!empty($previousUrl)) {
            return redirect($previousUrl);
        }

        return redirect()->back();
    }

    public function setCommonLocale($ln)
    {
        // $locale = localeToCountryCode(mb_strtoupper($ln), false);
        // echo $locale;

        $generalSettings = getGeneralSettings();
        $userLanguages = $generalSettings['user_languages'] ?? [];

        if (in_array(mb_strtoupper($ln), $userLanguages)) {
            if (auth()->check()) {
                $user = auth()->user();
                $user->update([
                    'language' => mb_strtoupper($ln)
                ]);

                //Cookie::queue('user_locale', $ln, 30 * 24 * 60);
                Session::put('site_language', $ln);
                Session::put('locale', $ln);
                Carbon::setLocale($ln);
            } else {
                Cookie::queue('user_locale', mb_strtoupper($ln), 30 * 24 * 60);
                Session::put('site_language', $ln);
                Session::put('locale', $ln);
                Carbon::setLocale($ln);
            }
        }

        // $previousUrl = $request->get('previous_url');

        // if (!empty($previousUrl)) {
        //     return redirect($previousUrl);
        // }

        return redirect()->back();
    }
}
