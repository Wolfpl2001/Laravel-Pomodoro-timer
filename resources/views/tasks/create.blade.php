<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('tasks.store')}}" method="POST">
        @csrf
        @method('POST')
        <input type="text" name="name" placeholder="Name" id="">
        <input type="datetime-local" name="created_at" id="">
        <button type="submit">Submit</button>
    </form>
</body>
</html> 