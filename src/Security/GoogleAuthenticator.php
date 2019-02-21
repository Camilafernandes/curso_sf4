<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Client\Provider\GoogleUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class GoogleAuthenticator extends SocialAuthenticator
{
    private $clientRegistry;
    private $em;
    private $router;

    public function __contruct(
        ClientRegistry $clientRegistry,
        EntityManagerInterface $em,
        RouterInterface $router
    )
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    public function supports(Request $request)
    {
        return $request->getPathInfo() == '/connect/google/check' && $request->isMethod('GET');
    }

    public function getCredentials(Request $request)
    {
        return $this->fetchAccessToken($this->getGoogleClient());
    }

    public function getUser(
        $credentials, 
        UserProviderInterface $userProvider
    )
    {
        /** @var GoogleUser $googleUser */
        $googleUser = $this->getGoogleClient()
            ->fetchUserFromToken($credentials);

        $email = $googleUser->getEmail();
        
        $user = $this->em->getRepository('App:User')
            ->findOneBy(['email' => $email]);
        
        if (! $user) {
            $user = new User();
            $user->setEmail($googleUser->getEmail());
            $user->setNome($googleuser->getName());
            $user->setCreatedAt( new \DateTime(date('Y-m-d H:i:s')));

            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }

    private function getGoogleClient()
    {
        return $this->clientRegistry
            ->getClient('google');

    }

    public function start (
        Request $request,
        AuthenticationException $authException = null 
    )
    {
        return new RedirectResponse('/login');
    }

    public function onAuthenticationFailure ( 
        Request $request,
        AuthenticationException $authException = null 
    )
    {
        //TODO implementar metodo de falha na autenticação
    }

    public function onAuthenticationSuccess(
        Request $request, 
        TokenInterface $token,
        $providerKey
    )
    {
        //TODO implementar metodo sucesso na autenticação
    }


}