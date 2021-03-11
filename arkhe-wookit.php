<?php
/**
 * Plugin Name: Arkhe Wookit
 * Plugin URI: https://arkhe-theme.com/
 * Description: Plugin to make Arkhe compatible with WooCommerce.
 * Version: 0.2.1
 * Author: LOOS,Inc.
 * Author URI: https://loos.co.jp/
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: arkhe-wookit
 * Domain Path: /languages
 *
 * @package Arkhe Wookit
 */

defined( 'ABSPATH' ) || exit;

/**
 * 定数定義
 */
define( 'ARKHE_WOO_VERSION', ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? date_i18n( 'mdGis' ) : '0.2.1' );
define( 'ARKHE_WOO_URL', plugins_url( '/', __FILE__ ) );
define( 'ARKHE_WOO_PATH', plugin_dir_path( __FILE__ ) );


/**
 * Autoload Class files.
 */
spl_autoload_register(
	function( $classname ) {
		// Arkhe_Woo の付いたクラスだけを対象にする。
		if ( strpos( $classname, 'Arkhe_Woo' ) === false ) return;

		$classname = str_replace( '\\', '/', $classname );
		$classname = str_replace( 'Arkhe_Woo/', '', $classname );

		$file = ARKHE_WOO_PATH . 'classes/' . $classname . '.php';
		if ( file_exists( $file ) ) {
			require $file;
		}
	}
);


/**
 * プラグイン実行クラス
 */
class Arkhe_Woo extends \Arkhe_Woo\Data {

	// use \Arkhe_Woo\Utility;

	public function __construct() {

		// テーマチェック : IS_ARKHE_THEME は Arkheプラグインで共通
		if ( ! defined( 'IS_ARKHE_THEME' ) ) {
			$theme_data     = wp_get_theme();
			$theme_name     = $theme_data->get( 'Name' );
			$theme_template = $theme_data->get( 'Template' );

			$is_arkhe_theme = ( 'Arkhe' === $theme_name || 'arkhe' === $theme_template );
			define( 'IS_ARKHE_THEME', $is_arkhe_theme );
		}

		if ( ! IS_ARKHE_THEME ) return;

		// WooCommerceチェック
		if ( ! function_exists( 'is_woocommerce_activated' ) ) {
			function is_woocommerce_activated() {
				return class_exists( 'woocommerce' );
			}
		}
		if ( ! is_woocommerce_activated() ) return;

		// 翻訳ファイルを登録
		$locale = apply_filters( 'plugin_locale', determine_locale(), 'arkhe-wookit' );
		load_textdomain( 'arkhe-wookit', ARKHE_WOO_PATH . 'languages/arkhe-wookit-' . $locale . '.mo' );

		// データセット
		// self::init();

		// Wooセットアップ
		require_once ARKHE_WOO_PATH . 'inc/setup.php';

		// ファイルの読み込み
		require_once ARKHE_WOO_PATH . 'inc/enqueue_scripts.php';

		// テンプレート上書き
		require_once ARKHE_WOO_PATH . 'inc/overwrite_template.php';

		// ウィジェット
		require_once ARKHE_WOO_PATH . 'inc/widget.php';

		// その他、フック処理
		require_once ARKHE_WOO_PATH . 'inc/hooks.php';

		// 管理メニュー
		// require_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu.php';
		require_once ARKHE_WOO_PATH . 'inc/admin_toolbar.php';

		// アップデート
		if ( is_admin() ) {
			require_once ARKHE_WOO_PATH . 'inc/update.php';
		}
	}
}


/**
 * プラグインファイルの実行
 */
add_action( 'plugins_loaded', function() {
	new Arkhe_Woo();
} );
