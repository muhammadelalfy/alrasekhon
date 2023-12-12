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

    'accepted' => 'يجب قبول حقل :attribute',
    'accepted_if' => 'حقل :attribute مقبول في حال ما إذا كان :other يساوي :value.',
    'active_url' => 'حقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على حقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => 'حقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي حقل :attribute سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي حقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون حقل :attribute ًمصفوفة',
    'before' => 'يجب على حقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'حقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة حقل :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'current_password' => 'كلمة المرور غير صحيحة',
    'date' => 'حقل :attribute ليس تاريخًا صحيحًا',
    'date_equals' => 'لا يساوي حقل :attribute مع :date.',
    'date_format' => 'لا يتوافق حقل :attribute مع الشكل :format.',
    'declined' => 'يجب رفض حقل :attribute',
    'declined_if' => 'حقل :attribute مرفوض في حال ما إذا كان :other يساوي :value.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits' => 'يجب أن يحتوي حقل :attribute على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي حقل :attribute بين :min و :max رقمًا/أرقام',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'ends_with' => 'الـ :attribute يجب ان ينتهي بأحد القيم التالية :value.',
    'enum' => 'حقل :attribute غير صحيح',
    'exists' => 'حقل :attribute لاغٍ',
    'file' => 'الـ :attribute يجب أن يكون من ملفا.',
    'filled' => 'حقل :attribute إجباري',
    'gt' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من :value.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من :value حروفٍ/حرفًا.',
    ],
    'gte' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي :value عناصر/عنصر او اكثر.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value حروفٍ/حرفًا.',
    ],
    'image' => 'يجب أن يكون حقل :attribute صورةً',
    'in' => 'حقل :attribute لاغٍ',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون حقل :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون حقل :attribute عنوان IP ذا بُنية صحيحة',
    'ipv4' => 'يجب أن يكون حقل :attribute عنوان IPv4 ذا بنية صحيحة.',
    'ipv6' => 'يجب أن يكون حقل :attribute عنوان IPv6 ذا بنية صحيحة.',
    'json' => 'يجب أن يكون حقل :attribute نصا من نوع JSON.',
    'lt' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اقل من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اقل من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اقل من :value.',
        'string' => 'الـ :attribute يجب ان يكون اقل من :value حروفٍ/حرفًا.',
    ],
    'lte' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value.',
        'string' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value حروفٍ/حرفًا.',
    ],
    'mac_address' => 'يجب أن يكون حقل :attribute عنوان MAC ذا بنية صحيحة.',
    'max' => [
        'array' => 'يجب أن لا يحتوي حقل :attribute على أكثر من :max عناصر/عنصر.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أصغر لـ :max.',
        'string' => 'يجب أن لا يتجاوز طول نص :attribute :max حروفٍ/حرفًا',
    ],
    'mimes' => 'يجب أن يكون حقل ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون حقل ملفًا من نوع : :values.',
    'min' => [
        'array' => 'يجب أن يحتوي حقل :attribute على الأقل على :min عُنصرًا/عناصر',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أكبر لـ :min.',
        'string' => 'يجب أن يكون طول نص :attribute على الأقل :min حروفٍ/حرفًا',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'حقل :attribute لاغٍ',
    'not_regex' => 'حقل :attribute نوعه لاغٍ',
    'numeric' => 'يجب على حقل :attribute أن يكون رقمًا',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب تقديم حقل :attribute',
    'prohibited' => 'حقل :attribute محظور',
    'prohibited_if' => 'حقل :attribute محظور في حال ما إذا كان :other يساوي :value.',
    'prohibited_unless' => 'حقل :attribute محظور في حال ما لم يكون :other يساوي :value.',
    'prohibits' => 'حقل :attribute يحظر :other من اي يكون موجود',
    'regex' => 'صيغة حقل :attribute .غير صحيحة',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'حقل :attribute يجب ان يحتوي علي مدخلات للقيم التالية :values.',
    'required_if' => 'حقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless' => 'حقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => 'حقل :attribute إذا توفّر :values.',
    'required_with_all' => 'حقل :attribute إذا توفّر :values.',
    'required_without' => 'حقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'حقل :attribute إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق حقل :attribute مع :other',
    'size' => [
        'array' => 'يجب أن يحتوي حقل :attribute على :size عنصرٍ/عناصر بالظبط',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية لـ :size',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
    ],
    'starts_with' => 'حقل :attribute يجب ان يبدأ بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون حقل :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة حقل :attribute مُستخدمة من قبل',
    'unique_import_customer' => 'قيمة حقل رقم ببطاقه الهويه مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'url' => 'صيغة الرابط :attribute غير صحيحة',
    'uuid' => 'حقل :attribute يجب ان ايكون رقم UUID صحيح.',

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
        'name' => [
            'regex' => 'يجب ان يحتوي الاسم علي الاقل حرف واحد',
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
        'role_id' => 'الدور',
        'user_id' => 'العملاء',
        'code' => 'كود',
        'phone' => 'رقم الهاتف',
        'reason_ar' => 'السبب بالعربيه',
        'reason_en' => 'السبب بالانجليزيه',
        'category_ids' => 'الاقسام',
        'category_id' => 'القسم',
        'classification_id' => 'التصنيف',
        'brand_ids' => 'العلامات التجاريه',
        'duration' => 'المده',
        'email' => 'البريد الالكتروني',
        'amount' => 'الكميه',
        'password_confirmation' => 'تاكيد كلمه المرور',
        'name' => 'الاسم',
        'type' => 'النوع',
        'name_ar' => 'الاسم بالعربيه',
        'quantity' => 'الكميه',
        'name_en' => 'الاسم بالانجليزيه',
        'title_ar' => 'الاسم بالعربيه',
        'title_en' => 'الاسم بالانجليزيه',
        'roles' => 'الصلاحيه',
        'password' => 'كلمه المرور',
        'default_refill_duration' => ' الفتره الافتراضية',
        'id_number' => 'رقم هويه الشركه',
        'first_name_ar' => 'الاسم الاول بالعربيه',
        'first_name_en' => 'الاسم الاول بالانجليزيه',
        'second_name_ar' => 'الاسم الاول بالعربيه',
        'second_name_en' => 'الاسم الاول بالانجليزيه',
        'items_ids' => 'العناصر',
        'classification_ids' => 'التصنيفات',
        'sub_classification_ids' => 'التصنيفات الفرعيه',
        'insurance_customer' => 'نوع تامين العميل',
        'new_password' => 'كلمه المرور الجديده',
        'current_password' => 'كلمه المرور الحاليه',
        'item_type' => 'نوع المهمه',
        'soDateFrom' => 'تاريخ المبيعات من',
        'soDateTo' => 'تاريخ المبيعات الي',
        'callDateFrom' => 'تاريخ الاتصال من',
        'callDateTo' => 'تاريخ الاتصال الي',
        'refileDateFrom' => 'تاريخ اعاده الملئ من',
        'refileDateTo' => 'تاريخ اعادة الملئ الي',
        "agents_number"=>"عدد المساعدين",
        "brands_ids"=>"العلامات التجاريه",
        "categories_ids"=>"الفئات",
        "grade"=>"المرتبة",
        "to"=>"الي",
        "from"=>"من",
        "types"=>"الانواع",
        "customer_duration"=>"مده العميل",
        "customer_min_price"=>"الحد الادني للسعر للعميل",

    ],
];
