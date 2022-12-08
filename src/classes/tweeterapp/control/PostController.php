<?php
    namespace iutnc\tweeterapp\control;


    class PostController extends \iutnc\mf\control\AbstractController{
        private int $userId;
        private int $isPost;
        private string $tweet;

        public function __construct() {
            parent::__construct(); 
            if($this->isPost =  isset($this->request->post["tweet"])){
                $this->tweet = $this->request->post["tweet"];
            }
        }


        public function execute() : void{
            if($this->isPost){
                $tweet = new \iutnc\tweeterapp\model\Tweet();   
                $tweet->text = $this->tweet;
                $tweet->author = \iutnc\tweeterapp\auth\TweeterAuthentification::connectedUser();
                $tweet->save();
            }
            $userView = new \iutnc\tweeterapp\view\PostView([$this->isPost]);
            $userView->makePage();
        }


    }