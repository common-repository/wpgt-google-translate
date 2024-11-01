<?php
/**
 * Google Widget for WordPress
 *
 * @package WPGT/Widget
 */

if ( ! class_exists( 'Wpgt_Widget' ) ) {

	/**
	 * Creating the widget
	 *
	 * @since 1.0
	 */
	class Wpgt_Widget extends WP_Widget {

		/**
		 * Default Constructor
		 *
		 * @since 1.0
		 */
		public function __construct() {
			parent::__construct(
				'wpgt_google_translate', // Base ID of your widget.
				__( 'Google Translate', 'wpgt-google-translate' ), // Widget name will appear in UI.
				array( 'description' => __( 'Translate your WordPress Website', 'wpgt-google-translate' ) ) // Widget description.
			);
		}

		/**
		 * Creating widget front-end
		 *
		 * @param array $args Arguments.
		 * @param array $instance Instance.
		 * @since 1.0
		 */
		public function widget( $args, $instance ) {

			$title = apply_filters( 'wpgt_widget_title', $instance['title'] );

			// phpcs:disable
			// before and after widget arguments are defined by themes.
			echo $args['before_widget'];

			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			if ( isset( $instance['wpgt_translate'] ) && 'on' === $instance['wpgt_translate'] ) {
				wpgt_language_field( 'widget' );
			}

			echo $args['after_widget'];
			// phpcs:enable
		}

		/**
		 * Widget Backend
		 *
		 * @param array $instance Widget Instance.
		 * @since 1.0
		 */
		public function form( $instance ) {

			$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Language', 'wpgt-google-translate' );

			// Widget admin form.
			// phpcs:disable
			?>
			<p>
				<label for="<?php esc_attr_e( $this->get_field_id( 'title' ) ); ?>"><?php __( 'Title:', 'wpgt-google-translate' ); ?></label> 
				<input class="widefat" id="<?php esc_attr_e( $this->get_field_id( 'title' ) ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php esc_attr_e( $this->get_field_id( 'wpgt_translate' ) ); ?>"><?php esc_html_e( 'Enable Google Translator:', 'wpgt-google-translate' ); ?></label>
				<?php
				$wpgt_translate = '';
				if ( isset( $instance['wpgt_translate'] ) && 'on' === $instance['wpgt_translate'] ) {
					$wpgt_translate = 'checked';
				}
				?>
				<input class="checkbox" type="checkbox" <?php echo esc_attr( $wpgt_translate ); ?> id="<?php echo esc_attr( $this->get_field_id( 'wpgt_translate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('wpgt_translate') ); ?>" />
			</p>
			<?php
			// phpcs:enable
		}

		/**
		 * Updating widget replacing old instances with new
		 *
		 * @param array $new_instance New Instance.
		 * @param array $old_instance Old Instance.
		 *
		 * @since 1.0
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                   = array();
			$instance['title']          = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
			$instance['wpgt_translate'] = ( ! empty( $new_instance['wpgt_translate'] ) ) ? wp_strip_all_tags( $new_instance['wpgt_translate'] ) : '';

			return $instance;
		}
	}
	new Wpgt_Widget();
}
