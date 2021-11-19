
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>News Apps</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
        $(window).on("load",function() {
            $(window).scroll(function() {
                var windowBottom = $(this).scrollTop() + $(this).innerHeight();
                $(".news").each(function() {
                
                    var objectBottom = $(this).offset().top + $(this).outerHeight();
                    
                    if (objectBottom < windowBottom) { 
                        if ($(this).css("opacity")==0) {$(this).fadeTo(500,1);}
                    } else { 
                        if ($(this).css("opacity")==1) {$(this).fadeTo(500,0);}
                    }
                });
            }).scroll(); 
        });
    </script>
    </head>
    
    <body>    
    <?php
        getJSON();

        function getJSON(){
            $myObj = file_get_contents('https://syazwansuhaimi.com/news/data.json');
            $data = json_decode($myObj);
            echo $data->access_token;
            console_log($data);   
            showNews($data);
            
        }

        function showNews($data){

            sort($data);
            foreach($data as $news){
                $title = $news->title;
                $date = date_create("$news->pubDate");
                $description = $news->description;
                $link = $news->link;

                echo '<div class="news">';
                echo '<h2 class="title">' . $title . '</h2>';
                echo '<p class="date"><i>' . date_format($date,'l, dS \o\f F Y g:i A') . '</i></p>';
                echo $description;
                foreach($link as $newLink){
                    if(strpos($newLink, "urn") === false){
                        
                        echo '<a href="' . $newLink . '">Read More</a>';
                    } 
                }
                echo '</div>';
            }
        }

        function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
        }

    ?>
    
        <!-- <script src="script.js"></script> -->
    </body>  
</html>