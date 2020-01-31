<?php


namespace App\Security;


use App\Bridge\AwsCognitoClient;
use App\Entity\User\AppUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class CognitoAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    private $cognitoClient;
    private $router;
    private $csrfTokenManager;

    public function __construct(
        RouterInterface $router,
        CsrfTokenManagerInterface $csrfTokenManager,
        AwsCognitoClient $cognitoClient
    ) {
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->cognitoClient = $cognitoClient;
    }

    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        $providerKey
    ) {
        if ($targetPath = $this->getTargetPath($request->getSession(),
            $providerKey)
        ) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->router->generate('login'));
    }

    /**
     * Does the authenticator support the given Request?
     *
     * If this returns false, the authenticator will be skipped.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request)
    {
        return ('login' === $request->attributes->get('_route') or 'homepage' === $request->attributes->get('_route'))
            && $request->isMethod('POST');
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array).
     *
     * Whatever value you return here will be passed to getUser() and checkCredentials()
     *
     * For example, for a form login, you might:
     *
     *      return [
     *          'username' => $request->request->get('_username'),
     *          'password' => $request->request->get('_password'),
     *      ];
     *
     * Or for an API token that's on a header, you might use:
     *
     *      return ['api_key' => $request->headers->get('X-API-TOKEN')];
     *
     * @param Request $request
     *
     * @return mixed Any non-null value
     *
     * @throws \UnexpectedValueException If null is returned
     */
    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

  /**
 * Return a UserInterface object based on the credentials.
 *
 * The *credentials* are the return value from getCredentials()
 *
 * You may throw an AuthenticationException if you wish. If you return
 * null, then a UsernameNotFoundException is thrown for you.
 *
 * @param mixed $credentials
 * @param UserProviderInterface $userProvider
 *
 * @return UserInterface|null
 * @throws AuthenticationException
 *
 */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // Load / create our user however you need.
        // You can do this by calling the user provider, or with custom logic here.
        $user = $userProvider->loadUserByUsername($credentials['email']);

        if (!$user) {
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('User with specified email could not be found.');
        }

        return $user;
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        try {
            $this->cognitoClient->checkCredentials(
                $credentials['email'],
                $credentials['password']
            );
        } catch (AuthenticationException $exception) {
            return false;
        }

        return true;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }
}