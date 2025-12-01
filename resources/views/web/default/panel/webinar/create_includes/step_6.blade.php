@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush


<section class="mt-50">
     <input type="hidden" id="user_email" value="{{ Auth::user()->email }}">
            <input type="hidden" id="user_phone" value="{{ Auth::user()->phone }}">
    <div class="">
        <h2 class="section-title after-line">{{ trans('public.faq') }} ({{ trans('public.optional') }})</h2>
    </div>

    <button id="webinarAddFAQ" data-webinar-id="{{ $webinar->id }}" type="button" class="btn btn-primary btn-sm mt-15">{{ trans('public.add_faq') }}</button>

    <div class="row mt-10">
        <div class="col-12">

            <div class="accordion-content-wrapper mt-15" id="faqsAccordion" role="tablist" aria-multiselectable="true">
                @if(!empty($webinar->faqs) and count($webinar->faqs))
                    <ul class="draggable-lists" data-order-table="faqs">
                        @foreach($webinar->faqs as $faqInfo)
                            @include('web.default.panel.webinar.create_includes.accordions.faq',['webinar' => $webinar,'faq' => $faqInfo])
                        @endforeach
                    </ul>
                @else
                    @include(getTemplate() . '.includes.no-result',[
                        'file_name' => 'faq.png',
                        'title' => trans('public.faq_no_result'),
                        'hint' => trans('public.faq_no_result_hint'),
                    ])
                @endif
            </div>
        </div>
    </div>
</section>

<div id="newFaqForm" class="d-none">
    @include('web.default.panel.webinar.create_includes.accordions.faq',['webinar' => $webinar])
</div>

@foreach(\App\Models\WebinarExtraDescription::$types as $webinarExtraDescriptionType)
    <section class="mt-50">
        <div class="">
            <h2 class="section-title after-line">{{ trans('update.'.$webinarExtraDescriptionType) }} ({{ trans('public.optional') }})</h2>
        </div>

        <button id="add_new_{{ $webinarExtraDescriptionType }}" data-webinar-id="{{ $webinar->id }}" type="button" class="btn btn-primary btn-sm mt-15">{{ trans('update.add_'.$webinarExtraDescriptionType) }}</button>

        <div class="row mt-10">
            <div class="col-12">

                @php
                    $webinarExtraDescriptionValues = $webinar->webinarExtraDescription->where('type',$webinarExtraDescriptionType);
                @endphp

                <div class="accordion-content-wrapper mt-15" id="{{ $webinarExtraDescriptionType }}_accordion" role="tablist" aria-multiselectable="true">
                    @if(!empty($webinarExtraDescriptionValues) and count($webinarExtraDescriptionValues))
                        <ul class="draggable-content-lists draggable-lists-{{ $webinarExtraDescriptionType }}" data-drag-class="draggable-lists-{{ $webinarExtraDescriptionType }}" data-order-table="webinar_extra_descriptions_{{ $webinarExtraDescriptionType }}">
                            @foreach($webinarExtraDescriptionValues as $learningMaterialInfo)
                                @include('web.default.panel.webinar.create_includes.accordions.extra_description',
                                    [
                                        'webinar' => $webinar,
                                        'extraDescription' => $learningMaterialInfo,
                                        'extraDescriptionType' => $webinarExtraDescriptionType,
                                        'extraDescriptionParentAccordion' => $webinarExtraDescriptionType.'_accordion',
                                    ]
                                )
                            @endforeach
                        </ul>
                    @else
                        @include(getTemplate() . '.includes.no-result',[
                            'file_name' => 'faq.png',
                            'title' => trans("update.{$webinarExtraDescriptionType}_no_result"),
                            'hint' => trans("update.{$webinarExtraDescriptionType}_no_result_hint"),
                        ])
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div id="new_{{ $webinarExtraDescriptionType }}_html" class="d-none">
        @include('web.default.panel.webinar.create_includes.accordions.extra_description',
            [
                'webinar' => $webinar,
                'extraDescriptionType' => $webinarExtraDescriptionType,
                'extraDescriptionParentAccordion' => $webinarExtraDescriptionType.'_accordion',
            ]
        )
    </div>
@endforeach


@push('scripts_bottom')
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>
@endpush
            <button type="button" class="btn btn-sm btn-primary" id="improveWithKemedari">improve With Kemedari</button>

<script>
    $(document).ready(function () {
    $('#improveWithKemedari').on('click', function (e) {
        e.preventDefault();

        let faqs = [];

        $('li.accordion-row').each(function() {
            let id = $(this).data('id') || 'new';
            let title = $(this).find('input[name="ajax['+id+'][title]"]').val();
            let answer = $(this).find('textarea[name="ajax['+id+'][answer]"]').val();

            faqs.push({
                id: id,
                title: title,
                answer: answer
            });
        });

        $.ajax({
            url: 'https://kemedari.com/backend/wxkmahsfs78.php?action=rephrase_course_content', 
            method: 'POST',
            dataType: 'json',
            data: { 
                user_email: $('#user_email').val(),
                user_phone: $('#user_phone').val(),
                faqs: JSON.stringify(faqs),
                course_title: $('#title').val(),
                description: $('#description').val()
            },
            success: function(response) {
                // console.log('Response:', response);
                 if (response.redirect) {
       window.open(response.redirect, '_blank');        }

    
                if (response.faqs) {
                    $.each(response.faqs, function(index, faq) {
                        let $faqRow = $('li.accordion-row[data-id="'+faq.id+'"]');

                        if ($faqRow.length === 0 && faq.id === 'new') {
                            $faqRow = $('li.accordion-row').eq(index);
                        }

                        $faqRow.find('input[name="ajax['+faq.id+'][title]"]').val(faq.title);
                        $faqRow.find('textarea[name="ajax['+faq.id+'][answer]"]').val(faq.answer);
                    });
                }
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    });
});

</script>