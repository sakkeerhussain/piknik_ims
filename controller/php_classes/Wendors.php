<?php

/**
 * Description of Wendors
 *
 * @author Sakkeer Hussain
 */
class Wendors {

    public $id;
    public $wendor_name;
    public $total_puchace_amount;
    public $wendor_tin_number;
    public $contact_no;
    public $contact_address;
    public $created_at;
    public $last_edited;
    
    private $db_handler;
    private $tag = 'WENDORS CONTROLLER';

    function __construct() {
        $this->db_handler = new DBConnection();
    }

    public function to_string() {
        return 'id : ' . $this->id . ' - '
                . 'wendor_name : ' . $this->wendor_name . ' - '
                . 'total_puchace_amount : ' . $this->total_puchace_amount . ' - '
                . 'wendor_tin_number : ' . $this->wendor_tin_number . ' - '
                . 'contact_no : ' . $this->contact_no . ' - '
                . 'contact_address : ' . $this->contact_address . ' - '
                . 'created_at : ' . $this->created_at . ' - '
                . 'last_edited : ' . $this->last_edited;
    }

    function addWendor($wendor = null) {
        if ($wendor == null) {
            $wendor = $this;
        }
        $this->db_handler->add_model($wendor);
        $description = "Added new Wendor (" . $wendor->to_string() . ")";
        Log::i($this->tag, $description);
    }
    function getWendor(){
        return $this->db_handler->get_model(new Wendors(),  $this->id);
    }
    function getWendors(){
        return $this->db_handler->get_model_list(new Wendors());
    }
}