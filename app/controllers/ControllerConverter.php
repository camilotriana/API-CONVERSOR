<?php
class ControllerConverter
{
    public static function moneyConverter($value){
        try {

            if($value > 0){
                $trm = self::getTRM();
                
                if($trm != null){
                    $total = $trm*$value;

                    $arrayResponse = array(
                        "TRM" => $trm,
                        "DOLARES" => $value,
                        "PESOS" => number_format($total,2,'.',',')
                    );
                    
                    return $arrayResponse;
                }else{
                    return "No se encontro el TRM del dia";
                }
            }else{
                return "El valor ingresado no es permitido";
            }

        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    private static function getTRM(){
        try {
            $url        = "https://www.datos.gov.co/resource/ceyp-9c7c.json?\$order=vigenciahasta%20DESC&\$limit=1";
            $res        = file_get_contents($url);
            $response   = json_decode($res);
            return (!empty($response[0]->valor)) ? $response[0]->valor : null;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
?>