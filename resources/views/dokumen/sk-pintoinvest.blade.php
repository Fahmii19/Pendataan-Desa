<!DOCTYPE html>
<html>
<head>
    <title>Portal Investasi Berbasis Spasial</title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('assets/gambar/favicon.png') }}">

    <style>
        #pdf-container canvas {
            width: 100%;
            height: auto;
        }

    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 sm:p-10">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div id="pdf-container" class="w-full"></div>
        </div>
    </div>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        var url = "{{ asset('pdf-documents/SK Pintoinvest.pdf') }}";
        var pdfjsLib = window["pdfjs-dist/build/pdf"];
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "//mozilla.github.io/pdf.js/build/pdf.worker.js";

        var pdfDoc = null;

        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            for (var i = 1; i <= pdfDoc.numPages; i++) {
                renderPage(i);
            }
        });

        function renderPage(num) {
            pdfDoc.getPage(num).then(function(page) {
                var containerWidth = document.getElementById("pdf-container").offsetWidth;
                var viewport = page.getViewport({
                    scale: 1
                });
                var scale = containerWidth / viewport.width;
                viewport = page.getViewport({
                    scale: scale
                });

                var canvas = document.createElement("canvas");
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                document.getElementById("pdf-container").appendChild(canvas);
                var ctx = canvas.getContext("2d");

                var renderContext = {
                    canvasContext: ctx
                    , viewport: viewport
                , };
                var renderTask = page.render(renderContext);
            });
        }

    </script>
</body>
</html>
