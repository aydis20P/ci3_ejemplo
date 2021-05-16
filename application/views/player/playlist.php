<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div hidden id="card-player" class="card text-white bg-dark mb-3">
                <div id="player-container" class="d-flex card-body justify-content-center">
                    <!-- music player -->
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body table-responsive">
                    <h5 class="card-title">Tu lista de reproducción</h5>
                    <table class="table" style="color : white;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Artista</th>
                                <th scope="col">Título</th>
                            </tr>
                        </thead>
                        <tbody id="http-response"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>

<script>
    window.onload = function() {
        getPlaylist();
    }

    function getPlaylist() {
        var user_name = '<?php echo $user_name ?>';
        var domain = window.location.hostname;
        if(domain=='localhost'){
            var uri = "http://localhost:8080" + "/index.php/music/playlist_usuario/" + user_name;
        }
        else{
            var uri = "https://" + domain + "/index.php/music/playlist_usuario/" + user_name;
        }

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            //console.log("ready state: " + this.readyState);
            //console.log("status: " + this.status);
            var response = null;
            if (this.readyState == 4 && this.status == 200) {
                response = JSON.parse(this.responseText);
                console.log(response);
                var tbody = document.getElementById("http-response");
                console.log(response);
                response.canciones.forEach(cancion => {
                    var row = document.createElement("tr");

                    var dataPlay = document.createElement("td");
                    var play = document.createElement("button");
                    play.setAttribute("class", "btn btn-success btn-floating");
                    play.setAttribute("type", "button");
                    play.setAttribute("onclick", "reproducirCancion('" + cancion.src +"')");
                    play.innerHTML = "<i class='fas fa-play'></i>";
                    dataPlay.appendChild(play);

                    var dataNombre = document.createElement("td");
                    var dataArtista = document.createElement("td");
                    dataNombre.innerHTML = cancion.nombre;
                    dataArtista.innerHTML = cancion.artista;

                    row.appendChild(dataPlay);
                    row.appendChild(dataArtista);
                    row.appendChild(dataNombre);

                    tbody.appendChild(row);
                });
            }
        };

        xmlhttp.open("GET", uri, true);
        xmlhttp.send();
    }

    function reproducirCancion(src){
        var player = '<audio id="player" controls> <source src=' + src
        + ' type="audio/mpeg"> Tu navegador no soporta elementos de audio. </audio>'
        document.getElementById("player-container").innerHTML = player;
        document.getElementById("card-player").hidden = false;
        document.getElementById("player").play();
    }
</script>