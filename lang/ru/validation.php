<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Вы должны принять :attribute.',
    'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'Поле :attribute содержит недействительный URL.',
    'after' => 'В поле :attribute должна быть дата после :date.',
    'after_or_equal' => 'The :attribute field must be a date after or equal to :date.',
    'alpha' => 'Поле :attribute может содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы, цифры и дефис.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'array' => 'Поле :attribute должно быть массивом.',
    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'В поле :attribute должна быть дата до :date.',
    'before_or_equal' => 'The :attribute field must be a date before or equal to :date.',
    'between' => [
        'array' => 'Количество элементов в поле :attribute должно быть между :min и :max.',
        'file' => 'Размер файла в поле :attribute должен быть между :min и :max Килобайт(а).',
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'string' => 'Количество символов в поле :attribute должно быть между :min и :max.',
    ],
    'boolean' => 'Поле :attribute должно иметь значение логического типа.',
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',
    'current_password' => 'The password is incorrect.',
    'date' => 'Поле :attribute не является датой.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format' => 'Поле :attribute не соответствует формату :format.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'declined' => 'The :attribute field must be declined.',
    'declined_if' => 'The :attribute field must be declined when :other is :value.',
    'different' => 'Поля :attribute и :other должны различаться.',
    'digits' => 'Длина цифрового поля :attribute должна быть :digits.',
    'digits_between' => 'Длина цифрового поля :attribute должна быть между :min и :max.',
    'dimensions' => 'Поле :attribute имеет недопустимые размеры изображения.',
    'distinct' => 'Поле :attribute содержит повторяющееся значение.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
    'email' => 'Поле :attribute должно быть действительным электронным адресом.',
    'ends_with' => 'The :attribute field must end with one of the following: :values.',
    'enum' => 'Выбранное значение :attribute недопустимо',
    'exists' => 'Выбранное значение для :attribute некорректно.',
    'file' => 'Поле :attribute должно быть файлом.',
    'filled' => 'Поле :attribute обязательно для заполнения.',
    'gt' => [
        'array' => 'The :attribute field must have more than :value items.',
        'file' => 'The :attribute field must be greater than :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than :value.',
        'string' => 'The :attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute field must have :value items or more.',
        'file' => 'The :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than or equal to :value.',
        'string' => 'The :attribute field must be greater than or equal to :value characters.',
    ],
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное значение для :attribute ошибочно.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'Поле :attribute должно быть JSON строкой.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' => [
        'array' => 'The :attribute field must have less than :value items.',
        'file' => 'The :attribute field must be less than :value kilobytes.',
        'numeric' => 'The :attribute field must be less than :value.',
        'string' => 'The :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute field must not have more than :value items.',
        'file' => 'The :attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be less than or equal to :value.',
        'string' => 'The :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'Количество элементов в поле :attribute не может превышать :max.',
        'file' => 'Размер файла в поле :attribute не может быть более :max Килобайт(а).',
        'numeric' => 'Поле :attribute не может быть более :max.',
        'string' => 'Количество символов в поле :attribute не может превышать :max.',
    ],
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'mimes' => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'mimetypes' => 'The :attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'Количество элементов в поле :attribute должно быть не менее :min.',
        'file' => 'Размер файла в поле :attribute должен быть не менее :min Килобайт(а).',
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'string' => 'Количество символов в поле :attribute должно быть не менее :min.',
    ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'Выбранное значение для :attribute ошибочно.',
    'not_regex' => 'The :attribute field format is invalid.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'password' => [
        'letters' => 'Поле :attribute должно содержать минимум одну букву',
        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'Поле :attribute должно присутствовать.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Поле :attribute имеет ошибочный формат.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'Поле :attribute обязательно для заполнения, когда :other не равно :values.',
    'required_with' => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_with_all' => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_without' => 'Поле :attribute обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле :attribute обязательно для заполнения, когда ни одно из :values не указано.',
    'same' => 'Значение :attribute должно совпадать с :other.',
    'size' => [
        'array' => 'Количество элементов в поле :attribute должно быть равным :size.',
        'file' => 'Размер файла в поле :attribute должен быть равен :size Килобайт(а).',
        'numeric' => 'Поле :attribute должно быть равным :size.',
        'string' => 'Количество символов в поле :attribute должно быть равным :size.',
    ],
    'starts_with' => 'The :attribute field must start with one of the following: :values.',
    'string' => 'Поле :attribute должно быть строкой.',
    'timezone' => 'Поле :attribute должно быть действительным часовым поясом.',
    'unique' => 'Такое значение поля :attribute уже существует.',
    'uploaded' => 'Загрузка поля :attribute не удалась.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'url' => 'Поле :attribute имеет ошибочный формат.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'user_name' => 'Имя пользователя',
        'password' => 'Пароль',
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation
    |--------------------------------------------------------------------------
    */
    'incorrect_login_format' => 'Неверный формат. Поле :attribute должно быть в нижнем регистре, латиницей, может содержать цифры и знак "."',
    'email_not_exist' => 'Пользователя с таким :attribute не существует',
    'array_model_not_exist' => 'Неверное значение поля :attribute',
    'filters_date' => 'Неверный формат даты',
    'choices_unique' => 'Значение должно быть уникальным',
    'date_less_now' => ':attribute должно быть не меньше сегодняшней даты',
];
