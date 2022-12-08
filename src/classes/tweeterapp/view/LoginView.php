<?php   
    namespace iutnc\tweeterapp\view;

    class LoginView extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{
            $html = "";
            $urlPost = $this->router->urlFor("login");

            $html .= "<form method=\"POST\" action=\"$urlPost\">
                <h2>Se connecter</h2>
                <input type=\"text\" placeholder=\"Nom d'utilisateur\" name=\"username\"/>
                <input type=\"password\" placeholder=\"Mot de passe\" name=\"password\"/>
                <button type=\"submit\">Se connecter</button>
                </form>";
            return $html;
        }

    }