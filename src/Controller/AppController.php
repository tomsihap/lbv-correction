<?php

namespace App\Controller;

use App\Repository\AdvertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(AdvertRepository $advertRepository)
    {
        return $this->render('app/index.html.twig', [
            'adverts' => $advertRepository->findBy(['bookingUser' => null], ['createdAt' => 'desc']),
        ]);
    }

    /**
     * @Route("/search", name="app_search")
     * @param Request $request
     * @param AdvertRepository $advertRepository
     * @return Response
     * @IsGranted("ROLE_USER")
     */
    public function search(Request $request, AdvertRepository $advertRepository) : Response
    {
        return $this->render('advert/index.html.twig', [
            'adverts' => $advertRepository->findBySearch($request->query->get('query')),
        ]);
    }
}
