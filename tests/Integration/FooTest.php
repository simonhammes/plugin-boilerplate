<?php
/**
 * Integration tests for Foo
 *
 * @package      Gamajo\PluginSlug\Tests\Integration
 * @author       Gary Jones
 * @copyright    2017 Gamajo
 * @license      GPL-2.0+
 */

declare( strict_types = 1 );

namespace Gamajo\PluginSlug\Tests\Integration;

use Gamajo\PluginSlug\Foo as Testee;
use BrightNucleus\Config\ConfigFactory;
use WP_UnitTestCase;

/**
 * Foo test case.
 */
class FooTest extends WP_UnitTestCase {
	
	protected static $user_id;

	public static function wpSetUpBeforeClass( WP_UnitTest_Factory $factory ) {
		self::$user_id = $factory->user->create(
			array(
				'role'   => 'administrator',
				'locale' => 'de_DE',
			)
		);
	}
	
	/**
	 * A single example test.
	 */
	public function test_foo(): void {
		// Replace this with some actual integration testing code.
		static::assertTrue( ( new Testee() )->is_true() );
	}
	
	public function test_action_to_plugin_textdomain_is_added(): void {
		$mock_config = [
			'Settings' => [],
			'Plugin'   => [
				'textdomain'    => 'apple',
				'languages_dir' => 'banana',
			],
		];

		$mock_config = ConfigFactory::createFromArray( $mock_config );
		
		// Replace this with some actual integration testing code.
		$plugin = new \Gamajo\PluginSlug\Plugin($mock_config);
		
		$plugin->run();
		
		static::assertIsInt( has_action( 'plugins_loaded', [ $plugin, 'load_textdomain' ] ), 'Loading textdomain is not hooked in correctly.' );
	}
	
	public function test_custom_action_to_plugin_textdomain_is_added(): void {
		$mock_config = [
			'Settings' => [],
			'Plugin'   => [
				'textdomain'    => 'apple',
				'languages_dir' => 'banana',
			],
		];

		$mock_config = ConfigFactory::createFromArray( $mock_config );
		
		// Replace this with some actual integration testing code.
		$plugin = new \Gamajo\PluginSlug\Plugin($mock_config);
		
		$plugin->run();
		
		static::assertIsInt( has_action( 'init', [ $plugin, 'action1' ] ) );
	}
	
	public function test_plugin_textdomain_is_loaded(): void {
		$mock_config = [
			'Settings' => [],
			'Plugin'   => [
				'textdomain'    => 'apple',
				'languages_dir' => 'banana',
			],
		];

		$mock_config = ConfigFactory::createFromArray( $mock_config );
		
		// Replace this with some actual integration testing code.
		$plugin = new \Gamajo\PluginSlug\Plugin($mock_config);
		
		$plugin->run();
		$plugin->load_textdomain();
		
		$a = do_action('plugins_loaded');
		
		//var_dump($GLOBALS['l10n']);
		
		
		
		//var_dump(is_textdomain_loaded('plugin_slug'));
		
		//var_dump($a);
		
		// self::assertTrue(is_textdomain_loaded('plugin_slug'));
		
		static::assertIsInt( has_action( 'plugins_loaded', [ $plugin, 'load_textdomain' ] ), 'Loading textdomain is not hooked in correctly.' );
	}
	
	public function test_bar_returns_correct_value_if_user_is_not_logged_in(): void {
		$foo = new Testee();
		// Replace this with some actual integration testing code.
		static::assertTrue( ( new Testee() )->is_true() );
		
		static::assertSame('Foo::bar()', $foo->bar());
	}
	
	public function test_bar_returns_correct_value_if_user_is_logged_in(): void {
		wp_set_current_user( self::$user_id );
		
		$foo = new Testee();
		// Replace this with some actual integration testing code.
		static::assertTrue( ( new Testee() )->is_true() );
		
		static::assertSame('Logged in', $foo->bar());
	}
	
}
