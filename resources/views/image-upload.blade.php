<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
<h1>Upload an Image</h1>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
    <h2>Resized Images:</h2>
    <ul>
        @foreach(session('images') as $size => $path)
            <li>{{ $size }}: {{ $path }}</li>
        @endforeach
    </ul>
@endif

@if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

<form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" accept="image/*" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>
