<?php

require_once __DIR__."/../src/init.php";

class BaseTest extends PHPUnit_Framework_TestCase {

    protected static function fixturesPath() {
        return __DIR__."/fixtures/";
    }

    protected static function loadFile($path) {
        $path = self::fixturesPath().$path;

        if (!file_exists($path)) {
            throw new Exception("Error: File $path not found.");
        }

        $string = file_get_contents($path);
        return $string;
    }

    protected static function loadJSON($path) {
        $string = self::loadFile($path);
        return json_decode($string,true);
    }

    /**
     * @param \Tml\Application $app
     * @param $label
     * @param $description
     * @param $translations
     */
    protected static function cacheTranslations($app, $label, $description, $translations) {
        $app->cacheTranslationKey(new \Tml\TranslationKey(array(
            "application" => $app,
            "label" => $label,
            "description" => $description,
            "translations" => $translations
        )));
    }

}

class User {
    public $name, $gender;
    function __construct($name, $gender = "male") {
        $this->name = $name;
        $this->gender = $gender;
    }
    function __toString() {
        return $this->name;
    }
    function fullName() {
        return $this->name;
    }
    function gender() {
        return $this->gender;
    }
}

class Number {
    public $value;
    function __construct($value) {
        $this->value = $value;
    }
    function __toString() {
        return "" . $this->value;
    }
}
