<?php
namespace Gummibeer\Laravel\Translation\Commands;

use Illuminate\Console\Command;

class TranslatorCreatePo extends Command
{
    protected $signature = 'trans:po';
    protected $description = 'Creates/Updates the PO files';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach(config('trans.supported_locales') as $locale) {
            $this->putInPoFile($locale);
        }
    }

    protected function putInPoFile($locale)
    {
        $header = $this->getHeader($locale);

        $path = base_path(config('trans.translations_path') . DIRECTORY_SEPARATOR . $locale . DIRECTORY_SEPARATOR . 'LC_MESSAGES');
        $file = $path . DIRECTORY_SEPARATOR . 'messages.po';

        if(\File::exists($file)) {
            $header .= "\n";
            $content = preg_replace('/^([^#])+:?/', $header, \File::get($file));
        } else {
            $content = $header;
        }

        if(!\File::isDirectory($path)) {
            \File::makeDirectory($path, 493, true);
        }
        return \File::put($file, $content);
    }

    protected function getHeader($locale)
    {
        $timestamp = date("Y-m-d H:iO");
        $relativePath = "../../../../..";
        $template = 'msgid ""' . "\n";
        $template .= 'msgstr ""' . "\n";
        $template .= '"Project-Id-Version: ' . config('trans.po.project') . '\n' . "\"\n";
        $template .= '"POT-Creation-Date: ' . $timestamp . '\n' . "\"\n";
        $template .= '"PO-Revision-Date: ' . $timestamp . '\n' . "\"\n";
        $template .= '"Last-Translator: ' . config('trans.po.translator') . '\n' . "\"\n";
        $template .= '"Language-Team: ' . config('trans.po.project') . '\n' . "\"\n";
        $template .= '"Language: ' . $locale . '\n' . "\"\n";
        $template .= '"MIME-Version: 1.0' . '\n' . "\"\n";
        $template .= '"Content-Type: text/plain; charset=' . config('trans.po.project') . '\n' . "\"\n";
        $template .= '"Content-Transfer-Encoding: 8bit' . '\n' . "\"\n";
        $template .= '"X-Generator: Poedit 1.5.4' . '\n' . "\"\n";
        $template .= '"X-Poedit-KeywordsList: ' . implode(';', config('trans.po.keywords_list')) . '\n' . "\"\n";
        $template .= '"X-Poedit-Basepath: ' . $relativePath . '\n' . "\"\n";
        $template .= '"X-Poedit-SourceCharset: ' . config('trans.po.encoding') . '\n' . "\"\n";

        $sourcePaths = config('trans.po.source_paths');
        if (count($sourcePaths)) {
            foreach ($sourcePaths as $key => $sourcePath) {
                $template .= '"X-Poedit-SearchPath-' . $key . ': ' . $sourcePath . '\n' . "\"\n";
            }
        }

        return $template;
    }

}
