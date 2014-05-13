<?php

class HiredtutorsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('hiredtutors')->truncate();

		DB::table('hiredtutors')->delete();

        DB::table('hiredtutors')->insert(
			array(
					array('MUid' => 'tom3'),
					
				)
			);

		// Uncomment the below to run the seeder
		// DB::table('hiredtutors')->insert($hiredtutors);
	}

}
