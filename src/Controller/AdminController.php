<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\Article;
use MicroCMS\Domain\Experience;
use MicroCMS\Domain\User;
use MicroCMS\Domain\Perso;
use MicroCMS\Domain\Portfolio;
use MicroCMS\Domain\Loisir;
use MicroCMS\Domain\Competence;
use MicroCMS\Form\Type\ArticleType;
use MicroCMS\Form\Type\LoisirType;
use MicroCMS\Form\Type\ExperienceType;
use MicroCMS\Form\Type\PersoType;
use MicroCMS\Form\Type\PortfolioType;
use MicroCMS\Form\Type\CommentType;
use MicroCMS\Form\Type\UserType;
use MicroCMS\Form\Type\CompetenceType;
use MicroCMS\Form\Type\ExperienceController;

class AdminController {

    /**
     * Admin home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $articles = $app['dao.article']->findAll();
        $comments = $app['dao.comment']->findAll();
        $users = $app['dao.user']->findAll();
        $experiences = $app['dao.experience']->findAll();
        $loisirs = $app['dao.loisir']->findAll();
        $persos = $app['dao.perso']->findAll();
        $portfolios = $app['dao.portfolio']->findAll();
        $competences = $app['dao.competence']->findAll();
        // $experiences = $app['dao.experiences']->findAll();
        return $app['twig']->render('admin.html.twig', array(
            'articles' => $articles,
            'comments' => $comments,
            'users' => $users,
            'experiences' => $experiences,
            'loisirs' => $loisirs,
            'persos' => $persos,
            'portfolios' => $portfolios,
            'competences' => $competences
          ));
    }

    /**
     * Add article controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addArticleAction(Request $request, Application $app) {
        $article = new Article();
        $articleForm = $app['form.factory']->create(ArticleType::class, $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'New article',
            'articleForm' => $articleForm->createView()));
    }
    /**
     * Add loisir controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addLoisirAction(Request $request, Application $app) {
        $loisir = new Loisir();
        $loisirForm = $app['form.factory']->create(LoisirType::class, $loisir);
        $loisirForm->handleRequest($request);
        if ($loisirForm->isSubmitted() && $loisirForm->isValid()) {
            $app['dao.loisir']->save($loisir);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'Nouveau Loisir',
            'articleForm' => $loisirForm->createView()));
    }
    /**
    * Edit article controller.
    *
    * @param integer $id Article id
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
    public function editLoisirAction($id, Request $request, Application $app) {
      $loisir = $app['dao.loisir']->find($id);
      $loisirForm = $app['form.factory']->create(LoisirType::class, $loisir);
      $loisirForm->handleRequest($request);
      if ( $loisirForm->isSubmitted() && $loisirForm->isValid() ) {
        $app['dao.loisir']->save($loisir);
        $app['session']->getFlashBag()->add('success', 'Votre loisir à été enregistré avec succé.');
      }
      return $app['twig']->render('loisir_form.html.twig', array(
        'title' => 'Editer votre loisir',
        'loisirForm' => $loisirForm->createView()));
      }

      /**
      * Delete article controller.
      *
      * @param integer $id Article id
      * @param Application $app Silex application
      */
      public function deleteLoisirAction( $id, Application $app ) {
          // Delete the article
          $app['dao.loisir']->delete($id);
          $app['session']->getFlashBag()->add('success', 'Ce loisir à été supprimé avec succé !');
          // Redirect to admin home page
          return $app->redirect($app['url_generator']->generate('admin'));
      }

