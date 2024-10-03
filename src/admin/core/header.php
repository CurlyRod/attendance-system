<?php   
        $directories = 
            [
                '/src/shared/bootstrap/bootstrap.css', 
                '/src/shared/css/style.css',
            ]; 
           foreach($directories as $dir) { 
            $combineUrl = $base . $dir;
                  echo '<link rel="stylesheet" href="' . $combineUrl . "\" />\n";       
       }       
?>