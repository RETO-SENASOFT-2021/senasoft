<?php
/* 
Senasoft: Grupo SIIGO
Aplicación: BugFind
Autor: Armel Peña
Servicio:Bug :  Almacena las cartas ocultas del Gus a encontrar por
                los jugadores
*/
	include("conexion.php");
	$pdo = new conexion();
    
	header("Content-Type: json/");
	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			if(isset($_GET['Partida_IdPartida']) AND (isset($_GET['Carta_IdCarta']) == NULL )){ // Consulta las cartas de una partida, se utiliza para descubrir las cartas de la partida
				$Partida_IdPartida=$_GET['Partida_IdPartida'];

				$sql = $pdo->prepare("SELECT * FROM Bug WHERE Partida_IdPartida= :Partida_IdPartida");
				$sql->bindValue(':Partida_IdPartida', $Partida_IdPartida, PDO::PARAM_INT);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);

				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
			} elseif ((isset($_GET['Partida_IdPartida'])==NULL) AND (isset($_GET['Carta_IdCarta']))){ //Busca una carta en todas las partida
				$Carta_IdCarta=$_GET['Carta_IdCarta'];

				$sql = $pdo->prepare("SELECT * FROM Bug WHERE Carta_IdCarta=:Carta_IdCarta");
				$sql->bindValue(':Carta_IdCarta', $Carta_IdCarta, PDO::PARAM_INT);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
			} elseif (isset($_GET['Partida_IdPartida']) AND isset($_GET['Carta_IdCarta'])) { // Busca una carta de una partida, este se utiliza para descubrir una carta
				$Partida_IdPartida=$_GET['Partida_IdPartida'];
                $Carta_IdCarta=$_GET['Carta_IdCarta'];

				$sql = $pdo->prepare("SELECT * FROM Bug WHERE Partida_IdPartida=:Partida_IdPartida
                                        AND Carta_IdCarta=:Carta_IdCarta");
				$sql->bindValue(':Partida_IdPartida', $Partida_IdPartida, PDO::PARAM_INT);
                $sql->bindValue(':Carta_IdCarta', $Carta_IdCarta, PDO::PARAM_INT);
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
			} else { // Consulta todas cartas de todas las cartida
				$sql = $pdo->prepare("SELECT * FROM Bug");
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_ASSOC);
				header("HTTP/1.1 200 hay datos");
				echo json_encode($sql->fetchAll());
			}
			$stm=null;
			break;
		case 'POST':
			$Carta_IdCarta=$_GET['Carta_IdCarta'];
			$Partida_IdPartida=$_GET['Partida_IdPartida'];

			$sql="INSERT INTO Bug (Partida_IdPartida, Carta_IdCarta) 
					VALUES (:Partida_IdPartida, :Carta_IdCarta)";
			$stm=$pdo->prepare($sql);
			$stm->bindParam(':Partida_IdPartida', $Partida_IdPartida, PDO::PARAM_INT);
            $stm->bindParam(':Carta_IdCarta', $Carta_IdCarta, PDO::PARAM_INT);
			$stm->execute();
			if ($stm) {
				header("HTTP/1.1 200 Datos guardados con éxito! ");
			}else{
				header("HTTP/1.1 200 Erro en la sentencia!");
			}
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
			}*/
			$stm=null;
			break;
		case 'DELETE':
			/* 
				Para eliminar una carta de la partida ingresar
				IdCarta = 1
				IdPartida = 1
				Para eliminar una partida
				IdCarta = 0
				IdPartida = 1
			*/
			if((isset($_GET['Carta_IdCarta']) != NULL) AND (isset($_GET['Partida_IdPartida']) != NULL)) {
				if(isset($_GET['Carta_IdCarta']) AND isset($_GET['Partida_IdPartida'])) {
					$Carta_IdCarta=$_GET['Carta_IdCarta'];
					$Partida_IdPartida=$_GET['Partida_IdPartida'];

					if($Carta_IdCarta > 0) {
						$sql="DELETE FROM Bug WHERE (Partida_IdPartida = :Partida_IdPartida 
							AND Carta_IdCarta = :Carta_IdCarta)";
						$stm=$pdo->prepare($sql);
						$stm->bindParam(':Partida_IdPartida', $Partida_IdPartida, PDO::PARAM_INT);
						$stm->bindParam(':Carta_IdCarta', $Carta_IdCarta, PDO::PARAM_INT);
								$stm->execute();
						if ($stm) {
							header("HTTP/1.1 200 Datos eliminado con éxito! ");
						}else{
							header("HTTP/1.1 200 Erro en la sentencia! No existe el código solicitado". $idtipocarta);
						}
					}elseif ($Carta_IdCarta == 0){

						$sql="DELETE FROM Bug WHERE (Partida_IdPartida = :Partida_IdPartida)";
						$stm=$pdo->prepare($sql);
						$stm->bindParam(':Partida_IdPartida', $Partida_IdPartida, PDO::PARAM_INT);
						$stm->execute();
						if ($stm) {
							header("HTTP/1.1 200 Datos eliminado con éxito! ");
						}else{
							header("HTTP/1.1 200 Erro en la sentencia! No existe el código solicitado");
						}
					} 
				}
			} else{
				header("HTTP/1.1 200 Erro en la sentencia! No existe el código solicitado");
			}
			$stm=null;
			break;
		default:
				header("HTTP/1.1 400 Bad RequestMethod! ");
		}
		$pdo= null;
?>