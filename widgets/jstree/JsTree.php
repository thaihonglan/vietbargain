<?php

/**
 * @copyright Copyright &copy; Thiago Talma, thiagomt.com, 2014
 * @package yii2-jstree
 * @version 1.0.0
 */

namespace app\widgets\jstree;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * JsTree widget is a Yii2 wrapper for the jsTree jQuery plugin.
 *
 * @author Thiago Talma <thiago@thiagomt.com>
 * @since 1.0
 * @see http://jstree.com
 */
class JsTree extends InputWidget
{
    /**
     * @var array Data configuration.
     * If left as false the HTML inside the jstree container element is used to populate the tree (that should be an unordered list with list items).
     */
    public $data = [];

    /**
     * @var array Stores all defaults for the core
     */
    public $core = [
        'expand_selected_onload' => true,
        'themes' => [
            'icons' => false
        ]
    ];

    /**
     * @var array Stores all defaults for the checkbox plugin
     */
    public $checkbox = [
        'three_state' => true,
        'keep_selected_style' => false];

    /**
     * @var array Stores all defaults for the contextmenu plugin
     */
    public $contextmenu = [];

    /**
     * @var array Stores all defaults for the drag'n'drop plugin
     */
    public $dnd = [];

    /**
     * @var array Stores all defaults for the search plugin
     */
    public $search = [];

    /**
     * @var string the settings function used to sort the nodes.
     * It is executed in the tree's context, accepts two nodes as arguments and should return `1` or `-1`.
     */
    public $sort = [];

    /**
     * @var array Stores all defaults for the state plugin
     */
    public $state = [];

    /**
     * @var array Configure which plugins will be active on an instance. Should be an array of strings, where each element is a plugin name.
     */
    public $plugins = ["checkbox"];

    /**
     * @var array Stores all defaults for the types plugin
     */
    public $types = [];

    public $bindChanged = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerAssets();

        echo Html::activeTextInput($this->model, $this->attribute, ['class' => 'hidden', 'value' => $this->value]);

        $this->options['id'] = 'jsTree_' . $this->options['id'];
        Html::addCssClass($this->options, "js_tree_{$this->attribute}");
        echo Html::tag('div', '', $this->options);
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        JsTreeAsset::register($view);

        $config = [
            'core' => array_merge(['data' => $this->data], $this->core),
            'checkbox' => $this->checkbox,
            'contextmenu' => $this->contextmenu,
            'dnd' => $this->dnd,
            'search' => $this->search,
            'sort' => $this->sort,
            'state' => $this->state,
            'plugins' => $this->plugins,
            'types' => $this->types
        ];
        $defaults = Json::encode($config);

        $inputId = Html::getInputId($this->model, $this->attribute);

        $bindChanged = '';
        if (!empty($this->bindChanged)) {
            foreach ($this->bindChanged as $bind) {
                $data = 'data.instance.get_node(data.selected[0]).'.$bind['attribute'];

                if (isset($bind['stringReplace'])) {
                    $data = '"'.$bind['stringReplace'].'".replace("{data}", '.$data.')';
                }

                $bindChanged .= '$("'.$bind['selector'].'").'.$bind['type'].'('.$data.');';
            }
        }

        $js = <<<SCRIPT
    $('#jsTree_{$this->options['id']}')
        .bind("loaded.jstree", function (event, data) {
                $("#{$inputId}").val(JSON.stringify(data.selected));
            })
        .bind("changed.jstree", function(e, data, x){
                $("#{$inputId}").val(JSON.stringify(data.selected));{$bindChanged}
        })
        .jstree({$defaults});
SCRIPT;
        $view->registerJs($js);
    }
}
