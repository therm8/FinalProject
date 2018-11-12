<?php
	
	header('Content-type: application/json');
	header('Accept: application/json');

	require_once __DIR__ . '/dataLayer.php';

	$requestMethod = $_SERVER['REQUEST_METHOD'];

	switch ($requestMethod)
	{
		case "GET" : $action = $_GET["action"];
					 getRequests($action);
					 break;

		case "POST" : $action = $_POST["action"];
					  postRequests($action);
					  break;
	}

	function getRequests($action)
	{
		switch ($action)
		{
			case "SEARCH": requestSearch();
						   break;
			case "LIST": requestList();
						 break;
			case "LOGIN": requestLogin();
						  break;
			case "REGISTER": requestRegister();
							 break;
			case "FAVOURITES": requestFavourites();
							   break; 
			case "ADD_FAV": requestAddFav();
							break;
			case "ADD_EXPR": requestAddExpr();
							 break;
			case "HANDLE_EXPR": requestAdmList();
								break;
			case "HANDLE_USERS": requestAdmUsers();
								 break;
			case "APPROVE": requestApprove();
							break;
			case "DECLINE": requestDecline();
							break;
			case "DELETE_USER": requestDelete();
								break;
			case "LOGOUT": requestLogout();
						    break;
			case "SESSION": sessionService();
							break;
			case "LOGINFORM": sessionService();
							  break;
			case "DELETE_FAV": requestDeleteFav();
							   break;
		}
	}

	function requestSearch()
	{
		$search = $_GET["search"];

		$response = attemptSearch($search);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestList()
	{
		$response = attemptList();

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestLogin()
	{
		$uName = $_GET["username"];
		$password = $_GET["password"];

		$response = attemptLogin($uName, $password);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestRegister()
	{
		$uName = $_GET["username"];
		//$password = $_GET["password"];
		$password = password_hash($_GET["password"], PASSWORD_DEFAULT);


		$response = attemptRegister($uName, $password);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestFavourites()
	{
		session_start();
		if (isset($_SESSION["uName"]))
		{

			$uName = $_SESSION["uName"]; 
		}
		else
		{
			session_destroy();
			header("HTTP/1.1 406 Session not set yet");
			die("Your session has expired.");
		}

		$response = attemptFavourites($uName);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}

	}

	function requestAddFav()
	{
		session_start();
		if (isset($_SESSION["uName"]))
		{
			$uName = $_SESSION["uName"];
		}
		else
		{
			session_destroy();
			header("HTTP/1.1 406 Session not set yet");
			die("Your session has expired.");
		}

		$expression = $_GET["expression"];

		$response = attemptAddFav($uName, $expression);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestAddExpr()
	{
		session_start();
		if (isset($_SESSION["uName"]))
		{
			$expression = $_GET["expression"];
			$explanation = $_GET["explanation"];
		}
		else
		{
			session_destroy();
			header("HTTP/1.1 406 Session not set yet");
			die("Your session has expired.");
		}

		$response = attemptAddExpr($expression, $explanation);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestAdmList()
	{
		$response = attemptAdmList();

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestAdmUsers()
	{
		$response = attemptAdmUsers();

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}	

	function requestApprove()
	{
		$expression = $_GET["expression"];

		$response = attemptApprove($expression);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestDecline()
	{
		$expression = $_GET["expression"];

		$response = attemptDecline($expression);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestDelete()
	{
		$uName = $_GET["username"];

		$response = attemptDelete($uName);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestLogout()
	{
		session_start();
		session_unset();
		session_destroy();

		$response = array("status" => "logged out and session destroyed");

		echo json_encode($response);
	}

	function sessionService()
	{
		session_start();

		if(isset($_SESSION["uName"]))
		{
			$response = array("uName" => $_SESSION["uName"]);
			echo json_encode($response);
		}
		else
		{
			session_destroy();
			header("HTTP/1.1 406 Session not set yet");
			die("Your session has expired.");
		}
	}

	function requestDeleteFav()
	{
		session_start();

		if (isset($_SESSION["uName"]))
		{
			$uName = $_SESSION["uName"];
		}
		else
		{
			session_destroy();
			header("HTTP/1.1 406 Session not set yet");
			die("Your session has expired.");
		}

		$expression = $_GET["expression"];
		$response = attemptDeleteFav($uName, $expression);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function errorHandler($status, $code)
	{
		switch ($code) 
		{
			
			case 406:	header("HTTP/1.1 $code User $status");
						die("Wrong credentials provided");
						break;
			case 500:	header("HTTP/1.1 $code $status. Bad connection, portal is down");
						die("The server is down, we couldn't retrieve data from the data base");
						break;
			case 409: 	header("HTTP/1.1 $code $status, username already in use please select another one");
            			die("Username already in use or is missing.");
            			break;
            case 404:	header("HTTP/1.1 $code $status, could not load resource");
            			die("The resource cold not be found");	
		}
	}








?>