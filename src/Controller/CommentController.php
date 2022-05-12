<?php

namespace App\Controller;

use App\DTO\Response\ArticleResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Actions\CommentAction;
use App\Actions\ArticleAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="app_comment")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/api/comment", methods={"POST"})
     */
    public function addCommentAction(Request $request, CommentAction $commentAction, ArticleAction $articleAction) {

        $data = [
            'parent' => $request->request->get('parent', null),
            'title' => $request->request->get('title'),
            'text' => $request->request->get('text'),
            'article' => $request->request->get('article'),
        ];

        $commentAction->addComment($data);

        return new JsonResponse('Comment Added succesfully', 201);
    }

    /**
     * @Route("/api/comment/{id}", methods={"GET"})
     */
    public function getCommentAction(int $id, CommentAction $commentAction, CommentResponse $commentResponse) {
        $comment = $commentAction->getComment($id);

        return new JsonResponse($commentResponse->getData($comment));
    }
}
