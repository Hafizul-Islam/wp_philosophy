<?php
	/**
	* Template Name: Contract page
	*/
    the_post();
    get_header();

?>
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-standard">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    <?php echo the_title(); ?>
                </h1>
            </div> <!-- end s-content__header -->

            <div class="col-full s-content__main">
                <?php 
                    if(is_active_sidebar('contract-maps'))
                        dynamic_sidebar('contract-maps');
                    ?>
                <?php the_content(); ?>

                <div class="row block-1-2 block-tab-full">
                	<?php 
                		if(is_active_sidebar('contract-info'))
                			dynamic_sidebar('contract-info');
                	?>
                </div>
                <h3> <?php _e('Say Hello','philosophy');?> </h3>
                <div>
                    <?php 
                        if(get_field("contact_form_short_code_")){
                            echo do_shortcode( get_field("contact_form_short_code_") );
                        }
                    ?>
                </div>


            </div> <!-- end s-content__main -->

        </article>


    </section> <!-- s-content -->


   <?php get_footer(); ?>