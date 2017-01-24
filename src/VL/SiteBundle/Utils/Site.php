<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 05.01.2016
 * Time: 15:25
 */
namespace VL\SiteBundle\Utils;

class Site
{
    static public function slugify($text)
    {
        if (empty($text)) {
            return 'n-a'; }
        // Замена пробелов на тире
        $text = preg_replace('/ +/', '-', $text);
        // Приведение текста к нижнему регистру
        $text = mb_strtolower(trim($text, '-'), 'utf-8');

        return $text;
    }
}