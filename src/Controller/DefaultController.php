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
use App\Form\LinkType;
use App\Repository\LinkRepository;
use App\Repository\UidRepository;
use App\Service\Flush;
use App\Service\LinkHandler;
use App\Service\UidGen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Flush $flush, UidRepository $uidRep, LinkRepository $linkRep, Request $request)
    {
        $userLink = null;

        $host = null;

        $link = new Link();

        $form = $this->createForm(LinkType::class, $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid())
        {
            $link = $form->getData();

            $id = UidGen::generate();

            $uid = new Uid($id);

            $link->Uid($uid);
            $uid->Link($link);

            $linkRep->persist($link);
            $uidRep->persist($uid);

            $flush();

            $userLink = $uid->getUid();

            $host = $request->server->get('HTTP_HOST');

            return $this->render('base.html.twig', ['form' => $form->createView(), 'userLink' => $userLink, 'host' => $host]);
        }
        
        return $this->render('base.html.twig', ['form' => $form->createView(), 'userLink' => $userLink, 'host' => $host]);
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