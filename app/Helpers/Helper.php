<?php

class Helper {

    public static function webContentExtractor() {
        
        $url = env('DISCOUNT_LINK');
        return $extractionResult = file_get_contents($url);
    }

    public static function stringCount($string) {

        $word = env('DISCOUNT_STRING');
        return substr_count($string, $word);
    }

}
