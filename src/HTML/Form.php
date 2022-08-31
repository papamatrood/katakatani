<?php
namespace App\HTML;

use DateTimeInterface;

class Form {

    private $errors = [];
    
    private $data;


    public function __construct($errors = [], $data = null)
    {
        $this->errors = $errors;
        $this->data = $data;
    }

    public function input(string $name, string $label) : ?string
    {
        $value = $this->getValue($name);
        $type = $this->getInputType($name);
        $class = isset($this->errors[$name]) ? "form-control is-invalid" : "form-control";
        return <<<HTML
            <div class="mb-3">
                <label for="id{$name}" class="form-label">{$label}</label>
                <input type="{$type}" class="{$class}" id="id{$name}" name="{$name}" value="{$value}">
                {$this->getInvalidFeedBack($name)}
            </div>
        HTML;
    }

    public function select(string $name, string $label, array $contenus = []) : ?string
    {
        $options = [];
        $selected = null;
        $value = $this->getValue($name);
        foreach ($contenus as $id => $v) {
            $selected = ($value == $id || $value == $v)  ? "selected" : ''; 
            $options[] = "<option value=\"$id\" $selected>$v</option>"; 
        }
        $options = implode('', $options);
        $class = isset($this->errors[$name]) ? "form-control form-select is-invalid" : "form-control form-select";
        return <<<HTML
            <div class="mb-3">
                <label for="id{$name}" class="form-label">{$label}</label>
                <select class="{$class}" id="id{$name}" name="{$name}" required>{$options}</select>
                {$this->getInvalidFeedBack($name)}
            </div>
        HTML;
    }

    public function textarea(string $name, string $label) : ?string
    {
        $value = $this->getValue($name);
        $class = isset($this->errors[$name]) ? "form-control is-invalid" : "form-control";
        return <<<HTML
            <div class="mb-3">
                <label for="id{$name}" class="form-label">{$label}</label>
                <textarea class="{$class}" id="id{$name}" name="{$name}" >{$value}</textarea>
                {$this->getInvalidFeedBack($name)}
            </div>
        HTML;
    }

    private function getValue(string $name)
    {
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
        $value  = $this->data->$method(); 
        if($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        return $value;
    }

    private function getInvalidFeedBack(string $name) : ?string
    {
        $error = null;
        if(isset($this->errors[$name])) {
            $error = implode(', ', $this->errors[$name]);
            return <<<HTML
                <div class="invalid-feedback">{$error}</div>
            HTML;
        }
        return null;
    }

    private function getInputType(string $name) : string
    {
        if (strpos($name, '_at') !== false) return 'date';
        
        if ($name === 'password') return 'password';
       
        return 'text';
    }

}