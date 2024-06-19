<?php
function google_search($query, $api_key, $cse_id, $num_results = 10) {
    $url = "https://www.googleapis.com/customsearch/v1?key={$api_key}&cx={$cse_id}&q=" . urlencode($query) . "&num={$num_results}";
    $response = file_get_contents($url);
    if ($response === FALSE) {
        die('Error occurred while fetching data from Google API');
    }
    return json_decode($response, true);
}

function get_similar_info($text, $api_key, $cse_id) {
    $results = google_search($text, $api_key, $cse_id);
    $similar_info = [];
    if (isset($results['items'])) {
        foreach ($results['items'] as $result) {
            $title = $result['title'];
            $link = $result['link'];
            $similar_info[] = ['title' => $title, 'link' => $link];
        }
    }
    return $similar_info;
}

// Reemplaza 'your_api_key' y 'your_cse_id' con tu clave API y ID del motor de búsqueda
$api_key = 'AIzaSyA1_A-2tiQgtKcnyOu30BgHG40LM0tdW0c';
$cse_id = '6642e4a73ce914e46';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<header>
  <nav>
    <ul>
      <img width= 100px src="img/mylologo.png" alt="MYLO">
      <li><a href="index.php">Inicio</a></li>
      <li><a href="MILO3.php">Busqueda De Similares</a></li>
      <li><a href="MILO2.html">Calidad Y Veracidad</a></li>
      <li><a href="MILO.html">AI Analysis</a></li>
    </ul>
  </nav>
</header>
<section>
    <table width= 70%>
        <tr>
            <td>
            <form method="POST" action="" class="container2">
                <label for="search_text"><h1>Introduce el texto para encontrar otras fuentes donde se habla de lo mismo:</h1></label><br>
                <textarea name="search_text" id="search_text" rows="4" cols="50"></textarea><br>
                <input type="submit" id="generateButton" value="Buscar">
            </form>
            </td>
        </tr> 
        
    </table> 
</section>   
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_text'])) {
    $input_text = $_POST['search_text'];
    $similar_results = get_similar_info($input_text, $api_key, $cse_id);

    foreach ($similar_results as $index => $info) {
        echo "<p style=color:yellow;>Resultado " . ($index + 1) . ":</p>";
        echo "<p style=color:yellow;>Título: " . htmlspecialchars($info['title']) . "</p>";
        echo "<p style=color:yellow;>Enlace: <a href='" . htmlspecialchars($info['link']) . "' target='_blank'>" . htmlspecialchars($info['link']) . "</a></p>";
    }
}
?>

<div id="cursor" class="cursor">
    <div class="ring">
      <div>
        <!--Border-->
      </div>
    </div>
    <div class="ring">
      <div>
        <!--Pointer-->
      </div>
    </div>
  </div>
  <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script><script  src="./script.js"></script>
    </body>
</html>
