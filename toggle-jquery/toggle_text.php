<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Toggle Visibility</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $('#toggleText').toggle();
            }, 1000); // Toggle every second
        });
    </script>
</head>
<body>

    <h2>Text Visibility Toggle</h2>
    <p id="toggleText">This text will toggle between visible and hidden every second.</p>

</body>
</html>
