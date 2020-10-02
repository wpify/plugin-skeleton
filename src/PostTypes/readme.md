# Custom post types
In the `Cpt` folder you should specify your Custom Post Types definitions.

## Custom post type class
Every custom post type extends the `AbstractPostType` and has to implement the following methods:
* `post_type_args` - array of the args for registering the post type, matches the standard WP args for [`register_post_type`](https://developer.wordpress.org/reference/functions/register_post_type/)
* `post_type_name` - CPT name
* `model` - name of the model Class. Every CPT *has to* have a model, if you don't need a custom model, you can use the generic `PostTypeModel::class`.

## Registering CPT
To register the new CPT, add it to the `modules` property of `Managers/CptManager`.

## Using CLI for creating a new CPT

The easiest way to create a new Custom Post Type is to use the cli command `wp wpify cpt MyPostType`.

That automatically generates custom post type with slug `my-post-type`, creates default *Model* and *Repository* and adds all of these to the respective *Managers*.

## Custom fields

You should also define custom fields in the `Cpt` class if needed. To do that, you need to use on of the `AbstractCustomFieldsFactory`. Currently `CMB2` and `CarbonFields` factories are available.

To add custom fields, add `custom_fields_factory` method, which should return the factory you want to use. After that you can add the custom fields definitions into the `custom_fields` method.

## Disabling Post Type registration

If you need to use a post type that is already registered (ie. `Product` when using WooCommerce), you should set `protected $register_cpt = false;`. In that case you need to ensure the custom post type exists before you initialize your Cpt.
