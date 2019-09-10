<article class="masonry__brick entry format-gallery" data-aos="fade-up">
                        
    <?php 
        if(class_exists('Attachments')):
            $attahments = new Attachments('gallery');
            if($attahments->exist()):
    ?>                    
    <div class="entry__thumb slider">
        <div class="slider__slides">
            <?php 
                while($attahment = $attahments->get()):
            ?>
            <div class="slider__slide">
                <?php echo $attahments->image("philosophy-home-squre"); ?>
            </div>
            <?php 
                endwhile;
            ?>
        </div>
    </div>
    <?php 
            endif;
        endif;
    ?>
    <?php get_template_part( 'template-parts/common-template/post/summery'); ?>
</article> <!-- end article -->