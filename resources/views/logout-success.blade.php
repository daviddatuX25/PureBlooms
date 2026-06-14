<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div style="text-align: center; margin-top: 100px; font-family: Arial, sans-serif;">
        <h2>Logging out successfully...</h2>
        <p>You will be redirected to login page shortly.</p>
    </div>

    <script>
        // Clear browser history and redirect to login
        setTimeout(function() {
            // Clear the current page from history
            window.location.replace('{{ route("login") }}');
        }, 1000);
        
        // Prevent back navigation
        history.pushState(null, null, window.location.href);
        window.addEventListener('popstate', function(e) {
            window.location.replace('{{ route("login") }}');
        });
    </script>
</body>
</html>
