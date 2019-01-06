# Installation

If not already done, install and configure [SonataMediaBundle](http://sonata-project.org/bundles/media/master/doc/index.html).

Then, use [Composer](https://getcomposer.org/) to install CoopTilleulsCKEditorSonataMediaBundle and FOSCKEditorBundle:

    composer require tilleuls/ckeditor-sonata-media-bundle friendsofsymfony/ckeditor-bundle

If you use Symfony <3.4 and PHP <7.1 do

    composer require tilleuls/ckeditor-sonata-media-bundle friendsofsymfony/ckeditor-bundle:1.2

Register the bundle in your AppKernel:

```php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...
        new CoopTilleuls\Bundle\CKEditorSonataMediaBundle\CoopTilleulsCKEditorSonataMediaBundle(),
        new FOS\CKEditorBundle\FOSCKEditorBundle(),
        // ...
    );
}
```
or 

```php
// config/bundles.php

return [
    // ...
    CoopTilleuls\Bundle\CKEditorSonataMediaBundle\CoopTilleulsCKEditorSonataMediaBundle::class => ['all' => true],
    FOS\CKEditorBundle\FOSCKEditorBundle::class => ['all' => true],
    // ...
];
```

Install bundles:

```
$ composer update
```

Add form theme to render the editor:

Symfony 2/3: app/config/config.yml   
Symfony 4: config/packages/twig.yaml
```
twig:
    form_themes:
        - '@FOSCKEditor/Form/ckeditor_widget.html.twig'
```

Configure FOSCKEditorBundle to use the bundle as file browser:

```yaml
# app/config/config.yml

fos_ck_editor:
    default_config: default
    configs:
        default:
            filebrowserBrowseRoute: admin_sonata_media_media_browser
            filebrowserImageBrowseRoute: admin_sonata_media_media_browser
            # Display images by default when clicking the image dialog browse button
            filebrowserImageBrowseRouteParameters:
                provider: sonata.media.provider.image
            filebrowserUploadRoute: admin_sonata_media_media_upload
            filebrowserUploadRouteParameters:
                provider: sonata.media.provider.file
            # Upload file as image when sending a file from the image dialog
            filebrowserImageUploadRoute: admin_sonata_media_media_upload
            filebrowserImageUploadRouteParameters:
                provider: sonata.media.provider.image
                context: my-context # Optional, to upload in a custom context
```

## Extending SonataMedia

```
php app/console sonata:easy-extends:generate --dest=src SonataMediaBundle
```

Then update your ApplicationSonataMediaBundle:

```php
// Application\Sonata\MediaBundle\ApplicationSonataMediaBundle.php

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'CoopTilleulsCKEditorSonataMediaBundle';
    }
```

If you want to customize `MediaAdminController` you must extends `CoopTilleuls\Bundle\CKEditorSonataMediaBundle\Controller\MediaAdminController` in your bundle, and set parameter `sonata.media.admin.media.controller` to match your controller.

## Usage without FOSCKEditorBundle

This bundle can be used with a custom install of CKEditor.
Read the [file browser (uploader)](http://docs.cksource.com/CKEditor_3.x/Developers_Guide/File_Browser_(Uploader)) doc of CKEditor and the [architecture](architecture.md) of this bundle.
