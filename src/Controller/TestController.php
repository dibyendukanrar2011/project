<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test1', name: 'web_test1')]
    public function test1(Request $request): Response
    {
        if($request->getMethod() == "POST") {
            $session = $request->getSession();
            //$session->set('test1', $request->get('v1'));
            $session->set('test1', $request->request->all());
            return $this->redirect($this->generateUrl('web_test2'));
        }
        return $this->render('test/test1.html.twig', []);
    }

    #[Route('/test2', name: 'web_test2')]
    public function test2(Request $request): Response
    {
        /* if($request->getMethod() == "POST") {
            $session = $request->getSession();
            $session->set('test1', $request->request->all());
            $this->redirect($this->generateUrl('test2'));
        } */
        $test1Data = $request->getSession()->get('test1');
        return $this->render('test/test2.html.twig', [
            "test1Data" => $test1Data
        ]);
    }
}
