<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - Ingetin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-700 font-sans p-6 sm:p-12">
    <div class="max-w-2xl mx-auto bg-white p-8 shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4 text-gray-900">Kebijakan Privasi</h1>
        <p class="mb-4 text-sm text-gray-500">Terakhir diperbarui: {{ date('d F Y') }}</p>

        <p class="mb-4">
            Kami menghormati privasi Anda. Halaman ini menjelaskan bagaimana data Anda diproses oleh aplikasi "Ingetin".
        </p>

        <h2 class="text-lg font-semibold mt-6 mb-2">1. Data yang Kami Kumpulkan</h2>
        <p class="mb-4">
            Aplikasi ini hanya memproses data publik dari akun Instagram Anda yang berinteraksi dengan layanan kami (seperti mengirim Direct Message), yang meliputi:
            <ul class="list-disc ml-5 mt-2">
                <li>Instagram User ID (untuk identifikasi pengirim).</li>
                <li>Username (untuk personalisasi sapaan).</li>
                <li>Isi Pesan (untuk diproses oleh sistem otomatisasi).</li>
            </ul>
        </p>

        <h2 class="text-lg font-semibold mt-6 mb-2">2. Penggunaan Data</h2>
        <p class="mb-4">
            Data tersebut HANYA digunakan untuk menjalankan fungsi balasan otomatis (chatbot). Kami tidak menjual, menyewakan, atau menyebarkan data Anda ke pihak ketiga manapun.
        </p>

        <h2 class="text-lg font-semibold mt-6 mb-2">3. Penghapusan Data</h2>
        <p class="mb-4">
            Jika Anda ingin menghapus riwayat percakapan Anda dari sistem kami, silakan kirimkan DM dengan kata kunci "DELETE DATA" atau hubungi admin kami.
        </p>

        <div class="mt-8 pt-4 border-t border-gray-100 text-center">
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-500">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
