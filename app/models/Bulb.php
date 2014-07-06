<?php

class Bulb extends Eloquent {

	public function clusters(){
		return $this->belongsToMany('Cluster');
	}



}
