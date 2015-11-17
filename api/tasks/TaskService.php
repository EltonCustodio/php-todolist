<?php


class TaskService{
    
    public static function listTasks(){
        $db = ConnectionFactory::getDB();
        $tasks = array();
        
        foreach($db->tasks() as $task){ //vai para o banco de dados dentro da tabela tasks
            $tasks[] = array(
                'id' => $task['id'],
                'description' => $task ['description'],
                'done' => $task['done']
            );
        }
    }
}
?>