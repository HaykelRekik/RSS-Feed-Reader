<?php

use Tests\TestCase;
use App\Http\Requests\Api\ImportArticlesRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);
uses(TestCase::class);

test('Gets all the artidles', function () {
    $response = $this->json('GET', '/api/articles');

    $response->assertStatus(200);
});


test('articles are imported from RSS feed', function () {

    $rssUrl = 'https://example.com/feed';


    $response = $this->json('POST', '/api/import', ['siteRssUrl' => $rssUrl]);

    $response->assertStatus(201);
});


test('RSS feed URL is required', function () {
    $request = new ImportArticlesRequest();

    $validator = validator($request->all(), $request->rules());

    $this->assertTrue($validator->fails());

    $this->assertTrue($validator->errors()->has('siteRssUrl'));
});

test('RSS feed URL must be a valid URL', function () {
    $request = new ImportArticlesRequest();

    $rssUrl = 'not-a-valid-url';

    $validator = validator(['siteRssUrl' => $rssUrl], $request->rules());

    $this->assertTrue($validator->fails());

    $this->assertTrue($validator->errors()->has('siteRssUrl'));
});

test('RSS feed URL is valid', function () {
    $request = new ImportArticlesRequest();

    $rssUrl = 'https://example.com/feed';

    $validator = validator(['siteRssUrl' => $rssUrl], $request->rules());

    $this->assertTrue($validator->passes());
});
