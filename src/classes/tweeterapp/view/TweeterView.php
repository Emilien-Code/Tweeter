<?php
    namespace iutnc\tweeterapp\view;
    abstract class TweeterView extends \iutnc\mf\view\AbstractView  implements \iutnc\mf\view\Renderer{
        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        abstract public function render() : string;

        protected function makeBody(): string {
            $menu = "";
            if(!\iutnc\tweeterapp\auth\TweeterAuthentification::connectedUser()){
                $menu = <<<EOT
                    <nav>
                        <a href="{$this->router->urlFor("home")}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M11 39h7.5V26.5h11V39H37V19.5L24 9.75 11 19.5Zm-3 3V18L24 6l16 12v24H26.5V29.5h-5V42Zm16-17.65Z"/></svg>
                        </a>
                        <a href="{$this->router->urlFor("login")}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M24.45 42v-3H39V9H24.45V6H39q1.2 0 2.1.9.9.9.9 2.1v30q0 1.2-.9 2.1-.9.9-2.1.9Zm-3.9-9.25L18.4 30.6l5.1-5.1H6v-3h17.4l-5.1-5.1 2.15-2.15 8.8 8.8Z"/></svg>
                        </a>
                        <a href="{$this->router->urlFor("signeup")}">
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M22.5 38V25.5H10v-3h12.5V10h3v12.5H38v3H25.5V38Z"/></svg>
                        </a>
                    </nav>
                EOT;
            }else{
                $menu = <<<EOT
                        <nav>
                            <a href="{$this->router->urlFor("home-loggedin")}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M11 39h7.5V26.5h11V39H37V19.5L24 9.75 11 19.5Zm-3 3V18L24 6l16 12v24H26.5V29.5h-5V42Zm16-17.65Z"/></svg>
                            </a>
                            <a href="{$this->router->urlFor("following")}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M24 23.95q-3.3 0-5.4-2.1-2.1-2.1-2.1-5.4 0-3.3 2.1-5.4 2.1-2.1 5.4-2.1 3.3 0 5.4 2.1 2.1 2.1 2.1 5.4 0 3.3-2.1 5.4-2.1 2.1-5.4 2.1ZM8 40v-4.7q0-1.9.95-3.25T11.4 30q3.35-1.5 6.425-2.25Q20.9 27 24 27q3.1 0 6.15.775 3.05.775 6.4 2.225 1.55.7 2.5 2.05.95 1.35.95 3.25V40Zm3-3h26v-1.7q0-.8-.475-1.525-.475-.725-1.175-1.075-3.2-1.55-5.85-2.125Q26.85 30 24 30t-5.55.575q-2.7.575-5.85 2.125-.7.35-1.15 1.075Q11 34.5 11 35.3Zm13-16.05q1.95 0 3.225-1.275Q28.5 18.4 28.5 16.45q0-1.95-1.275-3.225Q25.95 11.95 24 11.95q-1.95 0-3.225 1.275Q19.5 14.5 19.5 16.45q0 1.95 1.275 3.225Q22.05 20.95 24 20.95Zm0-4.5ZM24 37Z"/></svg>
                            </a>
                            <a href="{$this->router->urlFor("logout")}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M9 42q-1.2 0-2.1-.9Q6 40.2 6 39V9q0-1.2.9-2.1Q7.8 6 9 6h14.55v3H9v30h14.55v3Zm24.3-9.25-2.15-2.15 5.1-5.1h-17.5v-3h17.4l-5.1-5.1 2.15-2.15 8.8 8.8Z"/></svg>
                            </a>
                        </nav>
                    EOT;
            }

            $body = <<<EOT
                
            <header>
                <h1>Mini TweeTR</h1>
                ${menu}
             </header>
            <section>
                <a href="{$this->router->urlFor("post")}" id="new-tweet">
                <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M9 39h2.2l22.15-22.15-2.2-2.2L9 36.8Zm30.7-24.3-6.4-6.4 2.1-2.1q.85-.85 2.1-.85t2.1.85l2.2 2.2q.85.85.85 2.1t-.85 2.1Zm-2.1 2.1L12.4 42H6v-6.4l25.2-25.2Zm-5.35-1.05-1.1-1.1 2.2 2.2Z"/></svg>
                </a>        
                {$this->render()}
            </section>
            <footer> La super app créée en Licence Pro ©2022</footer>        
            
            EOT;

            return $body;
        }



    }