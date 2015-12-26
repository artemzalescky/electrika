<?php

namespace ph\phAdmin\application\models\dao;

class ThemeDAO {
    private $themes = [
        'yeti' => 'yeti-bootstrap.min.css',
        'plain' => 'bootstrap.min.css',
        'cerulean' => 'cerulean-bootstrap.min.css',
        'cosmo' => 'cosmo-bootstrap.min.css',
        'cyborg' => 'cyborg-bootstrap.min.css',
        'darkly' => 'darkly-bootstrap.min.css',
        'flatly' => 'flatly-bootstrap.min.css',
        'journal' => 'journal-bootstrap.min.css',
        'lumen' => 'lumen-bootstrap.min.css',
        'paper' => 'paper-bootstrap.min.css',
        'readable' => 'readable-bootstrap.min.css',
        'sandstone' => 'sandstone-bootstrap.min.css',
        'simplex' => 'simplex-bootstrap.min.css',
        'slate' => 'slate-bootstrap.min.css',
        'spacelab' => 'spacelab-bootstrap.min.css',
        'superhero' => 'superhero-bootstrap.min.css',
        'united' => 'united-bootstrap.min.css'
    ];

    public function get() {
        return $this->themes;
    }

    public function getNames() {
        return array_keys($this->themes);
    }

    public function exist($name) {
        return array_key_exists($name, $this->themes);
    }

    public function getFile($name) {
        return $this->themes[$name];
    }
}
