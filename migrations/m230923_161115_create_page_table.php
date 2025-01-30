<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m230923_161115_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(), // copy from admin
            'parent' => $this->integer(11)->unsigned(), // copy from admin
            'template' => $this->tinyInteger(3)->unsigned()->notNull(),
            'permalink' => $this->string(255)->notNull()->unique(),
            'redirect' => $this->string(255), // copy from admin
            'title' => $this->string(255),
            'description' => $this->string(255),
            'image' => $this->string(255),
            'tag_header' => $this->text(),
            'tag_body' => $this->text(),
            'content' => $this->text(), // copy from admin
            'content_aside' => $this->text(), // copy from admin
            'content_two_title_on' => $this->tinyInteger(1)->unsigned(), // copy from admin
            'content_two_title' => $this->string(255), // copy from admin
            'content_two_on' => $this->tinyInteger(1)->unsigned(), // copy from admin
            'content_two' => $this->text(), // copy from admin
            'content_two_aside' => $this->text(), // copy from admin
            'skryt_na_poddomene' => $this->tinyInteger(1)->unsigned(), // copy from admin
            'city' => $this->text(), // copy from admin
            'sh_pricerow' => $this->integer(11)->unsigned(), // copy from admin
            'customprice' => $this->text(), // copy from admin
            'table' => $this->text(), // copy from admin
            'after_table' => $this->text(), // copy from admin

            'banner_id' => $this->integer(11)->unsigned(),
            'sidebar_visible' => $this->tinyInteger(1)->unsigned(),
            'sidebar_menu' => $this->string(255),
            'block_leadback_price_visible' => $this->tinyInteger(1)->unsigned(),
            'block_masters_visible' => $this->tinyInteger(1)->unsigned(),
            'block_reviews_visible' => $this->tinyInteger(1)->unsigned(),
            'block_benefits_visible' => $this->tinyInteger(1)->unsigned(),
            'block_how_we_work_visible' => $this->tinyInteger(1)->unsigned(),
            'block_how_we_work_4_title' => $this->string(255),
            'block_how_we_work_4_text' => $this->text(),
            'block_ulicy_visible' => $this->tinyInteger(1)->unsigned(),
            'block_districts_visible' => $this->tinyInteger(1)->unsigned(),
            'block_leadback_visible' => $this->tinyInteger(1)->unsigned(),

            'visible' => $this->tinyInteger(1)->unsigned()->defaultValue(1)->notNull(),
            'lastmod' => $this->integer(11)->unsigned(), // copy from admin
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}
