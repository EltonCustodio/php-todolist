<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function() use ( $app ) {
    echo "Welcome to REST API";
});

$app->get('/tasks', function() use ( $app ) {
    $tasks = getTasks();
    //define what kind is this response
    $app->response()->header('Content-Type','application/json');
    echo json_encode($tasks);
});

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

function getTasks(){
     $tasks = array(
        array('id'=>1,'description'=>'Learn Rest','done'=>false),
        array('id'=>2,'description'=>'Learn JavaScript','done'=>false)
    );
    return $tasks;
}

$app->run();
?>