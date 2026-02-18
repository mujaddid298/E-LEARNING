<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
</head>

<body>

    <h1>Realtime Discussion Test</h1>
    <ul id="log"></ul>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            console.log("Echo =", window.Echo);

            let courseId = 2;

            window.Echo.channel('discussion.' + courseId)
                .listen('.discussion.created', (e) => {
                    let li = document.createElement('li');
                    li.innerText = "Discussion baru: " + e.content + " by " + e.user;
                    document.getElementById('log').appendChild(li);
                    console.log(e);
                });

        });
    </script>

</body>

</html>
