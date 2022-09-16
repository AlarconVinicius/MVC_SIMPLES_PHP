<?php 

//namespace App\Controller;

class HomeController 
{
    public function index(){
        try {
            $posts = Postagem::selectAll();
            
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);
            $titulo = "Home";
            $content = $twig->render("HomeContent.html", ['posts' => $posts, 'titulo' => $titulo]);
            echo $content;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}