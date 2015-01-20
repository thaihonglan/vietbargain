<?php
namespace app\components;

/**
 * Module is the customized base module class.
 * All module classes for this application should extend from this base class.
 */
class Module extends \yii\base\Module
{
	/**
	 * Configures an object with the initial property values.
	 * @param object $object the object to be configured
	 * @param array $properties the property initial values given in terms of name-value pairs.
	 * @return object the object itself
	 */
	public static function configure($object, $properties, $key = null)
	{
		if (isset($properties['components'])) {
			$components = $object->components;
			foreach ($properties['components'] as $name => $value) {
				self::_arrayMerge($components[$name], $value);
			}
			$object->components = $components;
			unset($properties['components']);
		}

		foreach ($properties as $name => $value) {
			$object->$name = $value;
		}

		return $object;
	}

	private static function _arrayMerge(&$a, $b)
	{
		if (isset($b['recursive'])) {
			$recursive = $b['recursive'];
			unset($b['recursive']);
		} else {
			$recursive = false;
		}

		if (!$recursive) {
			$a = $b;
			return;
		}

		foreach ($b as $k => $v) {
			if (is_integer($k)) {
				if (isset($a[$k])) {
					$a[] = $v;
				} else {
					$a[$k] = $v;
				}
			} elseif (is_array($v) && isset($a[$k]) && is_array($a[$k])) {
				self::_arrayMerge($a[$k], $v);
			} else {
				$a[$k] = $v;
			}
		}
	}
}