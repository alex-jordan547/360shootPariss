<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
    public function index(Request $request): Response
    {
        $hostname = $request->getSchemeAndHttpHost();
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $url = ['loc' => $this->generateUrl('app_home', ['form' => $form])];
        $response = new Response($this->renderView('sitemap/index.html.twig', [
            'url' => $url,
            'hostname' => $hostname]),
            200);
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
