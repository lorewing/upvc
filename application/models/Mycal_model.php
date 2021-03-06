<?php
class Mycal_model extends CI_Model {
	
	var $conf;
	
	function Mycal_model () {
		//parent::Model();
		
		$this->conf = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'admincms/mycal/display'
		);
		
		$this->conf['template'] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num" title="{content}">{day}</div>
				<div class="content" title="{content}">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
		';
		
		$this->conf_small = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'mycal/display_small'
		);
		
		$this->conf_small['template'] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar_small" >{/table_open}

		   {heading_row_start}<tr>{/heading_row_start}
		
		   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
		
		   {heading_row_end}</tr>{/heading_row_end}
		
		   {week_row_start}<tr>{/week_row_start}
		   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}
		
		   {cal_row_start}<tr class="days_small">{/cal_row_start}
		   {cal_cell_start}<td class="day_small">{/cal_cell_start}
		
		   {cal_cell_content}<a href="#" title="{content}">{day}</a>{/cal_cell_content}
		   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
		
		   {cal_cell_no_content}{day}{/cal_cell_no_content}
		   {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
		
		   {cal_cell_blank}&nbsp;{/cal_cell_blank}
		
		   {cal_cell_end}</td>{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}
		
		   {table_close}</table>{/table_close}
		';
		
		$this->conf_home = array(
			'start_day' => 'monday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'mycal/display'
		);
		
		$this->conf_home['template'] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num" title="{content}">{day}</div>
				<div class="content" title="{content}">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
		';

	}
	
	function get_calendar_data($year, $month) {
		
		$query = $this->db->select('date, data')->from('calendar')
			->like('date', "$year-$month", 'after')->get();
			
		$cal_data = array();
		
		foreach ($query->result() as $row) {
			
			//$cal_data[substr($row->date,8,2)] = $row->data;
			
			 $index = ltrim(substr($row->date,8,2), '0');   // this is the magic !!
            $cal_data[$index] = $row->data;
			
		}
		
		return $cal_data;
		
	}
	
	function add_calendar_data($date, $data) {
		
		if ($this->db->select('date')->from('calendar')
				->where('date', $date)->count_all_results()) {
			
			$this->db->where('date', $date)
				->update('calendar', array(
				'date' => $date,
				'data' => $data			
			));
			
		} else {
		
			$this->db->insert('calendar', array(
				'date' => $date,
				'data' => $data			
			));
		}
		
	}
	
	function generate ($year, $month) {
		
		$this->load->library('calendar', $this->conf);
		
		$cal_data = $this->get_calendar_data($year, $month);
		
		return $this->calendar->generate($year, $month, $cal_data);
		
	}
	
	function generate_small ($year, $month) {
		
		$this->load->library('calendar', $this->conf_small);
		
		$cal_data = $this->get_calendar_data($year, $month);
		
		return $this->calendar->generate($year, $month, $cal_data);
		
	}
	
	function generate_home($year, $month) {
		
		$this->load->library('calendar', $this->conf_home);
		
		$cal_data = $this->get_calendar_data($year, $month);
		
		return $this->calendar->generate($year, $month, $cal_data);
		
	}
}
