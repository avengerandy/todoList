<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Requests\TodoRequest;

class TodoRequestTest extends TestCase
{
    public function test_authorize_method_returns_true(): void
    {
        $request = new TodoRequest();
        $authorize = $request->authorize();

        $this->assertTrue($authorize);
    }

    public function test_rules_method_returns_rules(): void
    {
        $expectRules = [
            'title' => ['required'],
            'description' => ['required']
        ];

        $request = new TodoRequest();
        $actualRules = $request->rules();

        $this->assertSame($expectRules, $actualRules);
    }
}
