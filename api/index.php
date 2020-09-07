<?php
    require_once 'DisciplinesApi.php';
    try {
        $api = new DisciplinesApi();
        echo $api->run();
    } catch (Exception $e) {
        echo json_encode(Array('error' => $e->getMessage()));
    }
?>