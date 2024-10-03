<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{'css/create.css'}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        function confirmCreate() {
            return confirm('Are you sure you want to create this task?');
        }
    </script>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="bg">
    <h1>Create Task</h1>
    <form action="{{route('tasks.store')}}" method="POST" onsubmit="return confirmCreate();">
        @csrf
        @method('POST')
        <input type="text" name="name" placeholder="Name" id="" required><br>
        <input type="datetime-local" name="created_at" id="" required><br>
        <button type="submit">Submit</button>
    </form>
    </div>  
</body>
</html>
