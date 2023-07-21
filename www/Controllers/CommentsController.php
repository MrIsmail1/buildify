<?php
namespace App\Controllers;

use App\Models\Comments;
use App\Core\View;
use App\Forms\CommentsConfig;
use App\DataTable\CommentsTableConfig;
use App\Models\Page;


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
            
        } else {
            http_response_code(404);
        }
    }

    

    public function addComment()
    {
        $view = new View("/bdfy-admin/Comments/add", "back");
        $form = new CommentsConfig();
        $view->assign('form', $form->getConfig());
        

        if ((isset($_REQUEST['content']))) {
           // Récupérer les données du formulaire
                      
           //$idUser = $CommentsModel->getIdUser();
           $commentAuthor = $_POST['commentAuthor'];
           $content = $_POST['content'];
           $idPage = (int)$_REQUEST['id'];

           

           //ajouter le comment à la bdd
           if ($commentAuthor && $content) {
                // Ajouter le commentaire à la base de données
               
                $comment = new Comments();
                
                //assigner les attributs
                $CommentsModel->setContent($content);
                $CommentsModel->setIdUser($userid);
                $CommentsModel->setCommentAuthor($commentAuthor);
                $CommentsModel->setIdPage($idPage);
                //$CommentsModel->setCommentAuthor($_SESSION["user"]["firstname"]);
                $CommentsModel->setReported(false);
                
                $CommentsModel = Comments::getInstance();
                $CommentsModel->create($comment);

                echo "Comment added successfully.";
            } else {
                echo "Please fill in all the required fields.";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                header("Location: " . $_SERVER['REQUEST_URI'], true, 303);
            exit;
            }
        }
    }


    public function DeleteComment(){
        $id = $_REQUEST["id"];
        $CommentsModel = Comments::getInstance();
        $CommentsModel->deleteCommentById($id);
        header('Location:/bdfy-admin/comments');
    }

    public function Report(){
        $id = $_REQUEST["id"];
        $CommentsModel = Comments::getInstance();
        if ($CommentsModel->reportCommentById($id)) {
            echo "Comment reported successfully.";
        } 
        $CommentsModel->CommentReported($id);
        header('Location:/bdfy-admin/comments');
    }


}
