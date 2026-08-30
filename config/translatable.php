<?php

/*
|--------------------------------------------------------------------------
| Translatable section settings
|--------------------------------------------------------------------------
|
| For every admin "section" page, which settings keys hold language-specific
| text. Anything not listed here — links, embed URLs, phone numbers, uploads,
| layout toggles — is shared by all languages and is only editable while the
| default language is selected.
|
| Both the controllers (when saving) and the language dropdown (when deciding
| which fields to lock during a translation pass) read these lists, so they
| can never drift apart.
|
*/

return [

    'sections' => [

        'our-story' => [
            'story_badge',
            'story_heading_line1',
            'story_heading_line2',
            'story_paragraph1',
            'story_paragraph2',
            'story_location_title',
            'story_location_subtitle',
            'story_feature1_label',
            'story_feature2_label',
            'story_feature3_label',
            'story_button_text',
        ],

        'quick-stats' => [
            'stat1_suffix', 'stat1_label',
            'stat2_suffix', 'stat2_label',
            'stat3_suffix', 'stat3_label',
            'stat4_suffix', 'stat4_label',
        ],

        'process-section' => [
            'process_badge',
            'process_heading_line1',
            'process_heading_line2',
        ],

        'products-section' => [
            'products_badge',
            'products_heading_line1',
            'products_heading_line2',
            'products_description',
        ],

        'cert-section' => [
            'cert_badge',
            'cert_heading_line1',
            'cert_heading_line2',
            'cert_description',
        ],

        'faq-section' => [
            'faq_badge',
            'faq_heading',
            'faq_description',
        ],

        'gallery-section' => [
            'gallery_badge',
            'gallery_heading',
            'gallery_description',
        ],

        'contact-section' => [
            'contact_badge',
            'contact_heading_line1',
            'contact_heading_line2',
            'contact_description',
            'contact_address',
            'contact_manager',
            'contact_form_title',
            'contact_button_text',
            'contact_success_message',
        ],

        'footer-section' => [
            'footer_description',
            'footer_copyright',
            'footer_columns',
        ],

        // Search engines index each language separately, so the page title,
        // meta description, keywords and social-card copy are per language.
        'seo' => [
            'seo_title',
            'seo_description',
            'seo_keywords',
            'og_title',
            'og_description',
            'schema_address',
        ],

    ],

    /*
    | Settings each section shares across languages. Listed explicitly so a
    | translation pass can never blank one out.
    */

    'shared' => [

        'our-story' => [
            'story_media_type',
            'story_map_url',
            'story_button_link',
        ],

        'quick-stats' => [
            'stat1_number', 'stat1_suffix_pos',
            'stat2_number', 'stat2_suffix_pos',
            'stat3_number', 'stat3_suffix_pos',
            'stat4_number', 'stat4_suffix_pos',
        ],

        'contact-section' => [
            'contact_phone',
            'contact_email',
        ],

        'footer-section' => [
            'footer_whatsapp',
        ],

        // schema_business_type holds a schema.org vocabulary term and
        // schema_business_name is the brand: translating either would break
        // the structured data rather than localise it.
        'seo' => [
            'schema_business_name',
            'schema_business_type',
            'schema_email',
            'schema_phone',
            'schema_founding_date',
            'schema_price_range',
            'google_verification',
            'google_analytics',
        ],

    ],

];
