<?php
namespace App\Controllers;

use App\Core\Verificator;
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
        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $CommentsModel = Comments::getInstance();
                $CommentsModel->setContent($_POST["content"]);                
                $CommentsModel->setCommentAuthor($_POST["commentAuthor"]);
                $pageModel= new Page();
                $slug= $_REQUEST['slug'];
                $page= $pageModel->findSlug($slug);
                $CommentsModel->setIdPage($page["id"]);
                     
            } else {
                $view->assign('errors', $errors);
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
