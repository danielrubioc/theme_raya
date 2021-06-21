<?php get_header(); ?>
<div class="container">  
    <div class="row g-0">
        <?php  if(is_category()):  ?>
            <h2 class="px-2 py-2">Categoría: <?php echo $term->name?></h2>
        <?php  endif;  ?>
    <?php
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/post/content', get_post_format() );  
        endwhile; 
    else :
        echo '<p>No hay noticias!</p>'; 
    endif;
    ?>
    </div><!-- /.row --> 
</div><!-- /.container --> 
<?php get_footer(); ?>