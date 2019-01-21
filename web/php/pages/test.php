<!doctype html>
<html>
    <body>
        <button id="test">test</button>
        <script>
            var test = document.getElementsByTagName("button");
            test[0].addEventListener("click", fonction);
            function fonction(){
                var b = document.createElement("button");
                document.body.appendChild(b);
            }
        </script>
    </body>
</html>