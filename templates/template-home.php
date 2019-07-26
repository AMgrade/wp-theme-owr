<?php
/**
 * Template Name: Home Page
 */
?>

<?php get_header();
$post_id = get_the_ID();
$owr_top_background_image = get_field( 'owr_top_background_image', $post_id );
$owr_top_title_headline   = get_field( 'owr_top_title_headline', $post_id );
$owr_latitude             = get_field( 'owr_latitude', $post_id );
$owr_longitude            = get_field( 'owr_longitude', $post_id );
$owr_support_link         = get_field( 'owr_support_link', $post_id );

?>

    <!-- Headline Section -->
    <div class="headline-section"
         style='background: url("<?php echo $owr_top_background_image['url']; ?>") center no-repeat; background-size: cover;'>
        <!-- Begin Headline text -->
        <div class="headline-text-wrap">
            <div class="headline-text">
                <h1><?php echo $owr_top_title_headline; ?></h1>
            </div>
        </div><!-- End Headline text -->
    </div><!--End Headline Section -->

    <!-- Our work Section -->
    <div class="section-wrap our-work-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Our <span class="section-title-blue">work</span></h2>
                    </div>
                </div>
            </div>
            <div class="our-work-wrap">
                <div class="row">

					<?php
					$args      = [
						'post_type' => 'our_work',
						'order'     => 'ASC'
					];
					$old_query = $wp_query;
					$wp_query  = new WP_Query( $args );
					while(have_posts()) : the_post();
						$description = get_the_content(); ?>

                        <div class="col-md-6">
                            <div class="our-work-item">
                                <div class="image">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="our-work">
                                    <div class="post-title">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                </div>
                                <div class="our-work-descr"><?php do_excerpt_symbols( $description, 340 ); ?></div>
                                <div class="learn-more">
                                    <a href="<?php echo get_permalink() ?>">Learn more</a>
                                </div>
                            </div>
                        </div>

					<?php endwhile;
					$wp_query = $old_query;
					?>

                </div>
            </div>
        </div>
    </div><!--End Our work Section -->

    <!--Featured Stories Section -->
    <div class="section-wrap featured-stories-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Featured <span class="section-title-blue">Stories</span></h2>
                    </div>
                </div>
            </div>
            <div class="featured-stories-wrap">
                <div class="row justify-content-center">

					<?php
					$args      = [
						'post_type'      => 'stories',
						'posts_per_page' => '3',
						'order'          => 'DESC'
					];
					$old_query = $wp_query;
					$wp_query  = new WP_Query( $args );
					while(have_posts()) : the_post();
						$except_title      = get_the_title();
						$owr_st_autor_foto = get_field( 'owr_st_autor_foto' );
						$owr_st_autor_name = get_field( 'owr_st_autor_name' );
						$description       = get_field( 'owr_st_except' ); ?>

                        <div class="col-md-6 col-lg-4">
                            <div class="featured-item">
                                <div class="image"
                                     style="background: url('<?php the_post_thumbnail_url(); ?>') center no-repeat; background-size: cover"></div>
                                <div class="featured-description">
                                    <div class="autor-wrap">
                                        <div class="autor-foto">
                                            <img src="<?php echo $owr_st_autor_foto['url'] ?>"
                                                 alt="<?php echo $owr_st_autor_foto['alt'] ?>">
                                        </div>
                                        <div class="autor-name">
											<?php echo $owr_st_autor_name; ?>
                                        </div>
                                        <div class="post-date">
											<?php echo get_the_date( 'M j Y' ); ?>
                                        </div>
                                        <div class="fuatered-post-name">
                                            <a href="<?php echo get_permalink() ?>"><?php do_excerpt_title( $except_title, 26 ); ?></a>
                                        </div>
                                    </div>
                                    <div class="except">
										<?php do_excerpt_symbols( $description, 125 ); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

					<?php endwhile;
					$wp_query = $old_query;
					?>

                </div>
            </div>
        </div>
    </div><!--End Featured Stories Section -->

    <!--Media gallery Section -->
    <div class="section-wrap media-gallery-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Media <span class="section-title-blue">Gallery</span></h2>
                    </div>
                    <div class="single-article-title">
                        <div class="title-wrap">
                            <h1>Photos</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="photo-gallery-wrap">
                <div class="flexbin flexbin-margin">
                    <?php

                    if( have_rows('photo_gallery', 'option') ):
                        $i = 0;

                        while ( have_rows('photo_gallery', 'option') ) : the_row();

                            $photo_src = get_sub_field('photo');
                            $url = $photo_src['url'];
                            $alt = $photo_src['alt'];
                            $size = 'medium';
                            $thumb = $photo_src['sizes'][ $size ];

                            $photo_short_description = get_sub_field('photo_short_description');
                            $i++;
                            if( $i > 8 ):
                                break;
		                    endif; ?>

                            <div>
                                <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
                                <div class="overlay">
                                    <?php echo $photo_short_description; ?>
                                </div>
                            </div>

                        <?php endwhile;

                    endif;

                    ?>
                    <div class="photo photo-link" style="background: #2D9CDB;">
                        <a href="/media-gallery/"><span>Check out more photos & videos</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Where we are Section -->
    <div class="section-wrap where-we-are-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>Where <span class="section-title-blue">we are</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <div id="map" class="google-map-wrap"></div>
		<?php if(isset( $owr_support_link ) && $owr_support_link) : ?>
            <a href="<?php echo $owr_support_link; ?>" class="btn btn-primary owr-btn">Support</a>
		<?php endif; ?>
    </div>
    <!-- End Where we are Section -->

    <!-- google maps api -->
    <script>
        function initMap() {
            var place = {lat: <?php echo $owr_latitude; ?>, lng: <?php echo $owr_longitude; ?>};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: place,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false,
                styles: [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#d2ebca"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dadada"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffeb3b"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c9c9c9"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#cae0f6"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    }
                ]
            });
            var marker = new google.maps.Marker({
                position: place,
                map: map,
                icon: {
                    url: "/wp-content/themes/owr/assets/img/map-marker.svg",
                    scaledSize: new google.maps.Size(22, 28)
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&callback=initMap"></script>

<?php get_footer(); ?>
