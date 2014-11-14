<?php
class Amount {
	public $date;
	public $tags;
	public $amount;
	public $description;
}

class Toshl {
	public $data;
	public $file;
	
	public function __construct($file = null) {
		$this->file = $file;
		if (!empty($this->file)) $this->load();
	}
	
	public function load($file = null) {
		$file = empty($file)?$this->file:$file;
		$lines = file($file);
		$pattern = '/"([\d-]+)","(.+)","([\d,.]+)","(.*)","([\d,.]+)","(.+)","(.+)("|\n)/';
		foreach ($lines as $line) {
			if (preg_match($pattern, $line, $match)) {
				$amount = new Amount();
				$amount->date = $match[1];
				$amount->tags = explode(', ',$match[2]);
				$amount->amount = $match[3];
				$amount->description = $match[7];
				$this->data[] = $amount; 
			}	else {
				//dump($line);
			}
		}
	}
	
	public function tags() {
		$result = array();
		foreach ($this->data as $amount) {
			if (in_array($tag, $amount->tags)) 
				$result[] = $amount;
		}
		
		return $result;
	}
	
	public function tag($tag) {
		$result = array();
		$total = 0;
		foreach ($this->data as $amount) {
			if (in_array($tag, $amount->tags)) {
				$result[] = $amount;
				$total += $amount->amount;				
			} 
		}
		$result[] = $total;
		return $result;
	}
	
	public function tagmonth($tag, $month, $year = null) {
		$result = array();
		$total = 0;
		$year = empty($year)?date('Y'):$year;
		foreach ($this->data as $amount) {
			if (in_array($tag, $amount->tags) &&
				date('m', strtotime($amount->date))== $month &&
			 	date('Y', strtotime($amount->date))== $year) {
					$result[] = $amount;
					$total += $amount->amount;			 		
			 	} 

		}
		$result[] = $total;
		return $result;
	}
	
	public function month($month, $year = null) {
		$result = array();
		$total = 0;
		$year = empty($year)?date('Y'):$year;
		foreach ($this->data as $amount) {
			if (date('m', strtotime($amount->date))== $month &&
			 	date('Y', strtotime($amount->date))== $year) {
					$result[] = $amount;
					$total += $amount->amount;			 		
			 	} 

		}
		$result[] = $total;
		return $result;
	}
	
	public function aggregateTagYear($tag, $year) {
		$year = empty($year)?date('Y'):$year;
		$aggregatedData = array();
		$months = range(1, 12);
		foreach ($months as $month) {
			$data = $this->tagmonth($tag, $month, $year);
			$aggregatedData['data'][] = $data[count($data)-1];
		}
		$aggregatedData['name'] = $tag;
		
		return $aggregatedData;
	}
	
	public function aggregateTagYears($tag, $year) {
		$year = empty($year)?date('Y'):$year;
		$aggregatedData = array();
		$months = range(1, 12);
		foreach ($months as $month) {
			$data = $this->tagmonth($tag, $month, $year);
			$aggregatedData['data'][] = $data[count($data)-1];
		}
		$aggregatedData['name'] = $tag;
		
		return $aggregatedData;
	}
} 
?>