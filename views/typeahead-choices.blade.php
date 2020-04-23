<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.js"></script>

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
/>

@if($options)
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $multiple ? 'multiple' : ''}}
    ></select>
@else
    <input
        id="{{ $id }}"
        type="text"
        name="{{ $name }}"
    ></select>
@endif

<script type="text/javascript">
    var choices_params = {
        shouldSort: false,
        duplicateItemsAllowed: false,
    };

    @if($options)
        choices_params.choices = {!! $options !!};
    @endif

    @if($allow_arbitrary_input)
        choices_params.addItems = true;
    @endif

    var choices_element_{{ $name }} = document.getElementById('{{ $id }}')
    console.log(choices_params);
    var choices_{{ $name }} = new Choices(choices_element_{{ $name }}, choices_params);

    @if($allow_arbitrary_input)
        choices_element_{{ $name }}.addEventListener(
            'search',
            function(event) {

                // FIXME - 
                //  This is broken as of now. The best I can do is disable you from 
                //  re-adding an option, but I can't stop it from showing up in search results
                
                var current = choices_{{ $name }}._currentState.choices
                    .filter(function(choice) {
                        return !(choice.customProperties && choice.customProperties.disposable);
                    })
                    .map(function(choice) {
                        choice.selected = false;
                        choice.disable = true;

                        return choice;
                    });

                choices_{{ $name }}.setChoices([
                    {
                        label: event.detail.value,
                        value: event.detail.value,
                        selected: false,
                        customProperties: {
                            disposable: true
                        }
                    },
                    ...current
                ], 'value', 'label', true)
            }
        );

        choices_element_{{ $name }}.addEventListener(
            'choice',
            function(event) {
                console.log(choices_{{ $name }}._currentState)

                choices_{{ $name }}.clearInput()
            }
        );
    @endif
</script>
