<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScreeningSchedulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScreeningSchedulesTable Test Case
 */
class ScreeningSchedulesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScreeningSchedulesTable
     */
    public $ScreeningSchedules;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ScreeningSchedules',
        'app.Movies',
        'app.ReservedSeats',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ScreeningSchedules') ? [] : ['className' => ScreeningSchedulesTable::class];
        $this->ScreeningSchedules = TableRegistry::getTableLocator()->get('ScreeningSchedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ScreeningSchedules);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
