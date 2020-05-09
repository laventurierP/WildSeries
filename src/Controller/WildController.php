<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WildController
 * @Route("/wild", name="wild_")
 */

Class WildController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index() : Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }


        /**
         * @Route("/show/{slug}", name="show",requirements={"slug"="[a-z0-9\-]+"})
         *
         */
        public function show($slug): Response
    {
        $slugClean = str_replace('-',' ',$slug);
       $slugCleanCapit = ucwords($slugClean);
        return $this->render('wild/show.html.twig', ['slug' => $slugCleanCapit]);

    }

//    /**
//     * @Route("/show/{slug}",
//     *     methods={"GET"},
//     *     requirements={"slug"="[0-9]"},
//     *     defaults={"slug"="Aucune-série-sélectionnée,-veuillez-choisir-une-série"},
//     *     name="show"
//     * )
//     */
//    public function show(string $slug): Response
//    {
//       $slugClean = str_replace('-',' ',$slug);
//       $slugCleanCapit = ucwords($slugClean);
//        return $this->render('wild/show.html.twig', ['slug' => $slugCleanCapit]);
//    }

}
