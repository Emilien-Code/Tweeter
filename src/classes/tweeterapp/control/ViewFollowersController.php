<?php
    namespace iutnc\tweeterapp\control;
    
    class ViewFollowersController extends \iutnc\mf\control\AbstractController{
        public function __construct() {
            parent::__construct(); 
        }
        public function execute() : void{
  
            $id = \iutnc\tweeterapp\auth\TweeterAuthentification::connectedUser();
            $followers = [];
            if($id){

                $lignes = \iutnc\tweeterapp\model\Follow::select()->where('followee', '=', $id)->get();
                
                foreach($lignes as $l){
                    $follower = \iutnc\tweeterapp\model\User::select()->where('id', '=', $l->follower)->first();
                    $followers[] = array($follower->username, $follower->id);
                }
                

            }

            $HomeLoggedInView = new \iutnc\tweeterapp\view\WiewFollowersWiew($followers);
            $HomeLoggedInView->makePage();
        }
    }