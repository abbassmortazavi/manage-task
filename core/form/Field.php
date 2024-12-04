<?php
/**
 * Project:  phpMvc
 * FileName: Field.php
 * User:     abbass
 * Time:     22:08
 * Date:     2022/04/30
 */

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public string $type;
    public Model $model;

    public string $attribute;

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return sprintf('
        <div class="col">
            <div class="form-group">
                <label for="validationCustom01" class="form-label">%s</label>
                <input type="%s" 
                       name="%s" value="%s" class="form-control%s" id="validationCustom01">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        </div>',
            $this->attribute
            ,$this->type
            , $this->attribute
            , $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}