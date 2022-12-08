<?php
    namespace iutnc\tweeterapp\control;


    class TweetController extends \iutnc\mf\control\AbstractController{
        private int $tweetId;

        public function __construct() {
            /* Utiliser le request du parent  */
            $this->tweetId = $_GET["tweetID"];
        }


        public function execute() : void{
            $tweet = \iutnc\tweeterapp\model\Tweet::select()->where('id', '=', $this->tweetId)->first();
            
            // $html = "<div/>";
            // $html .= "<p>$tweet->text tweeté par = $tweet->id le $tweet->created_at score : $tweet->score</div>" ;

            // echo $html."</div>";

            $tweetView = new \iutnc\tweeterapp\view\TweetView($tweet);
            $tweetView->makePage();
        }


    }