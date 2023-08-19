<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\ArticleCategorie;
use App\DataTable\ArticlesTableConfig;
use App\Forms\ArticleConfig;
use App\Forms\EditArticleConfig;
use App\Renderer\RealSingleArticleConfig;

class ArticleController
{
    public function ViewArticles()
    {

    $view = new View("Articles/articles", 'back');
    $articleModel = Article::getInstance();
    $articles = $articleModel->getAllArticles();
    
    // Récupération des noms de catégorie correspondants aux IDs de catégorie et les rajoutes dans article 
    $categorieModel = new Categorie();
    foreach ($articles as &$article) {
        $category = $categorieModel->getCategorieById($article['categorie_id']);
        $article['categorie_title'] = $category ? $category[0]['title'] : '';
    }
    
    $dataTable = new ArticlesTableConfig($articles);
    $view->assign('dataTable', $dataTable->getConfig());
    }
    

    public function AddArticle()
{
    $categorieModel = Categorie::getInstance();
    $articleModel = new Article();  
    
    $categories = $categorieModel->getAllCategories();

    $view = new View("Articles/singleArticle", 'back');
    $form = new ArticleConfig($categories);
    $view->assign('form', $form->getConfig());

    if ($form->isSubmit()) {
        $errors = Verificator::form($form->getConfig(), $_POST);

        if (empty($errors)) {
            
            $articleModel->setArticleTitle($_POST['articletitle']);
            $articleModel->setContent($_POST['content']);
            $articleModel->setSlug($_POST['articletitle']);
            $articleModel->setCategorie($_POST['categorie_id']);
            $articleModel->setUserId($_SESSION["user"]["id"]);
            $articleModel->setArticleAuthor($_SESSION["user"]["firstname"]);
            $createdSlug = $articleModel->getSlug();
            $exist = $articleModel->findSlug($createdSlug);
            
            
            if (empty($exist)) {
            // Create the article
            $articleModel->create();
            
            // Get the ID of the newly created article
            $id = $articleModel->getLastCreatedId();
            
            // Link the article to the selected category
            $selectedCategory = $_POST['categorie_id'];

            // Use the ArticleCategorie model to link the article to the category
            $articleCategoryModel = new ArticleCategorie();  
            $articleCategoryModel->setIdArticle($id);
            $articleCategoryModel->setIdCategory($selectedCategory);
            $articleCategoryModel->create();
         
                
                // Redirect to the articles page
                header('Location:/bdfy-admin/articles');
            } else {
                $view->assign('errors', ["Cet article existe déjà"]);
            }
        } else {
            $view->assign('errors', $errors);
        }
    }
}


    public function DeleteArticle()
    {
        $id = $_REQUEST['id'];
        $articleModel = Article::getInstance();
        $articleModel->deleteArticleById($id);
        header('Location:/bdfy-admin/articles');
    }

    public function EditArticle()
    {

    $id = $_REQUEST['id'];
    $categorieModel = Categorie::getInstance();
    $articleModel = new Article();  

    // Récupération de l'article à partir de son ID
    $article = $articleModel->getArticleById($id);

    // Récupération de toutes les catégories
    $allCategories = $categorieModel->getAllCategories();
    // Création de l'instance de EditArticleConfig en passant l'article et les catégories
    $view = new View("Articles/singleArticle", 'back');
    $view->assign('id', $id);
    $form = new EditArticleConfig($article, $allCategories);
    $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) { 
                $articleModel->setArticleTitle($_POST['articletitle']);
        $articleModel->setContent($_POST['content']);
        $articleModel->setSlug($_POST['slug']);
        $articleModel->setCategorie_id($_POST['categorie']); // Utilisez setCategorie_id
                

            // Prepare the data for the update
           $data = [
            'articletitle' => $articleModel->getArticleTitle(),
            'content' => $articleModel->getContent(),
            'slug' => $articleModel->getSlug(),
            'categorie_id' => $articleModel->getCategorie_id(), // Utilisez getCategorie_id
        ];
            // Call the update function
            $articleModel->update($data, 'id', $id);
            header("location:/bdfy-admin/articles");
        } else {
            $view->assign('errors', $errors);
        }
    }
}

    public function ViewSingleArticle()
{
    $id = $_REQUEST['id'];
    $articleModel = new Article();

    // Récupération de l'article à partir de son ID
    $article = $articleModel->getArticleById($id);

    // Vérifiez si l'article existe
    if ($article) {
        // Stockez l'URL précédente dans une variable de session
        $_SESSION['previous_url'] = $_SERVER['HTTP_REFERER'];
        // Créez une instance de vue pour afficher l'article
        $view = new View("Articles/realSingleArticle", 'front');
        $view->assign('article', $article);
    } else {
        // Redirigez vers une page d'erreur ou effectuez une autre action appropriée
        // Par exemple, vous pouvez afficher une page 404
        http_response_code(404);
        header("location: /404");
        exit;
    }
}



}