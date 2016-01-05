<?php

namespace ph\helpers;

use config\Config;
use ph\config\Settings;
use ph\utils\StringUtil;

class HtmlHelper {
    const RESOURCES_FOLDER = 'resources';
    const FONTS_FOLDER = 'fonts';
    const IMAGES_FOLDER = 'images';
    const JAVASCRIPT_FOLDER = 'javascript';
    const STYLESHEETS_FOLDER = 'stylesheets';

    const SYSTEM_RESOURCE_PATH = 'ph/phAdmin';

    public function title($title) {
        $this->tag('title', $title);
        return $this;
    }

    public function charset($encoding) {
        $this->single_tag('meta', ['charset' => $encoding]);
        return $this;
    }

    // ------------- include tags ---------------

    public function include_css($src) {
        $this->single_tag('link', ['href' => $this->stylesheet_path($src), 'type' => 'text/css', 'rel' => 'stylesheet']);
        return $this;
    }

    public function include_js($src, $options = null) {
        $options = $this->merge_options(['src' => $this->js_path($src)], $options);
        $this->tag('script', null, $options);
        return $this;
    }

    public function include_js_lib($src, $options = null) {
        $this->include_js('lib/' . $src, $options);
        return $this;
    }

    // ------------- links ---------------

    public function link($name, $url, $options = null) {
        $options = $this->merge_options(['href' => $this->url($url)], $options);
        $this->tag('a', $name, $options);
        return $this;
    }

    public function link_open($url, $options = null) {
        $options = $this->merge_options(['href' => $this->url($url)], $options);
        $this->tag_open('a', $options);
        return $this;
    }

    public function link_close() {
        $this->tag_close('a');
        return $this;
    }

    public function link_back($name, $options = null) {
        return $this->link($name, $_SERVER['HTTP_REFERER'], $options);
    }

    public function button_link($name, $url, $options = null) {
        $options = $this->merge_options(['onclick' => 'location.href="' . $this->url($url) . '"; return false'], $options);
        $this->tag('button', $name, $options);
        return $this;
    }

    public function form_link($name, $url, $method = 'get', $inputOptions = null) {
        $formOptions = [
            'action' => $this->url($url),
            'method' => $method,
            'style' => 'display: inline'
        ];
        $inputOptions = $this->merge_options(['value' => $name], $inputOptions);
        $this->tag_open('form', $formOptions);
        $this->input_submit($inputOptions);
        $this->tag_close('form');
        return $this;
    }

    public function image_link($src, $url, $imageOptions = null, $linkOptions = null) {
        $linkOptions = $this->merge_options(['href' => $this->url($url)], $linkOptions);
        $this->tag_open('a', $linkOptions);
        $this->image($src, $imageOptions);
        $this->tag_close('a');
        return $this;
    }

    // ------------- input tags ---------------

    public function input($options = null) {
        $this->single_tag('input', $options);
        return $this;
    }

    public function input_with_type($type, $options = null) {
        $options = $this->merge_options(['type' => $type], $options);
        $this->input($options);
        return $this;
    }

    public function input_text($options = null) {
        $this->input_with_type('text', $options);
        return $this;
    }

    public function input_submit($options = null) {
        $this->input_with_type('submit', $options);
        return $this;
    }

    public function input_reset($options = null) {
        $this->input_with_type('reset', $options);
        return $this;
    }

    public function input_checkbox($options = null) {
        $this->input_with_type('checkbox', $options);
        return $this;
    }

    public function input_file($options = null) {
        $this->input_with_type('file', $options);
        return $this;
    }

    public function input_hidden($options = null) {
        $this->input_with_type('hidden', $options);
        return $this;
    }

    public function input_password($options = null) {
        $this->input_with_type('password', $options);
        return $this;
    }

    public function input_radio($options = null) {
        $this->input_with_type('radio', $options);
        return $this;
    }

    // ------------- message ---------------

    public function message_success($message) {
        $this->message($message, 'success');
        return $this;
    }

    public function message_info($message) {
        $this->message($message, 'info');
        return $this;
    }

    public function message_error($message) {
        $this->message($message, 'danger');
        return $this;
    }

    public function message_warning($message) {
        $this->message($message, 'warning');
        return $this;
    }

    private function message($message, $type = 'info') {
        $this->tag_open('div', ['class' => 'alert alert-dismissible alert-' . $type])
            ->tag('button', '×', ['class' => 'close', 'data-dismiss' => 'alert', 'type' => 'button'])
            ->text($message)
            ->tag_close('div');
        return $this;
    }

    // ------------- common ---------------

    public function space() {
        $this->text(' ');
        return $this;
    }

    public function image($src, $options = null) {
        $options = $this->merge_options(['src' => $this->image_path($src)], $options);
        $this->single_tag('img', $options);
        return $this;
    }

    public function button($name, $options = null) {
        $this->tag('button', $name, $options);
        return $this;
    }

    public function tag($name, $body = null, $options = null) {
        $this->tag_open($name, $options);
        $this->text($body);
        $this->tag_close($name);
        return $this;
    }

    public function tag_open($name, $options = null) {
        $html = '<' . $name;
        $this->append_all_html_attributes($options, $html);
        $html .= '>';
        echo $html;
        return $this;
    }

