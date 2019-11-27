<?php  

    /****************************************/ 
    /*              FB_ADDON.PHP            */    
    /*   Add meta properties for Facebook   */
    /*                                      */
    /*  (c) 2019 SOJO IT Service (sojo.se)  */ 
    /****************************************/

    // Declare constants
    define("IMAGE_URL", "http://meditationvisby.se/____impro/1/onewebmedia/");
    define("ADD_NEWLINE", false);
    
    // Setup default values    
    $default_image = 'lotus-website33.jpg';                                     // image=    
    $title = isset($_GET['title']) ? $_GET['title'] : '';                       // title=
    $description = isset($_GET['description']) ? $_GET['description'] : '';     // description=
    
    // Get current page and if failure get startpage (index)
    $page = isset($_GET['page']) ? $_GET['page'] : 'index';

    // Get image path
    $image = IMAGE_URL . (isset($_GET['image']) ? $_GET['image'] : $default_image);

    // Load the page into the memory
    $content = file_get_contents($page . '.html');

    // Get the page title if no title has been added
    if ($title === '') {
        $matches = array();
        if (preg_match('/<title>(.*?)<\/title>/', $content, $matches)) {
            $title = $matches[1];
        }
    }

    // Insert all meta properties for facebook at the end of <head>
    $content = str_replace('</head>', '<meta property="og:image" content="' . $image . '" />' . (ADD_NEWLINE ? PHP_EOL : '') . '</head>', $content);
    $content = str_replace('</head>', '<meta property="og:title" content="' . $title . '" />' . (ADD_NEWLINE ? PHP_EOL : '') . '</head>', $content);
    $content = str_replace('</head>', '<meta property="og:description" content="' . $description . '" />' . (ADD_NEWLINE ? PHP_EOL : '') . '</head>', $content);

    // Old way and do we need it?    
    $content = str_replace('</head>', '<link rel="image_src" href="' . $image . '" />' . (ADD_NEWLINE ? PHP_EOL : '') . '</head>', $content);

    // Show the modified content
    echo $content;
    
?>