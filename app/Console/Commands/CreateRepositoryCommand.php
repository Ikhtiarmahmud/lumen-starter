<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {className}';

     /**
     * @var Filesystem
     */
    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Repository Class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $className = $this->argument('className');

        if ($this->confirm('Do you wish to create ' . $className . 'file?')) {
            $file = $className . '.php';
            $path = base_path('app/Repositories/');

            $file = $path . "$file";
            $composerDir = $path;
            $contents = $this->getContents($className);

            if ($this->files->isDirectory($composerDir)) {
                if ($this->files->isFile($file)) {
                    return $this->error($className . ' File Already exists!');
                }

                if (!$this->files->put($file, $contents)) {
                    return $this->error('Something went wrong!');
                }

                $this->info("$className generated!");
            } else {
                $this->files->makeDirectory($composerDir, 0777, true, true);

                if (!$this->files->put($file, $contents)) {
                    return $this->error('Something went wrong!');
                }
                $this->info("$className generated!");
            }
        }
    }

    public function getContents($className): string
    {
        return
                '<?php' . PHP_EOL
                . 'namespace App\Repositories;' . PHP_EOL
                .  PHP_EOL
                . 'use App\Repositories\AbstractBaseRepository;' . PHP_EOL
                . PHP_EOL
                . 'class ' . $className . ' extends AbstractBaseRepository' . PHP_EOL
                . '{' . PHP_EOL
                . '   protected $modelName = "";' . PHP_EOL
                . '}';
    }
}
