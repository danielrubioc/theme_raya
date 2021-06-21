<?php get_header(); ?>

<main class="container"> 
    <div class="row g-5">
        <div class="col-md-8 the-article__text"> 
            <?php 
                if ( have_posts() ):
                    $image = get_field( "image", $post->ID ); 
                    $title = get_field( "title", $post->ID ); 
                    $description = get_field( "description", $post->ID ); 
                ?>  
                <h2 class="the-article__title"><?php echo $title ?></h2> 
                <img class="img-fluid" src="<?php echo $image ?>" alt="<?php echo $title ?>" title="<?php  echo $title ?>" />
                <p><?php echo $description ?></p>
            <?php  endif; ?>     
        </div>

        <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
      

            <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">Categorías</h4> 
            <ol class="list-unstyled mb-0"> 
                <?php
                    $categories = get_categories( array(
                        'orderby' => 'name',
                        'order'   => 'ASC'
                    ) );
                    
                    foreach( $categories as $category ):?>
                    <li><a href="<?php echo get_category_link( $category->term_id ) ?>"> <?php echo $category->name ?></a></li>
                    <?php endforeach;?>
            </ol>
            </div>

            <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">Años</h4>
            <ol class="list-unstyled"> 
                <?php     
                    $terms = get_terms('year');
                    if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                        echo '<ul>';
                        foreach ($terms as $term) {
                            echo '<li><a href="'.get_term_link($term->slug, 'year').'">'.$term->name.'</a></li>';
                        }
                        echo '</ul>';
                    }
                ?> 
            </ol>
            </div>
        </div>
        </div>
    </div>

</main>    

<?php get_footer(); ?>