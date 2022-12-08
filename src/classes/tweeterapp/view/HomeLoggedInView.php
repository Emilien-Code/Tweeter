<?php   
    namespace iutnc\tweeterapp\view;

    class HomeLoggedInView extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{
            $data = $this->data[0];
            $html = "";
            $html.=<<<EOT
                <p id="followed-by"> Vous êtes suivi par <a href="{$this->router->urlFor('following')}">$data[0] persones</a></p>
            EOT;
            $html.= "<h2>Les tweets des gens que vous suivez</h2>";
            
            $html .= "<ul>";
            foreach($data[1] as $el){
                echo "<br/>";
                $html .= "<li> $el[text] </li>";
            }
            $html .= "</ul>";

            return $html;
        }

    }