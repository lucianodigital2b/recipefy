@php
$config = [
    'githubAuth' => config('services.github.client_id'),
];

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipefy</title>
    @vite(['resources/js/main.js', 'resources/css/app.css', 'resources/sass/app.scss'])

    <script>
        window.config = @json($config);
    </script>
</head>
<body>
    <div id="app"></div>
</body>
</html>