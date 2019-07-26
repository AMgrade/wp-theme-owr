<?php
/**
 * Template Name: Our Work Page
 */
?>

<?php get_header();

$owr_owp_background_image = get_field('owr_owp_background_image', $post_id);
$owr_owp_title_headline   = get_field('owr_owp_title_headline', $post_id);
$owr_owp_latitude         = get_field('owr_owp_latitude', $post_id);
$owr_owp_longitude        = get_field('owr_owp_longitude', $post_id);

?>

    <!-- Headline Section -->
    <div class="headline-section">
        <div id="map" class="google-map-wrap"></div>
    </div>
    <!--End Headline Section -->

    <!-- What we do Section -->
    <div class="section-wrap what-we-do-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title">
                        <h2>What <span class="section-title-blue">we do</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="headline-section" style='background: url("<?php echo $owr_owp_background_image['url']; ?>") center no-repeat; background-size: cover;'>
            <div class="headline-text-wrap">
                <div class="headline-text">
                    <?php echo $owr_owp_title_headline; ?>
                </div>
            </div>
        </div>
    </div><!--End What we do Section -->

    <!-- Our work Section -->
    <div class="section-wrap our-work-section">
        <div class="container">
            <div class="our-work-wrap">
                <div class="row">

                    <?php
                    $args = array(
                        'post_type' => 'our_work',
                        'order' => 'ASC'
                    );
                    $old_query = $wp_query;
                    $wp_query = new WP_Query( $args );
                    while ( have_posts() ) : the_post();
                        $description = get_the_content(); ?>

                        <div class="col-md-6">
                            <div class="our-work-item">
                                <div class="image">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="our-work">
                                    <div class="post-title">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                </div>
                                <div class="our-work-descr"><?php echo do_excerpt_symbols( $description,340 ); ?></div>
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

    <!-- google maps api -->
    <script>
        function initMap() {
            var place = {lat: <?php echo $owr_owp_latitude; ?>, lng: <?php echo $owr_owp_longitude; ?>};
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
