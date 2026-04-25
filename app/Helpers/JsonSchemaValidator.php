<?php
// app/Helpers/JsonSchemaValidator.php

namespace App\Helpers;

use JsonSchema\Validator;
use JsonSchema\Constraints\Constraint;

class JsonSchemaValidator
{
    public static function validate(array $data, string $schemaPath): array
    {
        $validator = new Validator();
        $schema = json_decode(file_get_contents($schemaPath));
        $dataObj = json_decode(json_encode($data));
        $validator->validate($dataObj, $schema, Constraint::CHECK_MODE_APPLY_DEFAULTS);
        $errors = [];
        if (!$validator->isValid()) {
            foreach ($validator->getErrors() as $error) {
                $errors[] = ($error['property'] ? $error['property'] . ': ' : '') . $error['message'];
            }
        }
        return $errors;
    }
}
