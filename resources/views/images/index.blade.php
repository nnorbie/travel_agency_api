<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Images</title>
</head>
<body>
<h1>Uploaded Images</h1>
<div>
    @foreach($files as $file)
        <div>
            <img src="{{ asset('storage/' . $file) }}" alt="Image" style="max-width: 200px; height: auto;">
            <p>{{ basename($file) }}</p>
        </div>
    @endforeach
</div>
</body>
</html>
