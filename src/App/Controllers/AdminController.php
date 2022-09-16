<?php 

//namespace App\Controller;

class AdminController 
{
    public function index(){

        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $parametros = array();
        $parametros['tituloPagina'] = "Gerenciador de Conteúdo";
        try {
            $objPosts = Postagem::selectAll();
            $parametros['posts'] = $objPosts;
            $content = $twig->render("AdminContent.html", $parametros);
        } catch(Exception $e) {
            echo '<script>alert("'. $e->getMessage() .'");</script>';
            $content = $twig->render("AdminContent.html", $parametros);
        }

        echo $content;
    }
    public function create(){

        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $parametros = array();
        $parametros['tituloPagina'] = "Criar Publicação";
        $content = $twig->render("CreateContent.html", $parametros);
        echo $content;
    }
    public function insert(){

        try {
            Postagem::insert($_POST);
            echo '<script>alert("Postagem publicada com sucesso!");</script>';
            echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("'. $e->getMessage() .'");</script>';
            echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=create"</script>';
        }
        
    }

    public function change($paramId){

        $loader = new \Twig\Loader\FilesystemLoader('App/View');
        $twig = new \Twig\Environment($loader);
        $parametros = array();
        $post = Postagem::selectOneById($paramId);
        $parametros['tituloPagina'] = "Alterar Publicação";
        $parametros['id'] = $post->id;
        $parametros['titulo'] = $post->titulo;
        $parametros['conteudo'] = $post->conteudo;
        $content = $twig->render("UpdateContent.html", $parametros);
        echo $content;
    }
    public function update(){
        try {
            Postagem::update($_POST);
            echo '<script>alert("Postagem atualizada com sucesso!");</script>';
            echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("'. $e->getMessage() .'");</script>';
            echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
        }
    }
    public function delete($paramId){
        try {
            Postagem::delete($paramId);
            echo '<script>alert("Postagem deletada com sucesso!");</script>';
            echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("'. $e->getMessage() .'");</script>';
            echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';
        }
    }
}