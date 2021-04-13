<?php
/**
 * Plugin Name: Share4Happy Youtube Playlist 
 * Plugin URI: http://share4happy.com
 * Description: Show all video of a youtube playlist.
 * Version: 0.1
 * Text Domain: share4happy-youtube-playlist
 * Author: Share4Happy 
 * Author URI: http://share4happy.com
 */

?>

<?php
require_once plugin_dir_path( __FILE__ ) . 'help.php';



function share4happy_enqueue_styles() {
    wp_enqueue_style( 'style', plugins_url( '/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'share4happy_enqueue_styles' );

function share4happy_enqueue_scripts() {
    wp_enqueue_script( 'script', plugins_url( '/script.js', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'share4happy_enqueue_scripts' );



function share4happy_youtube_playlist($atts) {
  $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=' .$atts['playlist_id']. '&key=' . $atts['api_key'];
  $response = wp_remote_get( $url );

  if ( ! is_wp_error( $response ) ) {
    $body = json_decode( wp_remote_retrieve_body( $response ), true );
?>

<div id="share4happy-youtube-playlist">
    <div class="media-player">
    <iframe id="frame-youtube" src="https://www.youtube.com/embed/<?php echo $body['items'][0]['snippet']['resourceId']['videoId'] ?>"></iframe>
    </div>

    <div class="playlist">
      <div class="playlist-wrapper">

<?php
    foreach( $body['items'] as $item ) {
      $title = $item['snippet']['title'];
      $id = $item['snippet']['resourceId']['videoId'];
      $thumbnail = $item['snippet']['thumbnails']['default']['url'];
?>

        <div class="playlist-item">
          <div class="playlist-item-wrapper">
            <img src="<?php echo $thumbnail ?>" onclick="updateFrameYoutube(event, '<?php echo $id ?>')">
            <div class="playlist-item-title">
              <a href="https://youtu.be/<?php echo $id ?>" target="_blank"><?php echo $title ?></a>
            </div>
          </div>
        </div>

<?php
    }
?>
      </div>
    </div>
  </div>

<?php
  }
}

add_shortcode('share4happy-youtube-playlist', 'share4happy_youtube_playlist');
?>

