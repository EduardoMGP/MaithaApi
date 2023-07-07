<?php

return [
    'user' => [
        'not_found' => 'Usuário não encontrado.',
        'created' => 'Usuário criado com sucesso.',
        'updated' => 'Usuário atualizado com sucesso.',
        'not_updated' => 'Usuário não atualizado.',
        'deleted' => 'Usuário excluído com sucesso.',
    ],
    'login_success' => 'Login realizado com sucesso.',
    'logout_success' => 'Logout realizado com sucesso.',
    'invalid_credentials' => 'Credenciais inválidas.',
    'validation_error' => 'Erro de validação.',
    'required' => 'O campo :attribute é obrigatório.',
    'name' => [
        'string' => 'O campo nome deve ser uma sequência de caracteres.',
        'max' => 'O campo nome não pode ter mais de :max caracteres.',
    ],
    'email' => [
        'email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
        'max' => 'O campo e-mail não pode ter mais de :max caracteres.',
        'unique' => 'O e-mail fornecido já está em uso.',
    ],
    'password' => [
        'string' => 'O campo senha deve ser uma sequência de caracteres.',
        'min' => 'O campo senha deve ter pelo menos :min caracteres.',
        'confirmed' => 'A confirmação da senha não corresponde.',
    ]
];
