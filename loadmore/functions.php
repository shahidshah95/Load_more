<?php
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts()
{
    $page = isset($_POST['page']) ? $_POST['page'] : '';

    $args = array(
        'post_type' => 'post',
        'orderby'    => 'ID',
        'post_status' => 'publish',
        'paged' => $page,
        'order'    => 'DESC',
        'posts_per_page' => 3,
    );
    $query = new WP_Query($args); ?>
    <?php if ($query->have_posts()) { ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php //get_template_part('template-file/post-content', get_post_format()); 
            ?>
            <div class="card ig__blog-card">
                <div class="blog_data">
                    <div class="blog-img-wrapper">
                        <div class="ig__blog-img">
                            <?php $post_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                            <?php if (!empty($post_img)) : ?>
                                <img class="in-svg" src="<?php echo $post_img[0] ?>" alt="news">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ig__blog-content">
                        <div class="date mt-2">
                            <?php
                            $post_date = get_the_time('d M Y');
                            $post_date_formatted = date('d-m-Y', strtotime($post_date));
                            ?>
                            <p class="mb-1"><?php echo $post_date_formatted; ?></p>
                        </div>
                        <div class="title">
                            <h4 class="mt-1"><?php the_title(); ?></h4>
                        </div>
                        <div class="descrption">
                            <p><?php the_excerpt() ?></p>
                        </div>
                        <div class="blog-btn">
                            <a class="color-light" href="<?php the_permalink(); ?>"><span>Read More</span></a>
                        </div>
                    </div>
                </div>
            </div>
<?php
        endwhile;
    } else {
        echo 'No more posts to load';
    }
    wp_reset_postdata();
    die();
}
