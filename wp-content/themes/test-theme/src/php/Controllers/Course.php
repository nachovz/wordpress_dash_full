<?php
namespace php\Controllers;

use \php\Types\ProjectPostType;

class Course{
    
    public function renderCourse(){
        $current_course = get_queried_object();
        
        $args = [];
        $argsQuery = array(
            'post_type' => 'assignment',
            'post_parent' => $current_course->ID,
        );
    
        $args['assignments'] = get_posts($argsQuery);
        
        $argsQuery2 = array(
           'post_parent' => $current_course->ID,
        );
        
        $args['projects'] = ProjectPostType::all($argsQuery2);
        
        return $args;
    }
    
}
?>