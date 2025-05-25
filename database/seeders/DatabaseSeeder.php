<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call([

			\App\Domain\User\Database\Seeds\RoleTableSeeder::class,
			\App\Domain\User\Database\Seeds\UserTableSeeder::class,
			\App\Domain\General\Database\Seeds\SliderTableSeeder::class,
			\App\Domain\Interaction\Database\Seeds\ContactTableSeeder::class,
			\App\Domain\Setting\Database\Seeds\MemberTableSeeder::class,
			\App\Domain\General\Database\Seeds\ServiceTableSeeder::class,
			\App\Domain\Interaction\Database\Seeds\AnnouncementTableSeeder::class,
			\App\Domain\Setting\Database\Seeds\BlockIpTableSeeder::class,
			\App\Domain\Interaction\Database\Seeds\MailTemplateTableSeeder::class,
			\App\Domain\Setting\Database\Seeds\QuickLinkTableSeeder::class,
			\App\Domain\Interaction\Database\Seeds\MailTableSeeder::class,
			\App\Domain\General\Database\Seeds\TodoTableSeeder::class,
			\App\Domain\General\Database\Seeds\CategoryTableSeeder::class,
			\App\Domain\Ticket\Database\Seeds\DepartmentTableSeeder::class,
			\App\Domain\Ticket\Database\Seeds\SeverityTableSeeder::class,
			\App\Domain\Ticket\Database\Seeds\StatusTableSeeder::class,
			\App\Domain\Ticket\Database\Seeds\TicketTableSeeder::class,

			\App\Domain\Cms\Database\Seeds\ArticleTableSeeder::class,
			\App\Domain\Cms\Database\Seeds\FaqTableSeeder::class,

			\App\Domain\Setting\Database\Seeds\SettingTableSeeder::class,

			###SEEDER_CLASS###
        ]);

    }
}
