<h1> playlist template<br>user_name: <?php echo $user_name?></h1>
<p id="http-response"></p>

<script>
    window.onload = function() {
        getPlaylist();
    }

    function getPlaylist() {
        var user_name = '<?php echo $user_name ?>';
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            //console.log("ready state: " + this.readyState);
            //console.log("status: " + this.status);
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("http-response").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "http://localhost:8080/index.php/music/playlist_usuario/" + user_name, true);
        xmlhttp.send();
    }
</script>