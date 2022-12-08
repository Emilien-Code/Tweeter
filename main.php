<?php
    # Emi
    # MonSup3rMDP
    require_once 'vendor/autoload.php';

    use  \iutnc\tweeterapp\auth as AUTH;


    $config = parse_ini_file("./conf/config.ini");

    /* une instance de connexion  */
    $db = new Illuminate\Database\Capsule\Manager();

    $db->addConnection( $config ); /* configuration avec nos paramètres */
    $db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
    $db->bootEloquent();           /* établir la connexion */



    $router = new \iutnc\mf\router\Router();

    $router->addRoute('home', 'list_tweets', '\iutnc\tweeterapp\control\HomeController', AUTH\TweeterAuthentification::ACCESS_LEVEL_NONE);
    $router->addRoute('view', 'view_tweet', '\iutnc\tweeterapp\control\TweetController', AUTH\TweeterAuthentification::ACCESS_LEVEL_NONE);
    $router->addRoute('user', 'view_user_tweets', '\iutnc\tweeterapp\control\UserController', AUTH\TweeterAuthentification::ACCESS_LEVEL_NONE);
    
    $router->addRoute('signeup', 'signeup', '\iutnc\tweeterapp\control\SignupController', AUTH\TweeterAuthentification::ACCESS_LEVEL_NONE);
    $router->addRoute('login', 'login', '\iutnc\tweeterapp\control\LoginController', AUTH\TweeterAuthentification::ACCESS_LEVEL_NONE);
    
    $router->addRoute('home-loggedin', 'home_logged_in', '\iutnc\tweeterapp\control\HomeLoggedInController', AUTH\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('view-followers', 'view_followers', '\iutnc\tweeterapp\control\ViewFollowersController', AUTH\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('post', 'post_tweet', '\iutnc\tweeterapp\control\PostController', AUTH\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('logout', 'logout', '\iutnc\tweeterapp\control\LogoutController', AUTH\TweeterAuthentification::ACCESS_LEVEL_USER);
    $router->addRoute('following', 'view_following', '\iutnc\tweeterapp\control\FollowingController', AUTH\TweeterAuthentification::ACCESS_LEVEL_USER);


    $router->setDefaultRoute('list_tweets');
    $router->run();
