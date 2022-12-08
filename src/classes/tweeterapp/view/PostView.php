<?php   
    namespace iutnc\tweeterapp\view;

    class PostView extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{
            $html = "";
            $urlPost = $this->router->urlFor("post");
            if(!$this->data[0]){
                $html .= "<form method=\"POST\" action=\"$urlPost\">
                    <input type=\"text\" placeholder=\"Le tweet\" name=\"tweet\"/>
                    <button type=\"submit\">publier</button>
                    </form>";
            }else{
                $this->router->executeRoute("home"); // Dans le cotroller
            }
            return $html;
        }

    }