<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."Sql/dao/ActorDao.class.php";
require_once BASE_PATH."Sql/example/ActorExample.class.php";
require_once BASE_PATH."Sql/pojo/Actor.class.php";
require_once BASE_PATH."Sql/dao/FilmActorDao.class.php";
require_once BASE_PATH."Sql/example/FilmActorExample.class.php";
require_once BASE_PATH."Sql/pojo/FilmActor.class.php";


$actorDao = new ActorDao();


$filmActorDao = new FilmActorDao();



// $actor->setLastUpdate("2022-02-25 18:00:00");
// $actor->setFirstName("FEINT11");
// $actor->setLastName("FEINT12");




$actor = new Actor();
$actor->setActorId(207);

$actor1 = new Actor();
$actor1->setFirstName("FEINT11");
$actor1->setLastName("FEINT12");
$actorExample = new ActorExample();
$actorExample->And($actor1);


// $filmActor = new FilmActor();
// $filmActor->setActorId(39);
// $filmActorExample = new FilmActorExample();
// $filmActorExample->Or($filmActor);
// echo $actorDao->test();
echo var_dump($actorDao->select());
?>