<?php


namespace Box\Spout\Common\Entity;


use Box\Spout\Writer\XLSX\Manager\OptionsManager;

/**
 * Class Column
 * @package Box\Spout\Common\Entity
 */
class Column
{
    const DEFAULT_COLUMN_WIDTH = 9.10;
    const MEDIUM_COLUMN_WIDTH = self::DEFAULT_COLUMN_WIDTH * 2;
    const LARGE_COLUMN_WIDTH = self::DEFAULT_COLUMN_WIDTH * 4;

    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    /**
     * @var float
     */
    private $width;

    /**
     * @var bool
     */
    private $customWidth;

    /**
     * @var bool
     */
    private $autoWidth;

    /**
     * Column constructor.
     * @param int $min
     * @param int $max
     * @param float $width
     * @param bool $autoWidth
     * @param bool $customWidth
     */
    public function __construct(int $min, int $max, bool $autoWidth = true, float $width = self::DEFAULT_COLUMN_WIDTH, bool $customWidth = false)
    {
        $this->min = $min;
        $this->max = $max;
        $this->width = $width;
        $this->customWidth = $customWidth;
        $this->autoWidth = $autoWidth;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $min
     * @return Column
     */
    public function setMin(int $min): self
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return Column
     */
    public function setMax(int $max): self
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     * @return Column
     */
    public function setWidth(float $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCustomWidth(): bool
    {
        return $this->customWidth;
    }

    /**
     * @param bool $customWidth
     * @return Column
     */
    public function setCustomWidth(bool $customWidth): self
    {
        $this->customWidth = $customWidth;
        return $this;
    }

    /**
     * @return string
     */
    public function getIndex(): string
    {
        return $this->min . ':' . $this->max;
    }

    /**
     * @return bool
     */
    public function isAutoWidth(): bool
    {
        return $this->autoWidth;
    }

    /**
     * @param bool $autoWidth
     * @return Column
     */
    public function setAutoWidth(bool $autoWidth): self
    {
        $this->autoWidth = $autoWidth;
        return $this;
    }

    /**
     * @param string $value
     */
    public function increaseColumnWidth(string $value): void
    {
        if (mb_strlen($value) > $this->getWidth())  {
            $this->setWidth(mb_strlen($value));
        }
    }

    /**
     * @return float|int
     */
    public function calculateMaxColumnWidth()
    {
        $additionalCoefficient = 2;
        $fontSize = OptionsManager::DEFAULT_FONT_SIZE + $additionalCoefficient;
        $padding = 5;

        //[8*7+5]/7*256)/256
        return (((($this->getWidth() + $additionalCoefficient) * $fontSize) + $padding) / $fontSize);
    }
}
