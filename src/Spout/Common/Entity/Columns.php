<?php


namespace Box\Spout\Common\Entity;


/**
 * Class Columns
 * @package Box\Spout\Common\Entity
 */
class Columns
{
    /**
     * @var array
     */
    protected $columns = [];

    /**
     * Columns constructor.
     * @param Column|null $column
     */
    public function __construct(Column $column = null)
    {
        if ($column instanceof Column) {
            $this->addColumn($column);
        }
    }

    /**
     * @param Column $column
     * @return $this
     */
    public function addColumn(Column $column): self
    {
        $this->columns[$column->getIndex()] = $column;
        return $this;
    }

    /**
     * @param Column $column
     * @return $this
     */
    public function removeColumn(Column $column): self
    {
        $this->removeByIndex($column->getIndex());
        return $this;
    }

    /**
     * @param string $index
     * @return $this
     */
    public function removeByIndex(string $index): self
    {
        unset($this->columns[$index]);
        return $this;
    }

    /**
     * @param string $index
     * @return bool
     */
    public function hasByIndex(string $index): bool
    {
        return isset($this->columns[$index]);
    }

    /**
     * @param string $index
     * @return Column
     */
    public function getByIndex(string $index): Column
    {
        return $this->columns[$index];
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->columns);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->columns;
    }
}
