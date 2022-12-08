<?php
    namespace iutnc\tweeterapp\control;


    class HomeController extends \iutnc\mf\control\AbstractController{
        public function __construct() {
        }


        public function execute() : void{
            $lignes = \iutnc\tweeterapp\model\Tweet::select()->get();
            $homeView = new \iutnc\tweeterapp\view\HomeView($lignes);
            $homeView->makePage();
        
        }


    }