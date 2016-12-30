<?php

namespace alcea\yii2PrismSyntaxHighlighter;

use yii\base\Widget as Widget;

/**
 * Class PrismSyntaxHighlighter
 *
 * @package alcea\yii2PrismSyntaxHighlighter
 * @author  Niku Alcea <nicu(dotta)alcea(atta)gmail(dotta)com>
 * @license MIT License
 * @since 1.0
 * @see http://prismjs.com/download.html
 *
 * @property string $theme
 * @property array $languages
 * @property array $plugins
 */
class PrismSyntaxHighlighter extends Widget
{
    const THEME_DEFAULT = 'prism';
    const THEME_DARK = 'prism-dark';
    const THEME_FUNKY = 'prism-funky';
    const THEME_OKAIDIA = 'prism-okaidia';
    const THEME_TWILIGHT = 'prism-twilight';
    const THEME_COY = 'prism-coy';
    const THEME_SOLARIZEDLIGHT = 'prism-solarizedlight';

    public $theme;
    public $languages = [];
    public $plugins = [];

    /**
     * Publishes the assets
     */
    public function publishAssets()
    {
        PrismSyntaxHighlighterAsset::register($this->getView());
    }

    /**
     * Run the widget
     */
    public function run()
    {
        // load components from components.js
        $string = file_get_contents(__DIR__ . '/assets/components.js');
        $string = trim($string);
        $string = strstr($string, '{');
        $string = substr($string, 0, -1);
        $componentsArray = json_decode($string, 1);

        // load css theme
        if (array_key_exists('themes', $componentsArray)) {
            $this->theme = array_key_exists($this->theme, $componentsArray['themes']) ? $this->theme : self::THEME_DEFAULT;
            PrismSyntaxHighlighterAsset::$extraCss[] = "themes/{$this->theme}.css";
        }

        // language loaded by default
        if (empty($this->languages)) {
            $this->languages['clike'] = 'clike';
            $this->languages['markup'] = 'markup';
            $this->languages['css'] = 'css';
            $this->languages['javascript'] = 'javascript';
            $this->languages['php'] = 'php';
            $this->languages['php-extras'] = 'php-extras';
        }

        foreach ($this->languages as $language) {
            if (array_key_exists($language, $componentsArray['languages'])) {
                if (array_key_exists('require', $componentsArray['languages'][$language])) {
                    $requireLang = $componentsArray['languages'][$language]['require'];
                    PrismSyntaxHighlighterAsset::$extraJs[$requireLang] = "components/prism-{$requireLang}.min.js";
                }
                PrismSyntaxHighlighterAsset::$extraJs[$language] = "components/prism-{$language}.min.js";
            }
        }

        // TODO - test for all plugins - http://prismjs.com/download.html
        if (!empty($this->plugins)) {
            foreach ($this->plugins as $plugin) {
                if (is_array($componentsArray['plugins']) && array_key_exists($plugin, $componentsArray['plugins'])) {
                    if (is_array($componentsArray['plugins'][$plugin]) && array_key_exists('require', $componentsArray['plugins'][$plugin])) {
                        $requirePlugin = $componentsArray['plugins'][$plugin]['require'];
                        PrismSyntaxHighlighterAsset::$extraJs[$requirePlugin] = "plugins/{$requirePlugin}/prism-{$requirePlugin}.min.js";
                        // css
                        if (!array_key_exists('noCss', $componentsArray['plugins'][$requirePlugin])) {
                            PrismSyntaxHighlighterAsset::$extraCss[$requirePlugin] = "plugins/{$requirePlugin}/prism-{$requirePlugin}.css";
                        }
                    }
                    PrismSyntaxHighlighterAsset::$extraCss[$plugin] = "plugins/{$plugin}/prism-{$plugin}.css";
                    PrismSyntaxHighlighterAsset::$extraJs[$plugin] = "plugins/{$plugin}/prism-{$plugin}.min.js";
                }
            }
        }

        $this->publishAssets();

        parent::run();
    }

}
