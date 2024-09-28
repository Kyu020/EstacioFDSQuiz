<?php

    interface IGLobal{
        public function responsePayload($payload,$remarks,$message,$code);
    }
    class GlobalMethods implements IGLobal{
        public function responsePayload($payload,$remarks,$message,$code){
            $status = array("remarks" => $remarks, "message" => $message);
            http_response_code($code);
            return array ("status" => $status, "payload"=> $payload, date_create(), "prepared_by" => "Aaron Jan Estacio");
        }
    }