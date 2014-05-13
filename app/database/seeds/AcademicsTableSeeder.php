<?php

class AcademicsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('academics')->truncate();
		DB::table('academics')->delete();

		//Academic::create(array(
		//	array('MUid' => 'sunj3', 'courseID' => 'cse617'),
		//	array('MUid' => 'sunj3', 'courseID' => 'cse543')
		//));
		DB::table('academics')->insert(
			array(
					array('MUid' => 'sunj3', 'courseID' => 'cse617'),
					array('MUid' => 'sunj3', 'courseID' => 'cse543'),
					array('MUid' => 'sunj3', 'courseID' => 'cse631'),

					array('MUid' => 'john3', 'courseID' => 'cse617'),

					array('MUid' => 'tom3', 'courseID' => 'cse617'),

					array('MUid' => 'andy3', 'courseID' => 'cse617'),

					array('MUid' => 'jake3', 'courseID' => 'cse617'),

					array('MUid' => 'tyler3', 'courseID' => 'cse617'),

					array('MUid' => 'baker3', 'courseID' => 'cse617'),

					array('MUid' => 'mike3', 'courseID' => 'cse617'),
					array('MUid' => 'mike3', 'courseID' => 'cse543'),

				)
			);
		// Uncomment the below to run the seeder
		// DB::table('academics')->insert($academics);
	}

}
