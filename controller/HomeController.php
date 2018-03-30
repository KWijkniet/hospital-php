<?php
require(ROOT . "model/HomeModel.php");
function index()
{
	render("home/index", array(
		'clients' => get("clients"),
		'patients' => get("patients"),
		'species' => get("species"),
		'sortedPatients' => get("patients")
	));
	clearId();
}

function getViaJoin(){
	print_r(json_encode(getWithJoin()));
}

function getClientById($id){
	print_r(json_encode(getWhere("clients", "client_id", $id)));
}

function getWith($param){
	print_r(json_encode(get($param)));
}

function getPatientsByClient($id){
	print_r(json_encode(getWhere("patients", "client_id", $id)));
}

function getPatientById($id){
	print_r(json_encode(getWhere("patients", "patient_id", $id)));
}

function getSpeciesById($id){
	print_r(json_encode(getWhere("species", "species_id", $id)));
}


function clearId(){
	$userId = null;
}

function createClient($a, $b){
	$na = isset($a) ? $a : null;
	$nb = isset($b) ? $b : null;
	if (strlen($na) != 0 && strlen($nb) != 0) {
		create("clients", $a, $b);
	}
}

function updateClient($id, $a, $b){
	$na = isset($a) ? $a : null;
	$nb = isset($b) ? $b : null;
	if (strlen($na) != 0 && strlen($nb) != 0) {
		update("clients", $id, $a, $b);
	}
}

function deleteClient($id){
	delete("clients", $id);
}

function createPatient($a, $b, $c, $d, $f){
	$na = isset($a) ? $a : null;
	$nb = isset($b) ? $b : null;
	$nc = isset($c) ? $c : null;
	$nd = isset($d) ? $d : null;
	$nf = isset($f) ? $f : null;
	if (strlen($na) != 0 && strlen($nb) != 0 && strlen($nc) != 0 && strlen($nd) != 0 && strlen($nf) != 0) {
		create("patients", $a, $b, $c, $d, $f);
	}
}

function updatePatient($id, $a, $b, $c, $d, $f){
	$na = isset($a) ? $a : null;
	$nb = isset($b) ? $b : null;
	$nc = isset($c) ? $c : null;
	$nd = isset($d) ? $d : null;
	$nf = isset($f) ? $f : null;
	if (strlen($na) != 0 && strlen($nb) != 0 && strlen($nc) != 0 && strlen($nd) != 0 && strlen($nf) != 0) {
		update("patients", $id, $a, $b, $c, $d, $f);
	}
}

function deletePatient($id){
	delete("patients", $id);
}

function createSpecies($a){
	$na = isset($a) ? $a : null;
	if (strlen($na) != 0) {
		create("species", $a);
	}
}

function updateSpecies($id, $a){
	$na = isset($a) ? $a : null;
	if (strlen($na) != 0) {
		update("species", $id, $a);
	}
}

function deleteSpecies($id){
	delete("species", $id);
}