    /**
     * Edit article controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editArticleAction($id, Request $request, Application $app) {
        $article = $app['dao.article']->find($id);
        $articleForm = $app['form.factory']->create(ArticleType::class, $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was successfully updated.');
        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'Edit article',
            'articleForm' => $articleForm->createView() ));
    }

    /**
     * Delete article controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     */
    public function deleteArticleAction($id, Application $app) {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByArticle($id);
        // Delete the article
        $app['dao.article']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The article was successfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
    /**
     * Add perso controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addPersoAction(Request $request, Application $app) {
        $perso = new Perso();
        $persoForm = $app['form.factory']->create(PersoType::class, $perso);
        $persoForm->handleRequest($request);
        if ($persoForm->isSubmitted() && $persoForm->isValid()) {
            $app['dao.perso']->save($perso);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
        }
        return $app['twig']->render('perso_form.html.twig', array(
            'title' => 'Nouvelles informations personnels',
            'persoForm' => $persoForm->createView()));
    }
    /**
     * Edit article controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editPersoAction($id, Request $request, Application $app) {
        $perso = $app['dao.perso']->find($id);
        $persoForm = $app['form.factory']->create(PersoType::class, $perso);
        $persoForm->handleRequest($request);
        if ($persoForm->isSubmitted() && $persoForm->isValid()) {
            $app['dao.perso']->save($perso);
            $app['session']->getFlashBag()->add('success', 'The personnels was successfully updated.');
        }
        return $app['twig']->render('perso_form.html.twig', array(
            'title' => 'Editer ces informations personnels',
            'persoForm' => $persoForm->createView() ));
    }
    /**
     * Delete article controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     */
    public function deletePersoAction($id, Application $app) {
        // Delete the article
        $app['dao.perso']->delete($id);
        $app['session']->getFlashBag()->add('success', 'Ces information personnels ont été supprimé.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
    public function addCompetenceAction(Request $request, Application $app) {
        $competence = new Competence();
        $competenceForm = $app['form.factory']->create(CompetenceType::class, $competence);
        $competenceForm->handleRequest($request);
        if ($competenceForm->isSubmitted() && $competenceForm->isValid()) {
            $app['dao.competence']->save($competence);
            $app['session']->getFlashBag()->add('success', 'The competence was successfully created.');
        }
        return $app['twig']->render('competence_form.html.twig', array(
            'title' => 'Nouvelles informations competence',
            'competenceForm' => $competenceForm->createView()));
    }
    /**
     * Edit article controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editCompetenceAction($id, Request $request, Application $app) {
        $competence = $app['dao.competence']->find($id);
        $competenceForm = $app['form.factory']->create(CompetenceType::class, $competence);
        $competenceForm->handleRequest($request);
        if ($competenceForm->isSubmitted() && $competenceForm->isValid()) {
            $app['dao.competence']->save($competence);
            $app['session']->getFlashBag()->add('success', 'The competence was successfully updated.');
        }
        return $app['twig']->render('competence_form.html.twig', array(
            'title' => 'Editer ces informations competencennels',
            'competenceForm' => $competenceForm->createView() ));
    }
    /**
     * Delete article controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     */
    public function deleteCompetenceAction($id, Application $app) {
        // Delete the article
        $app['dao.competence']->delete($id);
        $app['session']->getFlashBag()->add('success', 'Ces competence ont été supprimé.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
    /**
     * Edit comment controller.
     *
     * @param integer $id Comment id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editCommentAction($id, Request $request, Application $app) {
        $comment = $app['dao.comment']->find($id);
        $commentForm = $app['form.factory']->create(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'The comment was successfully updated.');
        }
        return $app['twig']->render('comment_form.html.twig', array(
            'title' => 'Edit comment',
            'commentForm' => $commentForm->createView()));
    }
    public function addPortfolioAction(Request $request, Application $app) {
        $portfolio = new Portfolio();
        $portfolioForm = $app['form.factory']->create(PortfolioType::class, $portfolio);
        $portfolioForm->handleRequest($request);
        if ($portfolioForm->isSubmitted() && $portfolioForm->isValid()) {
            $app['dao.portfolio']->save($portfolio);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
        }
        return $app['twig']->render('portfolio_form.html.twig', array(
            'title' => 'Nouvelles informations portfolionnels',
            'portfolioForm' => $portfolioForm->createView()));
    }
    /**
     * Edit article controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editPortfolioAction($id, Request $request, Application $app) {
        $portfolio = $app['dao.portfolio']->find($id);
        $portfolioForm = $app['form.factory']->create(PortfolioType::class, $portfolio);
        $portfolioForm->handleRequest($request);
        if ($portfolioForm->isSubmitted() && $portfolioForm->isValid()) {
            $app['dao.portfolio']->save($portfolio);
            $app['session']->getFlashBag()->add('success', 'Vous avez édité cette element avec succés.');
        }
        return $app['twig']->render('portfolio_form.html.twig', array(
            'title' => 'Editer ces informations portfolionnels',
            'portfolioForm' => $portfolioForm->createView() ));
    }
    /**
     * Delete article controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     */
    public function deletePortfolioAction($id, Application $app) {
        // Delete the article
        $app['dao.portfolio']->delete($id);
        $app['session']->getFlashBag()->add('success', 'Ces information personnels ont été supprimé.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
    /**
     * Delete comment controller.
     *
     * @param integer $id Comment id
     * @param Application $app Silex application
     */
    public function deleteCommentAction($id, Application $app) {
        $app['dao.comment']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The comment was successfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    /**
     * Add user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addUserAction(Request $request, Application $app) {
        $user = new User();
        $userForm = $app['form.factory']->create(UserType::class, $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // generate a random salt value
            $salt = substr(md5(time()), 0, 23);
            $user->setSalt($salt);
            $plainPassword = $user->getPassword();
            // find the default encoder
            $encoder = $app['security.encoder.bcrypt'];
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'New user',
            'userForm' => $userForm->createView()));
    }

    /**
     * Edit user controller.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction($id, Request $request, Application $app) {
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(UserType::class, $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $plainPassword = $user->getPassword();
            // find the encoder for the user
            $encoder = $app['security.encoder_factory']->getEncoder($user);
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully updated.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'Edit user',
            'userForm' => $userForm->createView()));
    }

    /**
     * Delete user controller.
     *
     * @param integer $id User id
     * @param Application $app Silex application
     */
    public function deleteUserAction($id, Application $app) {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByUser($id);
        // Delete the user
        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The user was successfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
    // CUSTOM CLASS

    /**
    * Add article controller.
    *
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
    public function addExperienceAction(Request $request, Application $app) {
        $experience = new Experience();
        $experienceForm = $app['form.factory']->create(ExperienceType::class, $experience);
        $experienceForm->handleRequest($request);
        if ($experienceForm->isSubmitted() && $experienceForm->isValid()) {
            $app['dao.experience']->save($experience);
            $app['session']->getFlashBag()->add('success', 'Vous avez créé une nouvelle experience.');
        }
        return $app['twig']->render('experience_form.html.twig', array(
            'title' => 'Nouvelle Experience',
            'experienceForm' => $experienceForm->createView()));
    }

      /**
      * Edit article controller.
      *
      * @param integer $id Article id
      * @param Request $request Incoming request
      * @param Application $app Silex application
      */
      public function editExperienceAction($id, Request $request, Application $app) {
        $experience = $app['dao.experience']->find($id);
        $experienceForm = $app['form.factory']->create(ExperienceType::class, $experience);
        $experienceForm->handleRequest($request);
        if ( $experienceForm->isSubmitted() && $experienceForm->isValid() ) {
          $app['dao.experience']->save($experience);
          $app['session']->getFlashBag()->add('success', 'Votre experience à été enregistré avec succé.');
        }
        return $app['twig']->render('experience_form.html.twig', array(
          'title' => 'Editer votre experience',
          'experienceForm' => $experienceForm->createView()));
        }

        /**
        * Delete article controller.
        *
        * @param integer $id Article id
        * @param Application $app Silex application
        */
        public function deleteExperienceAction($id, Application $app) {
            // Delete the article
            $app['dao.experience']->delete($id);
            $app['session']->getFlashBag()->add('success', 'Cette experience à été supprimé avec succé !');
            // Redirect to admin home page
            return $app->redirect($app['url_generator']->generate('admin'));
        }
}
