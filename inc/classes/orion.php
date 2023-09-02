<?
class Orion extends Consultas{
   
    const version       = "1.0.0";

	private $RSP        = [];
    private $apiUrl     = 'https://smk.sysmika.org/webservice'; // URL de la API para obtener el token
    
    
    function get_token($username,$password){
        $ruta = '/token/'; // URL de la API para obtener el token
        // Inicializar cURL
        $curl = curl_init($this->apiUrl.$ruta);

        // Configurar opciones de cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Devolver el resultado como cadena
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password"); // Establecer el nombre de usuario y contraseña
        //curl_setopt($curl, CURLOPT_POSTFIELDS, "$username=$password");

        // Realizar la solicitud POST para obtener el token
        curl_setopt($curl, CURLOPT_POST, true);

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($curl);

        // Manejar errores de cURL
        if ($response === false) {
            $error = curl_error($curl);
            // Manejar el error adecuadamente
        }

        // Obtener el código de respuesta HTTP
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Cerrar la sesión de cURL
        curl_close($curl);
        if ($httpCode == 200) {
            $TOKEN = json_decode($response);
            return $TOKEN->Authorization;

        } else {
            return "Error al obtener el token. Código de respuesta: $httpCode. Mensaje: $response";
        }

    }
    /*
    / C_a = file
    / C_b = data
    / C_c = token
    */
    public function curl_post($C_a,$C_b,$C_c){
                            $ch = curl_init();
                            $H_log  = array('Content-Type: application/json');
                            curl_setopt($ch, CURLOPT_URL,$this->apiUrl.$C_a);
                            curl_setopt($ch, CURLOPT_POST, TRUE);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $C_b);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $C_c);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $RSP = curl_exec ($ch);
                            curl_close ($ch);
                            return $RSP;
                    }
    
    
    
    // END CLASS
}
?>