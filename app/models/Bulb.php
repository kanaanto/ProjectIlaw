<?php

class Bulb extends Eloquent {

	//Define fillable fields
	protected $fillable = array('name', 'ip', 'address','latitude','longitude');
	
	public function clusters(){
		return $this->belongsToMany('Cluster');
	}



}
