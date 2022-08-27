<?php
if (!empty($_GET['movie'])) {
    /**
     * Here we are suggesting movies with the help of movie titles
     */
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://mdblist.p.rapidapi.com/?s=". $_GET['movie'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: mdblist.p.rapidapi.com",
            "X-RapidAPI-Key: dced016ce3msh617de432b620444p1c2e67jsn8edffedaad78"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Movie Recommendation Searches</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
    <input type="text" name="movie"/>
    <button type="submit">Submit</button>
</form>
<br/>
<div>
    <?php
        if(!empty($response)) {
            $res = json_decode($response, true);
            foreach ($res['search'] as $key => $value) {
                echo "<div id=" . $value['imdbid'] . ">";
                echo "<p><b>" . $value['title'] . "</b></p>";
                echo "</div><br/>";
            }
        }    
    ?>
</div>
</body>
</html>