<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package arkatheme
 */

get_header();
?>

  <div class="single-article">
      <div class="single-article-child"></div>
            <?php the_post_thumbnail('thumbnail', ['class' => 'single-article-item', 'alt' => '']); ?>

      <div class="excerpt2">
       <?php the_content(); ?>
      </div>
   
      <b class="other-interesting-posts">Other interesting posts</b>
      <div class="rectangle-div"></div>
      <div class="single-article-child1"></div>
      <div class="post1">
        <div class="post-left1">
          <div class="double-tag-group">
            <div class="double-tag1">
              <div class="tag2">
                <div class="tutorials">Weekly updates</div>
              </div>
              <div class="tag3">
                <div class="august-13-20211">AUGust 13, 2021</div>
              </div>
            </div>
            <b class="heading1"
              >10 Hilarious Cartoons That Depict Real-Life Problems of
              Programmers</b
            >
          </div>
          <div class="excerpt6">
            Redefined the user acquisition and redesigned the onboarding
            experience, all within 3 working weeks.
          </div>
        </div>
        <img
          class="post-thumbnail-icon1"
          alt=""
          src="<?php echo get_template_directory_uri(); ?>/images/post-thumbnail1@2x.png"
        />
      </div>
      <div class="post2">
        <div class="post-left1">
          <div class="double-tag-group">
            <div class="double-tag1">
              <div class="tag2">
                <div class="tutorials">Weekly updates</div>
              </div>
              <div class="tag3">
                <div class="august-13-20211">AUGust 13, 2021</div>
              </div>
            </div>
            <b class="heading1"
              >10 Hilarious Cartoons That Depict Real-Life Problems of
              Programmers</b
            >
          </div>
          <div class="excerpt6">
            Redefined the user acquisition and redesigned the onboarding
            experience, all within 3 working weeks.
          </div>
        </div>
        <img
          class="post-thumbnail-icon1"
          alt=""
          src="<?php echo get_template_directory_uri(); ?>/images/post-thumbnail2@2x.png"
        />
      </div>
      <div class="post3">
        <div class="post-left1">
          <div class="double-tag-group">
            <div class="double-tag1">
              <div class="tag2">
                <div class="tutorials">Weekly updates</div>
              </div>
              <div class="tag3">
                <div class="august-13-20211">AUGust 13, 2021</div>
              </div>
            </div>
            <b class="heading1"
              >10 Hilarious Cartoons That Depict Real-Life Problems of
              Programmers</b
            >
          </div>
          <div class="excerpt6">
            Redefined the user acquisition and redesigned the onboarding
            experience, all within 3 working weeks.
          </div>
        </div>
        <img
          class="post-thumbnail-icon1"
          alt=""
          src="<?php echo get_template_directory_uri(); ?>/images/post-thumbnail3@2x.png"
        />
      </div>
      <div class="single-article-child2"></div>
      <b class="post-title"
        ><?php the_title(); ?></b
      >
      <div class="rectangle-parent">
        <div class="group-child"></div>
        <div class="post-title1">Copyright 2021 - Elikem Daniels</div>
      </div>
      <div class="blockquote1">
        <div class="excerpt9">
          Design comps, layouts, wireframes—will your clients accept that you go
          about things the facile way? Authorities in our business will tell in
          no uncertain terms that Lorem Ipsum is that huge, huge no no to
          forswear forever.
        </div>
      </div>
      <div class="double-tag4">
        <div class="tag8">
        	 <?php
        // Display the post categories.
        $categories = get_the_category();
        if ($categories) {
            echo '<div class="tutorials">';
            foreach ($categories as $category) {
                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                if ($category !== end($categories)) {
                    echo '&nbsp;&nbsp;';
                	echo get_the_date(); 
                    exit();
                }
            }
            echo '</div>';
        }
        ?>
           
        </div>
      </div>
      <img class="group-icon" alt="" src="<?php echo get_template_directory_uri(); ?>/images/group-73.svg" />

      <div class="rectangle-group">
        <div class="frame-child"></div>
        <img class="subtract-icon" alt="" src="<?php echo get_template_directory_uri(); ?>/images/subtract.svg" />

        <b class="heading4">Subscribe to my blog.</b>
        <div class="excerpt10">I post fresh content every week.</div>
        <div class="group-parent">
          <div class="rectangle-container">
            <div class="group-item"></div>
            <div class="post-title2">Email address</div>
          </div>
         
        </div>
      </div>
     
    </div>
<?php
// get_sidebar();
get_footer();
