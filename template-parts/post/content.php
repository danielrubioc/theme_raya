<?php
    $id = get_the_ID(); 
    $description = get_field( "description", $id ); 
    $image = get_field( "image", $id ); 
?>  
<div class="col-md-6 col-xs-12 px-2">
    <div class="card mb-3 content-news">
        <div class="row g-0">
            <div class="col-md-12">
                <a href="<?php the_permalink(); ?>">
                    <img class="img-fluid w-100" src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                </a>
            </div>
            <div class="col-md-12">
                <div class="card-body"> 
                <?php  $categories = get_the_category(); 
                if ( ! empty( $categories ) ) {?>
                    <a href="<?php echo get_category_link( $categories[0]->term_id ) ?>" class="category-ink"> <?php echo esc_html( $categories[0]->name );  ?></a> 
                <?php } ?>
                    <h5 class="card-title"><?php the_title(); ?></h5>
                    <p class="card-text"><?php  echo substr($description, 0, 100);  ?> ...</p>
                    <p class="card-text text-end"><small  class="text-end text-muted"><a href="<?php the_permalink(); ?>">Leer</a></small></p>
                </div>
            </div>
        </div>
    </div>
</div>