<?php
	$route 	= $_SERVER['REQUEST_URI'];
	$method = $_SERVER['REQUEST_METHOD'];

	$route = substr($route, 1);
	$route = explode("?", $route);
	$route = explode("/", $route[0]);
	$route = array_diff($route, array('api'));
	$route = array_values($route);

	$arr_json = null;

	if (count($route) <= 1) {
		switch ($route[0]) {
			case 'referal':
				$pattern = '/^[A-Z0-9]{6}$/';
				preg_match($pattern, $_REQUEST['referal'], $matches);
				if(empty($matches)){
					$arr_json = array('status' => 404, 'errors' => 'Invalid input', 'success' => false);
				} else {
					include('referal.class.php');
					$referal = new Referal($_REQUEST['referal']);
					$arr_json = $referal->getMethod($method, $route);
				}
				break;
			default:
				$arr_json = array('status' => 404, 'errors' => 'URL not exists', 'success' => false);
				break;
		}
	}else{
		$arr_json = array('status' => 404, 'errors' => 'Invalid input', 'success' => false);
	}

	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($arr_json);

?>