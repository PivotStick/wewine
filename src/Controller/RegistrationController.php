<?php

namespace App\Controller;

use App\CRUD\UserCRUD;
use App\Entity\User;
use App\Security\AppCustomAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/api/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param AppCustomAuthenticator $authenticator
     * @param UserCRUD $userCRUD
     * @return JsonResponse
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppCustomAuthenticator $authenticator, UserCRUD $userCRUD)
    {


        $data = [];
        $error = false;
        $msg_error = "";
        $user = new User();
        $body = json_decode($request->getContent(), false);

        $user->setFirstname($body->firstname);
        $user->setLastname($body->lastname);


        if (!$userCRUD->hasMail($body->mail)) {
            $user->setMail($body->mail);
        } else {
            $error = true;
            $msg_error = "L'adresse mail est déjà utilisée.";
        }

        if (false === $error) {
            $hasLower = false;
            $hasUpper = false;
            $hasDigit = false;

            foreach (str_split($body->password) as $letter) {
                ctype_upper($letter) && $hasUpper = true;
                ctype_lower($letter) && $hasLower = true;
                ctype_digit($letter) && $hasDigit = true;
            }


            if ($hasLower && $hasUpper && $hasDigit && strlen($body->password) >= 6 && $body->password === $body->confirm) {
                $user->setPassword($passwordEncoder->encodePassword($user, $body->password));
            } else {
                $error = true;
                $msg_error = "Le mot de passe doit contenir au moins 6 caractères, une majuscule, une minuscule et un chiffre et doivent être identiques.";
            }
        }


        if ($error === false) {
            $userCRUD->create($user);

            // create an authenticated token for the User
            $token = $authenticator->createAuthenticatedToken($user, 'main');
            // authenticate this in the system
            $guardHandler->authenticateWithToken($token, $request, 'main');


            $data['firstname'] = $user->getFirstname();
            $data['lastname'] = $user->getLastname();
            $data['mail'] = $user->getMail();
        }


        return new JsonResponse(
            [
                'data' => $data,
                'error' => $error,
                'msg' => $msg_error
            ],
            200,
            [
                'Access-Control-Allow-Headers' => '*',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
        // $response->headers->set('Access-Control-Allow-Origin', '*');
    }
}
