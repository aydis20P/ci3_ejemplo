<div class="container">
    <!-- player container -->
    <div class="row mt-3">
        <div class="col">
            <div hidden id="card-player" class="card text-white bg-dark mb-3">
                <div id="player-container" class="d-flex card-body justify-content-center">
                    <!-- music player -->
                </div>
            </div>
        </div>
    </div>
    <!-- playlist container -->
    <div class="row mt-3">
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
                        <tbody id="playlist-body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
    <!-- canciones container -->
    <div class="row mt-3 mb-3">
        <div class="col">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body table-responsive">
                    <h5 class="card-title">Todas las canciones</h5>
                    <table class="table" style="color : white;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Artista</th>
                                <th scope="col">Título</th>
                                <th scope="col">Agregar a mi lista</th>
                            </tr>
                        </thead>
                        <tbody id="canciones-body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var usuario_id = null;

    window.onload = function() {
        getPlaylist();
        getCanciones();
    }

    function getPlaylist() {
        var user_name = '<?php echo $user_name ?>';
        var domain = window.location.hostname;
        if(domain=='localhost'){
            var uri = "http://localhost:8080" + "/index.php/music/playlist/" + user_name;
        }
        else{
            var uri = "https://" + domain + "/index.php/music/playlist/" + user_name;
        }

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            //console.log("ready state: " + this.readyState);
            //console.log("status: " + this.status);
            var response = null;
            if (this.readyState == 4 && this.status == 200) {
                response = JSON.parse(this.responseText);
                usuario_id = response.id;
                //console.log(response);
                var tbody = document.getElementById("playlist-body");
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

    function getCanciones() {
        var domain = window.location.hostname;
        if(domain=='localhost'){
            var uri = "http://localhost:8080" + "/index.php/music/canciones";
        }
        else{
            var uri = "https://" + domain + "/index.php/music/canciones";
        }

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            var response = null;
            if (this.readyState == 4 && this.status == 200) {
                response = JSON.parse(this.responseText);
                var tbody = document.getElementById("canciones-body");
                response.forEach(cancion => {
                    var row = document.createElement("tr");

                    var dataAdd = document.createElement("td");
                    var add = document.createElement("button");
                    add.setAttribute("class", "btn btn-success btn-floating");
                    add.setAttribute("type", "button");
                    add.setAttribute("onclick", "agregarAPlaylist('" + cancion.id +"')");
                    add.innerHTML = "<i class='fas fa-plus'></i>";
                    dataAdd.appendChild(add);

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
                    row.appendChild(dataAdd);

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

    function agregarAPlaylist(cancion_id){
        console.log("entré a agregar a playlist");
        var formData = new FormData();
        var domain = window.location.hostname;

        formData.append('usuario_id', usuario_id);
        formData.append('cancion_id', cancion_id);

        if(domain=='localhost'){
            var uri = "http://localhost:8080" + "/index.php/music/usuarios_cancion/create";
        }
        else{
            var uri = "https://" + domain + "/index.php/music/usuarios_cancion/create";
        }

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            var response = null;
            if (this.readyState == 4 && this.status == 200) {
                response = this.responseText;
                console.log("response:" + response);
                if (response == 1){
                    document.getElementById("playlist-body").innerHTML = "";
                    getPlaylist();
                }
            }
        }

        xmlhttp.open("POST", uri, true);
        xmlhttp.send(formData);
    }
</script>