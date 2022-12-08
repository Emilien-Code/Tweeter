<?php
    namespace iutnc\tweeterapp\control;


    class UserController extends \iutnc\mf\control\AbstractController{
        private int $userId;

        public function __construct() {
            /* Utiliser le request du parent  */
            $this->userId = $_GET["userID"];
        }


        public function execute() : void{
            $tweets = \iutnc\tweeterapp\model\Tweet::select()->where('author', '=', $this->userId)->get();
            $user = \iutnc\tweeterapp\model\User::select()->where('id', '=', $this->userId)->first();


            $userView = new \iutnc\tweeterapp\view\UserView([$tweets, $user]);
            $userView->makePage();
        }


    }