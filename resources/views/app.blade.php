<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Developer Test</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
<main>
    <h1>PHP Developer Test</h1>
</main>
</body>
<script>
    window.data = @json($data);
</script>
</html>
<div id="app">
</div>
