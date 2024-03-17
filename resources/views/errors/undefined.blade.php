<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pintoinvest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="h-screen w-screen bg-gray-100 flex flex-col justify-center items-center">
        <!-- Logo Invest -->
        <div class="mb-[10vh] -mt-36">
            <img class="h-auto max-w-full" src="/assets/gambar/logo-invest-dashboard.png" alt="logo invest" />
        </div>

        <!-- row 2 -->
        <div class="flex flex-row mt-3">
            <div class="h-full w-[40vw]">
                <div>
                    <h2 class="text-center text-3xl font-bold">
                        Maaf ada gangguan pencetakan laporan
                    </h2>
                </div>
                <div class="text-center py-5">
                    <p class="mt-2 text-xl text-gray-500 leading-[2rem]">
                        Mohon laporkan titik koordinat {{ $coordinates }} pada admin. <br><b>Terima kasih</b>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

</html>