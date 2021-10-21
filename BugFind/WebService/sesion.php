<?php
/* 
Senasoft: Grupo SIIGO
Aplicación: BugFind
Autor: Armel Peña
Servicio:Sesion de juego
*/
	include("conexion.php");
	$pdo = new conexion();
    
	header("Content-Type: json/");
	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			if(isset($_GET['IdSesion'])){
				$IdSesion=$_GET['IdSesion'];

				$sql = $pdo->prepare("SELECT * FROM sesion WHERE IdSesion= :IdSesion");
				$sql->bindValue(':IdSesion', $IdSesion, PDO::PARAM_INT);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);

				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
				exit;				
			} elseif (isset($_GET['Partida'])) {
				$Partida=$_GET['Partida'];

				$sql = $pdo->prepare("SELECT * FROM Sesion WHERE Partida=:Partida");
				$sql->bindValue(':Partida', $Partida, PDO::PARAM_STR);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
				exit;
			} elseif (isset($_GET['Jugador_IdJugador'])) {
				$Jugador_IdJugador=$_GET['Jugador_IdJugador'];

				$sql = $pdo->prepare("SELECT * FROM Sesion WHERE Jugador_IdJugador=:Jugador_IdJugador");
				$sql->bindValue(':Jugador_IdJugador', $Jugador_IdJugador, PDO::PARAM_INT);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
				exit;                
			} else {
				$sql = $pdo->prepare("SELECT * FROM Sesion ORDER BY IdSesion DESC");
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
				exit;		
			}
            $stm=null;
			break;
		case 'POST':
			/*$Partida=$_GET['Partida'];
            $TipoSesion=$_GET['TipoSesion'];
            $Jugador_IdJugador=$_GET['Jugador_IdJugador'];

			$sql="INSERT INTO Sesion (Partida, TipoSesion, Jugador_IdJugador) 
					VALUES (:Partida, :TipoSesion, :Jugador_IdJugador)";
			$stm=$pdo->prepare($sql);
			$stm->bindParam(':Partida', $Partida, PDO::PARAM_STR);
            $stm->bindParam(':TipoSesion', $TipoSesion, PDO::PARAM_INT);
            $stm->bindParam(':Jugador_IdJugador', $Jugador_IdJugador, PDO::PARAM_INT);
			$stm->execute();
			if ($stm) {
				$IdSesion = $pdo->lastInsertId();
				if($IdSesion){
					header("HTTP/1.1 200 Datos guardados con éxito! ". $IdSesion);
				}else{
					header("HTTP/1.1 200 no se guardó la información en la base de datos!". $idTipoCarta);
				}
			}else{
				header("HTTP/1.1 200 Erro en la sentencia!". $IdSesion);
			}*/
			$stm=null;
			break;
		case 'PUT':
/*			$idtipocarta=$_GET['idtipocarta'];
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
			}
			$stm=null;*/
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
			}
			$stm=null;*/
            $stm=null;
			break;	
		default:
				header("HTTP/1.1 400 Bad RequestMethod! ");
		}
		$pdo= null;
?>