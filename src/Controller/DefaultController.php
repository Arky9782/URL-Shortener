<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 06.02.2018
 * Time: 23:57
 */

namespace App\Controller;

use App\Entity\Link;
use App\Entity\Uid;
use App\Repository\LinkRepository;
use App\Repository\UidRepository;
use App\Service\Flush;
use App\Service\LinkHandler;
use App\Service\UidGen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $link = null;
        return $this->render('base.html.twig', ['link' => $link]);
    }

    /**
     * @Route("/cut", name="cut", methods={"POST"})
     */
    public function cut(UidRepository $uidRep, LinkRepository $linkRep, Flush $flush, Request $request)
    {
        $link = $request->get('input');

        $id = UidGen::generate();

        $link = new Link($link);
        $Uid = new Uid($id);

        $Uid->Link($link);
        $link->Uid($Uid);

        $uidRep->persist($Uid);
        $linkRep->persist($link);

        $flush();


        $link = $Uid->getUid();

        $host = $request->server->get('HTTP_HOST');

        return $this->render('base.html.twig', ['link' => $link, 'host' => $host]);
    }

    /**
     * @Route("/{id}")
     */
    public function getLink(UidRepository $uidRep, $id)
    {
        $result = $uidRep->findLink($id);

       return LinkHandler::checkLink($result);
    }
}