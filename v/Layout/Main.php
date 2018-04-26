<?php 

class Main{

    public static function Lay(){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Bretzelus Elements API</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
                <link rel="stylesheet" href="/sys/css/main.css">

            </head>
            <body>
                <?php
                    require_once LAYOUT.DS.'Head.php';
                    try {
                        echo "<H1>We Are The Main!</H1>";
                    }
                    catch(\Exception $e){
                        WriteP("Exception: ".$e->getMessage());
                    }
                    // Debug:
                    foreach(\App\Controller\Dispatcher::$Stack as $Msg) echo $Msg;
                    require_once LAYOUT.DS.'Foot.php';
                    
            ?>
                <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
            </body>
            </html>
        <?php
    }
}
?>
