<?php
// ===================
//  HOME et ADMIN PAGE

$app->get('/', "MicroCMS\Controller\HomeController::indexAction")
->bind('home');

// Admin zone
$app->get('/admin', "MicroCMS\Controller\AdminController::indexAction")
->bind('admin');

// ======================================
// CONCERNE ARTICLE

// Detailed info about an article
$app->match('/article/{id}', "MicroCMS\Controller\HomeController::articleAction")
->bind('article');

// Add a new article
$app->match('/admin/article/add', "MicroCMS\Controller\AdminController::addArticleAction")
->bind('admin_article_add');

// Edit an existing article
$app->match('/admin/article/{id}/edit', "MicroCMS\Controller\AdminController::editArticleAction")
->bind('admin_article_edit');

// Remove an article
$app->get('/admin/article/{id}/delete', "MicroCMS\Controller\AdminController::deleteArticleAction")
->bind('admin_article_delete');

// API : get all articles
$app->get('/api/articles', "MicroCMS\Controller\ApiController::getArticlesAction")
->bind('api_articles');
// API : get an article
$app->get('/api/article/{id}', "MicroCMS\Controller\ApiController::getArticleAction")
->bind('api_article');
// API : create an article
$app->post('/api/article', "MicroCMS\Controller\ApiController::addArticleAction")
->bind('api_article_add');
// API : remove an article
$app->delete('/api/article/{id}', "MicroCMS\Controller\ApiController::deleteArticleAction")
->bind('api_article_delete');

// ======================================
// CONCERNE EXPERIENCE

// Experiences Page
$app->get('/experience', "MicroCMS\Controller\ExperienceController::experienceAction")
->bind('experience');

// Detailed info about an experience
$app->get('/experience/{id}', "MicroCMS\Controller\ExperienceController::experiencesingleAction")
->bind('experience_single');

// API : get all experiences
$app->get('/api/experience', "MicroCMS\Controller\ApiController::getExperiencesAction")
->bind('api_experiences');

// API : get an experience
$app->get('/api/experience/{id}', "MicroCMS\Controller\ApiController::getExperienceAction")
->bind('api_experience');

// API : create an experience
$app->post('/api/experience', "MicroCMS\Controller\ApiController::addExperienceAction")
->bind('api_experience_add');

// API : remove an experience
$app->delete('/api/experience/{id}', "MicroCMS\Controller\ApiController::deleteExperienceAction")
->bind('api_experience_delete');

// Add a new experience
$app->match('/admin/experience/add', "MicroCMS\Controller\AdminController::addExperienceAction")
->bind('admin_experience_add');

// Edit an existing experience
$app->match('/admin/experience/{id}/edit', "MicroCMS\Controller\AdminController::editExperienceAction")
->bind('admin_experience_edit');

// Remove an experience
$app->get('/admin/experience/{id}/delete', "MicroCMS\Controller\AdminController::deleteExperienceAction")
->bind('admin_experience_delete');

// ======================================
// CONCERNE LOISIR

// Loisirs Page
$app->get('/loisir', "MicroCMS\Controller\LoisirController::loisirAction")
->bind('loisir');

// Loisirs Detaile
$app->get('/loisir/{id}', "MicroCMS\Controller\LoisirController::loisirsingleAction")
->bind('loisir_single');

// Add a new experience
$app->match('/admin/loisir/add', "MicroCMS\Controller\AdminController::addLoisirAction")
->bind('admin_loisir_add');

// Edit an existing loisir
$app->match('/admin/loisir/{id}/edit', "MicroCMS\Controller\AdminController::editLoisirAction")
->bind('admin_loisir_edit');

// Remove an loisir
$app->get('/admin/loisir/{id}/delete', "MicroCMS\Controller\AdminController::deleteLoisirAction")
->bind('admin_loisir_delete');
// API : get all experiences
$app->get('/api/loisir', "MicroCMS\Controller\ApiController::getLoisirsAction")
->bind('api_loisirs');

// API : get an loisir
$app->get('/api/loisir/{id}', "MicroCMS\Controller\ApiController::getLoisirAction")
->bind('api_loisir');

// API : create an loisir
$app->post('/api/loisir', "MicroCMS\Controller\ApiController::addLoisirAction")
->bind('api_loisir_add');

// API : remove an loisir
$app->delete('/api/loisir/{id}', "MicroCMS\Controller\ApiController::deleteLoisirAction")
->bind('api_loisir_delete');

// ======================================
// CONCERNE COMPETENCE

