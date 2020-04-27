<?php
abstract class Controller {
        public $tab;
	public function callAction($a){
        if($this->tab[$a['a']]){
        	$m=$this->tab[$a['a']];
        	$this->$m($a);
        }
        else{
        	$this->defaultAction($this->tab);
        }
    }
}
?>