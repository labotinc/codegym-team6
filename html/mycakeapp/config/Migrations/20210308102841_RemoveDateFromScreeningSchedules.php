<?php
use Migrations\AbstractMigration;

class RemoveDateFromScreeningSchedules extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    // dateカラムを削除
    public function change()
    {
        $table = $this->table('screening_schedules');
        $table->removeColumn('date');
        $table->update();
    }
}
