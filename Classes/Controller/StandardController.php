<?php
namespace Facebook\PhpSDK\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Facebook.PhpSDK".            *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3,
Facebook\PhpSDK\Facebook as Facebook;

/**
 * Standard controller for the Facebook.PhpSDK package
 *
 * @FLOW3\Scope("singleton")
 */
class StandardController extends \TYPO3\FLOW3\MVC\Controller\ActionController
{

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {

        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
            'appId' => 'YOUR-APP-ID',
            'secret' => 'YOUR-APP-SECRET',
            'cookie' => true
        ));

        // Get User ID
        $view['userProfile'] = $facebook->getUser();
        // We may or may not have this data based on whether the user is logged in.
        //
        // If we have a $user id here, it means we know the user is logged into
        // Facebook, but we don't know if the access token is valid. An access
        // token is invalid if the user logged out of Facebook.
        if ($view['userProfile']) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $view['userProfile'] = $facebook->api('/me');
                //echo 'profile' . print_r($view['user']['user_profile'], true);
            } catch (FacebookApiException $e) {
                error_log($e);
                $view['userProfile'] = null;
            }

            // Login or logout url will be needed depending on current user state.
            $view['logouturl'] = $facebook->getLogoutUrl();
        } else {
            $view['loginurl'] = $facebook->getLoginUrl();
        }

        $this->view->assign('data', $view);

    }

    /**
     * Indexjs action
     *
     * @return void
     */
    public function indexjsAction()
    {
        $view['facebookAppId'] = 'YOUR-APP-ID';
        $view['facebookSecret'] = 'YOUR-APP-SECRET';

        // Create our Application instance (replace this with your appId and secret).
        $facebook = new Facebook(array(
            'appId' => $view['facebookAppId'],
            'secret' => $view['facebookSecret'],
            'cookie' => true
        ));


        // Get User ID

        $view['userProfile'] = $facebook->getUser();

        // We may or may not have this data based on whether the user is logged in.
        //
        // If we have a $user id here, it means we know the user is logged into
        // Facebook, but we don't know if the access token is valid. An access
        // token is invalid if the user logged out of Facebook.
        if ($view['userProfile']) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $view['userProfile'] = $facebook->api('/me');
                //echo 'profile' . print_r($view['user']['user_profile'], true);
            } catch (FacebookApiException $e) {
                error_log($e);
                $view['userProfile'] = null;
            }

            // Login or logout url will be needed depending on current user state.
            $view['logouturl'] = $facebook->getLogoutUrl();
        } else {
            $view['loginurl'] = $facebook->getLoginUrl();
        }
        $this->view->assign('data', $view);

    }

    public function loginAction()
    {

    }

}

?>