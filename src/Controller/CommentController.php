<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/edit", name="comment_edit")
     */
    public function edit(CommentType $commentType, Request $request)
    {
        $form = $this->createForm($commentType);
        $form->handleRequest();

        $user = $this->getUser();
        if ($user != null) {
            $user = $user->getId();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $comment->setEpisode($episode);
            $comment->setAuthor($this->getUser());
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('episode_index');
        }
    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return RedirectResponse
     * @route("comment/delete/{id}", name="comment_delete")
     */
    public function delete(Request $request, Comment $comment): RedirectResponse
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();

        return $this->redirectToRoute('episode_index');
    }


}
