<?php 

//namespace App\Controller;

class SobreController 
{
    public function index(){

        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $titulo = "Sobre";
        $content = $twig->render("SobreContent.html", ['titulo' => $titulo]);
        echo $content;
    }
}