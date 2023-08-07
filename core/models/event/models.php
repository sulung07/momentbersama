<?php
class Models_event extends controller {

    protected $connection;

    public function __construct($connection) {
       
        $db = $connection->getConnection();
        $this->database = $connection;

    }


    public function get($data = [])
    {
        if(isset($data[1]))
        {

            $param = $data[1];

        }else{

            $param = "";
        }
        
       
        $select = "
        event.eventID,
        event.clientID,
        event.event_name,
        event.event_date,
        event.categoryID,
        event.event_link,
        event.event_status,
        event.templateID,
        event.event_code,

        clients.client_name,
        clients.client_email,

        event_category.category_name

        
        ";

        $table  = "event
        
        LEFT JOIN clients ON event.clientID = clients.clientID
        LEFT JOIN event_category ON event.categoryID = event_category.categoryID

        ";

        switch ($data[0]) {
            
            case 'get_all' :    
                return $this->database->get_data($select , $table , array("order_by" => "event.eventID DESC" , "return_type" => "all"));
            break;

            case 'by_clientID' :
                return $this->database->get_data($select , $table , array("where" => array("event.clientID" => $param[0]) , "order_by" => "event.eventID DESC" , "return_type" => "all"));
                break;

            case 'by_eventID' :
                return $this->database->get_data($select , $table , array("where" => array("event.eventID" => $param[0]) , "return_type" => "single"));
                break;

            case 'by_code' :
                return $this->database->get_data($select , $table , array("where" => array("event.event_code" => $param[0]) , "return_type" => "single"));
                break;

            default:
                return;
                break;
        }
        
    }

}