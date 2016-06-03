<?php

namespace jorenvanhocht\Hashify;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\DatabaseManager;

class Hashify
{
    /**
     * @var \Illuminate\Database\Connection
     */
    private $db;

    /**
     * The minimum length for the hash.
     *
     * @var int
     */
    private $minLength;

    /**
     * The max length for the hash.
     *
     * @var int
     */
    private $maxLength;

    /**
     * The generated hash.
     *
     * @var string
     */
    private $hash;

    /**
     * All available charsets.
     *
     * @var array
     */
    private $config;

    /**
     * @param \Illuminate\Database\DatabaseManager $db
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(DatabaseManager $db, Repository $config)
    {
        $this->db = $db->connection();
        $this->config = $config->get('hash');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->hash;
    }

    /**
     * Make a random hash
     *
     * @param int $minLength
     * @param int $maxLength
     * @return $this
     */
    public function make($minLength = 5, $maxLength = 10)
    {
        $hash = '';
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
        $rand = rand($this->minLength, $this->maxLength);

        for ($i = 0; $i < $rand; $i++) {
            $char = rand(0, strlen($this->config['charsets']['database']));

            $minus = $char != 0 ? 1 : 0;

            $hash .= $this->config['charsets']['database'][$char - $minus];
        }

        $this->hash = $hash;

        return $this;
    }

    /**
     * Check if the hash unique in a given
     * database table and column.
     *
     * @param $table
     * @param $column
     * @return mixed
     */
    public function unique($table, $column = 'hash')
    {
        $result = $this->db->table($table)
            ->where($column, '=', $this->hash)
            ->get();

        if($result) {
            return $this->make($this->minLength, $this->maxLength)
                ->unique($table, $column);
        }

        return $this->hash;
    }
}