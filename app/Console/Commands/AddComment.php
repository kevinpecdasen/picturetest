<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

class AddComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:comment {id} {comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add comment to the user basing on the user id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $request = new Request();
        $values = [
            'id' => $this->argument('id'), 
            'comments' => $this->argument('comment')
        ];
        $request->merge($values);
        app(UserController::class)->add_comment($request);
    }
}
