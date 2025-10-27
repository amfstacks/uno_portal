<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSchoolsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'short_name' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'logo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'primary_color' => ['type' => 'VARCHAR', 'constraint' => 7, 'default' => '#1e40af'],
            'secondary_color' => ['type' => 'VARCHAR', 'constraint' => 7, 'default' => '#1e293b'],
            'header_html' => ['type' => 'TEXT', 'null' => true],
            'footer_html' => ['type' => 'TEXT', 'null' => true],
            'custom_css' => ['type' => 'TEXT', 'null' => true],
            'custom_js' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('schools');
    }

    public function down()
    {
        $this->forge->dropTable('schools');
    }
}