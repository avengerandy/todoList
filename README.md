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

run feature testing

```
$ php artisan test --coverage -- tests/Feature/

   PASS  Tests\Feature\TodoTest
  ✓ index return view with empty list                              0.29s
  ✓ index return view with todo list                               0.04s
  ✓ create return view                                             0.03s
  ✓ create action validation error todo and redirect to back       0.04s
  ✓ create action todo and redirect to index                       0.03s
  ✓ detail return view with todo                                   0.03s
  ✓ edit return view with todo                                     0.04s
  ✓ update todo validation error and redirect to back              0.04s
  ✓ update todo and redirect to index                              0.04s
  ✓ delete todo and redirect to index                              0.04s

  Tests:    10 passed (58 assertions)
  Duration: 0.78s

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
