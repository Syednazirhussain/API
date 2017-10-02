<?php
class authmiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
	private $response = array(); 
	
    public function __invoke($request, $response, $next)
    {
		
		
		$route = $request->getAttribute('route');
		//$routeName = $route->getName();
		//$groups = $route->getGroups();
		//$methods = $route->getMethods();
		$arguments = $route->getArguments();
		
		
		//print_r($arguments);
		$validApiKeys = config::getValidApiKeys();
		if(in_array($arguments['auth'],$validApiKeys)){
			//echo "Ok";
			$response = $next($request, $response);
		}else{
			$this->response = array('status' => false,'code' => 401,'message'=>'authentication error');
			echo json_encode($this->response);
		}
        

        return $response;
    }

}
?>

