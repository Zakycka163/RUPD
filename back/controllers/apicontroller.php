<?php
class Api
{
    protected function base_request_params(string $url){
        $request = curl_init($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/api'.$url);
        curl_setopt_array($request, array(
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true));
        return $request;
    }

    public function request(string $metod, string $url, $data = null){
        $request = $this->base_request_params($url);
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, $metod);
        if (isset($data)){
            curl_setopt_array($request, array(
                CURLOPT_HTTPHEADER => array('Content-type: application/json'),
                CURLOPT_POSTFIELDS => json_encode($data)));
        }
        $response = json_decode(curl_exec($request));
        $status = curl_getinfo($request, CURLINFO_HTTP_CODE);
        curl_close($request);
        return $response;

    }
}
?>