# todoList

The todoList with unit & feature testing implement by Laravel.

## screenshot

TODO

## architecture

TODO

## testing

run unit testing

```
$ php artisan test --coverage -- tests/Unit/

   PASS  Tests\Unit\TodoControllerTest
  ✓ index method returns view with todo get                        0.20s
  ✓ create method returns view with empty data                     0.02s
  ✓ create action method create by request and service             0.04s
  ✓ detail method returns view with todo                           0.02s
  ✓ edit method returns view with todo                             0.02s
  ✓ update action method create by request and service             0.02s
  ✓ delete method delete todo and redirect to index                0.02s

   PASS  Tests\Unit\TodoRequestTest
  ✓ authorize method returns true                                  0.01s
  ✓ rules method returns rules

   PASS  Tests\Unit\TodoServiceTest
  ✓ create return saved todo and init                              0.03s
  ✓ update return updated todo                                     0.02s

  Tests:    11 passed (37 assertions)
  Duration: 0.55s

  Http/Controllers\Controller ................................... 100.0%
  Http/Controllers\TodoController ............................... 100.0%
  Http/Requests\TodoRequest ..................................... 100.0%
  Models\Todo ................................................... 100.0%
  Providers\AppServiceProvider .................................. 100.0%
  Services\TodoService .......................................... 100.0%
  ──────────────────────────────────────────────────────────────────────
                                                          Total: 100.0 %
```

## License

The todoList is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
