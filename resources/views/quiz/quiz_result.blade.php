<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


    <h1>Your Quiz Results</h1>

    <div>{{ $stylePercentages['Leader'] ?? 0 }}% Leader</div>
    <div>{{ $stylePercentages['Supporter'] ?? 0 }}% Supporter</div>
    <div>{{ $stylePercentages['Organizer'] ?? 0 }}% Organizer</div>
    <div>{{ $stylePercentages['Creative'] ?? 0 }}% Creative</div>



</body>
</html>
