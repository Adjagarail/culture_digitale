<?php

namespace App\Controller;

use App\Entity\Soustheme;
use App\Form\SousthemeType;
use App\Repository\SousthemeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/soustheme")
 */
class SousthemeController extends AbstractController
{
    /**
     * @Route("/", name="soustheme_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Soustheme::class)->findAll();

        $soustheme = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        return $this->render('soustheme/index.html.twig', [
            'sousthemes' => $soustheme,
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
