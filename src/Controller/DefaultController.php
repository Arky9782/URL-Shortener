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
use App\Service\UIdGen;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function cut(EntityManagerInterface $em, Request $request)
    {
        $link = $request->get('input');

        $id = UIdGen::generate();

        $link = new Link($link);
        $Uid = new Uid($id);
        $Uid->setLink($link);
        $link->setUid($Uid);

        $em->persist($Uid);
        $em->persist($link);

        $em->flush();

        $link = $Uid->getUid();

        $host = $request->server->get('HTTP_HOST');

        return $this->render('base.html.twig', ['link' => $link, 'host' => $host]);
    }

    /**
     * @Route("/{id}")
     */
    public function getLink(EntityManagerInterface $em, $id)
    {
        $result = $this->getDoctrine()->getRepository('App:Uid')->findLink($id);

        if(!$result){
            return $this->redirect('/');
        }
        $link = $result[0]['link'];


        if(strpos($link, 'http') !== false)
        {
            return $this->redirect($link);
        }

        else {

            return $this->redirect('http://'.$link);
        }
    }
}