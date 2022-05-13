<?php defined('SYSPATH') or die('No direct script access.');
 
 
class Task_Spisanie extends Minion_Task {
    
    protected function _execute(array $params)
    {
        Model::factory('savesf')->snyatie_uslug();
    }
}