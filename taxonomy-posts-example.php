<?php
/**
Template Name: Movie 
* @package SKT Filmmaker
*/
get_header(); ?>
<div class="container">
      <div class="page_content">
    		 <section id="movie">     
             <?php echo "<pre>"; 
             //movies taxonomy created in the admin side
              $args = [ 
                            'taxonomy' => 'movies',
                            'hide_empty' => 0,
                            'orderby' => 'term_id'
                      ];    
                   //   print_r(get_terms($args)); die;
                //get all terms inside the movies taxonomy
              if(!get_terms($args)->errors) :
                 foreach(get_terms($args) as $term) : ?>
                     
                   <h3> <a href="<?php echo get_term_link($term->slug, 'movies'); ?>"> <?php echo $term->name; ?></a></h3>
               
                   <?php 
                   $args = [ 'post_type' => 'movie',
                             'post_status'    => 'publish',
                             'tax_query' => [['taxonomy' => 'movies', 'field' => 'slug', 'terms' => $term->slug ] ]
                           ];
                    //get all posts of movies taxonomy
                    $posts = get_posts($args); 
                    if( count($posts) > 0 ) : ?>
                    <div class="col-md-4">
                       <?php foreach($posts as $post): ?>
                           <h4><?php echo the_title(); ?></h4>
                           <a href="<?php echo $post->url; ?>">Click video </a>
                       <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <h3>No video found....</h3>
                    <?php endif; ?>
          
          
                 <?php endforeach;     
               endif; 
              ?>          
             <?php if( $query->have_posts() ) :
							while( $query->have_posts() ) : $query->the_post(); ?>
                            <h3> <?php $query->the_title(); ?> </h3>
                            <?php  $query->the_content();?>

             <?php endwhile;?>
             <?php endif; wp_reset_postdata();  ?>
            </section><!-- section-->
    <div class="clear"></div>
    </div><!-- .page_content --> 
 </div><!-- .container --> 
<?php get_footer(); ?>
