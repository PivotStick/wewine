<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\CellarRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AppCustomAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    private EntityManagerInterface $entityManager;
    private UrlGeneratorInterface $urlGenerator;
    private CsrfTokenManagerInterface $csrfTokenManager;
    private UserPasswordEncoderInterface $userPasswordEncoder;
    private UserRepository $repo;
    private CellarRepository $cellarRepository;


    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $userPasswordEncoder, UserRepository $repo, CellarRepository $cellarRepository)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->repo = $repo;
        $this->cellarRepository = $cellarRepository;
    }

    public function supports(Request $request)
    {
        return 'app_login' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $dataJson = $request->getContent();
        $dataObject = json_decode($dataJson, false);

        $credentials = [
            'mail' => $dataObject->mail,
            'password' => $dataObject->password,
            'csrf_token' => null,
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['mail']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {

        /*$token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            dump('DEBUG');

            throw new InvalidCsrfTokenException();
        }*/

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['mail' => $credentials['mail']]);

       /* if (!$user) {

            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Mail could not be found.');
        }*/


        return $user;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        parent::onAuthenticationFailure($request, $exception); // TODO: Change the autogenerated stub

        dump('DEBUG');
        return new JsonResponse(
            [
                "success" => false
            ],
            200,
            [
                "Access-Control-Allow-Origin" => "*",
                "Access-Control-Allow-Headers" => "*"
            ]
        );
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->userPasswordEncoder->isPasswordValid($user, $credentials['password']);
        // Check the user's password or other credentials and return true or false
        // If there are no credentials to check, you can just return true
    }

    /**
     * @param $creadentials
     * @return mixed
     */
    public function getPassword($creadentials)
    {
        return $creadentials['password'];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $requestData = json_decode($request->getContent(), true);

        $users = $this->repo->findBy(['mail'=>$requestData['mail']]);
        $user = $users[0];
        
        $userInfos['firstname'] = $user->getFirstname();
        $userInfos['lastname'] = $user->getLastname();
        $userInfos['mail'] = $user->getMail();

        return new JsonResponse(
          [
              'userInfos' => $userInfos,
              "success" => true
          ],
            200,
            [
                "Access-Control-Allow-Origin" => "*",
                "Access-Control-Allow-Headers" => "*"
            ]
        );
/*
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        // For example : return new RedirectResponse($this->urlGenerator->generate('some_route'));
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);*/
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('app_login');
    }
}
