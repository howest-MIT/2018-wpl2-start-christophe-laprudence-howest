<?php
require_once ('scripts/database.php');

//query voor mijn eigen playlists gaan maken
$sqlMijnPlayList = "SELECT playlistid, titel FROM savedplaylist s 
INNER JOIN playlist p ON s.playlistid = p.idplaylist";

//query voor alle playlists te gaan maken
$sqlBrowselijst = "SELECT idplaylist, titel, omschrijving, afbeelding, createdby
FROM playlist";

//query van mijn playlist uitvoeren om in NAV te plaatsen
if (!$resNAVMijnplaylists = $mysqli->query($sqlMijnPlayList)){
    echo "Oeps, een query foutje op DB voor opzoeken eigen playlist";
    print("<p>Error: " . $mysqli->error . "</p>");
    exit();
}

//query uitvoeren voor alle playlists om in centrum pagina te plaatsen
//opvangen van de fouten
if (!$resBrowselijst = $mysqli->query($sqlBrowselijst)){
    echo "Oeps, een query foutje op DB voor opzoeken van alle playlists";
    print("<p>Error: " . $mysqli->error . "</p>");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Spotify - les</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,400" rel="stylesheet" />
    <link rel="stylesheet" href="style/screen.css" />
  </head>
  <body class="container-fluid h-100">
    <div id="container" class="row h-100">
      <aside class="col-2 h-100">
        <nav>
          <ul class="list-unstyled">
            <li><a href="#">Browse</a></li>
            <li><a href="#">Radio</a></li>
          </ul>
        </nav>
        <nav>
          <h1>your library</h1>
          <ul class="list-unstyled">
            <li><a href="#">Your daily mix</a></li>
            <li><a href="#">Recent played</a></li>
            <li><a href="#">Songs</a></li>
            <li class="active"><a href="#">Albums</a></li>
            <li><a href="#">Artists</a></li>
            <li><a href="#">Stations</a></li>
          </ul>
        </nav>
        <nav>
          <h1>playlist</h1>
          <ul class="list-unstyled">
            <?php
            //ophalen van het resultaat van de query
            //doorlopen van het resultaat zolang er rijen zijn
            while ($row = $resNAVMijnplaylists->fetch_assoc()) {
                //opvullen tijdelijke var
                $tempId = $row['playlistid'];
                $tempTitel = $row['titel'];
                
                //gebruiken van var om rij van LI te maken
                print('<li><a href="playlist.php?idplaylist=' . $tempId . '">' . $tempTitel .'</a></li>');

            }
            
            ?>
            
            
          </ul>
        </nav>
      </aside>
      <main class="col-10 h-100">
        <header class="row">
          <div class="col-6">
            <i class="fas fa-chevron-left"></i>
            <i class="fas fa-chevron-right"></i>
            <form>
              <input type="text" name="zoeken" id="zoeken" />
            </form>
          </div>
          <div class="col-6 text-right">
            <img src="images/person.png" alt="mijn account" />
            Christophe Laprudence
            <a href="#"><i class="fas fa-chevron-down"></i></a>
          </div>
        </header>

        <section class="row" id="content">
    
    
        <header class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="type"><h1>Browse</h1> </div>
                </div>
              
              <div class="col-12 actions">
                <a class="btn solid" href="#">Play</a>
              </div>
            </div>
          </header>
    
    
    
          <div class="col-12 scrolledsmall">
            <div class="row">
              <div class="col-6"><h1>Browse</h1></div>
              <div class="col-6 text-right">
                <a class="btn solid" href="#">Play</a>
              </div>
            </div>
          </div>




          <section class="col-12 catalogus" id="bevat">
            <div class="row">
              
            <?php
            //zolang er resultaten zijn uit de query, steek je ze in de array 'row'
            while ($row = $resBrowselijst->fetch_assoc()) {
                //eerst tijdelijke vars opvullen
                $tempTitel = $row['titel'];
                $tempOmschrijving = $row['omschrijving'];
                $tempAfbeelding = $row['afbeelding'];
                $tempId = $row['idplaylist'];

                //artile element terug opnieuw opbouwen
                print('<article class="col-3">');
                print('<a href="playlist.php?idplaylist=' . $tempId . '">');
                print('<header>');
                //afbeelding tonen uit db met vast pad naar playlist
                print('<img src="images/playlist/' . $tempAfbeelding . '" class="img-fluid" />');
                
                //overlay voor speelknoppen
                print('<div class="overlay">');
                print('<div class="ctrl">');
                print('<i class="fas fa-plus"></i>');
                print('<i class="fas fa-play"></i>');
                print('<i class="fas fa-ellipsis-h"></i>');
                print('</div>');
                print('</div>');

                print('</header>');
                print('</a>');

                //eigenlijke info van de playlist tonen
                print('<div class="infocard">');
                print('<h1>' . $tempTitel . '</h1>');
                print('<section>' . $tempOmschrijving . '</section>');
                print('<footer>12343423 followers</footer>');
                print('</div>');
                
                print('</article>');


            }

            ?>
          
            </div>
          </section>
        </section>
      </main>
    </div>
    <footer class="row fixed-bottom">
      <section class="col-3" id="nav_playing">
        <div class="row">
          <div class="col-4">
            <img src="images/placeholder.png" class="img-fluid" alt="now playing" />
          </div>
          <div class="col-8 m-auto">
            <section class="infoplaying">
              <div class="songtitle">Title</div>
              <div class="artiest">artiest</div>
            </section>
          </div>
        </div>
      </section>
      <section class="col-6 m-auto" id="nav_ctrl">
        <div class="row">
          <div class="col-1 text-center">x:xx</div>
          <div class="col-10 m-auto">
            <div class="playbar">
              <div class="currentposbar"></div>
              <div class="currentpos"></div>
            </div>
          </div>
          <div class="col-1 text-center">x:xx</div>
        </div>
      </section>
      <section class="col-3 m-auto" id="now_remote">
        <div class="row">
          <div class="col-4"></div>
          <div class="col-5 m-auto">
            <div class="playbar">
              <div class="currentposbar"></div>
              <div class="currentpos"></div>
            </div>
          </div>
          <div class="col-3"></div>
        </div>
      </section>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scripts/scrollen.js"></script>
  </body>
</html>
