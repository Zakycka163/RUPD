<?php
require_once './Api.php';
require_once './config/database.php';

class CurrentApi extends Api
{
    #public $apiName = 'disciplines';
    private $table_name = "disciplines";

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/disciplines
     * http://ДОМЕН/disciplines?round=
     * @return string
     */
    public function indexAction()
    {
        $round = $this->requestParams['round'] ?? 1;
        $database = new Database();
        $link = $database->get_db_link();
        $sql = "SELECT MAX(`value`) FROM `constants` WHERE `key` = 'limitObj'";
        $limit_request = mysqli_query($link, $sql);
        $limit = mysqli_fetch_array($limit_request);
		$start = ($round - 1) * $limit[0];
		$sql_count = "SELECT count(*) FROM view_disciplines";
		$count_result = mysqli_query($link, $sql_count);
        $count_obj = mysqli_fetch_array($count_result);
        
        if ( (int)$count_obj[0] > 0) {
            $response_body = array('total' => (int)$count_obj[0], 'limit' => (int)$limit[0],'round' => (int) $round);
            $sql_columns = "SHOW COLUMNS FROM view_disciplines";
            $sql_main = "SELECT * FROM view_disciplines LIMIT ".$start.",".$limit[0]."";
            $result_columns = mysqli_query($link, $sql_columns);
            while($row = mysqli_fetch_array($result_columns)){
                $columns[] = $row['Field'];
            }
            $result_main = mysqli_query($link, $sql_main);
            $number = 1;
            while($row = mysqli_fetch_array($result_main)){
                for($i = 0, $size = count($columns); $i < $size; ++$i) {
                    if ($i == 0) {
                        $discipline['#'] = $number;
                    }
                    if(is_numeric($row[$i])){
                        $row[$i] = $row[$i] * 1;
                    }
                    $discipline[$columns[$i]] = $row[$i];
                }
                $number++;
                $disciplines[] = $discipline;
            }
            $response_body['disciplines'] = $disciplines;
            return $this->response($response_body, 200);
        }
        $link = $database->close_db_link();
        return $this->response('No Content', 204);
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/disciplines?id=
     * @return string
     */
    public function viewAction()
    {
        $id = $this->requestParams['id'] ?? '';

        if( is_numeric($id) ){

            $database = new Database();
            $link = $database->get_db_link();
            $sql_check = "SELECT 1 FROM view_disciplines WHERE discipline_id = ".$id."";

            $check_result = mysqli_query($link, $sql_check);
            $check = mysqli_fetch_array($check_result);

            if ($check[0] == 1) {
                $sql_columns = "SHOW COLUMNS FROM view_disciplines";
                $sql_main = "SELECT * FROM view_disciplines WHERE discipline_id = ".$id."";
                $result_columns = mysqli_query($link, $sql_columns);
                while($row = mysqli_fetch_array($result_columns)){
                    $columns[] = $row['Field'];
                }
                $result_main = mysqli_query($link, $sql_main);
                $discipline = array();
                while($row = mysqli_fetch_array($result_main)){
                    for($i = 0, $size = count($columns); $i < $size; ++$i) {
                        if(is_numeric($row[$i])){
                            $row[$i] = $row[$i] * 1;
                        }
                        $discipline[$columns[$i]] = $row[$i];
                    }
                }
                return $this->response($discipline, 200);
            } return $this->response('No Content', 204);
            $link = $database->close_db_link();
        }
        return $this->response('Bad Request', 400);
    }

    /*
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/disciplines + параметры запроса name, email
     * @return string
     */
    public function createAction()
    {
        $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        if($name && $email){
            
            $database = new Database();
            $link = $database->get_db_link();
            
            #TODO
            return $this->response('Data saved.', 200);
            $link = $database->close_db_link();
        }
        return $this->response("Saving error", 500);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/users/1 + параметры запроса name, email
     * @return string
     */
    public function updateAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;

        $database = new Database();
        $link = $database->get_db_link();

        $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';

        if($name && $email){
            #TODO
            return $this->response('Data updated.', 200);
        }
        $link = $database->close_db_link();
        return $this->response("Update error", 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function deleteAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'] ?? null;

        $database = new Database();
        $link = $database->get_db_link();

        #TODO
        return $this->response('Data deleted.', 200);
        
        $link = $database->close_db_link();

    }
}