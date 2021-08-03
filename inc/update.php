<?php
/**
 * アップデートチェック
 */
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function() {
	if ( ! class_exists( '\Puc_v4_Factory' ) ) {
		require_once ARKHE_WOO_PATH . 'inc/update/plugin-update-checker.php';
	}
	if ( class_exists( '\Puc_v4_Factory' ) ) {
		\Puc_v4_Factory::buildUpdateChecker(
			'https://looscdn.com/cdn/arkhe/update/arkhe-wookit-k7df20.json',
			ARKHE_WOO_PATH . 'arkhe-wookit.php',
			'arkhe-wookit'
		);
	}
});

// プラグインの画像をセット
add_action( 'admin_head', function() {
	global $hook_suffix;
	if ( 'update-core.php' !== $hook_suffix ) return;
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var ths = document.querySelectorAll('.updates-table .plugin-title');

			for (var i = 0; i < ths.length; i++) {
				var elem = ths[i];
				var title = elem.querySelector('strong');
				var img = elem.querySelector('.dashicons');

				if ( ! title || ! img ) continue;

				if ('Arkhe Wookit' === title.textContent) {
					img.classList.add('-arkhe-wookit');
				}
			}
		});
	</script>

	<style>
	.plugin-title .dashicons.-arkhe-wookit::before{
		content:none;
	}
	.plugin-title .dashicons.-arkhe-wookit{
		padding-right: 0;
		margin-right: 10px;
		<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		background:url(<?=ARKHE_WOO_URL?>thumbnail.jpg) no-repeat center / cover;
	}
	</style>
	<?php
});
