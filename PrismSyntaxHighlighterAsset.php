<?php

namespace alcea\yii2PrismSyntaxHighlighter;

use yii\web\AssetBundle as AssetBundle;
use yii;

/**
 * Class PrismSyntaxHighlighterAsset
 *
 * @package alcea\yii2PrismSyntaxHighlighter
 * @author  Niku Alcea <nicu(dotta)alcea(atta)gmail(dotta)com>
 * @license MIT License
 * @since 1.0
 * @see http://prismjs.com/download.html
 *
 * @property string $sourcePath
 * @property array $css
 * @property array $js
 * @property array $depends
 */
class PrismSyntaxHighlighterAsset extends AssetBundle
{
    public $sourcePath = '@yii2PrismSyntaxHighlighter/assets';
    public $css = [];
    public static $extraCss;
    public $js = [
        'components/prism-core.min.js',
    ];
    public static $extraJs = [];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * init
     */
    public function init()
    {
        Yii::setAlias('@yii2PrismSyntaxHighlighter', __DIR__);

        foreach (static::$extraCss as $css) {
            $this->css[] = $css;
        }

        foreach (static::$extraJs as $js) {
            $this->js[] = $js;
        }

        return parent::init();
    }

}