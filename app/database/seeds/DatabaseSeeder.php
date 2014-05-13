<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('ClientsTableSeeder');
		$this->call('TutorsTableSeeder');
		$this->call('AcademicsTableSeeder');
		$this->call('HiredtutorsTableSeeder');
		$this->call('ClientcoursesTableSeeder');
		$this->call('ClienttimesTableSeeder');
		
	}

}
