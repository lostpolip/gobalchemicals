<?php

class dbManagement {
	public $conn = '';
	public function __construct() {
    	$servername = "localhost";
		$username = "Gobalchemicals";
		$password = "1234";
		$dbname = "gobalchemicals";

		// Create connection
		$this->conn = mysqli_connect($servername, $username, $password, $dbname);
		$this->conn->query("set names utf8");
		// Check connection
		if (!$this->conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
   	}

   	public function __destruct()
    {
        mysqli_close($this->conn);
    }

	public function insert($sql) {
		if (mysqli_query($this->conn, $sql)) {
			echo 'New record created successfully';
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
		}
	}


	public function update($sql) {
		if (mysqli_query($this->conn, $sql)) {
			echo 'New record updateก successfully';
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
		}
	}


	public function delete($sql) {
		if (mysqli_query($this->conn, $sql)) {
			echo 'New record deleteก successfully';
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
		}
	}

	// public function sql($sql) {
	// 	if (mysqli_query($this->conn, $sql)) {
	// 		echo 'New record created successfully';
	// 	} else {
	// 	    echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
	// 	}
	// }	

	public function select($sql) {
		return mysqli_query($this->conn, $sql);
	}
}
?>