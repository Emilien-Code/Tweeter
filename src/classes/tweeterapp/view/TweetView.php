<?php
    namespace iutnc\tweeterapp\view;

    class TweetView extends TweeterView{

        public function __construct(mixed $data=null){
            parent::__construct($data); 
        }

        public function render(): string{
            $html = <<<EOT
                <div class="tweet"/>
                EOT;
            $html .= "
                <p>
                    {$this->data->text}
                </p>
                <p>
                    tweeté le {$this->data->created_at} score : {$this->data->score}
                </p>" ;
            $html."</div>";

            return $html;
        }

    }