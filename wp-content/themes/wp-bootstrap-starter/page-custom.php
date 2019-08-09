<?php
/**
 * Template Name: Page Detail team
 */

get_header();
?>
    <div class="col-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item custom-nav ml-5 col-md-2 col-sm-12">
                <a class="nav-link active dev" id="nav-dev-tab" data-toggle="pill" href="#dev-tab" role="tab"
                   aria-controls="pills-home" aria-selected="true">
                    DEVELOPMENT <br> AND <br> TEST
                </a>
            </li>
            <li class="nav-item custom-nav offset-1 col-md-2 col-sm-12">
                <a class="nav-link " id="nav-sap-tab" data-toggle="pill" href="#sap-tab" role="tab"
                   aria-controls="pills-profile" aria-selected="false">
                    APPLICATION <br>SUPPORT
                </a>
            </li>
            <li class="nav-item custom-nav offset-1 col-md-2 col-sm-12">
                <a class="nav-link " id="nav-data-tab" data-toggle="pill" href="#data-tab" role="tab"
                   aria-controls="data-tab" aria-selected="false">
                    DATA <br> MAINTENANCE
                </a>
            </li>
            <li class="nav-item custom-nav offset-1 col-md-2 col-sm-12">
                <a class="nav-link " id="nav-support-tab" data-toggle="pill" href="#support-tab" role="tab"
                   aria-controls="support-tab" aria-selected="false">
                    SUPPORT <br> TEAM
                </a>
            </li>

        </ul>

        <div class="tab-content mt-5" id="pills-tabContent">
            <div class="tab-pane fade show active" id="dev-tab" role="tabpanel" aria-labelledby="dev-tab">
                <div class="row">
                    <?php
                    $arg = array(
                        'name' => 'dev-post',
                        'post_type' => 'post',
                        'post_status' => 'publish',
                    );
                    $posts = get_posts($arg);
                    foreach ($posts as $post) {
                       var_dump(get_post_gallery($post->ID));

                        echo '<div class="col-md-8 content-tab">
                                <h3 class="title-post">
                                ' . $post->post_title . '
                                </h3> ' . $post->post_content . '</div>';
                        $fields = get_field('images', $post->ID);
                        echo '<div class="col-md-4 float-right"><img src="' . $fields["url"] . '" class="float-right"/> </div>';
                    }
                    ?>
                </div>
                <div class="row">
                    <?php
                    $arg = array(
                        'name' => 'test-post',
                        'post_type' => 'post',
                        'post_status' => 'publish',
                    );
                    $posts = get_posts($arg);

                    foreach ($posts as $post) {
                        $fields = get_field('images', $post->ID);
                        echo '<div class="col-md-4"><img src="' . $fields["url"] . '" /> </div>';
                        echo '<div class="col-md-8 content-tab">
                                    <div class="row">
                                        <h3 class="col-12 title-post-right">' . $post->post_title . '</h3>
                                        </div>
                                        <div class="col-12">' .
                            $post->post_content . '</div>
                                  </div>';


                    }
                    ?>
                </div>
                <div class="row">

                </div>

            </div>
            <div class="tab-pane fade" id="sap-tab" role="tabpanel" aria-labelledby="sap-tab">
                <div class="row">
                    <?php
                    $arg = array(
                        'name' => 'sap-post',
                        'post_type' => 'post',
                        'post_status' => 'publish',
                    );
                    $posts = get_posts($arg);
                    foreach ($posts as $post) {
                        echo '<div class="col-md-8 content-tab">
                                <h3 class="title-post">
                                ' . $post->post_title . '
                                </h3> ' . $post->post_content . '</div>';
                        $fields = get_field('images', $post->ID);

                        echo '<div class="col-md-4 float-right"><img src="' . $fields["url"] . '" class="float-right"/> </div>';


                    }
                    ?>
                </div>

                <div class="row">

                </div>
            </div>
            <div class="tab-pane fade" id="data-tab" role="tabpanel" aria-labelledby="data-tab">
                <div class="row">
                    <?php
                    $arg = array(
                        'name' => 'data-post',
                        'post_type' => 'post',
                        'post_status' => 'publish',
                    );
                    $posts = get_posts($arg);
                    foreach ($posts as $post) {
                        $fields = get_field('images', $post->ID);
                        echo '<div class="col-md-4"><img src="' . $fields["url"] . '" /> </div>';
                        echo '<div class="col-md-8 content-tab">
                                    <div class="row">
                                        <h3 class="col-12 title-post-right">' . $post->post_title . '</h3>
                                        </div>
                                        <div class="col-12">' .
                            $post->post_content . '</div>
                                  </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="support-tab" role="tabpanel" aria-labelledby="support-tab">
                <div class="row">
                    <?php
                    $arg = array(
                        'name' => 'support-post',
                        'post_type' => 'post',
                        'post_status' => 'publish',
                    );
                    $posts = get_posts($arg);
                    foreach ($posts as $post) {
                        $fields = get_field('images', $post->ID);
                        echo '<div class="col-md-4"><img src="' . $fields["url"] . '" /> </div>';
                        echo '<div class="col-md-8 content-tab">
                                    <div class="row">
                                        <h3 class="col-12 title-post-right">' . $post->post_title . '</h3>
                                        </div>
                                        <div class="col-12">' .
                            $post->post_content . '</div>
                                  </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();
