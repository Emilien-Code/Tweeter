<?php
    namespace iutnc\tweeterapp\control;
    
    class HomeLoggedInController extends \iutnc\mf\control\AbstractController{
        public function __construct() {
            parent::__construct(); 
        }
        public function execute() : void{
  
            $id = \iutnc\tweeterapp\auth\TweeterAuthentification::connectedUser();
            if($id){

                $follower = "";
                $followers = [];
                $lignes = [];
                $tweets = [];
                $lignes = \iutnc\tweeterapp\model\Follow::select()->where('follower', '=', $id)->get();
                
                foreach($lignes as $l){
                    $tweets = \iutnc\tweeterapp\model\Tweet::select()->where('author', '=', $l->followee)->get();
                }


                $lignes = \iutnc\tweeterapp\model\Follow::select()->where('followee', '=', $id)->get();
                
                foreach($lignes as $l){
                    $follower = \iutnc\tweeterapp\model\User::select()->where('id', '=', $l->follower)->first();
                    $followers[] = array($follower->username);
                }

                $result[] = array(count($followers), $tweets);
                

            }

            $HomeLoggedInView = new \iutnc\tweeterapp\view\HomeLoggedInView($result);
            $HomeLoggedInView->makePage();
        }
    }