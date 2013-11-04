<?php

  // Requirements
  require_once 'Load.php';
  require_once 'Model.php';
  require_once 'Error.php';
  require_once 'Controller.php';

class Core {

  // Properties
  private $_url;
  private $_getController;
  private $_getAction;
  private $_blnCheckValidControllerPath;
  private $_blnCheckValidMethod;
  private $_controllerPathFolder;
  private $_controllerPath;
  private $uri;

  // Methods
  public function __construct() {
    $this->uri                          = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $this->_controllerPathFolder        = 'application/controllers/';
    $this->_url                         = $this->getUrlParams();
    $this->_getController               = $this->getControllerFromUrlSegment($this->_url);
    $this->_getAction                   = $this->getActionFromUrlSegment($this->_url);
    $this->_blnCheckValidControllerPath = $this->checkControllerFile($this->_getController);
    
    // Do yo thing baby!
    $this->startTheEngine();

    /*------------- Debugging -------------*/
    echo "Controller: " . $this->_getController . "<br />";
    echo "Action: " . $this->_getAction . "<br />";
    echo "Controller File Exists: " . $this->_blnCheckValidControllerPath . "<br />";
    $this->debug( array('Url: ' => $this->_url, 'Action: ' => $this->_getAction, 'Controller: ' => $this->_getController) );
  }

  private function getUrlParams() {
    if ( isset($_GET['url']) ) {
      $url = $_GET['url'];
      $url = rtrim($url, '/');
      $url = htmlspecialchars($url);
      $url = explode('/', $url);
      return $url;
    } else {
      return array( 'home', 'index' );
    }
  }

  private function getControllerFromUrlSegment( $controllerUrlSegment ) {
    if ( isset($controllerUrlSegment[0]) ) {
      return $controllerUrlSegment[0];
    }
  }

  private function getActionFromUrlSegment( $actionUrlSegment ) {
    if ( isset($actionUrlSegment[1]) ) {
      return $actionUrlSegment[1];
    }
    array_push( $this->_url, "index" );
    return "index";
  }

  private function checkControllerFile($controllerStringFromControllerUrlSegment) {
    $path = $this->_controllerPathFolder . $controllerStringFromControllerUrlSegment . '.php';
    if ( file_exists($path) ) {
      return true;
    }
    return false;
  }

  private function debug( $arrayOfItemsToDebug ) {
    echo '<pre>';
    print_r($arrayOfItemsToDebug);
    echo '</pre>';
  }

  public function startTheEngine() {
    // Does the requested controller file exist
    if ($this->_blnCheckValidControllerPath) {
      
      // Set the path to the controllers folder      
      $pathToRequestedController =  $this->_controllerPathFolder . $this->_getController . '.php';

      // If yes, Require the controller file
      require $pathToRequestedController;

      // Instantiate the controller
      $controller = new $this->_getController();
      $action = $this->_getAction;

      if ( method_exists($controller, $action) ) {
        $controller->$action();

      } else {
        /*// Requested action not present
        echo "Method not available <br />";*/
        $e = new Error();
        $e->show( $this->uri );
      }

    } else {

      /*// If no, call an error function
      echo "Sorry the Controller you requested does not exist <br />";*/
      $e = new Error();
      $e->show( $this->uri );
    }
  }

}

// Instantiate the class
new Core();

/*------------------
  End of Core Class
 ------------------*/