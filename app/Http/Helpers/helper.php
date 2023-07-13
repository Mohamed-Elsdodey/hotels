<?php


if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('chef')) {
    function chef()
    {
        return auth()->guard('chef');
    }
}

if (!function_exists('cashier')) {
    function cashier()
    {
        return auth()->guard('cashier');
    }
}

if (!function_exists('setting')) {
    function setting() {
        return \App\Models\Setting::firstorFail();
    }
}


if (!function_exists('get_file')) {
    function get_file($file)
    {
        // Storage::exists( $file )
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $file_path = $file;
        } elseif ($file) {
            $file_path = asset('storage/uploads') . '/' . $file;
        } else {
            $file_path = asset('dashboard/assets/images/companies/img-1.png');
        }
        return $file_path;
    }//end
}


function localRowData($model, $id,$column)
{
    $lang = \App\Models\Language::where('abbreviation', app()->getLocale())->first();
    if ($lang) {
        return   $row = $model->where('lang_id', $lang->id)->where($column,$id)->first();

    }
    return null;
}

function rowData($model, $id,$column,$lang_id)
{
    $lang = \App\Models\Language::findOrFail($lang_id);
    if ($lang) {
        return   $row = $model->where('lang_id', $lang->id)->where($column,$id)->first();
    }
    return null;
}

if (!function_exists('get_lang')) {
    function get_lang() {
        return \LaravelLocalization::setLocale()??'en';
    }
}


if (!function_exists('session_lang')) {
    function session_lang()
    {
        $lang = 'ar';
        /*if (session()->get('lang') && in_array(session()->get('lang'), ['ar', 'en'])) {
            $lang = session()->get('lang') ? session()->get('lang') : 'default';
        }*/

        if (get_lang() && in_array(get_lang(), ['ar', 'en'])) {
            $lang = get_lang();
        }

        if (request()->get('lang') && in_array(request()->get('lang'), ['ar', 'en'])) {
            $lang = request()->get('lang');
        }

        if (request()->post('lang') && in_array(request()->post('lang'), ['ar', 'en'])) {
            $lang = request()->post('lang');
        }

        if (request()->header('lang') && in_array(request()->header('lang'), ['ar', 'en'])) {
            $lang = request()->header('lang');
        }
        return $lang;
    }


    if (!function_exists('TypesCategory')) {
        function TypesCategory()
        {
            return array(1 => 'type room');
        }
    }


    if (!function_exists('get_difference_between_two_dates')) {
        function get_difference_between_two_dates($date1, $date2)

    {
        $now = strtotime($date2);// or your date as well
        $your_date = strtotime($date1);
        $datediff = $now - $your_date;

        return round($datediff / (60 * 60 * 24));
    }
}




}
