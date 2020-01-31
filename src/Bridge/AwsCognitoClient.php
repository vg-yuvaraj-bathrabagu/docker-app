<?php


namespace App\Bridge;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Result;
use MsgPhp\Domain\Exception\EntityNotFoundException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AwsCognitoClient
{
    /**
     * @var AWSCognitoClient
     */
    private $client;

    private $poolId;

    private $clientId;

    public function __construct(
        string $poolId,
        string $clientId,
        string $region = 'us-east-1',
        string $version = 'latest',
        string $key,
        string $secret
    ) {
        $this->client = CognitoIdentityProviderClient::factory([
            'region' => $region,
            'version' => $version,
            'credentials' => [
                'key'    => $key,
                'secret' => $secret,
            ]
        ]);
        $this->poolId = $poolId;
        $this->clientId = $clientId;
    }

    public function findByUsername(string $username): Result
    {
        try {
            $result = $this->client->listUsers([
                'UserPoolId' => $this->poolId,
                'Filter'     => "email=\"" . $username . "\""
            ]);

            return $result;
        } catch (\Exception $e) {
            throw new EntityNotFoundException($e);
        }
    }

    public function checkCredentials($username, $password): Result
    {
        if (empty($username) or empty($password)) {
            throw new AuthenticationException("Please specify a username and password");
        }

        try {
            $result = $this->client->adminInitiateAuth([
                'UserPoolId' => $this->poolId,
                'ClientId' => $this->clientId,
                'AuthFlow' => 'ADMIN_NO_SRP_AUTH', // this matches the 'server-based sign-in' checkbox setting from earlier
                'AuthParameters' => [
                    'USERNAME' => $username,
                    'PASSWORD' => $password
                ]
            ]);

            return $result;
        } catch (NotAuthorizedException $nae) {
            throw new AuthenticationException("Login service not available");
        } catch (\Exception $e) {
            throw new AuthenticationException($e);
        }
    }

    public function adminResetUserPassword($username, $password): Result
    {

    }
}