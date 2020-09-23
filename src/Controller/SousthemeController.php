<?php

namespace App\Controller;

use App\Entity\Soustheme;
use App\Form\SousthemeType;
use App\Repository\SousthemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/soustheme")
 */
class SousthemeController extends AbstractController
{
    /**
     * @Route("/", name="soustheme_index", methods={"GET"})
     */
    public function index(SousthemeRepository $sousthemeRepository): Response
    {
        return $this->render('soustheme/index.html.twig', [
            'sousthemes' => $sousthemeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="soustheme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $soustheme = new Soustheme();
        $form = $this->createForm(SousthemeType::class, $soustheme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soustheme);
            $entityManager->flush();

            return $this->redirectToRoute('soustheme_index');
        }

        return $this->render('soustheme/new.html.twig', [
            'soustheme' => $soustheme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="soustheme_show", methods={"GET"})
     */
    public function show(Soustheme $soustheme): Response
    {
        return $this->render('soustheme/show.html.twig', [
            'soustheme' => $soustheme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="soustheme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Soustheme $soustheme): Response
    {
        $form = $this->createForm(SousthemeType::class, $soustheme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('soustheme_index');
        }

        return $this->render('soustheme/edit.html.twig', [
            'soustheme' => $soustheme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="soustheme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Soustheme $soustheme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soustheme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soustheme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('soustheme_index');
    }
}
