<?php

use Illuminate\Testing\Fluent\AssertableJson;

expect()->extend('firstResourceToMatchJson', function ($value, bool $strict = false) {
    if (is_array($value)) {
        return $this->assertJson([
            'data' => [
                0 => $value,
            ],
        ], $strict);
    }

    return $this->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data.0', $value)
            ->etc()
    );
});

expect()->extend('assertJsonData', function ($value, bool $strict = false) {
    if (is_array($value)) {
        return $this->assertJson([
            'data' => $value,
        ], $strict);
    }

    return $this->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data', $value)
            ->etc()
    );
});

expect()->extend('resourceHasAll', function (array $value) {
    return $this->assertJsonData(
        fn (AssertableJson $json) => $json
            ->hasAll($value)
            ->etc()
    );
});

expect()->extend('resourceMissingAll', function (array $value) {
    return $this->assertJsonData(
        fn (AssertableJson $json) => $json
            ->missingAll($value)
            ->etc()
    );
});

expect()->extend('resourceWhereAll', function ($value, bool $strict = false) {
    if (is_array($value)) {
        return $this->assertJsonData($value, $strict);
    }

    return $this->assertJsonData(
        fn (AssertableJson $json) => $json
            ->whereAll($value)
            ->etc()
    );
});

expect()->extend('whereAllTypes', function ($value) {
    return $this->assertJsonData(
        fn (AssertableJson $json) => $json
            ->whereAllType($value)
            ->etc()
    );
});

expect()->extend('firstResourceHasAll', function ($value) {
    return $this->firstResourceToMatchJson(
        fn (AssertableJson $json) => $json
            ->hasAll($value)
            ->etc()
    );
});

expect()->extend('firstResourceMissingAll', function ($value) {
    return $this->firstResourceToMatchJson(
        fn (AssertableJson $json) => $json
            ->missingAll($value)
            ->etc()
    );
});

expect()->extend('firstResourceWhereAll', function ($value, bool $strict = false) {
    if (is_array($value)) {
        return $this->firstResourceToMatchJson($value, $strict);
    }

    return $this->firstResourceToMatchJson(
        fn (AssertableJson $json) => $json
            ->whereAll($value)
            ->etc()
    );
});

expect()->extend('firstResourceTypes', function ($value) {
    return $this->firstResourceToMatchJson(
        fn (AssertableJson $json) => $json
            ->whereAllType($value)
            ->etc()
    );
});

expect()->extend('resourcesCount', function (int $count) {
    return $this->assertJson(
        fn (AssertableJson $json) => $json
            ->has('data', $count)
            ->etc()
    );
});
