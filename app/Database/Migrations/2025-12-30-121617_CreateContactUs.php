<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactUs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'address_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'phone_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'phone_numbers' => [ // Maps to user's 'number' array
                'type' => 'JSON',
                'null' => true,
            ],
            'emails_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'emails' => [ // Maps to user's 'emails' array
                'type' => 'JSON',
                'null' => true,
            ],
            'contact_heading' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'contact_btn_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'contact_btn_url' => [ // Inferred useful field
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'branch_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'branch_heading' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'branches' => [ // Array of objects
                'type' => 'JSON',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contact_us');
    }

    public function down()
    {
        $this->forge->dropTable('contact_us');
    }
}
