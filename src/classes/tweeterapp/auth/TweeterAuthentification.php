<?php
    namespace iutnc\tweeterapp\auth;



    class TweeterAuthentification extends \iutnc\mf\auth\AbstractAuthentification{
        const ACCESS_LEVEL_USER = 0;
        const ACCESS_LEVEL_ADMIN = 100;

        public static function register(string $username,
                                        string $password,
                                        string $fullname,
                                        $level=self::ACCESS_LEVEL_USER): void {


        /* La méthode register
            *
            *    Permet la création d'un nouvel utilisateur de l'application
            *
            * Paramètres :
            *
            *    $username : le nom d'utilisateur choisi
            *    $pass : le mot de passe choisi
            *    $fullname : le nom complet
            *    $level : le niveaux d'accès (par défaut ACCESS_LEVEL_USER)
            *
            * Algorithme :
            *
            *    - Si un utilisateur avec le même nom d'utilisateur existe déjà en BD
            *        - soulever une exception
            *    - Sinon
            *        - créer un nouveau modèle ``User`` avec les valeurs en paramètre
            *           ATTENTION : utiliser self::makePassword (cf. ``AbstractAuthentification``)
            *
            */


            $user = \iutnc\tweeterapp\model\User::select()->where('username', '=', $username)->first();
            if(is_null($user)){
                $newUser = new \iutnc\tweeterapp\model\User();
                $newUser->username = $username;
                $newUser->fullname = $fullname;
                $newUser->level = $level;
                $newUser->followers = 0;
                $newUser->password = self::makePassword($password);
                $newUser->save();
            }else {
                throw new \iutnc\mf\exceptions\AuthentificationException();
            }
        }


    public static function login(string $username, string $password): void {

        /* La méthode login
        *
        *     Permet de connecter un utilisateur qui a fourni son nom d'utilisateur
        *     et son mot de passe (depuis un formulaire de connexion)
        *
        * Paramètres :
        *
        *    $username : le nom d'utilisateur
        *    $password : le mot de passe tapé sur le formulaire
        *
        * Algorithme :
        *
        *    - Récupérer l'utilisateur avec l'identifiant $username depuis la BD
        *    - Si aucun de trouvé
        *         - soulever une exception
        *    - Sinon
        *         - réaliser l'authentification et le chargement du profil
        *            ATTENTION : utiliser self::checkPassword (cf. ``AbstractAuthentification``)
        *
        */

            $user = \iutnc\tweeterapp\model\User::select()->where('username', '=', $username)->firstOr(function(){
                throw new iutnc\mf\exceptions\AuthentificationException();
            });


            if(self::checkPassword($password, $user->password, $user->id, $user->level)){
                $_SESSION['user_profile']['id'] = $user->id;
                $_SESSION['user_profile']['access_level'] = $user->level;
            }
    }

    }