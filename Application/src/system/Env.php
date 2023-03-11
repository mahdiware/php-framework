<?php
namespace Mahdiware;
use InvalidArgumentException;

class Env
{
    protected $path;

    public function __construct(string $path, string $file = '.env')
    {
        $this->path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;
    }

    public function load(): bool
    {
    	$vars = $this->parse();
        return $vars !== null;
    }

    public function parse(): ?array
    {
        if (! is_file($this->path)) {
            return null;
        }
        if (! is_readable($this->path)) {
            throw new InvalidArgumentException("The .env file is not readable: {$this->path}");
        }

        $vars = [];
        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            if (strpos($line, '=') !== false) {
                [$name, $value] = $this->normaliseVariable($line);
                $vars[$name]    = $value;
                $this->setVariable($name, $value);
            }
        }
        return $vars;
    }

    protected function setVariable(string $name, string $value = '')
    {
        if (! getenv($name, true)) {
            putenv("{$name}={$value}");
        }
        if (empty($_ENV[$name])) {
            $_ENV[$name] = $value;
        }
        if (empty($_SERVER[$name])) {
            $_SERVER[$name] = $value;
        }
    }

    public function normaliseVariable(string $name, string $value = ''): array
    {
        // Split our compound string into its parts.
        if (strpos($name, '=') !== false) {
            [$name, $value] = explode('=', $name, 2);
        }

        $name  = trim($name);
        $value = trim($value);
        $name = preg_replace('/^export[ \t]++(\S+)/', '$1', $name);
        $name = str_replace(['\'', '"'], '', $name);
        $value = $this->sanitizeValue($value);
        $value = $this->resolveNestedVariables($value);

        return [$name, $value];
    }

    protected function sanitizeValue(string $value): string
    {
        if (! $value) {
            return $value;
        }
        if (strpbrk($value[0], '"\'') !== false) {
            $quote = $value[0];
            $regexPattern = sprintf(
                '/^
                %1$s          # match a quote at the start of the value
                (             # capturing sub-pattern used
                 (?:          # we do not need to capture this
                 [^%1$s\\\\] # any character other than a quote or backslash
                 |\\\\\\\\   # or two backslashes together
                 |\\\\%1$s   # or an escaped quote e.g \"
                 )*           # as many characters that match the previous rules
                )             # end of the capturing sub-pattern
                %1$s          # and the closing quote
                .*$           # and discard any string after the closing quote
                /mx',
                $quote
            );
            $value = preg_replace($regexPattern, '$1', $value);
            $value = str_replace("\\{$quote}", $quote, $value);
            $value = str_replace('\\\\', '\\', $value);
        } else {
            $parts = explode(' #', $value, 2);
            $value = trim($parts[0]);
            if (preg_match('/\s+/', $value) > 0) {
                throw new InvalidArgumentException('.env values containing spaces must be surrounded by quotes.');
            }
        }
        return $value;
    }

    protected function resolveNestedVariables(string $value): string
    {
        if (strpos($value, '$') !== false) {
            $value = preg_replace_callback(
                '/\${([a-zA-Z0-9_\.]+)}/',
                function ($matchedPatterns) {
                    $nestedVariable = $this->getVariable($matchedPatterns[1]);
                    if ($nestedVariable === null) {
                        return $matchedPatterns[0];
                    }
                    return $nestedVariable;
                },
                $value
            );
        }
        return $value;
    }

    protected function getVariable(string $name)
    {
        switch (true) {
            case array_key_exists($name, $_ENV):
                return $_ENV[$name];
            case array_key_exists($name, $_SERVER):
                return $_SERVER[$name];
            default:
                $value = getenv($name);
                return $value === false ? null : $value;
        }
    }
}