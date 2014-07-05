<?php

class Clusterbulb extends \Eloquent {
	protected $fillable = [];
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cluster_bulb';

	public function bulb_cluster(){
		return $this->belongsToMany('Bulb');
	}

	public function cluster_list($id){
		return Clusterbulb::find($id);
	}


}