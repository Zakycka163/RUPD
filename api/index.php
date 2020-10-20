<?php
    $requestUri = [];
    $requestUri = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

    try {
        //Первые 2 элемента массива URI должны быть "api" и название таблицы
        $is_api = $requestUri[0];
        $filename = $requestUri[1];

        if (substr($filename, 0, 5) === "view_"){
            $filename = 'views';
            $table_name = $requestUri[1];
        }

        if($is_api == 'api' and file_exists('tables/'.$filename.'.php')){
            
            require_once 'tables/'.$filename.'.php';
            $api = new CurrentApi();

            if ($filename == 'views'){
                if(in_array($table_name,$api->views)){
                    $api->table_name = $table_name;
                } else throw new RuntimeException('API Not Found');
            } 
            
            echo $api->run();
            
        } else {
            throw new RuntimeException('API Not Found');
        }
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(Array('error' => $e->getMessage()));
    }
?>