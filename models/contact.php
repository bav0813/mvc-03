<?php

/**
 * Created by PhpStorm.
 * User: Тарас
 * Date: 20.04.2018
 * Time: 20:21
 */

class Contact extends Model
{
    private $errors = [];

    public function getErrors()
    {
        $errorsHtml = '';
        if (!empty($this->errors)) {
            foreach ($this->errors as $er) {
                $errorsHtml .= '<div class="error">' . $er . '</div>';
            }
        }
        return $errorsHtml;
    }

    public function save($data)
    {
        if (empty($data['name'])) {
            $this->errors[] = 'Error: empty name.';
        }
        if (empty($data['email'])) {
            $this->errors[] = 'Error: empty email.';
        }
        elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Error: wrong email format.';
        }
        if (empty($data['message'])) {
            $this->errors[] = 'Error: empty message.';
        }

        $name = trim($this->db->escape(strip_tags($data['name'])));
        $email = trim($this->db->escape(strip_tags($data['email'])));
        $message = trim($this->db->escape(strip_tags($data['message'])));

        $sql = "INSERT INTO `messages` SET `name` = '{$name}', `email` = '$email', `message` = '{$message}'";

        if (empty($this->errors)) {
            return $this->db->query($sql);
        }
    }

    public function getList()
    {
        $sql = "select * from messages where 1 order by id desc";
        return $this->db->query($sql);
    }
}