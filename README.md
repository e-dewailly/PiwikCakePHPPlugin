# Piwik Analytics plugin for CakePHP 2.X

This Piwik plugin has a Component that will let you integrate it very easyly in your CakePHP site.


## Installation

Unzip / paste the plugin folder to your CakePHP plugins folder

Go to your AppController.php file and add this at the components array:

```php
public $components = array(
	'Piwik.Piwik' => array(
		'URL' => '{URL TO YOUR PIWIK INSTALLATION}',
		'idSite' => {SITE ID IN YOUR PIWIK},
		'autotrack' => {true|false}
	)
);
```

That's all. Now your site is tracking every visit to your piwik stats.

By default it takes "{ControllerName} > {ActionName} -> {NamedParams}" as page title.

## Usage and examples

Obviously you can also disable the "autotrack" feature and use the component and the helper feeting it to your own needs.

```php
// Easy tracking method (with curl)
$this->Piwik->doTrackPageView($page_title);
```

You can also use any method from the [PiwikTracker class](http://piwik.org/docs/tracking-api/#toc-two-tracking-methods-image-tracking-or-using-the-api):

```php
$this->Piwik->setCustomVariable(1, 'city', 'Chambéry');
$this->Piwik->setUrl($this->here);
$this->Piwik->doTrackPageView($page_title);
```

## License

	Copyright 2015 Etienne DEWAILLY (ED WEB Créations)

	Licensed under the Apache License, Version 2.0 (the "License");
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	   http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	imitations under the License. 