<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linii de limbă pentru validare
    |--------------------------------------------------------------------------
    |
    | Următoarele linii de limbă conțin mesajele de eroare implicite folosite de
    | clasa validatorului. Unele dintre aceste reguli au mai multe versiuni,
    | precum regulile pentru dimensiune. Vă rugăm să ajustați fiecare dintre
    | aceste mesaje aici, după cum doriți.
    |
    */

    'accepted' => 'Câmpul :attribute trebuie să fie acceptat.',
    'accepted_if' => 'Câmpul :attribute trebuie să fie acceptat când :other este :value.',
    'active_url' => 'Câmpul :attribute trebuie să fie un URL valid.',
    'after' => 'Câmpul :attribute trebuie să fie o dată după :date.',
    'after_or_equal' => 'Câmpul :attribute trebuie să fie o dată după sau egală cu :date.',
    'alpha' => 'Câmpul :attribute trebuie să conțină doar litere.',
    'alpha_dash' => 'Câmpul :attribute trebuie să conțină doar litere, cifre, liniuțe și underscore-uri.',
    'alpha_num' => 'Câmpul :attribute trebuie să conțină doar litere și cifre.',
    'array' => 'Câmpul :attribute trebuie să fie un array.',
    'ascii' => 'Câmpul :attribute trebuie să conțină doar caractere alfanumerice și simboluri într-un singur byte.',
    'before' => 'Câmpul :attribute trebuie să fie o dată înainte de :date.',
    'before_or_equal' => 'Câmpul :attribute trebuie să fie o dată înainte sau egală cu :date.',
    'between' => [
        'array' => 'Câmpul :attribute trebuie să aibă între :min și :max elemente.',
        'file' => 'Câmpul :attribute trebuie să aibă între :min și :max kilobyți.',
        'numeric' => 'Câmpul :attribute trebuie să fie între :min și :max.',
        'string' => 'Câmpul :attribute trebuie să aibă între :min și :max caractere.',
    ],
    'boolean' => 'Câmpul :attribute trebuie să fie adevărat sau fals.',
    'confirmed' => 'Confirmarea câmpului :attribute nu se potrivește.',
    'current_password' => 'Parola este incorectă.',
    'date' => 'Câmpul :attribute trebuie să fie o dată validă.',
    'date_equals' => 'Câmpul :attribute trebuie să fie o dată egală cu :date.',
    'date_format' => 'Câmpul :attribute trebuie să se potrivească cu formatul :format.',
    'decimal' => 'Câmpul :attribute trebuie să aibă :decimal zecimale.',
    'declined' => 'Câmpul :attribute trebuie să fie declinat.',
    'declined_if' => 'Câmpul :attribute trebuie să fie declinat când :other este :value.',
    'different' => 'Câmpul :attribute și :other trebuie să fie diferite.',
    'digits' => 'Câmpul :attribute trebuie să aibă :digits cifre.',
    'digits_between' => 'Câmpul :attribute trebuie să aibă între :min și :max cifre.',
    'dimensions' => 'Câmpul :attribute are dimensiuni de imagine nevalide.',
    'distinct' => 'Câmpul :attribute are o valoare duplicat.',
    'doesnt_end_with' => 'Câmpul :attribute nu trebuie să se termine cu una dintre următoarele valori: :values.',
    'doesnt_start_with' => 'Câmpul :attribute nu trebuie să înceapă cu una dintre următoarele valori: :values.',
    'email' => 'Câmpul :attribute trebuie să fie o adresă de email validă.',
    'ends_with' => 'Câmpul :attribute trebuie să se termine cu una dintre următoarele valori: :values.',
    'enum' => 'Valoarea selectată pentru :attribute este invalidă.',
    'exists' => 'Valoarea selectată pentru :attribute este invalidă.',
    'file' => 'Câmpul :attribute trebuie să fie un fișier.',
    'filled' => 'Câmpul :attribute trebuie să aibă o valoare.',
    'gt' => [
        'array' => 'Câmpul :attribute trebuie să aibă mai mult de :value elemente.',
        'file' => 'Câmpul :attribute trebuie să fie mai mare de :value kilobyți.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mare de :value.',
        'string' => 'Câmpul :attribute trebuie să aibă mai mult de :value caractere.',
    ],
    'gte' => [
        'array' => 'Câmpul :attribute trebuie să aibă :value elemente sau mai mult.',
        'file' => 'Câmpul :attribute trebuie să fie mai mare sau egal cu :value kilobyți.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mare sau egal cu :value.',
        'string' => 'Câmpul :attribute trebuie să aibă mai mult sau să fie egal cu :value caractere.',
    ],
    'image' => 'Câmpul :attribute trebuie să fie o imagine.',
    'in' => 'Valoarea selectată pentru :attribute este invalidă.',
    'in_array' => 'Câmpul :attribute trebuie să existe în :other.',
    'integer' => 'Câmpul :attribute trebuie să fie un număr întreg.',
    'ip' => 'Câmpul :attribute trebuie să fie o adresă IP validă.',
    'ipv4' => 'Câmpul :attribute trebuie să fie o adresă IPv4 validă.',
    'ipv6' => 'Câmpul :attribute trebuie să fie o adresă IPv6 validă.',
    'json' => 'Câmpul :attribute trebuie să fie un șir JSON valid.',
    'lowercase' => 'Câmpul :attribute trebuie să fie în litere mici.',
    'lt' => [
        'array' => 'Câmpul :attribute trebuie să aibă mai puțin de :value elemente.',
        'file' => 'Câmpul :attribute trebuie să fie mai mic de :value kilobyți.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mic de :value.',
        'string' => 'Câmpul :attribute trebuie să aibă mai puțin de :value caractere.',
    ],
    'lte' => [
        'array' => 'Câmpul :attribute nu trebuie să aibă mai mult de :value elemente.',
        'file' => 'Câmpul :attribute trebuie să fie mai mic sau egal cu :value kilobyți.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mic sau egal cu :value.',
        'string' => 'Câmpul :attribute trebuie să aibă mai puțin sau să fie egal cu :value caractere.',
    ],
    'mac_address' => 'Câmpul :attribute trebuie să fie o adresă MAC validă.',
    'max' => [
        'array' => 'Câmpul :attribute nu trebuie să aibă mai mult de :max elemente.',
        'file' => 'Câmpul :attribute nu trebuie să fie mai mare de :max kilobyți.',
        'numeric' => 'Câmpul :attribute nu trebuie să fie mai mare de :max.',
        'string' => 'Câmpul :attribute nu trebuie să fie mai mare de :max caractere.',
    ],
    'max_digits' => 'Câmpul :attribute nu trebuie să aibă mai mult de :max cifre.',
    'mimes' => 'Câmpul :attribute trebuie să fie un fișier de tip: :values.',
    'mimetypes' => 'Câmpul :attribute trebuie să fie un fișier de tip: :values.',
    'min' => [
        'array' => 'Câmpul :attribute trebuie să aibă cel puțin :min elemente.',
        'file' => 'Câmpul :attribute trebuie să fie de cel puțin :min kilobyți.',
        'numeric' => 'Câmpul :attribute trebuie să fie de cel puțin :min.',
        'string' => 'Câmpul :attribute trebuie să aibă cel puțin :min caractere.',
    ],
    'min_digits' => 'Câmpul :attribute trebuie să aibă cel puțin :min cifre.',
    'missing' => 'Câmpul :attribute trebuie să fie necompletat.',
    'missing_if' => 'Câmpul :attribute trebuie să fie necompletat când :other este :value.',
    'missing_unless' => 'Câmpul :attribute trebuie să fie necompletat, cu excepția cazului în care :other este :value.',
    'missing_with' => 'Câmpul :attribute trebuie să fie necompletat când :values este prezent.',
    'missing_with_all' => 'Câmpul :attribute trebuie să fie necompletat când :values sunt prezente.',
    'multiple_of' => 'Câmpul :attribute trebuie să fie un multiplu de :value.',
    'not_in' => 'Valoarea selectată pentru :attribute este invalidă.',
    'not_regex' => 'Formatul câmpului :attribute este invalid.',
    'numeric' => 'Câmpul :attribute trebuie să fie un număr.',
    'password' => [
        'letters' => 'Câmpul :attribute trebuie să conțină cel puțin o literă.',
        'mixed' => 'Câmpul :attribute trebuie să conțină atât litere, cât și cifre.',
        'numbers' => 'Câmpul :attribute trebuie să conțină cel puțin un număr.',
        'symbols' => 'Câmpul :attribute trebuie să conțină cel puțin un simbol.',
    ],
    'present' => 'Câmpul :attribute trebuie să fie prezent.',
    'prohibited' => 'Câmpul :attribute este interzis.',
    'prohibited_if' => 'Câmpul :attribute este interzis când :other este :value.',
    'prohibited_unless' => 'Câmpul :attribute este interzis, cu excepția cazului în care :other este în :values.',
    'prohibits' => 'Câmpul :attribute interzice :other să fie prezent.',
    'regex' => 'Formatul câmpului :attribute este invalid.',
    'relatable' => 'Câmpul :attribute nu poate fi asociat cu aceasta resursă.',
    'required' => 'Câmpul :attribute este obligatoriu.',
    'required_if' => 'Câmpul :attribute este obligatoriu când :other este :value.',
    'required_unless' => 'Câmpul :attribute este obligatoriu, cu excepția cazului în care :other este în :values.',
    'required_with' => 'Câmpul :attribute este obligatoriu când :values este prezent.',
    'required_with_all' => 'Câmpul :attribute este obligatoriu când :values sunt prezente.',
    'required_without' => 'Câmpul :attribute este obligatoriu când :values nu este prezent.',
    'required_without_all' => 'Câmpul :attribute este obligatoriu când niciuna dintre :values nu sunt prezente.',
    'same' => 'Câmpul :attribute și :other trebuie să fie identice.',
    'size' => [
        'array' => 'Câmpul :attribute trebuie să conțină exact :size elemente.',
        'file' => 'Câmpul :attribute trebuie să aibă :size kilobyți.',
        'numeric' => 'Câmpul :attribute trebuie să fie :size.',
        'string' => 'Câmpul :attribute trebuie să aibă :size caractere.',
    ],
    'starts_with' => 'Câmpul :attribute trebuie să înceapă cu una dintre următoarele valori: :values.',
    'string' => 'Câmpul :attribute trebuie să fie un șir de caractere.',
    'timezone' => 'Câmpul :attribute trebuie să fie o zonă validă.',
    'unique' => 'Câmpul :attribute a fost deja utilizat.',
    'uploaded' => 'Câmpul :attribute nu a reușit să se încarce.',
    'url' => 'Formatul câmpului :attribute este invalid.',
    'uuid' => 'Câmpul :attribute trebuie să fie un UUID valid.',
    'event_full' => "Nu va puteți înscrie! Evenimentul este plin.",
    'already_enrolled' => "Nu va puteți înscrie! Sunteți deja înscris la acest eveniment.",
    'too_young' => "Nu va puteți înscrie! Trebuie să aveți cel puțin :age ani.",
    'transition_not_allowed' => "Nu se poate schimba starea de la :from la :to.",

    /*
    |--------------------------------------------------------------------------
    | Linii de limbă personalizate pentru validare
    |--------------------------------------------------------------------------
    |
    | Aici puteți specifica mesaje de eroare personalizate pentru a înlocui mesajele implicite de validare.
    | Specificați regulile din clasa Validator ca chei în acest aranjament.
    |
    | De exemplu, pentru a personaliza regula „required” pentru câmpul „email”,
    | returnați un rând de limbă personalizat, folosind aranjamentul „email.required”.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Linii de limbă personalizate pentru atributele de validare
    |--------------------------------------------------------------------------
    |
    | Aici puteți specifica mesaje de eroare personalizate pentru atributele utilizate în validare.
    | De obicei, acest lucru este utilizat pentru a afișa numele atributelor mai prietenoase pentru utilizator.
    |
    | Această funcționalitate poate fi utilizată în cazul în care regula de validare specifică
    | pentru un atribut nu are sens sau nu are sens în contextul aplicației.
    |
    */

    'attributes' => [
        'terms' => 'termeni și condiții',
        'filter' => [
            'country_id' => 'țară',
        ],
        'state' => [
            'approved' => 'acceptat',
            'rejected' => 'respins',
            'pending' => 'în așteptare',
        ]
    ],

];
