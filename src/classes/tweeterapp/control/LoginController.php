<?php
    namespace iutnc\tweeterapp\control;


    class LoginController extends \iutnc\mf\control\AbstractController{
        private int $userId;
        private int $isPost;
        private string $username;
        private string $password;

        public function __construct() {
            parent::__construct(); 
        }


        public function execute() : void{
            if($this->request->method==="GET"){
                $SignupView = new \iutnc\tweeterapp\view\LoginView();
                $SignupView->makePage();
            }else{
                $username = $this->request->post["username"];
                $password = $this->request->post["password"];

                try{
                    \iutnc\tweeterapp\auth\TweeterAuthentification::login($username, $password);
                    \iutnc\mf\router\Router::executeRoute("home-loggedin");
                }catch(\iutnc\mf\exceptions\AuthentificationException $e){
                    $this->request->method = "GET";
                    $this->execute();
                }
            }
        }


    }