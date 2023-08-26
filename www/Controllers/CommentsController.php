<?php
namespace App\Controllers;

use App\Core\Verificator;
use App\Models\Comments;
use App\Core\View;
use App\Forms\CommentsConfig;
use App\DataTable\CommentsTableConfig;
use App\Forms\PageConfig;
use App\Models\Page;


class CommentsController
{
     

    public static function getComments($id)
    {
        
        $CommentsModel = Comments::getInstance();
        // Instancier le modèle Comments
        $comments = $CommentsModel->getCommentsForArticle($id);          
            
               
        if ($comments) {
            return $comments;
        } else {
            http_response_code(404);
        }
    }
    
    public function getAllComments()
    {
        
        $view = new View("Comments/comments", "back");
        $CommentsModel = Comments::getInstance();
        // Instancier le modèle Comments
        $comments = $CommentsModel->getAllComments();
        
       

        $dataTable = new CommentsTableConfig($comments);         
        $view->assign('dataTable', $dataTable->getConfig());      
        
        
        
    }
    

    public static function addComment($id)
    {
        
        $commentsForm = new CommentsConfig($id);

        
        if ($commentsForm->isSubmit()) {
            $errors = Verificator::form($commentsForm->getConfig(), $_POST);
            
            if (empty($errors)) {
                $commentAuthor = $_POST["author"];
                $content = $_POST["content"];

                $CommentsModel = Comments::getInstance();
                $CommentsModel->setContent($content);                
                $CommentsModel->setCommentAuthor($commentAuthor);              
                $CommentsModel->setIdArticle($id);

                $CommentsModel->create();
                
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit; 
            }else {
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
