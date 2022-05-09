<?php

namespace Cooper\CarbonChineseMacros\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GenerateIdeHelpers extends Command
{
    protected $signature = 'generate-ide-helpers';
    protected $description = 'Generates the IDE helpers';

    public function __invoke()
    {
        $files = $this->getTraitFiles();

        $files = $files->flatMap(function (string $fileName) {
            $matches = [];

            preg_match_all(
                '/Carbon::macro\([\'"](?P<macros>[a-zA-Z][\w]*)[\'"]/',
                file_get_contents($fileName),
                $matches
            );

            return collect($matches['macros'])->sort();
        })
            ->map(function (string $macroMethod) {
                if (Str::startsWith($macroMethod, 'is')) {
                    return "     * @method bool $macroMethod";
                }

                if (Str::startsWith($macroMethod, 'set')) {
                    return "     * @method Carbon $macroMethod";
                }

                if (Str::startsWith($macroMethod, 'get')) {
                    $property = Str::of(Str::substr($macroMethod, 3))->camel();

                    return "     * @property string \$$property\n     * @method string $macroMethod";
                }

                return '     * ';
            });

        $header = $this->getFileHeader();
        $content = $files->implode(PHP_EOL);
        $footer = $this->getFileFooter();

        file_put_contents($this->getPath('_ide_helper.php'), $header.$content.$footer);

        $this->info('Generates the IDE helpers done.');
    }

    protected function getTraitFiles(): Collection
    {
        return collect(scandir($this->getPath('src/traits')))
            ->filter(function ($file) {
                return Str::endsWith($file, '.php');
            })
            ->map(function (string $fileName) {
                return $this->getPath("src/traits/$fileName");
            })
            ->values();
    }

    private function getPath(string $path = null): string
    {
        return __DIR__.'/../'.$path ?: '';
    }

    protected function getFileHeader(): string
    {
        return <<<EOT
<?php
namespace Illuminate\Support {
    /**
     * Carbon
     * \n
EOT;
    }

    protected function getFileFooter(): string
    {
        return <<<EOT
    */
    class Carbon extends \Carbon\Carbon {}
}
EOT;
    }
}
