<?php
use PHPUnit\Framework\TestCase;

class TabDelimitedFileIterator implements Iterator
{
    protected $file;
    protected $key = 0;
    protected $current;

    public function __construct($file)
    {
        $this->file = fopen($file, 'r');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function rewind()
    {
        rewind($this->file);
        $this->current = fgetcsv($this->file,0,"\t");
        $this->key = 0;
    }

    public function valid()
    {
        return !feof($this->file);
    }

    public function key()
    {
        return $this->key;
    }

    public function current()
    {
        return $this->current;
    }

    public function next()
    {
        $this->current = fgetcsv($this->file,0,"\t");
        $this->key++;
    }
}