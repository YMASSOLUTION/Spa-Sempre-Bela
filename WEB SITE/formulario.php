<?php
if(isset($_POST['email'])) {
    $email_to = "yuriangulosaldana@gmail.com";
    $email_subject = "Contacto desde Web";
    function died($error) {
        // mensajes de error
        echo "Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento. ";
        echo "Detalle de los errores.<br /><br />";
        echo $error."<br /><br />";
        echo "Porfavor corrija estos errores e int�ntelo de nuevo.<br /><br />";
        die();
    }
    // Se valida que los campos del formulairo est�n llenos
    if(!isset($_POST['nombre']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefono']) ||
        !isset($_POST['mensaje'])) {
        die('Lo sentimos pero parece haber un problema con los datos enviados.');
    }
 //En esta parte el valor "name"  sirve para crear las variables que recolectaran la informaci�n de cada campo
    $first_name = $_POST['nombre']; // requerido
    $email_from = $_POST['email']; // requerido
    $telephone = $_POST['telefono']; // no requerido 
    $message = $_POST['mensaje']; // requerido
    $error_message = "";//Linea numero 52;
//En esta parte se verifica que la direcci�n de correo sea v�lida 
   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La direcci�n de correo proporcionada no es v�lida.<br />';
  }
//En esta parte se validan las cadenas de texto
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'El formato del nombre no es v�lido<br />';
  }
    if(strlen($message) < 2) {
    $error_message .= 'El formato del texto no es v�lido.<br />';
  }
  if(strlen($error_message) > 0) {
    die($error_message);
  }
//Este es el cuerpo del mensaje tal y como llegar� al correo
    $email_message = "Contenido del Mensaje.\n\n";
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
   
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Tel�fono: ".clean_string($telephone)."\n";
    $email_message .= "Mensaje: ".clean_string($message)."\n";
//Se crean los encabezados del correo
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>