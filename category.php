<?php get_header(); 
$term = get_queried_object();  ?>  
<div class="container">  
    <div class="row g-0">
        <h2 class="px-2 py-2">Categoría: <?php echo $term->name?></h2>
    <?php   
    $args = array(
        'post_type' => 'noticia',
        'posts_per_page' => 4,  
        'tax_query' => array( 
            array(
                'taxonomy' => $term->taxonomy,
                'field' => 'term_id',   
                'terms' => $term->term_id,
            )
        )
    );
    $the_query = new WP_Query($args); 
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
        get_template_part( 'template-parts/post/content', get_post_format() );  
    endwhile; 
    ?>
    </div><!-- /.row --> 
</div><!-- /.container --> 

  <?php get_footer(); ?>