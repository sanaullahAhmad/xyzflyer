<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MenuNodes class draws the tree menu dynamically 
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	PHP Tree Menu
 * @author		Gatelogix (Sajjad Mahmood) http://www.gatelogix.com
 */
 
class menunodes{
	
   protected $filter = 0;
      
   public function FilterMethod($row){
      //you need to replace $row['parent'] by your name of column, which is holding the parent's id of current entry!
      return $row['parent_category_id'] == $this->filter;
   }
   
   public function CreateNestedArray(&$data, &$arr, $parent, $startDepth, $maxDepth){
      if ($maxDepth-- == 0) return;
      $index = 0;
      $startDepth++;

      $this->filter = $parent;
      $children = array_filter($data, array($this, "FilterMethod"));
      foreach ($children as $child)
      {
         $arr[$index] = $child;
         $arr[$index]['depth'] = $startDepth;
         //you need to replace $child['id'] by your name of column, which is holding the id of current entry!
         $this->CreateNestedArray($data, $arr[$index]['children'], $child['category_id'], $startDepth, $maxDepth);
         $index++;
      }
   }
   
   public function CreateResult($data,$parent, $startDepth, $maxDepth){
      $arr = array();
      $this->CreateNestedArray($data, $arr, $parent, $startDepth, $maxDepth);
      return $arr;
   }
  /**
   *  It will create categories tree stucture dropdown 
   *
   *  @param array $dataArray 
   */   
  public function dropdownrecursion($dataArray){
	   $dropdown_html = '';

		foreach($dataArray as $element){

							       $level = $element['level'];
								   
									$leveltype = str_repeat('-', $level);
						$optionclass= '';	
						$grand_parent_class ='';
						    if($element['level']==0){
							     $grand_parent_class='grandparentclass';
							}
							
							if($element['has_childs']==1){
							   $optionclass = 'class="optionclass '.$grand_parent_class.'"';
							}else{
							   $optionclass = 'class="'.$grand_parent_class.'"';
							}		
							  
					 $dropdown_html .='<option id="id_cat_'.$element['category_id'].'"  '.$optionclass.' value="'.$element['category_id'].'" >'.$leveltype.' '.$element['category_name'].'</option>';

		   
		   if(!empty($element['children'])){
				$dropdown_html.= $this->dropdownrecursion($element['children']);
		   } 
		
		
		}
		
		
		return $dropdown_html;
	}

	
	
	/*public function catrecursion($dataArray){
	   $grid_html = '';
		foreach($dataArray as $element){
			
			$grid_html  .=  '<div class="catlistitem">';
			  $level     = $element['level'];
			  
			$leveltype='';
			
			if($level!=0){					   
			  $leveltype = str_repeat('*', $level);
			}
			
			if($element['has_childs']==1){
				
		         $grid_html  .=  $leveltype.'<a href="#" onclick="expand('.$element['category_id'].');"> <strong>+</strong> </a>';
			  
			}else if($element['can_have_child']==0){
				
				 $grid_html  .=  $leveltype.'<a href="baseurlquestions_and_answers/listing/1/5/'.$element['category_id'].'" style="color:blue;"> > </a>';
				
			}else{
				
		   	      $grid_html  .=  $leveltype.'<a href="#"  onclick="collapse('.$element['category_id'].');"> <strong>-</strong> </a>';
			  
			}
			
			$strongtag ='';
			
			
			$grid_html    .=  $element['category_name'].'</div>'; 
			
			
		   if(!empty($element['children'])){
				$grid_html.= $this->catrecursion($element['children']);
		   } 
			
		
		    
		}
		
		
		return $grid_html;
	}*/
	
	
    public function treestructurerecursion($dataArray){
	   $main_str_menu = '';
		foreach($dataArray as $element){
			if($element['questions_count']>0){
			   $main_str_menu.='<a href="baseurlquestions_and_answers/listing/1/5/'.$element['category_id'].'">';
			}
			
			$arrow = '';
			if($element['can_have_child']==0 && $element['questions_count']>0){
			    $arrow = '<span style="color:blue;font-weight:bold"> <strong>></strong> </span>';
			}
			
		   $main_str_menu.='<li>'.$arrow.$element['category_name']; 
		   if(!empty($element['children'])){
				$main_str_menu.='<ul>'.$this->treestructurerecursion($element['children']).'</ul>';
		   } 
			$main_str_menu.='</li>';
			if($element['questions_count']>0){
			   $main_str_menu.='</a>';
			}
		}
		return $main_str_menu;
	}
	
	 public function counter_recursion($dataArray, $category_id){
	   $main_str_menu = 0;
		foreach($dataArray as $element){
			
			$queryR = mysql_query('select count(question_id) as num_rows FROM questions WHERE category_id='.$element['category_id']);
			$result = mysql_fetch_array($queryR);
			
			$count  = $result['num_rows'];
			
		   $main_str_menu+= $count;
		   
		   if(!empty($element['children'])){
				$main_str_menu += $this->category_question_counter_recursion($element['children']);
		   } 
		}
		return $main_str_menu;
	}
	
    public function getallchildscategoryIds($dataArray){
	    $ids = '';
		foreach($dataArray as $element){
			
			$queryR = mysql_query('select GROUP_CONCAT(DISTINCT(category_id) SEPARATOR  ",") as category_ids FROM qa_categories WHERE parent_category_id='.$element['category_id']);
			$result = mysql_fetch_array($queryR);
			$ids  .= $result['category_ids'];
		   if(!empty($element['children'])){
				$ids .= ','.$this->getallchildscategoryIds($element['children']);
		   } 
		}
		return $ids;
	}
	
	function getids(){
		
		$result = mysql_query('SELECT * from qa_categories WHERE status=1');
		$data = '';
		while($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		
		return $data;
		//echo'<pre>'; print_r($data);
	
	}
	
	 function get_child_ids($category_id=0){
		
		$categories         = $this->getids();//$category_id);
		$nestedcategories   = $this->CreateResult($categories, $category_id, 0, 50);	
		$nestedcategories   = $this->getallchildscategoryIds($nestedcategories);
	    $categories         = substr($nestedcategories,0,-1);
		
		return $categories;
	}
	
	
	
    public function category_question_counter_recursion($dataArray){
	   $main_str_menu = 0;
		foreach($dataArray as $element){
			
			$queryR = mysql_query('select count(question_id) as num_rows FROM questions WHERE category_id='.$element['category_id']);
			$result = mysql_fetch_array($queryR);
			
			$count  = $result['num_rows'];
			
		   $main_str_menu+= $count;
		   
		   if(!empty($element['children'])){
				$main_str_menu += $this->category_question_counter_recursion($element['children']);
		   } 
		}
		return $main_str_menu;
	}
}
?>