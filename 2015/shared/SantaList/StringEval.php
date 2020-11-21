<?php declare(strict_types=1);


namespace SantaList;


final class StringEval
{
    private string $unparsed;

    public function __construct(string $unparsed)
    {
        $this->unparsed = $unparsed;
    }

    public static function parse(string $string): string
    {
        return (new self($string))->parsing();
    }

    public function parsing(): string
    {
        $string = $this->unparsed;
        foreach ($this->getRules() as $rule) {
            $string = $rule($string);
        }

        return $string;
    }

    /**
     * @return array|callable[]
     */
    private function getRules(): array
    {
        return [

            static function (string $string) {
                $replacements = [
                    '"'  => '\"',
                    '\\' => '\\\\',
                ];
                return str_replace(array_values($replacements), array_keys($replacements), $string);
            },
            static function (string $string) {
                return preg_replace('~^"(.*)"$~', '${1}', $string);
            },
            static function (string $string) {
                return preg_replace_callback(
                    '~\\\[x]([[:xdigit:]]{2})~',
                    static function ($matches) {
                        return \chr(hexdec($matches[1]));
                    },
                    $string
                );
            },
        ];
    }

    public static function encode(string $string): string
    {
        return '"'.addslashes($string).'"';
    }
}
