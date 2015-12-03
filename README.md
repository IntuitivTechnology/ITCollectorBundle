ITCollectorBundle
=============

This bundle will allow you to add some extra features to your Symfony2 dev debug toolbar.

Git
-------------

You will be able to view, directly in the toolbar, if your local git branch is up-to-date compared to the distant branch.
You can also add some extra useful links in it (Link to the Gitlab/Github project for example).


Installation
------------

### Step 1: Download ITCollectorBundle using Composer

```bash
$ composer require intuitiv/it-collector-bundle
```

### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Intuitiv\ITCollectorBundle\ITCollectorBundle(),
    );
}

?>
```

### Step 3 Change parameters in your config.yml

``` yaml
it_collector:
    git:
        branch: develop # default : master
        urls: # optional, add additional links
            - {'name': 'Gitlab', 'url': 'http://gitlab.company.com/bundle/my-project' }
```


Authors
------------

- Raphaël Amourette  (amourette.raphael@gmail.com / Twitter : @_nanakii)
- Tristan Pettinotti (t.pettinotti@gmail.com)