<?php
    namespace iutnc\tweeterapp\control;


    class LogoutController extends \iutnc\mf\control\AbstractController{
        public function __construct() {
            parent::__construct(); 
        }


        public function execute() : void{
            \iutnc\tweeterapp\auth\TweeterAuthentification::logout();
            \iutnc\mf\router\Router::executeRoute("home");
        }


    }