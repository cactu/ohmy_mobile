<?php

use Illuminate\Database\Seeder;
use App\Article;
class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //DB::table('articles')->detele();
        for($i=0;$i<10;$i++){
            Article::create([
                'title'=>'title'.$i,
                'body'=>'body'.$i,
                'user_id'=>1,
            ]);
        }
    }
}