    public function tag_close($name) {
        echo '</' . $name . '>';
        return $this;
    }

    public function single_tag($name, $options = null) {
        $this->tag_open($name, $options);
        return $this;
    }

    public function text($text, $specialCharEscaping = false) {
        if ($specialCharEscaping === true) {
            echo htmlspecialchars($text);
        } else {
            echo $text;
        }
        return $this;
    }

    public function cut_text($text, $count) {
        echo mb_substr($text, 0, $count, 'UTF-8');
        return $this;
    }

    // ------------- path ---------------

    public function stylesheet_path($src) {
        return $this->resource_path(self::STYLESHEETS_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function js_path($src) {
        return $this->resource_path(self::JAVASCRIPT_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function image_path($src) {
        return $this->resource_path(self::IMAGES_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function resource_path($src) {
        return $this->path(self::RESOURCES_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function path($url) {
        return StringUtil::isAbsoluteUrl($url) === true ? $url : Config::getBasePath() . $this->trimSlashes($url);
    }

    // ------------- url ---------------

    public function url($url) {
        return StringUtil::isAbsoluteUrl($url) === true ? $url : Config::getBasePath() . $this->trimSlashes($url);
    }

    private function trimSlashes($url) {
        return trim($url, '/');
    }

    public function currentUrlWithoutParams() {
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        return 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
    }

    // ------------- system ---------------

    public function include_system_css($src) {
        $this->single_tag('link', ['href' => $this->system_stylesheet_path($src), 'type' => 'text/css', 'rel' => 'stylesheet']);
        return $this;
    }

    public function include_system_js($src, $options = null) {
        $options = $this->merge_options(['src' => $this->system_js_path($src)], $options);
        $this->tag('script', null, $options);
        return $this;
    }

    public function include_system_js_lib($src, $options = null) {
        $this->include_system_js('lib/' . $src, $options);
        return $this;
    }

    public function system_link($name, $url, $options = null) {
        $this->link($name, $this->make_url_system($url), $options);
        return $this;
    }

    public function system_button_link($name, $url, $options = null) {
        $this->button_link($name, $this->make_url_system($url), $options);
        return $this;
    }

    public function system_form_link($name, $url, $method = 'get', $inputOptions = null) {
        $formOptions = [
            'action' => $this->system_url($url),
            'method' => $method,
            'style' => 'display: inline'
        ];
        $inputOptions = $this->merge_options(['value' => $name], $inputOptions);
        $this->tag_open('form', $formOptions);
        $this->input_submit($inputOptions);
        $this->tag_close('form');
        return $this;
    }

    public function system_image($src, $options = null) {
        $options = $this->merge_options(['src' => $this->system_image_path($src)], $options);
        $this->single_tag('img', $options);
        return $this;
    }

    public function system_stylesheet_path($src) {
        return $this->system_resource_path(self::STYLESHEETS_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function system_js_path($src) {
        return $this->system_resource_path(self::JAVASCRIPT_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function system_image_path($src) {
        return $this->system_resource_path(self::IMAGES_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function system_resource_path($src) {
        return $this->system_path(self::RESOURCES_FOLDER . '/' . $this->trimSlashes($src));
    }

    public function system_path($path) {
        return Config::getBasePath() . self::SYSTEM_RESOURCE_PATH . '/' . $this->trimSlashes($path);
    }

    public function system_url($url) {
        return $this->url($this->make_url_system($url));
    }

    private function make_url_system($url) {
        return Settings::SYSTEM_REQUEST_PREFIX . '/' . $this->trimSlashes($url);
    }

    // ------------- options ---------------

    private function has_option($key, $options) {
        return is_array($options) && isset($options[$key]);
    }

    private function get_option($key, $options) {
        if (!$this->has_option($key, $options)) {
            return null;
        }
        return $options[$key];
    }

    private function option_equals($key, $expected, $options) {
        return $this->get_option($key, $options) === $expected;
    }

    private function option_equals_one_of($key, $expected, $options) {
        if (!$this->has_option($key, $options) || !is_array($expected)) {
            return false;
        }
        foreach ($expected as $variation) {
            if ($options[$key] === $variation) {
                return true;
            }
        }
        return false;
    }

    private function append_html_attribute($key, $options, &$html) {
        if ($this->get_option($key, $options) === true) {
            $html .= ' ' . $key;
            return;
        }

        if ($this->has_option($key, $options)) {
            $html .= ' ' . $key . "='" . $this->get_option($key, $options) . "'";
        }
    }

    private function append_html_attributes($allowedKeys, $options, &$html) {
        foreach ($allowedKeys as $key) {
            $this->append_html_attribute($key, $options, $html);
        }
    }

    private function append_all_html_attributes($options, &$html) {
        if (empty($options)) {
            return;
        }
        foreach ($options as $key => $value) {
            $this->append_html_attribute($key, $options, $html);
        }
    }

    private function merge_options($custom, $default = null) {
        if (empty($default)) {
            return $custom;
        }
        if (empty($custom)) {
            return $default;
        }
        return array_merge($default, $custom);
    }
}
