<?php
    namespace iutnc\tweeterapp\view;

    class UserView extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{
            $html = "<div/>";
            $tweets = $this->data[0];
            $user = $this->data[1];
            $html.="<h2>$user->fullname</h2>";
            $html.="<p>username : $user->username </p>";
            $html.="<p> followers : $user->followers </p>";


            $html.="<ul>";
            foreach ($tweets as $v)    
                $html .= "<li>
                    <p>$v->text</p> 
                    <p>le $v->created_at</p> 
                </li>" ;
            $html.="</ul>";

            $html."</div>";
            return $html;
        }

    }