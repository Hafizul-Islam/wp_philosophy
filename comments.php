 <div class="comments-wrap">

            <div id="comments" class="row">
                <div class="col-full">

                    <h3 class="h2">
                        <?php 
                            $philosophy_cn = get_comments_number();
                            if($philosophy_cn<=1){
                                echo $philosophy_cn." ".__('Comment','philosophy');
                            }else{
                                echo $philosophy_cn." ".__('Comments','philosophy');
                            }
                        ?>
                    </h3>

                    <!-- commentlist -->
                    <ol class="commentlist">
                        <?php
                            /*$list = wp_list_comments();
                            $list = str_replace("class='comment-meta'", "class='depth-1 comment'", $list);
                            echo $list;*/
                           // philosophy_comment_list();
                            ?>
                            
                            <?php wp_list_comments( 'type=comment&callback=mytheme_comment' ); ?>
                        
                        
                    </ol> <!-- end commentlist -->

                    <div class="comments-pagination">
                        <?php 
                            the_comments_pagination(array(
                                'screen_reader_text' => __( "Pagination", 'philosophy' ) ,
                                'prev_text'          => '<'. __( "Previous Comments", 'philosophy' ),
                                'next_text'          => '>'. __( "Next Comments", 'philosophy' )

                            ));
                        ?>
                    </div>
                    <!-- respond
                    ================================================== -->
                    <div class="respond">

                        <h3 class="h2">
                            <?php _e('Add Comment','philosophy');?>
                                
                        </h3>

                    <?php 
                        comment_form();
                    ?>
                    </div> <!-- end respond -->

                </div> <!-- end col-full -->

            </div> <!-- end row comments -->
        </div> <!-- end comments-wrap -->