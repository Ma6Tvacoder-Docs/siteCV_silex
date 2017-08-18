<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\Comment;
use MicroCMS\Form\Type\CommentType;

class HomeController {

    /**
     * Home page controller.
     * injection des elements dans la page
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {

        $articles = $app['dao.article']->findAll();
        $experiences = $app['dao.experience']->findAll();
        $loisirs = $app['dao.loisir']->findAll();
        $persos = $app['dao.perso']->findAll();
        $portfolios = $app['dao.portfolio']->findAll();
        $competences = $app['dao.competence']->findAll();
        // var_dump($portfolios);
        return $app['twig']->render('index.html.twig', array(
          'articles' => $articles,
          'experiences' => $experiences,
          'loisirs' => $loisirs,
          'persos' => $persos,
          'portfolios' => $portfolios,
          'competences' => $competences
        ) );
        // return $app['twig']->render('index.html.twig', array( 'articles' => $articles ) );
    }


    /**
     * Article details controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function articleAction($id, Request $request, Application $app) {
        $article = $app['dao.article']->find($id);
        $commentFormView = null;
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
            // A user is fully authenticated : he can add comments
            $comment = new Comment();
            $comment->setArticle($article);
            $user = $app['user'];
            $comment->setAuthor($user);
            $commentForm = $app['form.factory']->create(CommentType::class, $comment);
            $commentForm->handleRequest($request);
            if ($commentForm->isSubmitted() && $commentForm->isValid()) {
                $app['dao.comment']->save($comment);
                $app['session']->getFlashBag()->add('success', 'Your comment was successfully added.');
            }
            $commentFormView = $commentForm->createView();
        }
        $comments = $app['dao.comment']->findAllByArticle($id);

        return $app['twig']->render('article.html.twig', array(
            'article' => $article,
            'comments' => $comments,
            'commentForm' => $commentFormView));
    }
    /**
     * Experience details controller.
     *
     * @param integer $id Experience id
     * @param Request $request Incoming requests
     * @param Application $app Silex application
     */
    public function experienceAction($id, Request $request, Application $app) {
        $experience = $app['dao.experience']->find($id);
        $commentFormView = null;

        return $app['twig']->render('experience.html.twig', array(
            'experience' => $experience/* ,
            'comments' => $comments,
            'commentForm' => $commentFormView */
          ));
    }
    public function competenceAction($id, Request $request, Application $app) {
        $competence = $app['dao.competence']->find($id);
        $commentFormView = null;

        return $app['twig']->render('competence.html.twig', array(
            'competence' => $experience/* ,
            'comments' => $comments,
            'commentForm' => $commentFormView */
          ));
    }
    public function loisirAction($id, Request $request, Application $app) {
        $loisir = $app['dao.loisir']->find($id);
        $commentFormView = null;

        return $app['twig']->render('loisir.html.twig', array(
            'loisir' => $loisir
          ));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }
}
