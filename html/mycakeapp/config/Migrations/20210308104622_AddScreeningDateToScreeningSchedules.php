<?php
use Migrations\AbstractMigration;

class AddScreeningDateToScreeningSchedules extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    // screening_dateカラムを追加
    public function change()
    {
        $table = $this->table('screening_schedules');
        $table->addColumn('screening_date', 'date', [
            'default' => null,
            'null' => false,
            'after' => 'movie_id'
        ]);
        $table->update();
    }
}
