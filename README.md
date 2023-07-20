# Laravel "Multi-Target Inheritance" by Polymorphic Relationships Example

> :warning: **This repository is not maintained anymore.** Laravel versions etc. are out of date and contain serious security issues.

NOTE: The `Module` (`moduleable`) is called `Element` (`elementable`) in this example.

Based on [this](https://stackoverflow.com/questions/59021442/multi-table-inheritance-in-laravel-eloquent/59146241#59146241) Stackoverflow thread (props to user [sss S](https://stackoverflow.com/users/11797973/sss-s) for pointing me in the right direction).

**Models**
```php
class Element extends Model {
  public function elementable() {
    return $this->morphTo();
  }
}

class TextElement extends Model {
  public function element() {
    return $this->morphOne('App\Element', 'elementable');
  }
}
```


**Migrations**
```php
Schema::create('elements', function (Blueprint $table) {
  $table->bigIncrements('id');
  $table->float('x');
  // ... other fields mentioned above
  $table->morphs('elementable'); // this creates a "elementable_id" and "elementable_type" field
  $table->timestamps();
});

Schema::create('textElements', function (Blueprint $table) {
  $table->bigIncrements('id');
  // ... only the fields that are exclusive for a TextElement (= not in Element, except "id")
});
```

**Factories**
```php
$factory->define(TextElement::class, function (Faker $faker) {
    return [
        // ... fill the "exclusive" fields as usual
    ];
});

$factory->define(Element::class, function (Faker $faker) {
  $elementables = [
    TextElement::class,
    // ... to be extended
  ];

  $elementableType = $faker->randomElement($elementables);
  $elementable = factory($elementableType)->create();

  return [
    // ... the fields exclusive for Element
    // add the foreign key for the created "elementable" (TextElement)
    'elementable_id' => $elementable->id,
    'elementable_type' => $elementableType
    ];
});
```

**Controller**
```php
public function index() {
  $all = \App\Element::whereHasMorph('elementable', '*')->with('elementable')->get();
  return response()->json($all);
}
```
The wildcard `*` will show any specific `Element` (e.g. TextElement, ImageElement) that was configured following the steps above. Adding `->with('elementable')` directly populates the "specific" attributes for every `Element`. Have a look at the section ["Querying Polymorphic Relationships"][1] in the official Laravel documentation for further information.

**Output**

```json
[{
   "id":1,
   "x":34.47,
   "y":17.04,
   "elementable_type":"App\\TextElement",
   "elementable_id":1,
   "created_at":"2019-12-02 20:08:01",
   "updated_at":"2019-12-02 20:08:01",
   "elementable":{
      "id":1,
      "font":"Arial",
      "color":"#94d22e",
      "size":12,
      "created_at":"2019-12-02 20:08:00",
      "updated_at":"2019-12-02 20:08:00"
   }
}]
```


  [1]: https://laravel.com/docs/6.x/eloquent-relationships#querying-polymorphic-relationships
