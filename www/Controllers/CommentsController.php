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
           $userid = $_SESSION['user']['id'];
           //$idUser = $CommentsModel->getIdUser();
           $content = $_POST['content'];
           $pageId = $_GET['page_id'];

           

           //ajouter le comment à la bdd
           if ($userid && $content) {
                // Ajouter le commentaire à la base de données
                $CommentsModel->setContent($content);
                $CommentsModel->setIdUser($userid);
                $CommentsModel->setIdPage($pageId);
                $CommentsModel->create();

                echo "Comment added successfully.";
            } else {
                echo "Please fill in all the required fields.";
            }
        }

        
        
    }
    public function DeleteComment(){
        $id = $_REQUEST["id"];
        $CommentsModel = Comments::getInstance();
        $CommentsModel->deleteCommentById($id);
        header('Location:/comments');
    }
    
    public function EditComment(){

    }
}
