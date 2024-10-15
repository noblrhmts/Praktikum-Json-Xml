<?php
// Mengatur Content-Type untuk XML
header('Content-Type: application/xml');

// Data dummy untuk persons
$persons = [
    [
        "id" => 1,
        "nama" => "John Doe",
        "umur" => 30,
        "alamat" => [
            "jalan" => "Jalan ABC",
            "kota" => "Jakarta"
        ],
        "hobi" => ["membaca", "bersepeda"]
    ]
];

// Data dummy untuk buku
$books = [
    [
        "id" => 1,
        "title" => "Naruto Bind Up Edition 10",
        "author" => "Masashi Kishimoto"
    ],
    [
        "id" => 2,
        "title" => "Sepatu Bola Ngatemin",
        "author" => "Djokolelono"
    ]
];

// Mendapatkan metode HTTP yang digunakan (GET, POST)
$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];

if (strpos($url, '/books') !== false) {
    switch ($method) {
        case 'GET':
            // Mengembalikan daftar buku dalam format XML
            $xml = new SimpleXMLElement('<books/>');
            foreach ($books as $book) {
                $bookXML = $xml->addChild('book');
                $bookXML->addChild('id', $book['id']);
                $bookXML->addChild('title', $book['title']);
                $bookXML->addChild('author', $book['author']);
            }
            echo $xml->asXML();
            break;

        case 'POST':
            // Mendapatkan data dari body request dan menambahkannya ke daftar buku
            $input = json_decode(file_get_contents('php://input'), true);
            $newBook = [
                'id' => end($books)['id'] + 1,
                'title' => $input['title'],
                'author' => $input['author']
            ];
            $books[] = $newBook;
            $xml = new SimpleXMLElement('<book/>');
            $xml->addChild('id', $newBook['id']);
            $xml->addChild('title', $newBook['title']);
            $xml->addChild('author', $newBook['author']);
            echo $xml->asXML();
            break;
    }
} else {
    switch ($method) {
        case 'GET':
            // Mengembalikan daftar persons dalam format XML
            $xml = new SimpleXMLElement('<persons/>');
            foreach ($persons as $person) {
                $personXML = $xml->addChild('person');
                $personXML->addChild('id', $person['id']);
                $personXML->addChild('nama', $person['nama']);
                $personXML->addChild('umur', $person['umur']);
                $alamatXML = $personXML->addChild('alamat');
                $alamatXML->addChild('jalan', $person['alamat']['jalan']);
                $alamatXML->addChild('kota', $person['alamat']['kota']);
                $hobiXML = $personXML->addChild('hobi');
                foreach ($person['hobi'] as $hobi) {
                    $hobiXML->addChild('item', $hobi);
                }
            }
            echo $xml->asXML();
            break;
    }
}
?>
