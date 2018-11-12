<?php
	
	function connect()
	{
		$servername = "localhost";
		$username = "root";
		$password= "root";
		$dbname = "FinalProjectDB"; 

		$connection = new mysqli($servername, $username, $password, $dbname);

		if ($connection->connect_error)
		{
			return null;
		}
		else
		{
			return $connection;
		}
	}

	function attemptSearch($search)
	{
		$conn = connect();

		if ($conn != null)
		{
			//$sql = "SELECT * FROM Expressions WHERE expression = '$search' AND status = 'A'";

			$sql = "SELECT * FROM Expressions WHERE expression LIKE '%$search%' AND status = 'A'"; 

			$result = $conn->query($sql);

			if ($result->num_rows > 0)
			{
				$response = array('expr' => array());

				while ($row = $result->fetch_assoc())
				{
					$response["expr"][] = array("expression" => $row["expression"], "explanation" => $row["explanation"]);
				}
				echo json_encode($response);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>404);
			}
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptList()
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT * FROM Expressions WHERE status = 'A' ORDER BY expression";

			$result = $conn->query($sql);

			if ($result->num_rows > 0)
			{
				$response = array('expr' => array());

				while ($row = $result->fetch_assoc())
				{
					$response["expr"][] = array("expression" => $row["expression"], "explanation" => $row["explanation"]);
				}
				echo json_encode($response);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>404);
			}
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptLogin($uName, $password)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT *
					FROM Users
					WHERE username = '$uName'"; //" AND passwrd = '$password'"; (query without hashed passwords)

			$result = $conn->query($sql);

			if ($result -> num_rows > 0)
			{
				session_start();

				while ($row = $result->fetch_assoc())
				{
					if (password_verify($password, $row["passwrd"]))
					{
						$_SESSION["uName"] = $_GET["username"];
						$response = array("uName" => $row["username"]);
					}
					else
					{
						$conn -> close();
						return array("status" => "NOT_FOUND", "code"=>406);
					}
				}
				$conn -> close();
				return array("status"=>"SUCCESS", "response" => $response);
			}
			else
			{	
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>406);
			} 
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptRegister($uName, $password)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT username 
	                FROM Users 
	                WHERE username = '$uName'";

	        $result = $conn->query($sql);

	        if ($result -> num_rows > 0)
	        {
	        	$conn -> close();
	        	return array("status" => "CONFLICT", "code"=>409);
	        }
	        else
	        {
	        	$sql = "INSERT INTO Users (username, passwrd) VALUES ('$uName', '$password')";

	        	if (mysqli_query($conn, $sql))
                {
                	session_start();
                	$_SESSION["uName"] = $uName;
                	$response = array("status" => "success", "uName" => $uName);
                	return array("status"=>"SUCCESS", "response" => $response);
				}
	        }
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptFavourites($uName)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT * FROM Favourites WHERE username = '$uName'";

			$result = $conn->query($sql);

			if ($result -> num_rows > 0)
			{
				$response = array();
				while ($row = $result->fetch_assoc())
				{
					$response["expr"][] = array("expression" => $row["expression"]);
				}
				echo json_encode($response);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>404);
			}
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptAddFav($uName, $expression)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "INSERT INTO Favourites (username, expression) VALUES ('$uName', '$expression')";

			$result = $conn->query($sql);
			$response = array("uname" => "$uName", "expression" => "$expression");
			echo json_encode($response);
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptAddExpr($expression, $explanation)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "INSERT INTO Expressions (expression, explanation, status) VALUES ('$expression', '$explanation', 'P')";

			$result = $conn->query($sql);
			$response = array("expression" => "$expression", "explanation" => "$explanation");
			echo json_encode($response);
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptAdmList()
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT * FROM Expressions WHERE status = 'P'";

			$result = $conn->query($sql);

			if ($result -> num_rows > 0)
			{
				$response = array('expr' => array());

				while ($row = $result->fetch_assoc())
				{
					$response["expr"][] = array("expression" => $row["expression"], "explanation" => $row["explanation"]);
				}
				echo json_encode($response);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>404);
			}

		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptAdmUsers()
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT * FROM Users ORDER BY username";

			$result = $conn->query($sql);

			if ($result -> num_rows > 0)
			{
				$response = array('users' => array());

				while ($row = $result->fetch_assoc())
				{
					$response["users"][] = array("uname" => $row["username"]);
				}
				echo json_encode($response);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>404);
			}
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}

	}

	function attemptApprove($expression)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "UPDATE Expressions SET status = 'A' WHERE expression = '$expression'";

			$result = $conn->query($sql);

			echo json_encode("Approved");
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptDecline($expression)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "DELETE FROM Expressions WHERE expression = '$expression'";

			$result = $conn->query($sql);

			echo json_encode("Declined");
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptDelete($uName)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "DELETE FROM Users WHERE username = '$uName'";

			$result = $conn->query($sql);

			echo json_encode("Deleted user");
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function attemptDeleteFav($uName, $expression)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "DELETE FROM Favourites WHERE username = '$uName' AND expression = '$expression'";

			$result = $conn->query($sql);

			echo json_encode("Deleted favourite");
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}




?>