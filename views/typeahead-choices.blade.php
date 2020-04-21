<?php /** @var \Galahad\Aire\Elements\Attributes\Collection $attributes */ ?>


<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/base.min.css"
/>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
/>


<select id="typeahead"></select>

<script type="text/javascript">
    const element = document.getElementById('typeahead')
    const choices = new Choices(element, {
        choices: {{  }},
    });
</script>
