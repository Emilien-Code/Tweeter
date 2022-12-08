<?php   
    namespace iutnc\tweeterapp\view;

    class SignupView extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{
            $html = "";
            $urlPost = $this->router->urlFor("signeup");

            $html .= "<form method=\"POST\" action=\"$urlPost\">
                <h2>Créer un compte</h2>
                <input type=\"text\" placeholder=\"Nom d'utilisateur\" name=\"username\"/>
                <input type=\"text\" placeholder=\"Nom Prénom\" name=\"fullname\"/>
                <input type=\"password\" placeholder=\"Mot de passe\" name=\"password\"/>
                <button type=\"submit\">Créer mon compte</button>
                </form>";
            return $html;
        }

    }