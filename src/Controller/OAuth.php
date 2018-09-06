<?php
// src/Controller/indexController.php
// use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class OAuth
{
    /**
     * An instance of the League OAuth Client Provider.
     *
     * @var AbstractProvider
     */
    protected $provider;
    
    /**
     * The current OAuth access token.
     *
     * @var AccessToken
     */
    protected $oauthToken;
    
    /**
     * The user's email address, usually used as the login ID
     * and also the from address when sending email.
     *
     * @var string
     */
    protected $oauthUserEmail = '';
    
    /**
     * The client secret, generated in the app definition of the service you're connecting to.
     *
     * @var string
     */
    protected $oauthClientSecret = '';
    
    /**
     * The client ID, generated in the app definition of the service you're connecting to.
     *
     * @var string
     */
    protected $oauthClientId = '';
    
    /**
     * The refresh token, used to obtain new AccessTokens.
     *
     * @var string
     */
    protected $oauthRefreshToken = '';
    
    /**
     * OAuth constructor.
     *
     * @param array $options Associative array containing
     *                       `provider`, `userName`, `clientSecret`, `clientId` and `refreshToken` elements
     */
    
    
    public function __construct($options=array())
    {
        $this->provider = $options['provider'];
        $this->oauthUserEmail = $options['userName'];
        $this->oauthClientSecret = $options['clientSecret'];
        $this->oauthClientId = $options['clientId'];
        $this->oauthRefreshToken = $options['refreshToken'];
    }
    
    /**
     * Get a new RefreshToken.
     *
     * @return RefreshToken
     */
    protected function getGrant()
    {
        return new RefreshToken();
    }
    
    /**
     * Get a new AccessToken.
     *
     * @return AccessToken
     */
    protected function getToken()
    {
        return $this->provider->getAccessToken(
            $this->getGrant(),
            ['refresh_token' => $this->oauthRefreshToken]
            );
    }
    
    /**
     * Generate a base64-encoded OAuth token.
     *
     * @return string
     */
    public function getOauth64()
    {
        // Get a new token if it's not available or has expired
        if (null === $this->oauthToken or $this->oauthToken->hasExpired()) {
            $this->oauthToken = $this->getToken();
        }
        
        return base64_encode(
            'user=' .
            $this->oauthUserEmail .
            "\001auth=Bearer " .
            $this->oauthToken .
            "\001\001"
            );
    }
}


?>
