<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.02.2018
 * Time: 0:29
 */

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;

class UidGen
{
    private const CHAR = "0123456789aqwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM_-";

    public static function generate()
    {
        $id = '';

        $amount = 6;

        while ($amount-- > 0)
        {
            $id .= self::CHAR[mt_rand(0, 63)];
        }

        return $id;
    }
}