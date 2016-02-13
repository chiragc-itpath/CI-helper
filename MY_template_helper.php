<?php

/**
 * Template Helper
 * Dynamically add Javascript files to header page
 * @author chirag chudashma <chiragc@itpathsolutions.co.in>
 */
if (!function_exists('add_js')) {

    function add_js($file = '') {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('footer_js');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $footer_js[] = $item;
            }
            $ci->config->set_item('footer_js', $footer_js);
        } else {
            $str = $file;
            $footer_js[] = $str;
            $ci->config->set_item('footer_js', $footer_js);
        }
    }

}

//Dynamically add CSS files to header page
if (!function_exists('add_css')) {

    function add_css($file = '') {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file AS $item) {
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css', $header_css);
        } else {
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css', $header_css);
        }
    }

}

if (!function_exists('LoadCssPageLevel')) {

    function LoadCssPageLevel() {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        if(!empty($header_css)){
            foreach ($header_css AS $item) {
                if(is_array($item)){
                    $str .= '<link rel="stylesheet" href="'.$item['fullpath'].'" type="text/css" />' . "\n";
                }else{
                    $str .= '<link rel="stylesheet" href="' . base_url() . 'assets/admin-theme/' . $item . '" type="text/css" />' . "\n";
                }
            }
        }
        return $str;
    }

}
if (!function_exists('LoadJsPageLevel')) {

    function LoadJsPageLevel() {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('footer_js');
        if (!empty($footer_js)) {
            foreach ($footer_js AS $item) {
                if(is_array($item)){
                    $str .= '<script type="text/javascript" src="' . $item['fullpath'] . '"></script>' . "\n";
                }else{
                    $str .= '<script type="text/javascript" src="' . base_url() . 'assets/admin-theme/' . $item . '"></script>' . "\n";
                }
            }
        }

        return $str;
    }

}
