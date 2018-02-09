<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09.02.2018
 * Time: 16:21
 */

namespace App\Service;


use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class linkHandler
{

    public static function checkLink(array $result)
    {
        if (!$result)
        {
            return new RedirectResponse('/');
        }

        $link = $result[0]['link'];

        if (strpos($link, 'http') !== false)
        {
            return new RedirectResponse($link);
        }

        return new RedirectResponse('http://' . $link);
    }

}