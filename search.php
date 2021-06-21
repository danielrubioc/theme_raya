<?php get_header(); ?>  
<div class="container">  
    <div class="row g-0">
    <h1 class="search-title"> Resultados de búsqueda </h1> 
    <?php     
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post();   $id = get_the_ID(); 
            get_template_part( 'template-parts/post/content', get_post_format() );  
        endwhile; 
    else :
        echo '<p>No hay noticias!</p>'; 
    endif;
    ?>
    </div><!-- /.row --> 
</div><!-- /.container --> 

  <?php get_footer(); ?>