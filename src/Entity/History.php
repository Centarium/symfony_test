<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="history")
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository")
 */
class History
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $history_id;
    /**
     * @ORM\Column(type="string",length=30)
     */
    private $table;
    /**
     * @ORM\Column(type="string",length=30)
     */
    private $field;
    /**
     * @ORM\Column(type="integer",length=30)
     */
    private $field_id;
    /**
     * @ORM\Column(type="integer",length=200)
     */
    private $old_value;
    /**
     * @ORM\Column(type="integer",length=200)
     */
    private $new_value;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="create_user", referencedColumnName="id",nullable=false)
     */
    private $user_id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    /**
     * @return mixed
     */
    public function getHistoryId()
    {
        return $this->history_id;
    }

    /**
     * @param mixed $history_id
     */
    public function setHistoryId($history_id): void
    {
        $this->history_id = $history_id;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table): void
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $field
     */
    public function setField($field): void
    {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getFieldId()
    {
        return $this->field_id;
    }

    /**
     * @param mixed $field_id
     */
    public function setFieldId($field_id): void
    {
        $this->field_id = $field_id;
    }

    /**
     * @return mixed
     */
    public function getOldValue()
    {
        return $this->old_value;
    }

    /**
     * @param mixed $old_value
     */
    public function setOldValue($old_value): void
    {
        $this->old_value = $old_value;
    }

    /**
     * @return mixed
     */
    public function getNewValue()
    {
        return $this->new_value;
    }

    /**
     * @param mixed $new_value
     */
    public function setNewValue($new_value): void
    {
        $this->new_value = $new_value;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}