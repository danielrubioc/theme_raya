<?php get_header();  
$term = get_queried_object();  ?>  
<div class="container">  
    <div class="row g-0 row-posts"> 
    <?php   
    $args = array(
        'post_type' => 'noticia',
        'posts_per_page' => 4,
    );
    $wp_query = new WP_Query($args); 
    while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
        get_template_part( 'template-parts/post/content', get_post_format() );  
    endwhile;  
    // don't display the button if there are not enough posts
    if ( $wp_query->max_num_pages > 1 ){}
        echo '<div class="misha_loadmore">Cargar más notas</div>'; // you can use <a> as well
    ?> 
    </div><!-- /.row -->   
</div><!-- /.container -->  

<?php get_footer(); ?>