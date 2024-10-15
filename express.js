// server.js
const express = require('express');
const app = express();
const port = 3000;

// Middleware untuk memparsing request body dalam format JSON
app.use(express.json());

// Data dummy untuk persons
let persons = [
  { id: 1, nama: "John Doe", umur: 30, alamat: { jalan: "Jalan ABC", kota: "Jakarta" }, hobi: ["membaca", "bersepeda"] }
];

// Data dummy untuk buku
let books = [
  { id: 1, title: "Naruto Bind Up Edition 10", author: "Masashi Kishimoto" },
  { id: 2, title: "Sepatu Bola Ngatemin", author: "Djokolelono" }
];

// Endpoint GET untuk daftar persons
app.get('/person', (req, res) => {
  res.json(persons);
});

// Endpoint POST untuk menambahkan data person
app.post('/person', (req, res) => {
  const newPerson = req.body;
  newPerson.id = persons.length + 1;
  persons.push(newPerson);
  res.status(201).json(newPerson);
});

// Endpoint DELETE untuk menghapus person berdasarkan ID
app.delete('/person/:id', (req, res) => {
  const id = parseInt(req.params.id);
  persons = persons.filter(person => person.id !== id);
  res.status(204).send();
});

// Endpoint GET untuk daftar buku
app.get('/books', (req, res) => {
  res.json(books);
});

// Endpoint POST untuk menambahkan buku baru
app.post('/books', (req, res) => {
  const newBook = req.body;
  newBook.id = books.length + 1;
  books.push(newBook);
  res.status(201).json(newBook);
});

// Jalankan server
app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
});
