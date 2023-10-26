  <div class="container">
      <div class="ig__blog">
          <h2 class="mb-3">Blogs</h2>
          <div class="cards-3 blogs-details">
              <?php
                $args = array(
                    'post_type' => 'post',
                    'orderby'    => 'ID',
                    'post_status' => 'publish',
                    'paged' => 1,
                    'order'    => 'DESC',
                    'posts_per_page' => 9,
                );
                $query = new WP_Query($args);
                $on_page_max_pages = $query->max_num_pages;
                $load_args = array(
                    'post_type' => 'post',
                    'orderby'    => 'ID',
                    'post_status' => 'publish',
                    'paged' => 1,
                    'order' => 'DESC',
                    'posts_per_page' => 3,
                );
                $load_query = new WP_Query($load_args);
                // echo '<pre>';
                // print_r($query);
                $max_pages = $load_query->max_num_pages;
                ?>
              <?php if ($query->have_posts()) : ?>
                  <?php while ($query->have_posts()) : $query->the_post(); ?>
                      <?php //get_template_part('template-file/post-content', get_post_format()); 
                        ?>
                      <div class="card ig__blog-card">
                          <div class="blog_data">
                              <div class="blog-img-wrapper">
                                  <div class="ig__blog-img">
                                      <?php $post_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full') ?>
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
                  <?php endwhile; ?>
              <?php endif; ?>
          </div>
      </div>
      <?php if ($query->have_posts() && $on_page_max_pages > 1) : ?>
          <div style="text-align: center;">
              <button id="loadmore" class="blog_loadmore_btn" data-page_id="<?php echo $max_pages; ?>">Load More</button>
          </div>
      <?php endif; ?>
  </div>