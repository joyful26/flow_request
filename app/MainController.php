<?php
abstract class MainController
{
    public function loadModel(string $model)
    {   
        require_once(ROOT.'models/'.$model.'.php');
        $this->$model = new $model();
    }

    public function render(string $fichier, string $layout = "default",array $data = [])
    {
        if($layout === ""){
            $layout = "default";
        }
        extract($data);
        $class = get_class($this);
        $class = str_replace('Controller', '', $class);
        $class = strtolower($class);
        ob_start();
    
        if(file_exists((ROOT.'views/'.$class.'/'.$fichier.'.php'))){

            require_once(ROOT.'views/'.$class.'/'.$fichier.'.php');


        }else{
            echo "la page n'existe pas pourquoi pas<br>";
        }
        
        $content = ob_get_clean();

        if($content==="")
            $content="ici";

        require_once(ROOT.'views/layouts/'.$layout.'.php');
        
    }
}
?>