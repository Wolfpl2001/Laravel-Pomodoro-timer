<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{'js/clock.js'}}"></script>
    <script src="{{'js/timer.js'}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="{{'css/style.css'}}">
    <title>Document</title>
</head>
<body>
    <div class="bg">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <tr>
                <th>
                    <h1>Tasks</h1>
                    <h2 id="time"></h2>
                </th>
                <th>
                    <p>Workd Time:</p>
                    <p id="timer1">25:00</p>
                    <button id="startFirstTimerButton" onclick="startFirstTimer()">Start Working Timer</button>
                </th>
                <th>
                    <p>Break Time:</p>
                    <p id="timer2">5:00</p>
                    <button id="startSecondTimerButton" onclick="startSecondTimer()" disabled>Start Break Timer</button>
                </th>
            </tr>
    </table>
    </div>
    <div class="bg">
        <a href="{{route('tasks.create')}}"><ion-icon name="add-circle-outline"></ion-icon></a>
<table>
    <tr>
        <th>Task</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Edit</th>
    </tr>
    @foreach ($tasks as $task)
    <tr>
        <td>{{ $task->name }}</td>
        <td>
            <input type="checkbox" class="myCheckbox" name="status" value="{{$task->id}}"
                {{ $task->status == 1 ? 'checked' : '' }}>
        </td>
        <td>{{ $task->Created_at }}</td>
        <td>{{ $task->Ended_at }}</td>
        <td>
            <table>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirmDelete();">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="border: none; background: none; cursor: pointer;">
                        <ion-icon name="trash-outline"></ion-icon>
                    </button>
                </form>

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                <button type="submit" style="border: none; background: none; cursor: pointer;">
                    <ion-icon name="create-outline"></ion-icon>
                </button>
            </form>

        </td>
    </tr>
</table>


    @endforeach
</table>
    </div>
</body>
<script>
$(document).ready(function() {
    $('.myCheckbox').on('change', function() {
        const isChecked = $(this).is(':checked') ? 1 : 0;  // Sprawdzamy, czy checkbox jest zaznaczony
        const taskId = $(this).val();  // Pobieramy wartość z atrybutu 'value'

        // Pobieranie tokenu CSRF z meta tagu
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Wysyłanie danych przez AJAX za pomocą jQuery
        $.ajax({
            url: `/save-checkbox/${taskId}`,
            type: 'PUT',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken  // Przekazanie tokenu CSRF
            },
            data: JSON.stringify({
                status: isChecked
            }),
            contentType: 'application/json',
            success: function(data) {
                console.log('Sukces:', data);
            },
            error: function(xhr, status, error) {
                console.error('Błąd:', status, error);
            }
        });
    });
});
function confirmDelete() {
    return confirm('Do you want to delete this task?');
}

    </script>
</html>
