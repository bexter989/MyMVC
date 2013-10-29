<?php
require 'Controller.php';
require 'Load.php';
require 'Model.php';
require 'Error.php';

class Core {

  // Properties
  private $_url;
  private $_getController;
  private $_getAction;
  private $_blnCheckValidControllerPath;
  private $_blnCheckValidMethod;
  private $_controllerPathFolder;
  private $_controllerPath;

  // Methods
  public function __construct() {
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
    $this->debug( $this->_url );
  }

  public function sets($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }
  }

  public function gets($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
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
      $this->sets($this->_controllerPath, $path);
      return true;
    }
    return false;
  }

  private function debug( $arrayOfItemsToDebug ) {
    if ( is_array($arrayOfItemsToDebug) && !empty($arrayOfItemsToDebug) ) {
      var_dump($arrayOfItemsToDebug);
    } else {
      echo "Sorry nothing to debug <br />";
    }
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
        // Requested action not present
        echo "Method not available <br />";
      }

    } else {

      // If no, call an error function
      echo "Sorry the Controller you requested does not exist <br />";
    }
  }

}

// Instantiate the class
new Core();

/*------------------
  End of Core Class
 ------------------*/