// Loisirs Page
$app->get('/competence', "MicroCMS\Controller\LoisirController::competenceAction")
->bind('competence');

// Loisirs Detaile
$app->get('/competence/{id}', "MicroCMS\Controller\LoisirController::competencesingleAction")
->bind('competence_single');

// Add a new experience
$app->match('/admin/competence/add', "MicroCMS\Controller\AdminController::addCompetenceAction")
->bind('admin_competence_add');

// Edit an existing competence
$app->match('/admin/competence/{id}/edit', "MicroCMS\Controller\AdminController::editCompetenceAction")
->bind('admin_competence_edit');

// Remove an competence
$app->get('/admin/competence/{id}/delete', "MicroCMS\Controller\AdminController::deleteCompetenceAction")
->bind('admin_competence_delete');
// API : get all experiences
$app->get('/api/competence', "MicroCMS\Controller\ApiController::getCompetencesAction")
->bind('api_competences');

// API : get an competence
$app->get('/api/competence/{id}', "MicroCMS\Controller\ApiController::getCompetenceAction")
->bind('api_competence');

// API : create an competence
$app->post('/api/competence/add', "MicroCMS\Controller\ApiController::addCompetenceAction")
->bind('api_competence_add');

// API : remove an competence
$app->delete('/api/competence/{id}', "MicroCMS\Controller\ApiController::deleteCompetenceAction")
->bind('api_competence_delete');

// ======================================
// CONCERNE PERSO

// page des infos Perso
$app->get('/perso', "MicroCMS\Controller\PersoController::persoAction")
->bind('perso');

$app->get('/perso/{id}', "MicroCMS\Controller\PersoController::persosingleAction")
->bind('perso_single');

// Add a new experience
$app->match('/admin/perso/add', "MicroCMS\Controller\AdminController::addPersoAction")
->bind('admin_perso_add');

// Edit an existing perso
$app->match('/admin/perso/{id}/edit', "MicroCMS\Controller\AdminController::editPersoAction")
->bind('admin_perso_edit');

// Remove an perso
$app->get('/admin/perso/{id}/delete', "MicroCMS\Controller\AdminController::deletePersoAction")
->bind('admin_perso_delete');

// API : get all experiences
$app->get('/api/perso', "MicroCMS\Controller\ApiController::getPersosAction")
->bind('api_perso');

// API : get an perso
$app->get('/api/perso/{id}', "MicroCMS\Controller\ApiController::getPersoAction")
->bind('api_perso');

// API : create an perso
$app->post('/api/perso', "MicroCMS\Controller\ApiController::addPersoAction")
->bind('api_perso_add');

// API : remove an perso
$app->delete('/api/perso/{id}', "MicroCMS\Controller\ApiController::deletePersoAction")
->bind('api_perso_delete');

// ======================================
// CONCERNE PORTFOLIO

// Page Portfolio
$app->get('/portfolio', "MicroCMS\Controller\PortfolioController::portfolioAction")
->bind('portfolio');

// Page Portfolio Detaille
$app->get('/portfolio/{id}', "MicroCMS\Controller\PortfolioController::portfoliosingleAction")
->bind('portfolio_single');

// Add a new experience
$app->match('/admin/portfolio/add', "MicroCMS\Controller\AdminController::addPortfolioAction")
->bind('admin_portfolio_add');

// Edit an existing portfolio
$app->match('/admin/portfolio/{id}/edit', "MicroCMS\Controller\AdminController::editPortfolioAction")
->bind('admin_portfolio_edit');

// Remove an portfolio
$app->get('/admin/portfolio/{id}/delete', "MicroCMS\Controller\AdminController::deletePortfolioAction")
->bind('admin_portfolio_delete');
// ======================================
// CONCERNE USER

// Login form
$app->get('/login', "MicroCMS\Controller\HomeController::loginAction")
->bind('login');

// Add a user
$app->match('/admin/user/add', "MicroCMS\Controller\AdminController::addUserAction")
->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', "MicroCMS\Controller\AdminController::editUserAction")
->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', "MicroCMS\Controller\AdminController::deleteUserAction")
->bind('admin_user_delete');

// ======================================
// CONCERNE COMMENTS

// Edit an existing comment
$app->match('/admin/comment/{id}/edit', "MicroCMS\Controller\AdminController::editCommentAction")
->bind('admin_comment_edit');

// Remove a comment
$app->get('/admin/comment/{id}/delete', "MicroCMS\Controller\AdminController::deleteCommentAction")
->bind('admin_comment_delete');
