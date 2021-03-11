<?php
namespace Arkhe_Woo;

defined( 'ABSPATH' ) || exit;

class Data {

	// 設定データを保持する変数
	protected static $data     = [];
	protected static $defaults = [];

	//  定数
	// const DB_NAME = 'arkhe_wookit';
	// const MENU_SLUG = 'arkhe_wookit';

	// メニューの設定タブ
	// public static $menu_tabs = [];

	// 外部からインスタンス化させない
	private function __construct() {}

	// init()
	// public static function init() {}

}
