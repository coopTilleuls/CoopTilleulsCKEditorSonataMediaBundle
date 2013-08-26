# Architecture

## Media browser

This bundle adds a new action allowing to browse and select files managed by SonataMediaBundle with CKEditor.

The route name of this action is `admin_sonata_media_media_browser`. Two optionals parameters can be set:
* `provider`: the SonataMediaBundle provider to select (default with all providers)
* `context`: the SonataMediaBundle context to select (default to the default context)

## Direct upload

Another action allowing to upload files directly from CKEditor is provided.

The route name of this action is `admin_sonata_media_media_upload`.

This route must have a `provider` parameter set (`sonata.media.provider.file` is a good default choice).
The uploaded file will be handled with this provider.

An optional `context` parameter can be added. If set, the uploaded file will be added to this context.