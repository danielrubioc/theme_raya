
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Test Raya">
        <meta name="author" content="Daniel Rubio"> 
        <title>Test Raya · Wordpress + Bootstrap 5</title>   
        <?php wp_head() ?> 
    </head>
    <body>    
    <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
        <a class="navbar-brand" href="<?php echo get_home_url() ?>">Test Raya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item current-menu-item">
                <a class="nav-link" aria-current="page" href="<?php echo get_home_url() ?>">Home</a>
            </li> 
            <?php 
                $categories = get_categories( array(
                    'orderby' => 'name',
                    'order'   => 'ASC',
                    "hide_empty" => 0,
                ) ); 
            foreach( $categories as $category ):
                if($category->term_id == 1)
                continue;?> 
                <li class="nav-item"><a  class="nav-link"href="<?php echo get_category_link( $category->term_id ) ?>"> <?php echo $category->name ?></a></li>
            <?php endforeach; ?>
            </ul>  
            <form id="searchform" method="get" action="<?php echo home_url(); ?>" class="search-form d-flex" >
                <input class="form-control me-2 search-field" type="text" name="s" id="s" size="15" />
                <select class="me-2 form-select" aria-label="Default select example" name="cat" id="cat">
                <option selected value="-1">Todas</option>
                <?php 
                    foreach( $categories as $category ):
                    if($category->term_id == 1)
                    continue;?> 
                    <option value="<?php echo $category->term_id ?>"><?php echo $category->name ?></option>
                    <?php endforeach; ?>
                ?>
                </select> 
                <input type="hidden" name="post_type" value="noticia" /> 
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        </div>
    </nav>
    </header> 
<main>