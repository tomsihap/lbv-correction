<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Form\AdvertType;
use App\Repository\AdvertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/advert")
 * @IsGranted("ROLE_USER")
 */
class AdvertController extends AbstractController
{
    /**
     * @Route("/", name="advert_index", methods={"GET"})
     */
    public function index(Request $request, AdvertRepository $advertRepository): Response
    {
        $filter = $request->query->get('filter');

        if (in_array($filter, ['Location', 'Vente'])) {
            $adverts = $advertRepository->findByType($filter);
        }
        else {
            $adverts = $advertRepository->findBy([], ['createdAt' => 'desc']);
        }
        return $this->render('advert/index.html.twig', [
            'adverts' => $adverts,
            'dataFilter' => $filter,
        ]);
    }

    /**
     * @Route("/new", name="advert_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $advert = new Advert();
        $form = $this->createForm(AdvertType::class, $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $advert->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advert);
            $entityManager->flush();

            return $this->redirectToRoute('advert_index');
        }

        return $this->render('advert/new.html.twig', [
            'advert' => $advert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="advert_show", methods={"GET"})
     */
    public function show(Advert $advert): Response
    {
        return $this->render('advert/show.html.twig', [
            'advert' => $advert,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advert_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Advert $advert): Response
    {
        $form = $this->createForm(AdvertType::class, $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advert_index');
        }

        return $this->render('advert/edit.html.twig', [
            'advert' => $advert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Advert $advert
     * @return Response
     * @Route("/{id}/booking", name="advert_book", methods={"GET"})
     */
    public function bookAdvert(Advert $advert) : Response
    {
        if ($advert->getUser() !== $this->getUser()) {
            if ($advert->getBookingUser() === $this->getUser()) {
                $advert->setBookingUser(null);
            }
            else {
                $advert->setBookingUser($this->getUser());
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

        }

        return $this->redirectToRoute('advert_show', ['id' => $advert->getId() ]);
    }

    /**
     * @Route("/{id}", name="advert_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Advert $advert): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advert->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($advert);
            $entityManager->flush();
        }

        return $this->redirectToRoute('advert_index');
    }
}
