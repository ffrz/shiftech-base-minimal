<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
    protected $base_url = '';
    protected $view_path = '';

    protected function redirect($url = '') {
        return redirect(url($this->base_url . '/' . $url));
    }

    protected function view($file, $data = [], $merge = []) {
        $path = $this->base_url;
        
        if (!empty($this->view_path))
            $path = $this->view_path;

        $path = $path . '/' . $file;

        return view($path, $data, $merge);
    }
}
