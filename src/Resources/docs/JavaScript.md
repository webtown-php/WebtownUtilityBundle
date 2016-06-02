# JavaScript

A JavaScript fájlokat lehetőség szerint a legvégén szeretnénk betölteni, azonban vannak Bundle-ök vagy esetek, amikor ez
egyáltalán nem könnyű feladat. Pl mert a külső Bundle nem teszi ezt lehetővé, vagy pl Form widget-ben szeretnénk használni JS-t.

Ennek a problémának a megoldására lett létrehozva a `registerJs` JS objektum. Ennek használatához a következőkre van szükség:

1. A `layout.html.twig`-ben a fejlécbe be kell include-olni a `WebtownUtilityBundle:JavaScript:header.html.twig`-et.
2. Az összes script beszúrása után kell include-olni a `WebtownUtilityBundle:JavaScript:footer.html.twig`-et.
3. A `registerJs.add(function () { ... });` szerkezettel kell "késleltetni" a script futását.

Az első két pontra példa látható lejjebb.

Ha ez megvan, akkor minden olyan esetben, amikor futtatni kell vmi JS fájlt, vagy olyan kódot kell beszúrni, ami JS kódot generál, akkor a következő módon kell ejárni:

```twig
    <script type="text/javascript">
        registerJs.add(function () {
            jQuery('.bxslider').bxSlider({
                auto: true,
                pause: 10000,
                pagerCustom: '#bx-pager-{{ resource.id }}'
            });
        });
    </script>
```

vagy:

```twig
    <script type="text/javascript">
        registerJs.add(function () {
            {{ chart(chart) }} {# <=== JS-t renderel #}
        });
    </script>
```

## Kunstmaan

Kunstmaan esetén az alábbi fájlokba kell belenyúlni:

### Admin bundle

```twig
{# app/Resources/KunstmaanAdminBundle/views/Default/_js_header_extra.html.twig #}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

{% include 'WebtownUtilityBundle:JavaScript:header.html.twig' %}
```

```twig
{# app/Resources/KunstmaanAdminBundle/views/Default/_js_footer_extra.html.twig #}

<script src="{{ asset('js/bxslider.min.js') }}"></script>
<script src="//code.highcharts.com/4.1.8/highcharts.js"></script>
<script src="//code.highcharts.com/4.1.8/modules/data.js"></script>
<script src="//code.highcharts.com/4.1.8/modules/exporting.js"></script>

{% include 'WebtownUtilityBundle:JavaScript:footer.html.twig' %}
```

### Public bundle

```twig
{# src/Company/PublicBundle/Resources/views/Layout/layout.html.twig #}
{% spaceless %}<!DOCTYPE html>
{% set htmlLocale = app.request.locale|default(defaultlocale)|slice(0,2) %}
<!--[if lte IE 9]> <html class="no-js lt-ie9" lang="{{ htmlLocale }}"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="{{ htmlLocale }}"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {# title, links, favicons, css, ... #}

    {% include 'WebtownUtilityBundle:JavaScript:header.html.twig' %} {# <=== #}
</head>
{% endspaceless %}

<body id="sidebar-toggle-container" class="sidebar-toggle-container{% block extra_body_classes %}{% endblock %}" {% block extra_body_attributes %}{% endblock %}>

    {# ... content ... #}

    {# JS Footer #}
    {% include '@WebtownPublic/Layout/_js_footer.html.twig' %}

    {% block javascripts_bottom %}{% endblock %}

    {% include 'WebtownUtilityBundle:JavaScript:footer.html.twig' %} {# <=== #}
</body>
</html>
```
