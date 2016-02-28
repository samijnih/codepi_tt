<?php

return [
    'h2' => 'Parcourir les concerts à venir',

    /////////////
    // Filters //
    /////////////
    'submit_filters'       => 'Filter les concerts',
    'select_city_default'  => 'Ville',
    'select_tags_default'  => 'Tags',
    'select_price_default' => 'Prix',
    'label_date_between'   => 'Entre le',
    'label_date_and'       => 'et le',
    'select_date_default'  => 'Date',

    //////////
    // Data //
    //////////
    'show_header_at'        => '@',
    'show_header_separator' => '-',
    'show_price'            => 'Prix : ',
    'link_to_show'          => 'Voir le détail >',
    'no_show'               => 'Aucun concert',

    ////////////
    // Errors //
    ////////////
    'filter_city_required'          => 'La ville est requise.',
    'filter_city_exists'            => "La ville n'existe pas",
    'filter_tags_required'          => 'Les tags sont requis.',
    'filter_tags_exists'            => "Les tags n'existent pas.",
    'filter_price_required'         => 'Le prix est requis.',
    'filter_price_numeric'          => 'Le prix doit être numérique.',
    'filter_price_min'              => 'Le prix doit être supérieur à 0€.',
    'filter_date_start_required'    => 'La date de début est requise.',
    'filter_date_start_date_format' => 'La date de début doit être au format :format.',
    'filter_date_start_before'      => 'La date de début doit être inférieur à la date de fin.',
    'filter_date_end_required'      => 'La date de fin est requise.',
    'filter_date_end_date_format'   => 'La date de fin doit être au format :format.',
];