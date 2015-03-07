<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Lesson;
use App\Tag;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		Lesson::truncate();
		Tag::truncate();
		DB::table('lesson_tag')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		Model::unguard();
		$this->call('LessonsTableSeeder');
		$this->command->info('Lessons table seeded!');
		$this->call('UsersTableSeeder');
		$this->command->info('Users table seeded!');
		$this->call('TagsTableSeeder');
		$this->command->info('Tags table seeded!');
		$this->call('LessonsTagsTableSeeder');
		$this->command->info('Lessons-Tags table seeded!');
	}

}

class LessonsTableSeeder extends Seeder
{
    
		    public function run()
		    {
		    	$faker = Faker\Factory::create();
		        for ($i=0; $i < 20; $i++) { 
		        	DB::table('lessons')->insert(array('title'  => $faker->sentence($nbWords = 5),
		        								'some_bool'=>$faker->boolean(),
												'body'   	=> $faker->paragraph($nbSentences = 4)));
		        }

			}
}

class UsersTableSeeder extends Seeder
{
    
		    public function run()
		    {
		    	$faker = Faker\Factory::create();
		        for ($i=0; $i < 5; $i++) { 
		        	DB::table('users')->insert(array('name'  	=> $faker->name($gender = null),
		        								'email'			=>$faker->freeEmail,
												'password'   	=> $faker->userName));
		        }

			}
}

class TagsTableSeeder extends Seeder
{
    
		    public function run()
		    {
		    	$faker = Faker\Factory::create();
		        for ($i=0; $i < 20; $i++) { 
		        	DB::table('tags')->insert(array('name' => $faker->word));
		        }

			}
}

class LessonsTagsTableSeeder extends Seeder
{
		    public function run()
		    {
		    	$faker = Faker\Factory::create();
		        for ($i=0; $i < 30; $i++) { 
		        	DB::table('lesson_tag')->insert(array('lesson_id' 	=>$faker->randomElement(Lesson::lists('id')),
		        											'tag_id' 	=>$faker->randomElement(Tag::lists('id'))));
		        }

			}
}
