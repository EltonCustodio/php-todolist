<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function() use ( $app ) {
    echo "Welcome to REST API";
});

//Get all tasks
$app->get('/tasks', function() use ( $app ) {
    $tasks = getTasks();
    //define what kind is this response
    $app->response()->header('Content-Type','application/json');
    echo json_encode($tasks);
});


//Get tasks by id
$app->get('/tasks/:id',function($id) use ($app){
   $tasks = getTasks();
   $index = array_search($id, array_column($tasks, 'id'));
   if($index > -1){
      $app->response()->header('Content-Type','application/json');
      echo json_encode($tasks[$index]); 
   }else{
       $app->response()->setStatus(404);
       echo "Not Found";
   }
   
});



$app->post('/tasks', function()use ($app){
    $tasksJson =  $app->request()->getBody();
    $tasks = json_decode($tasksJson);
    if($tasks){
        echo "{$tasks->description} added";
    }else{
        $app->response()->setStatus(400);
        echo "Malformat JSON";
    }
});


    
function getTasks(){
     $tasks = array(
        array('id'=>1,'description'=>'Learn Rest','done'=>false),
        array('id'=>2,'description'=>'Learn JavaScript','done'=>false),
        array('id'=>3,'description'=>'Learn English','done'=>false)
    );
    return $tasks;
}

$app->run();
?>