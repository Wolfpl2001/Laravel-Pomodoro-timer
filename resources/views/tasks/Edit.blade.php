<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <title>Document</title>
</head>
<body>
<div class="bg">
    <h1>Update Information</h1>
    <form action="{{route('tasks.edit', $id)}}" method="POST">
        @csrf
        @method('POST')
        <input type="text" name="name" id="" placeholder="name" value="{{$name}}">
        <input type="datetime-local" value="{{$date}}">
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
