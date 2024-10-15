// Import modul yang diperlukan
const axios = require('axios'); // Untuk mengambil data dari API
const xml2js = require('xml2js'); // Untuk mengonversi JSON ke XML

// URL API JSON
const url = 'http://localhost/json-api/api.php/books';

// Fungsi untuk mengambil data dari API JSON
async function fetchJsonData() {
  try {
    // Mengambil data dari API
    const response = await axios.get(url);
    const jsonData = response.data;

    // Menampilkan data JSON yang diambil
    console.log('Data JSON yang diambil:', jsonData);

    // Konversi JSON ke XML
    const builder = new xml2js.Builder();
    const xml = builder.buildObject({ books: jsonData });

    // Menampilkan hasil XML
    console.log('Data yang dikonversi menjadi XML:\n', xml);

    // Jika Anda ingin menyimpan hasil XML ke file, aktifkan kode di bawah ini
    // const fs = require('fs');
    // fs.writeFileSync('output.xml', xml);
    // console.log('File XML berhasil disimpan sebagai output.xml');

  } catch (error) {
    console.error('Error saat mengambil data dari API JSON:', error.message);
  }
}

// Panggil fungsi untuk memulai proses
fetchJsonData();
