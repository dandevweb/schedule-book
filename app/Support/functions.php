<?php

if (! function_exists('user')) {

    function user(): ?\App\Models\User
    {
        return auth()->user();
    }
}

if (! function_exists('deleteOptions')) {
    function deleteOptions(array $options = []): array
    {
        return !empty($options) ? $options : [
            'text'              => 'Após a confirmação, esse processo não poderá ser revertido!',
            'onConfirmed'       => 'confirmed',
            'cancelButtonText'  => 'Cancelar',
            'confirmButtonText' => 'Sim',
            "confirmButton"     => "btn btn-danger",
            "cancelButton"      => "btn btn-secondary"
        ];
    }
}
