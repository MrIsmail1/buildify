<?php

namespace App\Controllers;

// Importation des classes nécessaires
use App\Core\View;
use App\Models\Categorie;
use App\Models\Article;
use App\Models\ArticleCategorie;
use App\Forms\CategorieConfig;
use App\Forms\EditCategorieConfig;
use App\Core\Verificator;
use App\DataTable\CategoriesTableConfig;

class CategorieController
{

    public function ViewCategories()
    {
        // Création d'une instance de la classe View pour afficher la vue des catégories
        $view = new View("Categories/categories", 'back');
        $categorieModel = Categorie::getInstance();
        $categories = $categorieModel->getAllCategories();
        $dataTable = new CategoriesTableConfig($categories);
        $view->assign('dataTable', $dataTable->getConfig());
    }

    public function AddCategorie()
    {

        $form = new CategorieConfig();
        $view = new View("Categories/addCategorie", "back");
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);

            //Recupère les infos dans le form
            if (empty($errors)) {
                $categorieModel = Categorie::getInstance();
                $title = $_POST['title'];

                // Check if categorie with given name already exists
                $exist = $categorieModel->getCategorieByTitle($title);
                if (empty($exist)) {

                    // Create new categorie
                    $categorieModel->setTitle($title);
                    $categorieModel->create();
                    header('Location: /bdfy-admin/categories');

                } else {
                    $view->assign('errors', ['La catégorie existe déjà !']);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

   public function DeleteCategorie()
{
    $id = $_REQUEST['id'];
    $categorieModel = Categorie::getInstance();
    
    // Récupération de la catégorie à supprimer
    $categorie = $categorieModel->getCategorieById($id);

    if ($categorie) {
        // Supprimez les entrées correspondantes dans la table article_categorie pour cette catégorie
        $articleCategoryModel = new ArticleCategorie();
        $articleCategoryModel->deleteByCategory($id);

        // Mettez à jour les articles restants en affectant une autre catégorie ou en laissant la colonne categorie_id à NULL
        $articleModel = new Article();
        $articleModel->updateCategoryWhenCategoryDeleted($id);

        // Ensuite, supprimez la catégorie de la table des catégories
         $categorieModel->delete(["id" => $id]);
    }

    // Redirigez l'utilisateur vers la liste des catégories après la suppression
    header('Location: /bdfy-admin/categories');
}




    public function EditCategorie()
    {
        // Récupération de l'ID de la catégorie à modifier depuis la requête
        $id = $_REQUEST['id'];
        $categorieModel = Categorie::getInstance();

        // Récupération des informations de la catégorie à partir de son ID
        $categorie = $categorieModel->getCategorieById($id);
        $view = new View("Categories/editCategorie", 'back');

        // Création d'une instance de la classe EditCategorieConfig pour obtenir la configuration du formulaire de modification de la catégorie
        $form = new EditCategorieConfig($categorie);

        // Assignation de la configuration du formulaire à la vue
        $view->assign('form', $form->getConfig());

        // Vérification si le formulaire a été soumis
        if ($form->isSubmit()) {
            // Validation du formulaire en utilisant la classe Verificator et obtention des éventuelles erreurs
            $errors = Verificator::form($form->getConfig(), $_POST);

            // Vérification si aucune erreur n'est présente dans le formulaire
            if (empty($errors)) {
                // Traitement à effectuer lorsque le formulaire est soumis et valide
                $title = $_POST['title'];

                $categorieModel->updateTitle($title, $id);
                header('Location: /bdfy-admin/categories');
            }
        }
    }
}
