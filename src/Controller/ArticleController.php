<?php

namespace App\Controller;

use App\Actions\CommentAction;
use App\DTO\Response\ArticleResponse;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Actions\ArticleAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(
        ArticleAction $articleAction,
        ArticleResponse $articleResponse,
        Request $request,
        CommentAction $commentAction
    ): Response {

        $article = $articleAction->getArticle(1);
        $commentForm = $this->createForm(CommentType::class);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()){
            $commentAction->addComment(['text' => $commentForm->getData()->getText(), 'article' => $article->getId()]);
        }

        return $this->render('article/index.html.twig', [
            'username' => $this->getUser()->getName(),
            'article' => $articleResponse->getData($article),
            'form' => $commentForm->createView()
        ]);
    }

    /**
     * @Route("/api/article", methods={"POST"})
     */
    public function addArticleAction(Request $request, ArticleAction $articleAction) {

        $data = [
            'title' => $request->request->get('title'),
            'content' => $request->request->get('content'),
        ];

        $articleAction->addArticle($data);

        return new JsonResponse('Article Added succesfully', 201);
    }

    /**
     * @Route("/api/article/{id}", methods={"GET"})
     */
    public function getArticleAction(int $id, ArticleAction $articleAction, ArticleResponse $articleResponse) {
        $article = $articleAction->getArticle($id);

        return new JsonResponse($articleResponse->getData($article));
    }
}
