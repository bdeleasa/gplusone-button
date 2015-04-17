<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class GPlusOne_Button_Options {

	/**
	 * Option key, and option page slug
	 * @var string
	 */
	private $key = 'gplusone_button_options';

	/**
	 * Options page metabox id
	 * @var string
	 */
	private $metabox_id = 'gplusone_button_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';


	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {

		// Set our title
		$this->title = __( 'Google Plus Button', 'gplusone_button' );

	}


	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {

		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_init', array( $this, 'add_options_page_metabox' ) );

	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {

		register_setting( $this->key, $this->key );

	}


	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {

		$this->options_page = add_options_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

	}


	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>

		<div class="wrap cmb2_options_page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
          <p>To output the Google Plus button, use the <code style="display: inline;">[gplusone-button]</code> shortcode.</p>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>

	<?php
	}


	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		$cmb = new_cmb2_box( array(
			'id'      => $this->metabox_id,
			'hookup'  => false,
			'show_on' => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// Set our CMB2 fields

		$cmb->add_field( array(
			'name' => __( 'URL', 'gplusone_button' ),
			'desc' => __( 'the URL of the page that is to be liked', 'gplusone_button' ),
			'id'   => 'href',
			'type' => 'text_url',
			'default' => get_bloginfo('url'),
		) );

		$cmb->add_field( array(
			'name' => __( 'Size', 'gplusone_button' ),
			'id'   => 'size',
			'type' => 'select',
			'default' => 'button',
			'options'          => array(
				'small'         => __( 'Small', 'cmb' ),
				'medium'        => __( 'Medium', 'cmb' ),
				'standard'      => __( 'Standard', 'cmb' ),
				'tall'          => __( 'Tall', 'cmb' ),
			),
		) );

		$cmb->add_field( array(
			'name' => __( 'Annotation', 'gplusone_button' ),
			'id'   => 'annotation',
			'type' => 'select',
			'default' => 'like',
			'options'          => array(
				'inline'        => __( 'Inline', 'cmb' ),
				'bubble'        => __( 'Bubble', 'cmb' ),
                'none'          => __( 'None', 'cmb' ),
			),
		) );

		$cmb->add_field( array(
			'name' => __( 'JS Callback Function', 'gplusone_button' ),
			'id'   => 'callback',
			'type' => 'text',
		) );

	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {

		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );

	}

}


/**
 * Helper function to get/return the gplusone_button_options object
 * @since  0.1.0
 * @return gplusone_button_options object
 */
function gplusone_button_options_object() {
  static $object = null;
  if ( is_null( $object ) ) {
    $object = new GPlusOne_Button_Options();
    $object->hooks();
  }
  return $object;
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function gplusone_button_get_option( $key = '' ) {
	return cmb2_get_option( gplusone_button_options_object()->key, $key );
}
