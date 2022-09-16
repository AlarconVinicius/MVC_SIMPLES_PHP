<?php 
require_once "vendor/autoload.php";
// use App\Core\Core;
// use App\Controller\HomeController;
require "lib/Database/Connection.php";

require "App/Core/Core.php";

require "App/Controllers/HomeController.php";
require "App/Controllers/SobreController.php";
require "App/Controllers/PostController.php";

require "App/Controllers/AdminController.php";
       
require "App/Controllers/ErroController.php";

require "App/Models/Postagem.php";
require "App/Models/Comentario.php";

$template = file_get_contents("App/Template/HomeTemplate.html");

ob_start();
    $core = new Core;
    $core->start($_GET);
    $saida = ob_get_contents();
ob_end_clean();

$finalTemplate = str_replace('{{area_dinamica}}', $saida, $template);
echo $finalTemplate;
?>