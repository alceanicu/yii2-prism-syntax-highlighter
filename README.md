[![Latest Stable Version](https://poser.pugx.org/alcea/yii2-prism-syntax-highlighter/v/stable.svg)](https://packagist.org/packages/alcea/yii2-prism-syntax-highlighter) [![Total Downloads](https://poser.pugx.org/alcea/yii2-prism-syntax-highlighter/downloads.svg)](https://packagist.org/packages/alcea/yii2-prism-syntax-highlighter) [![Latest Unstable Version](https://poser.pugx.org/alcea/yii2-prism-syntax-highlighter/v/unstable.svg)](https://packagist.org/packages/alcea/yii2-prism-syntax-highlighter) [![License](https://poser.pugx.org/alcea/yii2-prism-syntax-highlighter/license.svg)](https://packagist.org/packages/alcea/yii2-prism-syntax-highlighter)

# YII2 Prism Syntax Highlighter
Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind. It’s used in thousands of websites, including some of those you visit daily.

#How to install?

### 1. Use composer
```php
composer require alcea/yii2-prism-syntax-highlighter "~1"
```

### 2. or, edit require section from composer.json
```
"alcea/yii2-prism-syntax-highlighter": "~1"
```

### 3. or, clone from GitHub
```
git clone https://github.com/alceanicu/yii2-prism-syntax-highlighter
```

#How to use?

```php
<?php

use alcea\yii2PrismSyntaxHighlighter\PrismSyntaxHighlighter;
 
PrismSyntaxHighlighter::widget([
    'theme' => PrismSyntaxHighlighter::THEME_DEFAULT,
    'languages' => ['php', 'php-extras', 'css'],
    'plugins' => ['copy-to-clipboard']
]);
 
echo Markdown::process($model->xxx, 'gfm-comment');
```

### PrismJs page http://prismjs.com/download.html
