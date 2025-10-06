<?php

use function Pest\Laravel\get;

it(
    'verifies that the jiris.create route displays a form to create a jiri',
    function (string $locale, string $main_heading) {
        App::setLocale($locale);

        $response = get(route('jiris.create'));

        $response->assertSee("<h1 class=\"font-bold text-4xl my-4 text-center\">$main_heading</h1>", false);
    }
)->with([
    ['fr', 'Créez un jiri'],
    ['en', 'Create a jiri'],
]);


