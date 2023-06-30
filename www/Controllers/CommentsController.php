<?php
namespace App\Controllers;

use App\Models\Comments;
use App\Core\View;
use App\Forms\CommentsConfig;
use App\DataTable\CommentsTableConfig;


class CommentsController
{
     

    public function getComments()
    {
        $view = new View("Comments/comments", "back");
        $CommentsModel = Comments::getInstance();
        // Instancier le modèle Comments
        $comments = $CommentsModel->getAllComments();
        
        $dataTable = new CommentsTableConfig($comments);         
        $view->assign('dataTable', $dataTable->getConfig());
        

        
        if ($comments) {
            var_dump($comments);
        } else {
            echo "No comments found. ";
        }
    }

    public function addComment()
    {
        $view = new View("Comments/add", "back");
        $form = new CommentsConfig();
        $view->assign('form', $form->getConfig());
        
        $CommentsModel = Comments::getInstance();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           // Récupérer les données du formulaire
           $idUser = $_SESSION['user']['id'];
           //$idUser = $CommentsModel->getIdUser();
           $content = $_POST['content'];

           

           //ajouter le comment à la bdd
           if ($idUser && $content) {
                // Ajouter le commentaire à la base de données
                $CommentsModel->setContent($content);
                $CommentsModel->setIdUser($idUser);
                $CommentsModel->create();

                echo "Comment added successfully.";
            } else {
                echo "Please fill in all the required fields.";
            }
        }

        
        
    }
    private function getUserId(){

    }
}
