<?php

if (!function_exists('set_active')) {

    function set_active($routes)
    {
        $activeClass = 'bg-slate-100 text-slate-900 border-r-4 border-slate-900 font-semibold';
        $defaultClass = '';

        if (is_array($routes)) {
            foreach ($routes as $route) {
                if (request()->routeIs($route)) {
                    return $activeClass;
                }
            }
        }

        if (request()->routeIs($routes)) {
            return $activeClass;
        }

        return $defaultClass;
    }
}
