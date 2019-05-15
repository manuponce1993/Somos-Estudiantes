<?php  
	require('db.php');

	$id_materia = $_POST['id_materia'];
	$tipo = $_POST['tipo'];
	$sql="";
	if(isset($_POST['palabra']) && !empty($_POST['palabra']) ){
		// Se toma como que la palabra a buscar puede aparecer en cualquier lugar del titulo del archivo 
		// Ahora hay que hacerlo para que busque cada vez que se teclea una letra, sin el boton buscar.
		$palabra = "%".$_POST['palabra']."%";
		$sql = mysqli_query($db,"SELECT * FROM archivos 
								INNER JOIN usuarios ON archivos.id_usuario = usuarios.id_usuario
								WHERE id_materia = '$id_materia' AND tipo = '$tipo' 
								AND (titulo like '$palabra' OR CONCAT(usuarios.nombre,' ',usuarios.apellido) like '$palabra');");		
		// SELECT * FROM archivos INNER JOIN usuarios ON archivos.id_usuario = usuarios.id_usuario WHERE id_materia = 1 AND (titulo like '%a%' OR usuarios.nombre = '%e%')

	}else{
		$sql = mysqli_query($db,"SELECT * FROM archivos WHERE id_materia = '$id_materia' AND tipo = '$tipo';");	
	}
	
	if($sql->num_rows > 0){
		while ($archivo =  mysqli_fetch_assoc($sql)){
			$id_usuario = $archivo["id_usuario"];
			$usuario =  mysqli_fetch_assoc( mysqli_query($db,"SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';"));
			$ruta = "archivos/".$id_materia."/".$archivo["id_archivo"].".".$archivo["extension"];
			
	    	echo '<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col">
							<div class="hr-sect">' . $archivo["fecha_subido"] . '</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-sm-12 col-lg-3 mb-3 text-center">
							<!-- foto -->
							<img src="resources/extensiones/'.$archivo["extension"].'.png" class="img-fluid img-thumbnail w-50" style=" max-width: 50%;" alt="Responsive image">
						</div>
						<div class="col-12 col-sm-12 mb-3 col-lg-7">
							<!-- Texto descriptivo -->
							<div class="row">
								<div class="col-12"><h5><a class="link_archivo text-success" href="'.$ruta.'" download="'.$archivo["titulo"].'">'. $archivo["titulo"] .'</a></h5></div>
							</div>
							<div class="row">
								<div class="col"><span class="lead">Usuario: '. $usuario["nombre"] .' ' . $usuario["apellido"] .'</span> </div>
							</div>
							<div class="row">
								<div class="col"><span class="lead">Detalles: '. $archivo["detalles"] .'</span></div>
							</div>
							<div class="row">
							  	
								<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
</fieldset>
							</div>

						</div>
						<div class="col-12 col-sm-12 col-lg-2">
							<!-- Denunciar -->
							<button class="btn btn-danger" data-toggle="modal" data-target="#modal_denunciar">
								DENUNCIAR
							</button>
						</div>
					</div>
				</div>
			</div>';
	    }
	}
?>