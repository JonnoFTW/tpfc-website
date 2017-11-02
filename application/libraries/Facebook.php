<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
 
// Autoload the required files
require_once( APPPATH . 'libraries/facebook/autoload.php' );
 
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
 
 
class Facebook {
  var $ci;
  var $helper;
  var $session;
  var $permissions;
 
  public function __construct() {
    $this->ci =& get_instance();

    $this->permissions = $this->ci->config->item('permissions', 'facebook');
    $app_id  = $this->ci->config->item('api_id', 'facebook');
    $app_secret = $this->ci->config->item('app_secret', 'facebook');
    $this->session = new Facebook\Facebook([
                                     'app_id'                => $app_id,
                                     'app_secret'            => $app_secret,
                                     'default_access_token'  => "{$app_id}|{$app_secret}",
                                  //   'http_client_handler'   => 'guzzle'
                                    ]); 
    

   
  }
 
  /**
   * Returns the login URL.
   */
  public function login_url() {
    return $this->helper->getLoginUrl( $this->permissions );
  }
 
  /**
   * Returns the current user's info as an array.
   */
  public function get_user() {
    if ( $this->session ) {
      /**
       * Retrieve User’s Profile Information
       */
      // Graph API to request user data
      $request = ( new FacebookRequest( $this->session, 'GET', '/me' ) )->execute();
 
      // Get response as an array
      $user = $request->getGraphObject()->asArray();
 
      return $user;
    }
    return false;
  }
  public function get_uploaded_photos($page) {
     $request = $this->session->request(
        'GET',
         "/$page/photos/uploaded?fields=source,name,link,picture"
     );
   try {  
       $response = $this->session->getClient()->sendRequest($request);
   } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      $msg = 'Graph returned an error: ' . $e->getMessage();
      echo $msg;
      $this->ci->output->set_status_header(500)->set_content_type('application/text', 'utf-8')->set_output($msg);
      error_log($msg);
      return;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      $msg = 'Facebook SDK returned an error: ' . $e->getMessage();
      $this->ci->output->set_status_header(500)->set_content_type('application/text', 'utf-8')->set_output($msg);
      error_log($msg);
      return;
    }
   return  $response->getGraphEdge();
  }
}
