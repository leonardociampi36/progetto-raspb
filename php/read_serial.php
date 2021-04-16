<?php
	// Apertura porta seriale
	$fp = fopen("/dev/ttyUSB0","w+");
	if(!$fp){
		echo "Porta seriale non aperta";
		die();
	}

	while(true){
		fflush($fp);
		$buffer = "";
		// Legge una riga
		$buffer = fgets($fp, 15);
		// Controlla che ci sia tutto il dato
		if(strpos($buffer,"[") === false) continue;
		if(strpos($buffer,"]") === false) continue;
		// Rimuove i caratteri che non servono
		$buffer_tmp = str_replace("[","",$buffer);
		$value = str_replace("]\n","",$buffer_tmp);
		//echo $value;
		// Prende la data di sistema
		date_default_timezone_set('Europe/Rome');
		$data = date("Y/m/d");
		$time = date("H:i");
		/*$query = "INSERT INTO temperature_tbl (date,time,temperature) VALUES ('" .
				$data . "','" . $time . "','" . $value . "');\n";
		echo $query;*/
		try {
			$connect_string = "mysql:host=localhost;dbname=temperature_db;";
			$db_handle = new PDO($connect_string, 'user_temperature_db', 'password_temperature_db');
			$query = "INSERT INTO temperature_tbl (date,time,temperature) VALUES ('" .
				$data . "','" . $time . "','" . $value . "');";
			
			$rq = $db_handle->prepare($query);
			$result = $rq->execute();
			echo "Ho inserito:" . $query . "\n";	


		}

		catch(PDOException $e){
			echo "La query non è andata a buon file: " . $e->getMessage();
			return;
		}

	}














?>
