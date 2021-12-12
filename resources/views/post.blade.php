<!DOCTYPE html>
<html lang="en">

<head>

    <title>My Posts Website</title>
    <link rel="stylesheet" href="/app.css">
</head>

<body>
    <article>
        <h1>{{ $postheader->title;}} </h1>
        <div>
            {!! $postheader->body; !!}
        </div>
        <a href="/">Go Back</a>
    </article>

</body>

</html>
