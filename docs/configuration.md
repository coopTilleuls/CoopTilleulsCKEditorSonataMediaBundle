# Full configuration options

```yaml
# Symfony 3: app/config/config.yml
# Symfony 4: config/packages/coop_tilleuls_ck_editor_sonata_media.yaml

coop_tilleuls_ck_editor_sonata_media:
    templates:
        layout: CoopTilleulsCKEditorSonataMediaBundle::layout.html.twig # Layout of the file browser
        browser: CoopTilleulsCKEditorSonataMediaBundle:MediaAdmin:browser.html.twig # Template of the CKEditor file browser
        upload: CoopTilleulsCKEditorSonataMediaBundle:MediaAdmin:upload.html.twig # Template returned after a direct upload
```
