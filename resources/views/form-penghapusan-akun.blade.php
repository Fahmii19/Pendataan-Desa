<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <title>Form Penghapusan Akun</title>
</head>

<body class="bg-gray-100 p-4 md:p-10">
  <div class="max-w-full mx-auto md:max-w-md bg-white rounded-xl shadow-md p-4 md:p-8">
    <h1 class="text-xl md:text-2xl font-bold mb-6 text-center">Form Penghapusan Akun</h1>
    <form action="/deleted_account" method="post">
      @csrf
      @method('POST')
      <div class="mb-4">
        <label for="email" class="block text-sm md:text-base font-medium text-gray-600">Email:</label>
        <input type="email" id="email" name="email" placeholder="Email Anda" required
          class="mt-1 p-2 w-full border rounded-md" />
      </div>

      <div class="mb-4">
        <label for="reason" class="block text-sm md:text-base font-medium text-gray-600">Alasan Penghapusan
          Akun:</label>
        <textarea id="reason" name="reason" rows="4" placeholder="Tuliskan alasan Anda" required
          class="mt-1 p-2 w-full border rounded-md"></textarea>
      </div>

      <div class="mb-4">
        <button type="submit"
          class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200">
          Kirim
        </button>
      </div>
    </form>
  </div>
</body>

</html>