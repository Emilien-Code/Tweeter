<?php   
    namespace iutnc\tweeterapp\view;

    class WiewFollowersWiew extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{
            $html = "";
            
            $html = "<h2>Vous suivez : </h2>";
            
            $html .= "<ul>";
            foreach($this->data as $el){
                echo "<br/>";

                $html .= <<<EOT
                    <li> <a href="{$this->router->urlFor("user",[["userID",$el[1]]])}">$el[0]</a> </li>
                EOT;
            }
            $html .= "</ul>";

            return $html;
        }

    }