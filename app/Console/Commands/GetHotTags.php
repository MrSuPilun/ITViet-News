<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetHotTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $tags = DB::table("tags")
                ->leftJoin('post_tags', 'tags.id', '=', 'post_tags.tag_id')
                ->leftJoin('posts', 'post_tags.post_id', '=', 'posts.id')
                ->whereRaw('MONTH(posts.created_at) = MONTH(NOW())')
                ->groupBy('tags.id')
                ->orderByRaw('SUM(posts.view) DESC')
                ->select('tags.id')
                ->take(10)
                ->get();

            foreach ($tags as $item) {
                DB::table('hot_tags')->insert(['tag_id' => $item->id, 'created_at' => now(), 'updated_at' => now()]);
            }
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }
}
