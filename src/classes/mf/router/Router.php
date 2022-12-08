<?php
    namespace iutnc\mf\router;

    class Router extends AbstractRouter{
        public function __construct(){
            parent::__construct();
        }

        
        public function addRoute(string $name,string $action, string $ctrl, int $acces): void{
            self::$routes[$action] = [$ctrl, $acces];
            self::$aliases[$name]= $action;
        }
        
        public function setDefaultRoute(string $action):void{
            self::$aliases["default"] = $action;
        }

        public function run() : void{
            $isAuthorized = false;
            
            if(isset($this->request->get["action"])){

                if (in_array($this->request->get["action"], self::$aliases)) {

                    $controller = new self::$routes[$this->request->get["action"]][0]();
                    $isAuthorized =  \iutnc\tweeterapp\auth\TweeterAuthentification::checkAccessRight(self::$routes[$this->request->get["action"]][1]);                    
                
                }else{

                    $controller = new self::$routes[self::$aliases["default"]][0]();  
                    $isAuthorized =  \iutnc\tweeterapp\auth\TweeterAuthentification::checkAccessRight(self::$routes[self::$aliases["default"]][1]);                    
                
                }
                
            }else{

                $controller = new self::$routes[self::$aliases["default"]][0]();
                $isAuthorized =  \iutnc\tweeterapp\auth\TweeterAuthentification::checkAccessRight(self::$routes[self::$aliases["default"]][1]);                    

            }

            if($isAuthorized)
                $controller->execute();
            else {

                $controller = new self::$routes[self::$aliases["default"]][0]();
                $controller->execute();
                
            }
        }

        static public function executeRoute(string $alias) : void{
            $ex = new self::$routes[self::$aliases[$alias]][0]();
            
            $isAuthorized =  \iutnc\tweeterapp\auth\TweeterAuthentification::checkAccessRight(self::$routes[self::$aliases[$alias]][1]);                    
            if($isAuthorized)
                $ex->execute();
        }

        public function urlFor(string $name, array $params=[]): string{//Vérifier si le tableau est vide 
            $action = self::$aliases[$name];
            $lien=$_SERVER['SCRIPT_NAME'];
            $lien=$lien."?action=".$action;
            foreach ($params as $v){
              $lien=$lien."&amp;".$v[0]."=".$v[1];
            }
            return $lien;
        }
    }