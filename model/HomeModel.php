<?php

function getWithJoin(){
	$db = openDatabaseConnection();
	$result = null;
	$sql = "SELECT 	patients.patient_id as id, patients.patient_name as name,species.species_description as species_name,clients.client_firstname as client_firstname,clients.client_lastname as client_lastname,patients.patient_gender as gender,patients.patient_status as status FROM patients INNER JOIN species ON species.species_id = patients.species_id INNER JOIN clients on clients.client_id = patients.client_id;";
	$query = $db->prepare($sql);
	$query->execute();
	$result = $query->fetchAll();
	$db = null;
	return $result;
}

function get($type){
	$db = openDatabaseConnection();
	$result = null;
	switch ($type) {
		case "clients":
			$sql = "SELECT * FROM clients";
			$query = $db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			break;
		case "patients":
			$sql = "SELECT * FROM patients";
			$query = $db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			break;
		case "species":
			$sql = "SELECT * FROM species";
			$query = $db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			break;
		default:
			echo '<script>console.log("ERROR: type couldnt be found!");</script>';
			break;
	}
	$db = null;
	return $result;
}

function getWhere($type, $filter, $id){
	$db = openDatabaseConnection();
	$result = null;
	switch ($type) {
		case "clients":
			$sql = "SELECT * FROM clients WHERE $filter='$id'";
			$query = $db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			break;
		case "patients":
			$sql = "SELECT * FROM patients WHERE $filter='$id'";
			$query = $db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			break;
		case "species":
			$sql = "SELECT * FROM species WHERE $filter='$id'";
			$query = $db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			break;
		default:
			echo '<script>console.log("ERROR: type couldnt be found!");</script>';
			break;
	}
	$db = null;
	return $result;
}

function create($type, $a, $b = null, $c = null, $d = null, $f = null){
	echo '<script>console.log("creating..");</script>' . "type: " . $type . " data: " . $a . " - " . $b;

	$db = openDatabaseConnection();
	$status = false;
	switch ($type) {
		case "clients":
			$sql = "INSERT INTO clients(client_firstname, client_lastname) VALUES ('$a', '$b')";
			echo $sql;
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		case "patients":
			$sql = "INSERT INTO patients(patient_name, species_id, client_id, patient_gender, patient_status) VALUES ('$a', '$b', '$c', '$f', '$d')";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		case "species":
			$sql = "INSERT INTO species(species_description) VALUES ('$a')";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		default:
			echo '<script>console.log("ERROR: type couldnt be found!");</script>';
			$status = false;
			break;
	}
	$db = null;
	return $status;
}

function delete($type, $id){
	$db = openDatabaseConnection();
	$status = false;
	switch ($type) {
		case "clients":
			$sql = "DELETE FROM clients WHERE client_id='$id'";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		case "patients":
			$sql = "DELETE FROM patients WHERE patient_id='$id'";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		case "species":
			$sql = "DELETE FROM species WHERE species_id='$id'";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		default:
			echo '<script>console.log("ERROR: type couldnt be found!");</script>';
			$status = false;
			break;
	}
	$db = null;
	return $status;
}


function update($type, $id, $a, $b = null, $c = null, $d = null, $f = null){
	$db = openDatabaseConnection();
	$status = false;
	switch ($type) {
		case "clients":
			$sql = "UPDATE clients SET client_firstname='$a', client_lastname='$b' WHERE client_id=$id";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		case "patients":
			$sql = "UPDATE patients SET patient_name='$a', species_id='$b', client_id='$c', patient_gender='$f', patient_status='$d'  WHERE patient_id=$id";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		case "species":
			$sql = "UPDATE species SET species_description='$a' WHERE species_id='$id'";
			$query = $db->prepare($sql);
			$query->execute();
			$status = true;
			break;
		default:
			echo '<script>console.log("ERROR: type couldnt be found!");</script>';
			$status = false;
			break;
	}
	$db = null;
	return $status;
}

/*
function getClients(){
	$db = openDatabaseConnection();
	$sql = "SELECT * FROM clients";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return $query->fetchAll();
}

function getClient($id){
	$db = openDatabaseConnection();
	$sql = "SELECT * FROM clients WHERE client_id=$id";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return $query->fetch();
}

function getPatients(){
	$db = openDatabaseConnection();
	$sql = "SELECT * FROM patients";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return $query->fetchAll();
}

function createClient($firstname, $lastname){
	$db = openDatabaseConnection();
	$sql = "INSERT INTO clients(client_firstname, client_lastname) VALUES ($firstname, $lastname)";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return true;
}

function updateClient($id, $firstname, $lastname){
	$db = openDatabaseConnection();
	$sql = "UPDATE clients SET client_firstname='$firstname', client_lastname='$lastname' WHERE client_id=$id";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return true;
}

function deleteClient($id){
	$db = openDatabaseConnection();
	$sql = "DELETE FROM clients WHERE client_id=$id";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return true;
}





function getBirthdays(){
	$db = openDatabaseConnection();
	$sql = "SELECT * FROM verjaardagskalender";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return $query->fetchAll();
}

function getMonths(){
	$months = ["januari","februari","maart","april","mei","juni","juli","augustus","september","oktober","november","december"];
	return $months;
}

function deleteRow($id){
	$db = openDatabaseConnection();
	$sql = "DELETE FROM verjaardagskalender WHERE id=$id";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
}

function getUser($id){
	$db = openDatabaseConnection();
	$sql = "SELECT * FROM verjaardagskalender WHERE id=$id";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return $query->fetch();
}

function createRow($day, $month, $name, $birth){
	$db = openDatabaseConnection();
	$sql = "INSERT INTO verjaardagskalender(day, month, name, birth) VALUES (:day, :month, :name, :birth)";
	$query = $db->prepare($sql);
	$query->execute(array(
		':day' => $day,
		':month' => $month,
		':name' => $name,
		':birth' => $birth
	));
	$db = null;
	return true;
}

function updateRow($id, $day, $month, $name, $birth){
	$db = openDatabaseConnection();
	$sql = "UPDATE verjaardagskalender SET day='$day', month='$month', name='$name', birth='$birth' WHERE id=$id";
	$query = $db->prepare($sql);
	$query->execute();
	$db = null;
	return true;
}*/