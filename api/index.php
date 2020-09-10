<?php
    $requestUri = [];
    $requestUri = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

    try {
        //Первые 2 элемента массива URI должны быть "api" и название таблицы
        $is_api = $requestUri[0];
        $filename = $requestUri[1];

        if($is_api == 'api' || file_exists('tables/'.$filename.'.php')){
            
            require_once 'tables/'.$filename.'.php';
            $api = new CurrentApi();
            echo $api->run();
            
        } else {
            throw new RuntimeException('API Not Found', 404);
        }
    } catch (Exception $e) {
        echo json_encode(Array('error' => $e->getMessage()));
    }
?>