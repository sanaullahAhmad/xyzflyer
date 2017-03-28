<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function page_links($base_url,$total_rows,$per_page,$div)
	{   $limit=$per_page;
		//$this->div = $div;
		//$this->base = $base_url;
		//$this->totalRows = $total_rows;		
		//$this->perPage = $per_page;
		$page = ceil($total_rows/$per_page);
	    $prev = $page - 1;
	    $next = $page + 1;
	    $pagination = "";
		
		if($page>1){
			
			//$pagination .='<a href="'.$this->base.'"><<pervious</a>';
			for($loop=1;$loop<=$page;$loop++){
				$i = ($loop * $page) - $page;
					
			if ($i >= 0)
			{
					$n = ($i == 0) ? '' : $i;
					$pagination .= getAJAXlink( $n, $loop,$base_url,$div );
			}
				//$pagination .='<a href="'.$this->base.($limit*$i).'">'.($i+1).'</a> ';
			}
		}

	return $pagination;
	}
 function getAJAXlink($count,$text,$base,$div){
	 $additional_param='';
	 $js_rebind= '';
		if( $div == '')
            return '<a href="'. $base . $count . '">'. $text .'</a>';
            
        if( $additional_param == '' )
        	$additional_param = "{'t' : 't'}";

		return "<a href=\"#\" 
					onclick=\"$.post('". $base .'/'. $count ."', ". $additional_param .", function(data){
					$('". $div . "').html(data);" . $js_rebind ."; }); return false;\">"
				. $text .'</a> ';
	}
