<?php

//require './DBConnection.php';
//require './Constants.php';
//require './Log.php';
//require './Purchace_items.php';
/**
 * Description of Purchaces
 *
 * @author Sakkeer Hussain
 */
class Purchaces {

    public $id;
    public $wendor_id;
    public $purchace_manager_id;
    public $amount;
    public $created_at;
    public $last_edited;
    
    private $purchace_items = array();
    private $db_handler;
    private $tag = 'PURCHACE CONTROLLER';

    function __construct() {
        $this->db_handler = new DBConnection();
    }

    public function to_string() {
        $purchace_items = '';
        foreach ($this->purchace_items as $purchace_item) {
            $purchace_items = $purchace_items.$purchace_item->to_string();
        }
        return 'id : ' . $this->id . ' - '
                . 'wendor_id : ' . $this->wendor_id . ' - '
                . 'purchace_manager_id : ' . $this->purchace_manager_id . ' - '
                . 'amount : ' . $this->amount . ' - '
                . 'purchace_items : ' . $purchace_items . ' - '
                . 'created_at : ' . $this->created_at . ' - '
                . 'last_edited : ' . $this->last_edited;
    }
    
    public function setPurchaceItems($purchace_items){
        $this->purchace_items = $purchace_items;
    }
    
    public function getPurchaceItems(){
        return $this->purchace_items;
    }

    function addPurchace($purchace = null) {
        if ($purchace == null) {
            $purchace = $this;
        }
        $purchace_id = $this->db_handler->add_model($purchace);
        foreach ($this->purchace_items as $purchace_item) {
            $purchace_item->purchace_id = $purchace_id;
            $purchace_item->addPurchaceItem();
        }
        $description = "Added new Purchace (" . $purchace->to_string() . ")";
        Log::i($this->tag, $description);
    }
    function getPurchace(){
        $this->db_handler->get_model($this,  $this->id);
        $purchace_item = new Purchace_items();
        $purchace_items =  $purchace_item->getPurchace_items($this->id);
        $this->purchace_items = $purchace_items;
    }

}

//
//$p = new Purchaces();
//$p->id = 4;
////$p->amount = 300;
////$p->wendor_id = 1;
////$p->purchace_manager_id = 1;
////$pi = new Purchace_items();
////$pi->item_id=1;
////$pi->quantity=10;
////$pi->rate=10;
////$pia = array($pi,$pi,$pi);
////$p->setPurchaceItems($pia);
////$p->addPurchace();
//$p->getPurchace();
//print_r($p);