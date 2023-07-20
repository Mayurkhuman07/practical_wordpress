<?php /* Template Name: Home page */ ?>

<?php get_header(); ?>

      <div class="hero">
        <div class="container">
          <b class="the-blog"><?php the_field('page_title'); ?></b>
        </div>
      </div>
      <div class="blog-page-header">
        <div class="header-section">
          <div class="container1">
            <div class="content">
              <div class="heading-and-supporting-text">
                <div class="heading-and-subheading">
                  <div class="subheading">Our blog</div>
                  <div class="heading">Stories and interviews</div>
                </div>
                <div class="supporting-text">
                  Subscribe to learn about new product features, the latest in
                  technology, solutions, and updates.
                </div>
              </div>
              <div class="email-capture">
                <div class="input-field">
                  <div class="input-field-base">
                    <div class="input-with-label">
                      <div class="label">Email</div>
                      <div class="input">
                        <div class="content1">
                          <img
                            class="mail-icon"
                            alt=""
                            src="./public/mail.svg"
                          />

                          <div class="text">Enter your email</div>
                        </div>
                        <img
                          class="help-icon"
                          alt=""
                          src="./public/help-icon.svg"
                        />
                      </div>
                    </div>
                    <div class="hint-text">
                      We care about your data in our
                      <span class="privacy-policy">privacy policy</span>
                    </div>
                  </div>
                </div>
                <div class="button">
                  <div class="button-base">
                    <div class="text1">Subscribe</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="section">
          <div class="container2">
            <div class="heading1">Recent blog posts</div>
            <div class="content2">


              <?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 1, // Adjust the number of recent posts to display
    'orderby' => 'date',
    'order' => 'DESC'
);

$recent_posts = new WP_Query($args);

