<?php namespace Webunion\Config;

class Config{
	
	private $file;
	private $extension;
	private $data;
	
	public function __construct( $file ){
		$this->file = $file;
	}
	
	public function load(){
		if( empty($this->data) && is_readable( $this->file) ){
			$this->extension = substr($this->file, -3);

			switch($this->extension){
				case'xml':
					return $this->data = simplexml_load_file( $this->file );
				break;
				case'php':
					return $this->data = new \ArrayIterator( require_once($this->file) );
				break;				
			}	
		}
		else{
			return array();
		}		
	}
	
	
	public function get( $param ){
		$this->load();
		$param = explode('.', $param);
		
		if( $this->extension == 'php' ){
			return $this->getArray( $param );
		}
		else{
			return $this->getXml( $param );
		}
	}
	
	public function getXml( $param ){
		$data = $this->data;
		
		for($i = 0; $i < count($param); $i++){
			$data = $data->$param[$i];
		}
		if( count(get_object_vars($data)) == 0 ){
			return utf8_decode((string)$data);
		}
		else{
			return (array)$data;
		}

	}
	
	public function getArray( $param ){
		$data = $this->data;

		for($i = 0; $i < count($param); $i++){
			$data = $data[$param[$i]];
		}
		return $data ;
	}
	
	
	public function set( $name, $value  ){
		$this->load();
		$this->data->$name = $value;
	}
	
	public function save(){
		//TO DO
	}
}