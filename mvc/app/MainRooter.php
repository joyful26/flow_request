<?php

class MainRooter
{

    public function start()
    {
        $params = explode('/', $_GET['p']);
   
        require_once(ROOT.'controllers/RegisterController.php');
        $defaultController = new RegisterController();

        if($params[0] !== "")
        {
            $controller = ucfirst($params[0])."Controller";
            if($params[1] === "" || !isset($params[1])){
                $action = "index";
            }else{
                $action = $params[1];
            }
            
            if(file_exists(ROOT.'controllers/'.$controller.'.php')){

                require_once(ROOT.'controllers/'.$controller.'.php');

                $controller = new $controller();
                if(method_exists($controller, $action)){
                    unset($params[0]);
                    unset($params[1]);
                    call_user_func_array([$controller, $action], $params);
                    
                }else{
                    http_response_code(404);
                    echo "la page n'existe pas encore pourquoi chez le routeur";
                }
            }else if($controller === "ConnexionController" || $controller === "InscriptionController"){
                $action = strtolower($controller);
                $action = str_replace("controller", "", $action);
                $defaultController->$action();

            }else{
                 echo "Tu pars où? le fichier n'existe pas!!!";
            }
        }else{
            if(isset($_SESSION['etudiant'])){
                unset($_SESSION['etudiant']);
            }
            
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
            $defaultController->index();
        }

    }
    
}

?>