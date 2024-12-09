<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Your Quiz Results</h1>

    @if ($stylePercentages)
        <ul>
            <li>Leader: {{ $stylePercentages['Leader'] }}%</li>
            <li>Supporter: {{ $stylePercentages['Supporter'] }}%</li>
            <li>Organizer: {{ $stylePercentages['Organizer'] }}%</li>
            <li>Creative: {{ $stylePercentages['Creative'] }}%</li>
        </ul>
    @else
        <p>You have not completed the quiz yet or there was an issue retrieving your results.</p>
    @endif


</body>
</html>
