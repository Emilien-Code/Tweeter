<?php
    namespace iutnc\tweeterapp\view;

    class HomeView extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{

            $html = "<ul>";
            foreach ($this->data as $v) {//Pour afficher le nom faire comme dans le cours de bdd
                $urlTweet = $this->router->urlFor("view",[['tweetID', $v->id]]);
                $urlUser = $this->router->urlFor("user",[["userID", $v->author]]);
                $html .= "<li> 
                    <p> 
                        <a href=\"$urlTweet\">$v->text</a> 
                    </p>
                    <p>
                        tweeté par <a href=\"$urlUser\">$v->author</a> le $v->created_at </a>
                    </p>
                </li>" ;
            }
            $html .= "</ul>";
            return $html;
        }

    }