<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
</head>

<body>

    <h1>Realtime Replies Test</h1>
    <ul id="log"></ul>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            console.log("Echo =", window.Echo);

            let discussionId = 2;

            window.Echo.channel('replies.' + discussionId)
                .listen('.replies.created', (e) => {
                    let li = document.createElement('li');
                    li.innerText = "Replies baru: " + e.content + " by " + e.user;
                    document.getElementById('log').appendChild(li);
                    console.log(e);
                });
        });
    </script>

</body>

</html>
