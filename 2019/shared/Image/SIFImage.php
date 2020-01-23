<?php declare(strict_types=1);

namespace Image;

class SIFImage
{
    /**
     * @var int
     */
    private $width;
    /**
     * @var int
     */
    private $height;
    /**
     * @var string
     */
    private $data;

    private function __construct(int $width, int $height, string $data)
    {
        $this->width = $width;
        $this->height = $height;
        $this->data = $data;
        $this->layers = self::splitLayers($this->width, $this->height, $data);
    }

    private static function splitLayers(int $width, int $height, string $data): array
    {
        $bytes = $width * $height;
        return str_split($data, $bytes);
    }

    public static function create(int $width, int $height, string $data): SIFImage
    {
        return new self($width, $height, $data);
    }

    public function getLayersDigitsCount(): array
    {
        $info = [];
        foreach ($this->layers as $idx => $layer) {
            $info[$idx] = self::digitsPerLayer($layer);
        }

        return $info;
    }

    private static function digitsPerLayer(string $layer): array
    {
        $layer_info = array_combine(range(0, 9), array_fill(0, 10, 0));
        $counted = array_count_values(str_split($layer));
        return array_replace($layer_info, $counted);
    }
}
