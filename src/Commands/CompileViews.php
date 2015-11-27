<?php

namespace Gummibeer\Laravel\Translation\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;

class CompileViews extends Command
{
    protected $signature = 'view:compile';
    protected $description = 'Compiles all blade views into php.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('start view compiler');
        $targetDir = storage_path(config('trans.view_store_path'));
        if (!file_exists($targetDir)) {
            $this->createDirectory($targetDir);
            $this->comment('created directory ' . $targetDir);
        }
        $path = base_path(config('trans.view_blade_path'));
        $fs = new Filesystem($path);
        $files = $fs->allFiles(realpath($path));
        $compiler = new BladeCompiler($fs, $targetDir);
        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $this->comment('compile view: ' . $filePath);
            $compiler->setPath($filePath);
            $contents = $compiler->compileString($fs->get($filePath));
            $compiledPath = $compiler->getCompiledPath($compiler->getPath());
            $fs->put($compiledPath . '.php', $contents);
        }
    }

    protected function createDirectory($path)
    {
        if (!mkdir($path)) {
            throw new \RuntimeException(sprintf('Can\'t create the directory: %s', $path));
        }
    }
}
