<?php
namespace app\Libraries;

class GeneralFunctions
{

/*    public static function getNameFoto($nameImage) //Загрузка фото при добавлении обьявлении
    {
        $destinationPath = 'img/advertisement_foto/';
        $fileName = md5(microtime()).".".substr($nameImage->getMimeType(), strlen("image/"));
        if ($nameImage->move($destinationPath, $fileName)) {
            return $fileName;
        } else {
            return '';
        }
    }*/

    public static function getSlug($str)
    {
        $str = mb_strtolower($str);
        $str = self::translit($str);
        $str = str_replace(['"', "'", " "], ['', '', '-'], $str);

        return $str;
    }

    public static function translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
            'і' => 'i'
        );
        return strtr($string, $converter);
    }
}
