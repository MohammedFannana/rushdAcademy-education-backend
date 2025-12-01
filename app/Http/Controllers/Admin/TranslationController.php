<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Log;

class TranslationController extends Controller
{
    public function index()
    {
        return view('admin.translation.index');
    }

    public function data_sync()
    {
        $userLanguages = getGeneralSettings('user_languages');
        if (!empty($userLanguages) and is_array($userLanguages)) {
            $userLanguages = getLanguages($userLanguages);
        } else {
            $userLanguages = [];
        }

        set_time_limit(-1);
        $client = new Client();
        foreach ($userLanguages as $k => $v) {
            $lang = strtolower($k);
            $url = "http://laravel-kemedar.dev2.kemedar.com/api/get-translation?lang=$lang&system=kemecademy";

            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody()->getContents(), true);

            //$allData = [];
            $count = count($data['result']);
            Log::alert("Total Data found for {$lang} is {$count}", );
            foreach ($data['result'] as $v) {
                $dir = "/lang/$lang";
                Log::info("Translation Directory: {$dir}");
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }

                if (isset($v['lang_key']) && isset($v['lang_value'])) {
                    $key = $v['lang_key'];
                    $value = $v['lang_value'];

                    $keys = explode('.', $key);

                    // make directory
                    $paths = explode("_", $keys[0]);
                    for ($i = 0; $i < count($paths) - 1; $i++) {
                        $dir .= "/$paths[$i]";
                        if (!file_exists($dir)) {
                            mkdir($dir, 0777, true);
                        }
                    }

                    $dir .= "/" . $paths[count($paths) - 1] . ".php";
                    //$tempDir = $dir;
                    //echo "Final dir: $dir<br>";

                    // Skip 0 index portion
                    array_shift($keys);

                    $file_info = pathinfo($dir);
                    $file_name = $file_info['filename'];
                    $file_extension = $file_info['extension'] ?? '';

                    //$arr = include($dir) ?? [];
                    if( $file_name === '' && strtolower($file_extension) === 'php' ) {
                        $arr = [];
                    } else if (file_exists($dir)) {
                        $arr = include ($dir) ?? [];
                    } else {
                        $arr = []; // The file does not exist, initialize an empty array
                    }

                    $numKeys = count($keys);
                    $tempArray = &$arr;
                    foreach ($keys as $index => $nestedKey) {
                        if ($index == $numKeys - 1) {
                            // Last key, assign the value
                            $tempArray[$nestedKey] = $value;
                        } else {
                            // Create nested arrays for intermediate keys if not already an array
                            if (!isset($tempArray[$nestedKey]) || !is_array($tempArray[$nestedKey])) {
                                $tempArray[$nestedKey] = [];
                            }
                            $tempArray = &$tempArray[$nestedKey];
                        }
                    }
                    unset($tempArray);
                    //$allData[$tempDir] = $arr;

                    // $content = "<?php\n\nreturn " . var_export($arr, true) . ";\n";
                    // file_put_contents($dir, $content);

                    if ($file_name === '' && strtolower($file_extension) === 'php') {
                        //echo "Skipping file: $tempDir (No name)<br>";
                    } else {
                        $content = "<?php\n\nreturn " . var_export($arr, true) . ";\n";
                        file_put_contents($dir, $content);
                    }
                }
            }

            // foreach ($allData as $tempDir => $arr) {
            //     if( is_file($tempDir) ) {
            //         $content = "<?php\n\nreturn " . var_export($arr, true) . ";\n";
            //         file_put_contents($tempDir, $content);
            //     }
            //     //echo "Final dir: $tempDir<br>";
            // }
        }
        return redirect()->back()->with('success', 'Data Sync Successfully');
    } // data_sync
}
