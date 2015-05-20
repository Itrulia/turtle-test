<?php namespace Tests\Services\Avatar;

use Battleborn\Services\Avatar\Gravatar;
use TestCase;
use Mockery;
use Mockery\MockInterface;

class GravatarTest extends TestCase {

	/**
	 * @var Gravatar
	 */
	protected $gravatar;

	public function __construct($name = null, array $data = array(), $dataName = '') {
		parent::__construct($name, $data, $dataName);

		$this->gravatar = new Gravatar();
	}


	public function testGetAvatar()
	{
		$user = Mockery::mock('Battleborn\User', function(MockInterface $mock) {
			$mock->makePartial();
			$mock->email = 'info@karl-merkli.ch';
		});

		$result = $this->gravatar->getAvatar($user);
		$expected = 'http://www.gravatar.com/avatar/d9f7d064e522b26a3821a504876f451a';

		$this->assertEquals($expected, $result);
	}

}
