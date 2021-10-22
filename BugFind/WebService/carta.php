<?php
/* 
Senasoft: Grupo SIIGO
Aplicación: BugFind
Autor: Armel Peña
Servicio:Carta
----------------------
*/
	include("conexion.php");
	$pdo = new conexion();
    
	header("Content-Type: json/");
	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			if(isset($_GET['IdCarta'])){
				$IdCarta = $_GET['IdCarta'];
				$sql = $pdo->prepare("SELECT * FROM Carta WHERE IdCarta=:IdCarta");
				$sql->bindValue(':IdCarta', $IdCarta, PDO::PARAM_INT);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
				exit;				
			} elseif (isset($_GET['TipoCarta_IdTipoCarta'])) {
				$TipoCarta_IdTipoCarta = $_GET['TipoCarta_IdTipoCarta'];
				$sql = $pdo->prepare("SELECT * FROM Carta WHERE TipoCarta_IdTipoCarta = :TipoCarta_IdTipoCarta");
				$sql->bindValue(':TipoCarta_IdTipoCarta', $TipoCarta_IdTipoCarta, PDO::PARAM_INT);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
				exit;
			} else {
				$sql = $pdo->prepare("SELECT * FROM Carta ORDER BY TipoCarta_IdTipoCarta");
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
				exit;		
			}
			break;
		case 'POST':
			/*
			$sql="INSERT INTO Jugador (NombreJugador, Avatar) 
					VALUES (:NombreJugador, :Avatar)";
	
			$stm=$pdo->prepare($sql);
	
			$stm->bindParam(':NombreJugador', $_GET['NombreJugador'], PDO::PARAM_STR);
			$stm->execute();
			if ($stm) {
				$idTipoCarta = $pdo->lastInsertId();
				if($idTipoCarta){
					header("HTTP/1.1 200 Datos guardados con éxito! ". $idTipoCarta);
				}else{
					header("HTTP/1.1 200 no se guardó la información en la base de datos!". $idTipoCarta);
				}
			}else{
				header("HTTP/1.1 200 Erro en la sentencia!". $idTipoCarta);
			}*/
			$stm=null;
			break;
		case 'PUT':
			/*$idtipocarta=$_GET['idtipocarta'];
			$tipocarta=$_GET['tipocarta'];

			$sql="UPDATE tipocarta SET tipocarta = :tipocarta
				WHERE idtipocarta = :idtipocarta";
	
			$stm=$pdo->prepare($sql);
			$stm->bindParam(':tipocarta', $tipocarta, PDO::PARAM_STR);
			$stm->bindParam(':idtipocarta', $idtipocarta, PDO::PARAM_INT);
			$stm->execute();
			if ($stm) {
				header("HTTP/1.1 200 Datos actualizado con éxito! ". $tipocarta);
			}else{
				header("HTTP/1.1 200 Erro en la sentencia! No existe el código solicitado". $idtipocarta);
			}*/
			$stm=null;
			break;	
		case 'DELETE':
			/*$idtipocarta=$_GET['idtipocarta'];
			$sql="DELETE FROM tipocarta WHERE (idtipocarta = :idtipocarta)";
			$stm=$pdo->prepare($sql);
			$stm->bindParam(':idtipocarta', $idtipocarta, PDO::PARAM_STR);
			$stm->execute();
			if ($stm) {
				header("HTTP/1.1 200 Datos eliminado con éxito! ". $idtipocarta);
			}else{
				header("HTTP/1.1 200 Erro en la sentencia! No existe el código solicitado". $idtipocarta);
			}*/
			$stm=null;
			break;	
		default:
				header("HTTP/1.1 400 Bad RequestMethod! ");
		}
		$pdo= null;
?>