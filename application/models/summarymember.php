<?php

class summarymember extends CI_Model{
	
	public function __construct(){

		parent::__construct();

		$this->load->database();

	}

	public function getdata_allyears($year=''){

		$year1 = '1965';
		$year2 = '1975';
		$year3 = '1990';

		if ($year == '')

			$yearFilter = '';

		else

			$yearFilter = "AND year='$year'";

		// a lot of count queries

		$u = $this->session->userdata['userid'];

		// all years

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' $yearFilter");

		$allocated = $this->getcount($res);

		// status table.

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND search='1' $yearFilter");

		$yet = $this->getcount($res);

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND search='2' $yearFilter");

		$notfound = $this->getcount($res);

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND search='3' $yearFilter");

		$found = $this->getcount($res);

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND search='4' $yearFilter");

		$ready = $this->getcount($res);

		// response table

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND called='1' $yearFilter");

		$called2way = $this->getcount($res);

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND called='2' $yearFilter");

		$negative = $this->getcount($res);

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND called='3' $yearFilter");

		$neutral = $this->getcount($res);

		$res = $this->db->query("SELECT COUNT(*) FROM status WHERE touserid='$u' AND called='4' $yearFilter");

		$positive = $this->getcount($res);

		// create the classes of the appropriate years

		$ayc = '';
		$c_year1 = '';
		$c_year2 = '';
		$c_year3 = '';

		if ($year == '')

			$ayc = 'selected';

		elseif ($year == $year1)

			$c_year1 = 'selected';

		elseif ($year == $year2)

			$c_year2 = 'selected';

		elseif ($year == $year3)

			$c_year3 = 'selected';

		// send the data to the view

		$result = array('totalallocated'=>$allocated,
			'yet'=>$yet,
			'notfound'=>$notfound,
			'found'=>$found,
			'ready'=>$ready,
			'called2way'=>$called2way,
			'negative'=>$negative,
			'neutral'=>$neutral,
			'positive'=>$positive,
			'allyearsclass'=>$ayc,
			'class_1'=>$c_year1,
			'class_2'=>$c_year2,
			'class_3'=>$c_year3,
			'year1'=>$year1,
			'year2'=>$year2,
			'year3'=>$year3
			);

		return $result;
	}

	public function getcount($res){

		$y = $res->result_array();

		// print_r($y[0]);

		foreach($y[0] as $count){

			return $count;

		}

	}
}

?>