<?php
$style = "../../css/style.css";
?>

<style>
	#slides {
	display:none;
	}
</style>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="../../js/jquery.slides.min.js"></script>
<script>
    $(function(){
      $("#slides").slidesjs({
        width: 100,
        height: 100,
		navigation: {
		active: true,
		effect: "slide"
			}
    	});
    });
</script>

<?php
include("../includes/fonctions.php");
if(isset($_GET['idg'])){
    $idg = $_GET['idg'];
}else{
	header("Location: /index.php");
}
   	$connect = connexionBD();
  	$stat=pg_connection_status($connect);
	$query = "select * from groupes_projets where idg=$idg";
	$result = pg_query($connect, $query);
	$row = pg_fetch_array($result);
	$nomg = $row['nomg'];
	$themeg = $row['themeg'];

$titrePage = $nomg;
include("../includes/header.php");
?>

<main>
        <section id="groupe_public">
            <h1>Theme du groupe : <?php echo ucfirst($themeg) ?></h1>
             <h1>Documents publics</h1>

             <?php
                    /*$path  = '/home/plateforme/www/media/';
                    $files = scandir($path);
                    $files = array_diff(scandir($path), array('.', '..'));
                    print_r($files);*/

                    $connect = connexionBD();
                    $query = "select * from documents where vuedoc='public' order by iddoc";
                    $result = pg_query($connect, $query);
                    while($row = pg_fetch_array($result)){
                        echo '
                        <a href="/media/'."$idg/".$row['nomdoc'].'" alt="'.$row['commentairedoc'].'">
                            <div>
                                '.$row['commentairedoc'].'
                                <button type="button" class="button_fermer">x</button>
                            </div>
                        </a>';
                    }
                ?>
             <article class="documents">
                 <div class="liste_documents">
                  <div id="documents_public">
                <link href="http://vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet">
                    <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
                    <video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
                    poster="" data-setup="{}">
                        <source src="" type='video/mp4'>
                        <source src="MY_VIDEO.webm" type='video/webm'>
                        <p class="vjs-no-js">
                        <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    <script src="http://vjs.zencdn.net/5.19.2/video.js"></script>
               
                <div class="a_droite">
                    <div class="plaquette">
                    <a href="javascript:void(0);" onclick="javascipt:window.open('ex.pdf');" class="popup"><img src="" alt="Plaquette de Présentation" height="100" width="100"></a>
                    </div>
                    <div class="documentation">
                    <a href="" download><img src="" alt="Documentation du Projet" height="100" width="100"></a>
                    </div>
                    <div class="article">Article</div>
                    <div class="image" id="slides">
                        <img src="http://www.jqueryscript.net/images/Simplest-Responsive-jQuery-Image-Lightbox-Plugin-simple-lightbox.jpg">
                        <img src="http://www.ilovegenerator.com/large/pinou-love-131456229186.png">
                        <img src="http://www.ilovegenerator.com/large/i-love-pinou-131358589597.png">
                        <img src="http://www.jqueryscript.net/images/Simplest-Responsive-jQuery-Image-Lightbox-Plugin-simple-lightbox.jpg">
                        <img src="http://www.jqueryscript.net/images/Simplest-Responsive-jQuery-Image-Lightbox-Plugin-simple-lightbox.jpg">
                    </div>
                    </div>
                </div>
        </section>
                    
            <article class="taches">
                <button title="Ajouter une tâche" class="button_ajouter" id="button_tache">+</button>
                <table class="table_taches">
                    <tr>
                        <th>Date</th>
                        <th>Tâche</th>
                        <th>Membre(s) concerné(s)</th>
                    </tr>
                    <tr>
                        <td>00/00/0000</td>
                        <td>tache exemple</td>
                        <td>membre exemple</td>
                    </tr>
                    <tr>
                        <td>00/00/0000</td>
                        <td>tache exemple</td>
                        <td>membre exemple</td>
                    </tr>
                </table>
            </article>
        </section>
    </main>
           <div id="documents_public">
