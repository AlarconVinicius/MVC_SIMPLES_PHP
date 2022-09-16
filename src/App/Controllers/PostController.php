<?php 

//namespace App\Controller;

class PostController 
{
    public function index($params){
        try {
            $post = Postagem::selectOneById($params);
            
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader);

            $parametros = array();
            $parametros['tituloPagina'] = "Criar Publicação";
            $parametros['id'] = $post->id;
            $parametros['titulo'] = $post->titulo;
            $parametros['conteudo'] = $post->conteudo;
            $parametros['comentarios'] = $post->comentarios;
            
            $content = $twig->render("Single-Post-Content.html", $parametros);
            echo $content;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function addComent(){
        try {
            Comentario::insert($_POST);
            header("Location: http://localhost:8080/?pagina=post&metodo=index&id=".$_POST['id']);
        } catch (Exception $e) {
            echo '<script>alert("'. $e->getMessage() .'");</script>';
            echo '<script>location.href="http://localhost:8080/?pagina=admin&metodo=index"</script>';
        }
    }
}