if ($recent_posts->have_posts()) {
    while ($recent_posts->have_posts()) {
        $recent_posts->the_post();
        $post_link = get_permalink();
?>
        <div class="blog-post-card">
            <?php if (has_post_thumbnail()) { ?>
                <a href="<?php echo $post_link; ?>">
                    <img class="image-icon" alt="<?php the_title(); ?>" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                </a>
            <?php } ?>

            <div class="content3">
                <div class="heading-and-subheading">
                    <div class="author"><?php the_time('l, j M Y'); ?></div>
                    <div class="heading-and-icon">
                        <a href="<?php echo $post_link; ?>">
                            <div class="heading2"><?php the_title(); ?></div>
                        </a>
                        <div class="icon-wrap">
                            <img class="arrow-up-right-icon" alt="" src="<?php echo get_template_directory_uri(); ?>/images/arrowupright.svg">
                        </div>
                    </div>
                    <div class="supporting-text1">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <div class="categories">
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        foreach ($categories as $category) {
                            $category_link = get_category_link($category->term_id);
                    ?>
                            <a href="<?php echo $category_link; ?>">
                                <div class="badge">
                                    <div class="badge-base">
                                        <div class="number"><?php echo $category->name; ?></div>
                                    </div>
                                </div>
                            </a>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
    }
    wp_reset_postdata();
}
?>



              <div class="column">
              <?php
               $args = array(
                  'post_type' => 'post',
                  'posts_per_page' => 2, // Adjust the number of recent posts to display
                  'orderby' => 'date',
                  'order' => 'DESC',
                  'offset' => 2, // Skip the first post (index starts from 0)
              );


              $recent_posts = new WP_Query($args);

              if ($recent_posts->have_posts()) {
                  while ($recent_posts->have_posts()) {
                      $recent_posts->the_post();
                      $post_link = get_permalink();
              ?>
                      <div class="blog-post-card1">
                          <?php if (has_post_thumbnail()) { ?>
                              <a href="<?php echo $post_link; ?>">
                                  <img class="image-icon1" alt="<?php the_title(); ?>" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                              </a>
                          <?php } ?>

                          <div class="content4">
                              <div class="heading-and-subheading">
                                  <div class="author"><?php the_time('l, j M Y'); ?></div>
                                  <div class="heading-and-text2">
                                      <a href="<?php echo $post_link; ?>">
                                          <div class="heading3"><?php the_title(); ?></div>
                                      </a>
                                      <div class="supporting-text1">
                                          <?php the_excerpt(); ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="categories1">
                                  <?php
                                  $categories = get_the_category();
                                  if ($categories) {
                                      foreach ($categories as $category) {
                                          $category_link = get_category_link($category->term_id);
                                  ?>
                                          <a href="<?php echo $category_link; ?>">
                                              <div class="badge">
                                                  <div class="badge-base3">
                                                      <div class="number"><?php echo $category->name; ?></div>
                                                  </div>
                                              </div>
                                          </a>
                                  <?php
                                      }
                                  }
                                  ?>
                              </div>
                          </div>
                      </div>
              <?php
                  }
                  wp_reset_postdata();
              }
              ?>

              </div>


            </div>
          </div>
        </div>
        <div class="section1">
          <div class="container3">
            <div class="content6">
              <?php
              $args = array(
                  'post_type' => 'post',
                  'posts_per_page' => 1, // Fetch the last 2 recent posts
                  'orderby' => 'date',
                  'order' => 'DESC',
                  'offset' => 1, // Skip the first post (index starts from 0)
              );

              $recent_posts = new WP_Query($args);

              if ($recent_posts->have_posts()) {
                  while ($recent_posts->have_posts()) {
                      $recent_posts->the_post();
                      $post_link = get_permalink();
              ?>
                      <div class="blog-post-card3">
                          <?php if (has_post_thumbnail()) { ?>
                              <a href="<?php echo $post_link; ?>">
                                  <?php the_post_thumbnail('full', array('class' => 'image-icon3', 'alt' => get_the_title(), 'id' => 'image3')); ?>
                              </a>
                          <?php } ?>

                          <div class="content4">
                              <div class="heading-and-subheading">
                                  <div class="author"><?php the_time('l, j M Y'); ?></div>
                                  <div class="heading-and-icon1" id="headingAndIcon1">
                                      <a href="<?php echo $post_link; ?>">
                                          <div class="heading2"><?php the_title(); ?></div>
                                      </a>
                                      <div class="icon-wrap">
                                          <img class="arrow-up-right-icon" alt="" src="<?php echo get_template_directory_uri(); ?>/images/arrowupright.svg">
                                      </div>
                                  </div>
                                  <div class="supporting-text1">
                                      <?php the_excerpt(); ?>
                                  </div>
                              </div>
                              <div class="categories">
                                  <?php
                                  $categories = get_the_category();
                                  if ($categories) {
                                      foreach ($categories as $category) {
                                          $category_link = get_category_link($category->term_id);
                                  ?>
                                          <a href="<?php echo $category_link; ?>">
                                              <div class="badge">
                                                  <div class="badge-base">
                                                      <div class="number"><?php echo $category->name; ?></div>
                                                  </div>
                                              </div>
                                          </a>
                                  <?php
                                      }
                                  }
                                  ?>
                              </div>
                          </div>
                      </div>
              <?php
                  }
                  wp_reset_postdata();
              }
              ?>

            </div>
          </div>
        </div>
        <div class="section2">
          <div class="container4">
            <div class="heading-and-content">
              <div class="heading1">All blog posts</div>
              <!-- <div class="content8"> -->
         <div class="content8">
              <?php
              $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
              $args = array(
                'post_type' => 'post',
                'posts_per_page' => 6,
                'paged' => $paged,
              );
              $wp_query = new WP_Query($args);
              $post_count = 0;
              while ($wp_query->have_posts()) :
                $wp_query->the_post();
                if ($post_count % 3 === 0) {
                  echo '<div class="row">';
                }
                $post_count++;
              ?>
                <div class="blog-post-card4">
                  <img class="image-icon4" alt="" src="<?php echo get_the_post_thumbnail_url(); ?>">

                  <div class="content3">
                    <div class="heading-and-subheading">
                      <div class="author"><?php echo get_the_date('l, j M Y'); ?></div>
                      <div class="heading-and-icon">
                        <div class="heading2">
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="icon-wrap">
                          <img class="arrow-up-right-icon" alt="" src="<?php echo get_template_directory_uri(); ?>/images/arrowupright.svg">
                        </div>
                      </div>
                      <div class="supporting-text1">
                        <?php the_excerpt(); ?>
                      </div>
                    </div>
                    <div class="categories">
                      <?php
                      $categories = get_the_category();
                      if ($categories) {
                        foreach ($categories as $category) {
                          echo '<div class="badge">';
                          echo '<div class="badge-base">';
                          echo '<div class="number">' . esc_html($category->name) . '</div>';
                          echo '</div>';
                          echo '</div>';
                        }
                      }
                      ?>
                    </div>
                  </div>
                </div>
              <?php
                if ($post_count % 3 === 0) {
                  echo '</div>';
                }
              endwhile;
              if ($post_count % 3 !== 0) {
                echo '</div>';
              }
              ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
              <div class="button1">
                <div class="button-base1">
                  <?php previous_posts_link('<img class="arrow-left-icon" alt="" src="<?php echo get_template_directory_uri(); ?>/images/arrowleft.svg"> Previous'); ?>
                </div>
              </div>
              <div class="pagination-numbers">
                <?php
                echo paginate_links(array(
                  'total' => $wp_query->max_num_pages,
                  'current' => $paged,
                  'prev_text' => __('Previous'),
                  'next_text' => __('Next'),
                ));
                ?>
              </div>
              <div class="button1">
                <div class="button-base1">
                  <?php next_posts_link('Next <img class="arrow-left-icon" alt="" src="<?php echo get_template_directory_uri(); ?>/images/arrowright.svg">'); ?>
                </div>
              </div>
            </div>

            <?php wp_reset_query(); ?>

              <!-- </div> -->
            </div>
    <!--         <div class="pagination">
              <div class="button1">
                <div class="button-base1">
                  <img
                    class="arrow-left-icon"
                    alt=""
                    src="./public/arrowleft.svg"
                  />

                  <div class="number">Previous</div>
                </div>
              </div>
              <div class="pagination-numbers">
                <div class="pagination-number-base">
                  <div class="content15">
                    <div class="number">1</div>
                  </div>
                </div>
                <div class="pagination-number-base1">
                  <div class="content15">
                    <div class="number">2</div>
                  </div>
                </div>
                <div class="pagination-number-base1">
                  <div class="content15">
                    <div class="number">3</div>
                  </div>
                </div>
                <div class="pagination-number-base1">
                  <div class="content15">
                    <div class="number">...</div>
                  </div>
                </div>
                <div class="pagination-number-base1">
                  <div class="content15">
                    <div class="number">8</div>
                  </div>
                </div>
                <div class="pagination-number-base1">
                  <div class="content15">
                    <div class="number">9</div>
                  </div>
                </div>
                <div class="pagination-number-base1">
                  <div class="content15">
                    <div class="number">10</div>
                  </div>
                </div>
              </div>
              <div class="button1">
                <div class="button-base1">
                  <div class="number">Next</div>
                  <img
                    class="arrow-left-icon"
                    alt=""
                    src="./public/arrowright.svg"
                  />
                </div> -->

                
              </div>
            </div>
          </div>
        </div>
      </div>
    
<?php get_footer(); ?>