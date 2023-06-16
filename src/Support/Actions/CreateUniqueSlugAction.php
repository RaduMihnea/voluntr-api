<?php

namespace Support\Actions;

use Illuminate\Support\Str;

class CreateUniqueSlugAction
{
    public function __invoke(string $model, string $title): string
    {
        $slug = Str::slug($title);

        $latestSlug = $model::whereRaw("slug = '$slug' or slug LIKE '$slug-%'")->latest('id')->value('slug');

        if ($latestSlug) {
            $pieces = explode('-', $latestSlug);

            $number = intval(end($pieces));

            $slug .= '-' . ($number + 1);
        }

        return $slug;
    }
}
