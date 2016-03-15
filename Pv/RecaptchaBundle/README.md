# RecaptchaBundle

Symfony2 Bundle for Google reCaptcha v2.
It provides a form type to include in your forms and a specific validator.

## Installation

This bundle is not hosted by Packagist yet.
It will be soon.

### Enable the bundle in your project

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new PV\RecaptchaBundle\PVRecaptchaBundle(),
        // ...
    );
}
```

## Config

Add the following line to your `config.yml` :
```yaml
# app/config/config.yml

# Include the recaptcha widget
twig:
    form:
        resources:
            # ...
            - 'PVRecaptchaBundle:Form:recaptcha_widget.html.twig'
            # ...

# Recaptcha Configuration
ice_recaptcha:
    recaptcha_public_key: 'your-public-key'
    recaptcha_private_key: 'your-private-key'
```

## Usage

Add the following code to your form class :
```php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        // ...
        ->add('recaptcha', 'pv_recaptcha', array(
            'label' => 'Your label'
            'mapped' => false,
        ))
        // ...
    ;
}
```
Then, display the widget in your twig view like
```twig
    {{ form_label(form.recaptcha) }}
    {{ form_widget(form.recaptcha) }}
    {{ form_errors(form.recaptcha) }}
```

## TODO
* Publish the Bundle into packagist and create a tag
* All translations
