</div>
<div id="#footer">
    <a id="logoutButton" href="#">Logout</a>

    <script>
        $("#logoutButton").click( function() {
            $.post("", { controller: "login", action: "logout" },
            function() {
                window.location.href = "";
            });
        });
    </script>
</div>
</body>
</html>
