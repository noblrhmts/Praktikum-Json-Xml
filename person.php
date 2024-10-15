<?php header('Content-Type: application/xml');
$xml = new SimpleXMLElement('<persons/>');
$person = $xml->addChild('person');
$person->addChild('id', 1);
$person->addChild('name', 'John Doe');
$person->addChild('age', 30);
$address = $person->addChild('address');
$address->addChild('street', 'Jalan ABC');
$address->addChild('city', 'Jakarta');
$hobbies = $person->addChild('hobbies');
$hobbies->addChild('hobby', 'membaca');
$hobbies->addChild('hobby', 'bersepeda');
echo $xml->asXML();
?>

<?php
header('Content-Type: application/xml');
$xml = new SimpleXMLElement('<books/>');

$book1 = $xml->addChild('book');
$book1->addChild('id', 1);
$book1->addChild('title', 'Naruto Bind Up Edition 11');
$book1->addChild('author', 'Masashi Kishimoto');

$book2 = $xml->addChild('book');
$book2->addChild('id', 2);
$book2->addChild('title', 'Sepatu Bola Ngatemin');
$book2->addChild('author', 'Djokolelono');

echo $xml->asXML();
?>

<?php
header('Content-Type: application/xml');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$xml = new SimpleXMLElement('<book/>');
$xml->addChild('id', $data['id']);
$xml->addChild('title', $data['title']);
$xml->addChild('author', $data['author']);

echo $xml->asXML();
?>
