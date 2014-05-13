<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		DB::table('users')->delete();

        DB::table('users')->insert(
			array(
					array('MUid' => 'sunj3', 'password' => Hash::make('12345')),
					array('MUid' => 'john3', 'password' => Hash::make('12345')),
					array('MUid' => 'jake3', 'password' => Hash::make('12345')),
					array('MUid' => 'andy3', 'password' => Hash::make('12345')),
					array('MUid' => 'tom3', 'password' => Hash::make('12345')),
					array('MUid' => 'mike3', 'password' => Hash::make('12345')),
					array('MUid' => 'baker3', 'password' => Hash::make('12345')),
					array('MUid' => 'tyler3', 'password' => Hash::make('12345')),
				)
			);

		// Uncomment the below to run the seeder
		// DB::table('users')->insert($users);
	}

}
