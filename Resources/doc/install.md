# Installation

If not already done, install and configure [SonataMediaBundle](http://sonata-project.org/bundles/media/master/doc/index.html).

Then, use [Composer](https://getcomposer.org/) to install CoopTilleulsCKEditorSonataMediaBundle and IvoryCKEditorBundle:

    composer require tilleuls/ckeditor-sonata-media-bundle egeloen/ckeditor-bundle

Register the bundle in your AppKernel:

```php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...
        new CoopTilleuls\Bundle\CKEditorSonataMediaBundle\CoopTilleulsCKEditorSonataMediaBundle(),
        new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
        // ...
    );
}
```

Install bundles:

```
$ composer update
```

Configure IvoryCKEditorBundle to use the bundle as file browser:

```yaml
# app/config/config.yml

ivory_ck_editor:
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

This bundle extends SonataMedia. So, if you want to extends SonataMedia, extends this bundle, not SonataMedia directly.

### Using SonataEasyExtendsBundle

Run the generate command on CoopTilleulsCKEditorSonataMediaBundle:

    php app/console sonata:easy-extends:generate CoopTilleulsCKEditorSonataMediaBundle

### Directly

Update your bundle file to specify CoopTilleulsCKEditorSonataMediaBundle as parent:

```php
// Acme\Bundle\MediaBundle\AcmeMediaBundle

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'CoopTilleulsCKEditorSonataMediaBundle';
    }
```

If you want to customize `MediaAdminController` you must extends `CoopTilleuls\Bundle\CKEditorSonataMediaBundle\Controller\MediaAdminController` in your bundle.

## Usage without IvoryCKEditorBundle

This bundle can be used with a custom install of CKEditor.
Read the [file browser (uploader)](http://docs.cksource.com/CKEditor_3.x/Developers_Guide/File_Browser_(Uploader)) doc of CKEditor and the [architecture](architecture.md) of this bundle.
