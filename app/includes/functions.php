<?php

function get_settings($type){
    return \Modules\Admin\Models\Settings::where('post_type', $type)->get();
}

function is_admin(){
    if (auth()->check()) {
        return (boolean) DB::table('model_has_roles')->select('model_id')->where('model_id', auth()->id());
    }
    return false;
}

function generate_google_map_link(array $data)
{
    $url = '';
    foreach ($data as $datum) {
        if (is_string($datum) and strlen($datum) > 1) {
            $url = $url . '+' . $datum;
        }
    }
    $link = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyDrIHJDN5FNpn8bC3CfiIzDR8uA-0tOD4Y&q=' . trim($url, '+');
    return $link;
}

function get_image_url_to_profile($user)
{
    if (is_object($user)) {
        return asset('storage/users/' . md5($user->email));
    } elseif (is_array($user)) {
        return asset('storage/users/' . md5($user['email']));
    }
    return false;
}

function get_image_path_to_profile($user)
{
    if (is_object($user)) {
        return base_path('public/storage/users/' . md5($user->email));
    } elseif (is_array($user)) {
        return base_path('public/storage/users/' . md5($user['email']));
    }
    return false;
}

function get_image_path_storage_to_profile($user)
{
    if (is_object($user)) {
        return 'public/users/' . md5($user->email);
    } elseif (is_array($user)) {
        return b'public/users/' . md5($user['email']);
    }
    return false;
}

function get_url_to_uploaded_files($user, $uploading_files)
{
    if (is_array($uploading_files)) {
        $images = [];
        foreach ($uploading_files as $img) {
            if ($img == null) continue;

            if (!$img instanceof \Illuminate\Http\UploadedFile) {
                print_r($img);
                throw new Exception('Неправильный объект файла');
            }
            $path = $img->store(get_image_path_storage_to_profile($user) . '/img');
            $images[] = asset(str_replace('public', 'storage', $path));
        }
    } else {
        if ($uploading_files == null) return null;

        if (!$uploading_files instanceof \Illuminate\Http\UploadedFile) {
            print_r($uploading_files);
            throw new Exception('Неправильный объект файла');
        }
        $path = $uploading_files->store(get_image_path_storage_to_profile($user) . '/img');
        $images[] = asset(str_replace('public', 'storage', $path));
    }
    return $images;
}

function delDir($dir)
{
    $files = array_diff(scandir($dir), ['.', '..']);
    try {
        foreach ($files as $file) {
            (is_dir($dir . '/' . $file)) ? delDir($dir . '/' . $file) : unlink($dir . '/' . $file);
        }
        return rmdir($dir);
    } catch (Exception $e) {
    }
}

function get_raiting_template($num, $echo_num = true)
{
    $count_star = 0;
    $num = (float)$num;
    if ($num < 0) $num = 0.0;
    $fl = $num - floor($num);
//    dd($fl);
    if ($num > 0) {
        $str = '<span class="rating-star-display">';
        for ($i = 0; $i < (int)$num; $i++) {
            $str .= '<span class="rating-star-solid"></span>';
            $count_star++;
        }
        if ($fl > 0) {
            $str .= '<span class="rating-star-half"></span>';
            $count_star++;
        }
        for ($a = 1, $i = 5 - $count_star; $a <= $i; $a++){
            $str .= '<span class="rating-star-empty"></span>';
        }
        if ($echo_num)
            $str .= '<span class="rating-value">' . ((string)$num) . '</span>';
        $str .= '</span>';
        return $str;
    }
    return false;
}

























