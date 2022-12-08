<?php
    namespace iutnc\tweeterapp\control;


    class SignupController extends \iutnc\mf\control\AbstractController{
        private int $userId;
        private int $isPost;
        private string $username;
        private string $password;
        private string $fullname;

        public function __construct() {
            parent::__construct(); 
        }


        public function execute() : void{
            if($this->request->method==="GET"){
                $SignupView = new \iutnc\tweeterapp\view\SignupView();
                $SignupView->makePage();
            }else{
                $username = $this->request->post["username"];
                $password = $this->request->post["password"];
                $fullname = $this->request->post["fullname"];

                try{
                    \iutnc\tweeterapp\auth\TweeterAuthentification::register($username, $password, $fullname);
                    \iutnc\mf\router\Router::executeRoute("home");
                }catch(\iutnc\mf\exceptions\AuthentificationException $e){
                    $this->request->method = "GET";
                    $this->execute();
                }
            }
        }


    }