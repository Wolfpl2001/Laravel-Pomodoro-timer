<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zaznacz box</title>
</head>
<body>
    <label>
        <input type="checkbox" id="myCheckbox" name="status" value="1">
        Zaznacz mnie
    </label>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('myCheckbox');

        checkbox.addEventListener('change', function() {
            const isChecked = checkbox.checked ? 1 : 0;  // Sprawdzamy czy checkbox jest zaznaczony

            // Pobieranie tokenu CSRF z meta tagu
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Wysyłanie danych przez AJAX
            fetch('/save-checkbox/3', {
                method: 'PUT', // Użyj PUT do aktualizacji
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken // Przekaż token CSRF
                },
                body: JSON.stringify({
                    status: isChecked
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Sukces:', data);
            })
            .catch((error) => {
                console.error('error:', error);
            });
        });
    });
    </script>
</body>
</html>
