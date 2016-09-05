<?php
use OrzPicker\Catcher\ClientManager;

/**
 * ClientManagerTest.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/05 14:26
 */
class ClientManagerTest extends PHPUnit_Framework_TestCase
{

    public function testInstanceGetter()
    {
        $this->assertInstanceOf(ClientManager::class, $instance = ClientManager::getInstance());
        $this->assertEquals($instance, ClientManager::getInstance());
    }
}
